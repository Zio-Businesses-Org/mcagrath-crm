<?php

namespace App\Http\Controllers;

use App\Helper\Reply;
use App\Http\Requests\Settings\UpdateOrganisationSettings;
use App\Traits\CurrencyExchange;
use App\Helper\Files;

class SettingsController extends AccountBaseController
{

    use CurrencyExchange;

    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'app.menu.accountSettings';
        $this->activeSettingMenu = 'company_settings';
        $this->middleware(function ($request, $next) {
            return user()->permission('manage_company_setting') !== 'all' ? redirect()->route('profile-settings.index') : $next($request);
        });
    }

    /**
     * XXXXXXXXXXX
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('company-settings.index', $this->data);
    }

    // phpcs:ignore
    public function update(UpdateOrganisationSettings $request, $id)
    {
        
        $setting = \company();
        $setting->company_name = $request->company_name;
        $setting->company_email = $request->company_email;
        $setting->company_phone = $request->company_phone;
        $setting->website = $request->website;
        if ($request->image_delete == 'yes') {
            Files::deleteFile($setting->company_sign, 'signature');
            $setting->company_sign = null;
        }

        if ($request->hasFile('image')) {
            Files::deleteFile($setting->company_sign, 'signature');
            $setting->company_sign = Files::uploadLocalOrS3($request->image, 'signature', 300);
        }
        $setting->save();

        return Reply::success(__('messages.updateSuccess'));
    }

    // Remove in v 5.2.5
    public function hideWebhookAlert()
    {
        $this->company->show_new_webhook_alert = false;
        $this->company->saveQuietly();
        session()->forget('company');

        return Reply::success('Webohook alert box has been removed permanently');
    }

}
