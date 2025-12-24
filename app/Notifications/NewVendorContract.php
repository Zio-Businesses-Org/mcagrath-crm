<?php

namespace App\Notifications;


use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Company;
use App\Models\Vendor;
use Illuminate\Support\Facades\Log;
use App\Models\GlobalSetting;

class NewVendorContract extends BaseNotification
{
    

    protected $vendor;
    /**
     * Create a new notification instance.
     */
    public function __construct($id)
    {
        $this->company= Company::find(1);
        $this->vendor=Vendor::find($id);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
       
        return ['mail'];
        // $via = ['database'];

        // if ($notifiable->email_notifications && $notifiable->email != '') {
        //     array_push($via, 'mail');
        // }

        // return $via;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        // 
        
        $build = parent::build();
        $url = url()->temporarySignedRoute('front.ota.show', now()->addDays(GlobalSetting::SIGNED_ROUTE_EXPIRY),[
            'id'=>$this->vendor->id
        ]);
        $url = getDomainSpecificUrl($url, $this->company);


        return $build
            ->subject(__('Welcome to McGrath Consulting Contractor Network!'))
            ->markdown('mail.vendor_co', [
                'name'=>$this->vendor->vendor_name,
                'url' => $url,
                'themeColor' => $this->company->header_color,
                'actionText' => __('app.view') . ' ' . __('app.menu.contract'),
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