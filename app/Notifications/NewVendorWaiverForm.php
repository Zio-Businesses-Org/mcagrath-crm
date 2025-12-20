<?php

namespace App\Notifications;


use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Company;
use App\Models\VendorContract;
use App\Models\VendorWaiverFormTemplate;
use App\Models\GlobalSetting;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class NewVendorWaiverForm extends BaseNotification
{
    

    protected $vendorid;
    /**
     * Create a new notification instance.
     */
    public function __construct($vid)
    {
        $this->company = Company::find(1);
        $this->vendorid = $vid;
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

    protected function castAttributeAsEncryptedString($key, $value)
    {
        return Crypt::encryptString($value);
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        $data = [
            'vendorid'=> $this->vendorid
        ];
    
        $encryptedData = $this->castAttributeAsEncryptedString('data', json_encode($data));
        
        $build = parent::build();
        $url = url()->temporarySignedRoute('front.waiver.show', now()->addDays(GlobalSetting::SIGNED_ROUTE_EXPIRY),[
            'data' => $encryptedData,
        ]);
        $url = getDomainSpecificUrl($url, $this->company);

        $wvendor = VendorContract::findOrFail($this->vendorid);
        $wvendor->waiver_form_status='Pending';
        $wvendor->form_sent_date=date("Y-m-d");
        $wvendor->waiver_signed_date=null;
        $wvendor->save();
        $content = __('Please review the document and click Accept. If you have any questions or need clarification, feel free to contact office.') . '<br>';

        return $build
            ->subject(__('Workers\' Compensation Waiver - Signature Required'))
            ->markdown('mail.waiveremail', [
                'content' => $content,
                'url' => $url,
                'themeColor' => $this->company->header_color,
                'actionText' => __('app.view') . ' ' . __('Waiver Form'),
                'notifiableName' => $wvendor->vendor_name,
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