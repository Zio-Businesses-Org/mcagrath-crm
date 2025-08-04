<?php

namespace App\Notifications;


use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Company;
use App\Models\ProjectVendor;
use App\Models\Project;
use App\Models\GlobalSetting;
use Illuminate\Support\Facades\Crypt;

class NewVendorWorkOrder extends BaseNotification
{
    

    protected $projectvendor,$projectid,$contractid,$vendorid,$urlest,$urlext;
    /**
     * Create a new notification instance.
     */
    public function __construct($vproid,$proid,$cid,$vid,$urlest,$urlext)
    {
        $this->company = Company::find(1);
        $this->projectvendor = $vproid;
        $this->projectid = $proid;
        $this->contractid = $cid;
        $this->vendorid = $vid;
        $this->urlest = $urlest;
        $this->urlext = $urlext;
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
            'projectvendor' => $this->projectvendor,
            'projectid' => $this->projectid,
            'contractid' => $this->contractid,
            'vendorid'=> $this->vendorid
        ];
    
        $encryptedData = $this->castAttributeAsEncryptedString('data', json_encode($data));
        
        $build = parent::build();
        $url = url()->temporarySignedRoute('front.wo.show', now()->addDays(GlobalSetting::SIGNED_ROUTE_EXPIRY),[
            'data' => $encryptedData,
        ]);
        $url = getDomainSpecificUrl($url, $this->company);

        $vpro = ProjectVendor::findOrFail($this->projectvendor);
        $pro = Project::with('propertyDetails')->findOrFail($this->projectid);
        $vpro->link=$url;
        $vpro->save();

        $content = __('Please note that the work order # ') . $pro->project_short_code .' for Property Address - '. $pro->propertyDetails->property_address .' has been assigned to you and please click below to review and "Accept/Reject" . If you have any questions, please call the office immediately.';

        return $build
            ->subject(__($pro->project_short_code .', '.$pro->propertyDetails->property_address))
            ->markdown('mail.email-workorder', [
                'content' => $content,
                'url' => $url,
                'themeColor' => $this->company->header_color,
                'phone'=> $this->company->company_phone,
                'actionText' => __('app.view') . ' ' . __('Work Order'),
                'notifiableName' => $vpro->vendor_name,
                'estlink' => $this->urlest,
                'extlink' => $this->urlext,
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