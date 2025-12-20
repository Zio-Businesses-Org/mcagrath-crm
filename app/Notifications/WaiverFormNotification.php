<?php

namespace App\Notifications;


use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Company;
use Illuminate\Support\Facades\Log;
use App\Models\GlobalSetting;

class WaiverFormNotification extends BaseNotification
{
    

    protected $vendor;
    /**
     * Create a new notification instance.
     */
    public function __construct($vendor)
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
        $url = url()->temporarySignedRoute('front.waiver.download', now()->addDays(GlobalSetting::SIGNED_ROUTE_EXPIRY),[
            'id'=>$this->vendor->id
        ]);
        $url = getDomainSpecificUrl($url, $this->company);
        $content = 'Thank you for accepting the Waiver Form. Click the download pdf below to get the copy.';


        return $build
            ->subject(__('Workers\' Compensation Waiver - Signed Copy'))
            ->markdown('mail.waiveremail', [
                'notifiableName'=>$this->vendor->vendor_name,
                'content'=>$content,
                'url' => $url,
                'themeColor' => $this->company->header_color,
                'actionText' => __('Download') . ' ' . __('PDF'),
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