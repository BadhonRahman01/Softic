<?php

namespace App\Listeners;

use App\Events\MoneyAdded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Notification;
use App\Notifications\CommissionNotification;
use Illuminate\Http\Request;
use App\Models\Affiliate;
use App\Models\Subaffiliate;
use Mail;
use App\Mail\CommissionMail;

class SendCommissionNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(MoneyAdded $event): void
    {       
        if ($event->details['user_type'] == "Affiliate"){
            $aff = Affiliate::where('id', $event->details['aff_id'])->get();

            $details = [
                'greeting' => 'Hi '.$event->details['aff_name'],
                'body' => 'This notification from Softic.ai .You received commission '.$event->details['amount'].' from transaction of '.$event->details['user'].', User ID:'.$event->details['user_id'],
                'thanks' => 'Thank you for using Softic.ai!',
            ];
    
            Notification::send(($aff), new CommissionNotification($details));
        }else{
            $aff = Affiliate::where('id', $event->details['aff_id'])->get();
            $sub_aff = Subaffiliate::where('id', $event->details['subaff_id'])->get();

            $details = [
                'greeting' => 'Hi '.$aff[0]->name,
                'body' => 'This notification from Softic.ai .You received commission '.$event->details['aff_amount'].' from your Sub-Affiliate '.$event->details['subaff_name'].', Sub-affiliate ID:'.$event->details['subaff_id'],
                'thanks' => 'Thank you for using Softic.ai!',
            ];
            Notification::send(($aff), new CommissionNotification($details));
            $subdetails = [
                'greeting' => 'Hi '.$event->details['subaff_name'],
                'body' => 'This notification from Softic.ai .You received commission '.$event->details['sub_amount'].' from transaction of '.$event->details['user'].', User ID:'.$event->details['user_id'],
                'thanks' => 'Thank you for using Softic.ai!',
            ];
            Notification::send(($sub_aff), new CommissionNotification($subdetails));
        }

        // $aff->notify(new CommissionNotification($details));
        // \Mail::to($event->aff_email)->send(new CommissionMail($details));
    }
}
