<?php

namespace App\Notifications;


use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Company;

class WaiverFormSelfNotification extends BaseNotification
{
 
    protected $vendor;
    /**
     * Create a new notification instance.
     */
    public function __construct( $vendor)
    {
        $this->company = Company::find(1);
        $this->vendor = $vendor;
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
        $content = 'Please note ' . $this->vendor->vendor_name .' ; '. $this->vendor->id.' has accepted the Waiver Form. Please take action. Thank you';
        $subject = 'Waiver Form Accepted';
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