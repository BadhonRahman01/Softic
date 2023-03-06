<?php

namespace App\Http\Controllers;

use App\Models\Affiliate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AffiliateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $affiliates = Affiliate::latest()->paginate(5);
    
        return view('affiliates.index',compact('affiliates'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('affiliates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $affiliate = $request->validate([
            'name' => 'required',
            'email' =>  'required',
            'password' => 'required',
            'commission_money' => 'nullable',
            'promo' => 'required',
        ]);
        $length = 10;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        $affiliate['promo'] = $randomString;
        $affiliate['password'] = Hash::make($request->password);


        Affiliate::create($affiliate);
     
        return redirect()->route('affiliates.index')
                        ->with('success','Affiliate created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Affiliate $affiliate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Affiliate $affiliate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Affiliate $affiliate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Affiliate $affiliate)
    {
        $affiliate->delete();
    
        return redirect()->route('affiliates.index')
                        ->with('success','Affiliate deleted successfully');
    }

}
