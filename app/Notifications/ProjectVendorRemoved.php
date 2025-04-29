<?php

namespace App\Notifications;


use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Company;
use App\Models\ProjectVendor;
use Illuminate\Support\Facades\Log;
use App\Models\GlobalSetting;

class ProjectVendorRemoved extends BaseNotification
{
    

    protected $vendor;
    /**
     * Create a new notification instance.
     */
    public function __construct($id)
    {
        $this->company= Company::find(1);
        $this->vendor=ProjectVendor::find($id);
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
        $build = parent::build();
        $content = __('Please note that the work order # ') . $this->vendor->project->project_short_code .' for Property Address - '. $this->vendor->project->propertyDetails->property_address .' has been re-assigned or cancelled with you. If you have any questions, please call the office immediately';
        $subject = $this->vendor->project->project_short_code . 'and Cancellation Notice' ;
        return $build
            ->subject($subject)
            ->markdown('mail.removed', [
                'content' => $content,
                'notifiableName'=>$this->vendor->vendor_name,
                'themeColor' => $this->company->header_color,
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