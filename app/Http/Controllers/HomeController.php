<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Notification;
use App\Notifications\CommissionNotification;
use App\Models\Affiliate;
use App\Models\Subaffiliate;
use App\Models\User;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    // public function sendNotification()
    // {
    //     $user = User::first();

    //     $details = [
    //         'greeting' => 'Hi '.$user->name,
    //         'body' => 'This notification from Softic.ai .You received commission 100 from Transaction ID 12',
    //         'thanks' => 'Thank you for using Softic.ai!',
    //     ];
  
    //     Notification::send($user, new CommissionNotification($details));
    //     // $user->notify(new CommissionNotification($details));
    //     dd('done');
    // }
}
