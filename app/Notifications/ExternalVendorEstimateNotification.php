<?php

namespace App\Notifications;


use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Company;
use App\Models\vendor_estimates;
use App\Models\GlobalSetting;

class ExternalVendorEstimateNotification extends BaseNotification
{
    

    protected $estimate_id;
    /**
     * Create a new notification instance.
     */
    public function __construct($estimate)
    {
        $this->company = Company::find(1);
        $this->estimate_id = $estimate;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
       
        return ['mail'];
    }


    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        
        
        $build = parent::build();
        $vpro = vendor_estimates::findOrFail($this->estimate_id);
        $content = 'Please note '. $vpro->vendors->vendor_name.' has uploaded an estimate to above WO. Please take action. Thank you.';
        $subject = $vpro->project->project_short_code.' ; '.$vpro->project->propertyDetails->property_address.' - Bid Submitted';
        return $build
            ->subject(__($subject))
            ->markdown('mail.email', [
                'content'=>$content,
                'themeColor' => $this->company->header_color,
                'phone'=> $this->company->company_phone,
                'notifiableName' => '',
            ]);

    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

}