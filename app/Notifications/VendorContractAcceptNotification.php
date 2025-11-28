<?php

namespace App\Notifications;


use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Company;
use Illuminate\Support\Facades\Log;
use App\Models\GlobalSetting;

class VendorContractAcceptNotification extends BaseNotification
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
        $url = url()->temporarySignedRoute('front.ota.download', now()->addDays(GlobalSetting::SIGNED_ROUTE_EXPIRY),[
            'id'=>$this->vendor->id
        ]);
        $url = getDomainSpecificUrl($url, $this->company);
        $content = <<<HTML
                        Thank you for completing the onboarding application and you have successfully added your vendor profile with McGrath Consulting LLC. We look forward to doing business with you.
                        <br/><br/>
                        Gentle Reminder for the below:
                        <br/>
                        Document Required
                        <br/>
                        Please email the following documents to vendors@mcresi.com:
                        <br/>
                        - <strong>Contractor or Business license copy</strong>
                        <br/>
                        - <strong>Certificate of Insurance</strong>: The email should be sent by your insurance agent directly to COI@mcresi.com with us added as Certificate Holder – “McGrath Consulting, 6 Melissa Dr, Barnegat, NJ 08005” and to mention under Description of Operations – “McGrath Consulting is added as an additional insured.”
                        <br/>
                        - <strong>Workers Compensation</strong>: (If exempted, the letter of exemption)
                        <br/>
                        - <strong>W9</strong>
                        <br/><br/>

                        <strong>Upcoming Projects:</strong>
                        <br/>
                        We will be reaching out to you shortly with details on your first project with us. Please review the project scope and deadlines, and let us know if you have any questions or need additional information.
                        <br/><br/>

                        <strong>Communication:</strong>
                        <br/>
                        For any questions or support, please do not hesitate to contact us. We are here to assist you with any queries you may have.
                        <br/><br/>

                        Once again, welcome to the team! We are excited to work with you and look forward to achieving great things together.
                        HTML;


        return $build
            ->subject(__('Welcome To McGrath Consulting LLC Network'))
            ->markdown('mail.email', [
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