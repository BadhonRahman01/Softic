<?php

namespace App\Http\Controllers;

use App\Models\Subaffiliate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Transaction;

class SubaffiliateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subaffiliates = Subaffiliate::latest()->paginate(5);
        $total_commission = Transaction::where('subaffiliate_commission','!=', 'NULL')->sum('subaffiliate_commission');
        return view('subaffiliates.index',compact('subaffiliates','total_commission'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('subaffiliates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $subaffiliate = $request->validate([
            'name' => 'required',
            'email' =>  'required',
            'password' => 'required',
            'commission_money' => 'nullable',
            'promo' => 'required',
            'affiliate_id' => 'required',
        ]);
        $length = 10;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        $subaffiliate['promo'] = $randomString;
        $subaffiliate['password'] = Hash::make($request->password);


        Subaffiliate::create($subaffiliate);
     
        return redirect()->route('subaffiliates.index')
                        ->with('success','Sub-Affiliate created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subaffiliate $subaffiliate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subaffiliate $subaffiliate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subaffiliate $subaffiliate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subaffiliate $subaffiliate)
    {
        $subaffiliate->delete();
    
        return redirect()->route('subaffiliates.index')
                        ->with('success','Sub-affiliate deleted successfully');
    }
}
