<?php

namespace App\Notifications;


use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Company;
use App\Models\Project;
use App\Models\GlobalSetting;

class ExternalFileSelfNotification extends BaseNotification
{
 
    protected $project, $name, $company;
    /**
     * Create a new notification instance.
     */
    public function __construct( $project, $company, $name)
    {
        $this->project = $project;
        $this->company = $company;
        $this->name = $name;
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
        $content = 'Please note' . $this->name . ' has uploaded files to above WO. Please take action. Thank you';
        $subject = $this->project->project_short_code.' ; '.$this->project->propertyDetails->property_address.' - Files Received Externally';
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