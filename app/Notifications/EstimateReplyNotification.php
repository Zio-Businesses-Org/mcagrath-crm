<?php

namespace App\Notifications;


use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Company;
use App\Models\vendor_estimates;
use App\Models\GlobalSetting;

class EstimateReplyNotification extends BaseNotification
{
    

    protected $estimate_id;
    /**
     * Create a new notification instance.
     */
    public function __construct($estimate)
    {
        $this->company = Company::find(1);
        $this->estimate_id = $estimate;
        // $this->pdfsent =  $pdfgenerated;
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
        
        $content = __('Please Click the download pdf below to get the copy');
        $subject = 'Estimate Copy';
        $build = parent::build();
        $vpro = vendor_estimates::findOrFail($this->estimate_id);
        $url = url()->temporarySignedRoute('front.vendorestimate.download', now()->addDays(GlobalSetting::SIGNED_ROUTE_EXPIRY),[
            'id' => $this->estimate_id,
        ]);
        $url = getDomainSpecificUrl($url, $this->company);
        return $build
            ->subject(__($subject))
            ->markdown('mail.email', [
                'content'=>$content,
                'url' => $url,
                'themeColor' => $this->company->header_color,
                'phone'=> $this->company->company_phone,
                'actionText' => __('Download') . ' ' . __('PDF'),
                'notifiableName' => $vpro->vendors->vendor_name,
            ]);
            // ->attachData($pdfPath, $filename, [
            //     'mime' => 'application/pdf',
            // ]);
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