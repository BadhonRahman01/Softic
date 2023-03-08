<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Affiliate;
use App\Models\Subaffiliate;
use App\Events\MoneyAdded;
use Event;
use Notification;
use App\Notifications\CommissionNotification;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::latest()->paginate(5);
    
        return view('transactions.index',compact('transactions'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transactions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   $user = User::find($request->user_id);
        if($user->money == null){
            $user->money = $request->amount; 
        }else{
            $user->money = $user->money + $request->amount; 
        }
        $user->save(); 
        
        if($user->promo_code == null){
            $request->validate([
                'amount' => 'required',
                'user_id' =>  'required',
                'affilate_commission' => 'nullable',
                'subaffiliate_commission' => 'nullable',
            ]);
            Transaction::create($request->all());
     
        return redirect()->back()
                        ->with('success','Money Added successfully.');
        }else{
            $transaction = $request->validate([
                'amount' => 'required',
                'user_id' =>  'required',
                'affilate_commission' => 'nullable',
                'subaffiliate_commission' => 'nullable',
            ]);
            $aff = Affiliate::where('promo', $user->promo_code)->get();

            $subaff = Subaffiliate::where('promo', $user->promo_code)->get();
            

            if(isset($aff[0]->promo)){
                $transaction['affilate_commission'] = ($transaction['amount']*30)/100;
                            // event_calling MoneyAdded
                            $cdata = ['user_type' => 'Affiliate',
                            'aff_id' => $aff[0]->id,
                            'aff_name' => $aff[0]->name,
                            'aff_email' => $aff[0]->email,
                         'user_id' => $user->id,
                          'user' => $user->name, 
                          'amount' => $transaction['affilate_commission'], 
                          'date' => date(now())];
                        event(new MoneyAdded($cdata));
                        $affiliate = Affiliate::find($aff[0]->id); 
                        if($affiliate->commission_money == null){
                            $affiliate->commission_money =  $transaction['affilate_commission']; 
                        }else{
                            $affiliate->commission_money = $affiliate->commission_money + $transaction['affilate_commission']; 
                        }
                        $affiliate->save(); 

                Transaction::create($transaction);


                return redirect()->back()
                                ->with('success','Money Added successfully.');
            }else{
                $transaction['affilate_commission'] = ($transaction['amount']*10)/100;
                $transaction['subaffiliate_commission'] = ($transaction['amount']*20)/100;
                            // event_calling MoneyAdded
                            $cdata = ['user_type' => 'Sub-Affiliate',
                            'aff_id' => $subaff[0]->affiliate_id,
                            'subaff_id' => $subaff[0]->id,
                            'subaff_name' => $subaff[0]->name,
                            'subaff_email' => $subaff[0]->email,
                         'user_id' => $user->id,
                          'user' => $user->name, 
                          'aff_amount' => $transaction['affilate_commission'], 
                          'sub_amount' => $transaction['subaffiliate_commission'], 
                          'date' => date(now())];
                        event(new MoneyAdded($cdata));
                        $affiliate = Affiliate::find($subaff[0]->affiliate_id); 
                        if($affiliate->commission_money == null){
                            $affiliate->commission_money =  $transaction['affilate_commission']; 
                        }else{
                            $affiliate->commission_money = $affiliate->commission_money + $transaction['affilate_commission']; 
                        }
                        $affiliate->save(); 
                        $subaffiliate = Subaffiliate::find($subaff[0]->id); 
                        if($subaffiliate->commission_money == null){
                            $subaffiliate->commission_money = $transaction['subaffiliate_commission']; 
                        }else{
                            $subaffiliate->commission_money = $subaffiliate->commission_money+ $transaction['subaffiliate_commission']; 
                        }
                        $subaffiliate->save(); 
                        
                        
                Transaction::create($transaction);
     
                return redirect()->back()
                                ->with('success','Money Added successfully.');
            }

        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
