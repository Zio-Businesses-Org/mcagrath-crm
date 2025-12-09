<?php

/* Setting menu routes starts from here */
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\AppSettingController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\TicketTypeController;
use App\Http\Controllers\CustomFieldController;
use App\Http\Controllers\LeadSettingController;
use App\Http\Controllers\SmtpSettingController;
use App\Http\Controllers\TaskSettingController;
use App\Http\Controllers\TicketAgentController;
use App\Http\Controllers\TicketGroupController;
use App\Http\Controllers\CustomModuleController;
use App\Http\Controllers\LeaveSettingController;
use App\Http\Controllers\SlackSettingController;
use App\Http\Controllers\ThemeSettingController;
use App\Http\Controllers\TwoFASettingController;
use App\Http\Controllers\EmployeeShiftController;
use App\Http\Controllers\ModuleSettingController;
use App\Http\Controllers\TicketChannelController;
use App\Http\Controllers\TicketSettingController;
use App\Http\Controllers\InvoiceSettingController;
use App\Http\Controllers\MessageSettingController;
use App\Http\Controllers\ProfileSettingController;
use App\Http\Controllers\ProjectSettingController;
use App\Http\Controllers\PusherSettingsController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\StorageSettingController;
use App\Http\Controllers\TimeLogSettingController;
use App\Http\Controllers\BusinessAddressController;
use App\Http\Controllers\CurrencySettingController;
use App\Http\Controllers\LanguageSettingController;
use App\Http\Controllers\SecuritySettingController;
use App\Http\Controllers\LeadAgentSettingController;
use App\Http\Controllers\PushNotificationController;
use App\Http\Controllers\AttendanceSettingController;
use App\Http\Controllers\ContractSettingController;
use App\Http\Controllers\CustomLinkSettingController;
use App\Http\Controllers\LeadSourceSettingController;
use App\Http\Controllers\SocialAuthSettingController;
use App\Http\Controllers\TicketEmailSettingController;
use App\Http\Controllers\TicketReplyTemplatesController;
use App\Http\Controllers\DatabaseBackupSettingController;
use App\Http\Controllers\GoogleCalendarSettingController;
use App\Http\Controllers\LeadPipelineSettingController;
use App\Http\Controllers\LeadStageSettingController;
use App\Http\Controllers\OfflinePaymentSettingController;
use App\Http\Controllers\PaymentGatewayCredentialController;
use App\Http\Controllers\NotificationSettingController;
use App\Http\Controllers\QuickbookSettingsController;
use App\Http\Controllers\SignUpSettingController;
use App\Http\Controllers\TaxSettingController;
use App\Http\Controllers\UnitTypeController;
use App\Http\Controllers\UpdateAppController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\VendorSettingsController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth', 'prefix' => 'account/settings'], function () {

    Route::post('app-settings/deleteSessions', [AppSettingController::class, 'deleteSessions'])->name('app-settings.delete_sessions');
    Route::resource('app-settings', AppSettingController::class);
    Route::resource('profile-settings', ProfileSettingController::class);
    
    /* 2FA */
    Route::get('2fa-codes-download', [TwoFASettingController::class, 'download'])->name('2fa_codes_download');
    Route::get('verify-2fa-password', [TwoFASettingController::class, 'verify'])->name('verify_2fa_password');
    Route::get('2fa-confirm', [TwoFASettingController::class, 'showConfirm'])->name('two-fa-settings.validate_confirm');
    Route::post('2fa-confirm', [TwoFASettingController::class, 'confirm'])->name('two-fa-settings.confirm');
    Route::get('2fa-email-confirm', [TwoFASettingController::class, 'showEmailConfirm'])->name('two-fa-settings.validate_email_confirm');
    Route::post('2fa-email-confirm', [TwoFASettingController::class, 'emailConfirm'])->name('two-fa-settings.email_confirm');
    Route::resource('two-fa-settings', TwoFASettingController::class);

    Route::post('profile/dark-theme', [ProfileController::class, 'darkTheme'])->name('profile.dark_theme');
    Route::post('profile/updateOneSignalId', [ProfileController::class, 'updateOneSignalId'])->name('profile.update_onesignal_id');
    Route::resource('profile', ProfileController::class);

    Route::get('smtp-settings/show-send-test-mail-modal', [SmtpSettingController::class, 'showTestEmailModal'])->name('smtp_settings.show_send_test_mail_modal');
    Route::get('smtp-settings/send-test-mail', [SmtpSettingController::class, 'sendTestEmail'])->name('smtp_settings.send_test_mail');

    Route::get('slack-settings/send-test-notification', [SlackSettingController::class, 'sendTestNotification'])->name('slack_settings.send_test_notification');

    Route::get('push-notification-settings/send-test-notification', [PushNotificationController::class, 'sendTestNotification'])->name('push_notification_settings.send_test_notification');

    Route::resource('smtp-settings', SmtpSettingController::class);
    Route::resource('notifications', NotificationSettingController::class);
    Route::resource('slack-settings', SlackSettingController::class);
    Route::resource('push-notification-settings', PushNotificationController::class);
    Route::resource('pusher-settings', PusherSettingsController::class);

    // Currency Settings routes
    Route::get('currency-settings/update/exchange-rates', [CurrencySettingController::class, 'updateExchangeRate'])->name('currency_settings.update_exchange_rates');

    /* Start Currency Settings routes */
    Route::get('currency-settings/exchange-key', [CurrencySettingController::class, 'currencyExchangeKey'])->name('currency_settings.exchange_key');
    Route::post('currency-settings/exchange-key-store', [CurrencySettingController::class, 'currencyExchangeKeyStore'])->name('currency_settings.exchange_key_store');
    Route::get('currency-settings/exchange-rate/{currency}', [CurrencySettingController::class, 'exchangeRate'])->name('currency_settings.exchange_rate');

    Route::get('currency-settings/update-currency-format', [CurrencySettingController::class, 'updateCurrencyFormat'])->name('currency_settings.update_currency_format');
    Route::resource('currency-settings', CurrencySettingController::class);
    Route::resource('payment-gateway-settings', PaymentGatewayCredentialController::class);
    /* End Currency Settings routes */

    Route::resource('offline-payment-setting', OfflinePaymentSettingController::class);

    /* Invoice Setting Routes */
    Route::post('invoice-settings/update-template/{id}', [InvoiceSettingController::class, 'updateTemplate'])->name('invoice_settings.update_template');
    Route::post('invoice-settings/update-prefix/{id}', [InvoiceSettingController::class, 'updatePrefix'])->name('invoice_settings.update_prefix');
    Route::resource('invoice-settings', InvoiceSettingController::class);

    /* unitType */
    Route::resource('unit-type', UnitTypeController::class);
    Route::post('unit-types/set-default', [UnitTypeController::class, 'setDefaultUnit'])->name('unit-type.set_default');

    /* Start Ticket settings routes */
    Route::post('ticket-agents/update-group/{id}', [TicketAgentController::class, 'updateGroup'])->name('ticket_agents.update_group');
    Route::resource('ticket-agents', TicketAgentController::class);
    Route::get('agent-groups', [TicketAgentController::class, 'agentGroups'])->name('ticket_agents.agent_groups');

    Route::resource('ticket-settings', TicketSettingController::class);
    Route::resource('ticket-groups', TicketGroupController::class);
    Route::resource('ticketTypes', TicketTypeController::class);
    Route::resource('ticketChannels', TicketChannelController::class);
    Route::resource('ticket-email-settings', TicketEmailSettingController::class);

    Route::get('replyTemplates/fetch-template', [TicketReplyTemplatesController::class, 'fetchTemplate'])->name('replyTemplates.fetchTemplate');
    Route::resource('replyTemplates', TicketReplyTemplatesController::class);
    /* End Ticket settings routes */
    Route::get('project-settings/create-category', [ProjectSettingController::class, 'createCategory'])->name('project-settings.createCategory');
    Route::get('project-settings/create-subcategory', [ProjectSettingController::class, 'createSubCategory'])->name('project-settings.createSubCategory');
    Route::get('project-settings/create-type', [ProjectSettingController::class, 'createType'])->name('project-settings.createType');
    Route::get('project-settings/create-priority', [ProjectSettingController::class, 'createPriority'])->name('project-settings.createPriority');
    Route::get('project-settings/create-delayedby', [ProjectSettingController::class, 'createDelayedBy'])->name('project-settings.createDelayedBy');
    Route::get('project-settings/create-property-type', [ProjectSettingController::class, 'createPropertyType'])->name('project-settings.createPropertyType');
    Route::get('project-settings/create-occupancy-status', [ProjectSettingController::class, 'createOccupancyStatus'])->name('project-settings.createOccupancyStatus');
    Route::get('project-settings/create-contractor-type', [ProjectSettingController::class, 'createContractorType'])->name('project-settings.createContractorType');
    Route::get('project-settings/create-cancelled-reason', [ProjectSettingController::class, 'createCancelledReason'])->name('project-settings.createCancelledReason');
    Route::get('project-settings/create-file-type', [ProjectSettingController::class, 'createFileType'])->name('project-settings.createFileType');
    Route::get('project-settings/import-subcategory', [ProjectSettingController::class, 'importSubCategory'])->name('project-settings.importSubCategory');
    Route::post('project-settings/save-project-category', [ProjectSettingController::class, 'saveProjectCategory'])->name('project-settings.saveProjectCategory');
    Route::post('project-settings/save-project-subcategory', [ProjectSettingController::class, 'saveProjectSubCategory'])->name('project-settings.saveProjectSubCategory');
    Route::post('project-settings/save-project-type', [ProjectSettingController::class, 'saveProjectType'])->name('project-settings.saveProjectType');
    Route::post('project-settings/save-project-priority', [ProjectSettingController::class, 'saveProjectPriority'])->name('project-settings.saveProjectPriority');
    Route::post('project-settings/save-property-type', [ProjectSettingController::class, 'savePropertyType'])->name('project-settings.savePropertyType');
    Route::post('project-settings/save-occupancy-status', [ProjectSettingController::class, 'saveOccupancyStatus'])->name('project-settings.saveOccupancyStatus');
    Route::post('project-settings/save-delayed-by', [ProjectSettingController::class, 'saveDelayedBy'])->name('project-settings.saveDelayedBy');
    Route::post('project-settings/save-contractor-type', [ProjectSettingController::class, 'saveContractorType'])->name('project-settings.saveContractorType');
    Route::post('project-settings/save-cancelled-reason', [ProjectSettingController::class, 'saveCancelledReason'])->name('project-settings.saveCancelledReason');
    Route::post('project-settings/save-file-type', [ProjectSettingController::class, 'saveFileType'])->name('project-settings.saveFileType');
    Route::resource('project-settings', ProjectSettingController::class);
    Route::post('project-settings/{id?}', [ProjectSettingController::class, 'statusUpdate'])->name('project-settings.statusUpdate');
    Route::put('project-settings/change-status/{id?}', [ProjectSettingController::class, 'changeStatus'])->name('project-settings.changeStatus');
    Route::post('project-settings/set-default/{id?}', [ProjectSettingController::class, 'setDefault'])->name('project-settings.setDefault');
    // Route::get('check-qr-login', [AttendanceSettingController::class, 'qrClockInOut'])->name('settings.qr-login');
    // Route::post('change-qr-code-status', [AttendanceSettingController::class, 'qrCodeStatus'])->name('settings.change-qr-code-status');

    Route::resource('attendance-settings', AttendanceSettingController::class);


    Route::resource('leaves-settings', LeaveSettingController::class);
    Route::post('leaves-settings/change-permission', [LeaveSettingController::class, 'changePermission'])->name('leaves-settings.changePermission');

    // LeaveType Resource
    Route::resource('leaveType', LeaveTypeController::class);

    // Custom Fields Settings
    Route::resource('custom-fields', CustomFieldController::class);

    // Tax Settings
    Route::resource('taxes', TaxSettingController::class);

    // Message settings
    Route::resource('message-settings', MessageSettingController::class);

    // Storage settings
    Route::get('storage-settings/aws-local-to-aws-modal', [StorageSettingController::class, 'awsLocalToAwsModal'])->name('storage-settings.aws_local_to_aws_modal');
    Route::post('storage-settings/aws-local-to-aws', [StorageSettingController::class, 'moveFilesLocalToAwsS3'])->name('storage-settings.aws_local_to_aws');
    Route::get('storage-settings/storage-test-modal/{type}', [StorageSettingController::class, 'awsTestModal'])->name('storage-settings.aws_test_modal');
    Route::post('storage-settings/aws-test', [StorageSettingController::class, 'awsTest'])->name('storage-settings.aws_test');
    Route::resource('storage-settings', StorageSettingController::class);

    // Language settings
    Route::get('language-settings/auto-translate', [LanguageSettingController::class, 'autoTranslate'])->name('language_settings.auto_translate');
    Route::post('language-settings/auto-translate', [LanguageSettingController::class, 'autoTranslateUpdate'])->name('language_settings.auto_translate_update');
    Route::post('language-settings/update-data/{id?}', [LanguageSettingController::class, 'updateData'])->name('language_settings.update_data');
    Route::post('language-settings/fix-translation', [LanguageSettingController::class, 'fixTranslation'])->name('language_settings.fix_translation');
    Route::post('language-settings/create-en-locale', [LanguageSettingController::class, 'createEnLocale'])->name('language_settings.create_en_locale');
    Route::resource('language-settings', LanguageSettingController::class);

    // Task Settings
    Route::resource('task-settings', TaskSettingController::class, ['only' => ['index', 'store']]);

    // Time Log Settings
    Route::resource('timelog-settings', TimeLogSettingController::class);

    // Social Auth Settings
    Route::resource('social-auth-settings', SocialAuthSettingController::class, ['only' => ['index', 'update']]);

    /* Lead Settings */
    Route::resource('lead-settings', LeadSettingController::class);
    Route::post('lead-settings-status/update-status/{companyId}', [LeadSettingController::class, 'updateLeadSettingStatus'])->name('lead-setting.update_status');
    Route::resource('lead-source-settings', LeadSourceSettingController::class);

    Route::get('lead-stage-update/{statusId}', [LeadStageSettingController::class, 'statusUpdate'])->name('lead-stage-setting.stageUpdate');
    Route::resource('lead-stage-setting', LeadStageSettingController::class);

    Route::get('lead-pipeline-update/{statusId}', [LeadPipelineSettingController::class, 'statusUpdate'])->name('lead-pipeline-update.stageUpdate');
    Route::resource('lead-pipeline-setting', LeadPipelineSettingController::class);

    Route::resource('lead-agent-settings', LeadAgentSettingController::class);
    Route::post('lead-agent-settings/update-category/{id}', [LeadAgentSettingController::class, 'updateCategory'])->name('lead_agents.update_category');
    Route::post('lead-agent-settings/update-status/{id}', [LeadAgentSettingController::class, 'updateStatus'])->name('lead_agents.update_status');
    Route::get('agent-category', [LeadAgentSettingController::class, 'agentCategories'])->name('lead_agent.categories');

    /* Contract Setting */
    Route::resource('contract-settings', ContractSettingController::class);

    // Security Settings
    Route::get('verify-google-recaptcha-v3', [SecuritySettingController::class, 'verify'])->name('verify_google_recaptcha_v3');
    Route::resource('security-settings', SecuritySettingController::class);

    // Google Calendar Settings
    Route::resource('google-calendar-settings', GoogleCalendarSettingController::class);
    Route::get('google-auth', [GoogleAuthController::class, 'index'])->name('googleAuth');
    Route::delete('google-auth', [GoogleAuthController::class, 'destroy'])->name('googleAuth.destroy');


    // Database Backup Settings
    Route::get('database-backup-settings/create-backup', [DatabaseBackupSettingController::class, 'createBackup'])->name('database-backup-settings.create_backup');
    Route::get('database-backup-settings/download/{file_name}', [DatabaseBackupSettingController::class, 'download'])->name('database-backup-settings.download');
    Route::get('database-backup-settings/delete/{file_name}', [DatabaseBackupSettingController::class, 'delete'])->name('database-backup-settings.delete');
    Route::resource('database-backup-settings', DatabaseBackupSettingController::class);

    // Role Permissions
    Route::post('role-permission/storeRole', [RolePermissionController::class, 'storeRole'])->name('role-permissions.store_role');
    Route::post('role-permission/deleteRole', [RolePermissionController::class, 'deleteRole'])->name('role-permissions.delete_role');
    Route::post('role-permissions/permissions', [RolePermissionController::class, 'permissions'])->name('role-permissions.permissions');
    Route::post('role-permissions/customPermissions', [RolePermissionController::class, 'customPermissions'])->name('role-permissions.custom_permissions');
    Route::post('role-permissions/reset-permissions', [RolePermissionController::class, 'resetPermissions'])->name('role-permissions.reset_permissions');
    Route::resource('role-permissions', RolePermissionController::class);

    // Theme settings
    Route::resource('theme-settings', ThemeSettingController::class);

    // Module settings
    Route::resource('module-settings', ModuleSettingController::class);

    // Custom Modules
    Route::post('custom-modules/verify-purchase', [CustomModuleController::class, 'verifyingModulePurchase'])->name('custom-modules.verify_purchase');
    Route::resource('custom-modules', CustomModuleController::class);

    Route::post('business-address/set-default', [BusinessAddressController::class, 'setDefaultAddress'])->name('business-address.set_default');
    Route::resource('business-address', BusinessAddressController::class);

    Route::post('employee-shifts/set-default', [EmployeeShiftController::class, 'setDefaultShift'])->name('employee-shifts.set_default');
    Route::resource('employee-shifts', EmployeeShiftController::class);

    Route::resource('quickbooks-settings', QuickbookSettingsController::class);

    Route::resource('custom-link-settings', CustomLinkSettingController::class);

    Route::resource('sign-up-settings', SignUpSettingController::class)->only(['index', 'update']);

    //app-location settings

    Route::get('location/import-Location', [LocationController::class, 'importLocation'])->name('location.importLocation');
    Route::post('location/import-store-Location', [LocationController::class, 'importStore'])->name('location.importStore');
    Route::get('location/get-locations', [AppSettingController::class, 'getLocations'])->name('locations.getLocations');

    //vendor-settings
    
    Route::get('vendor-settings/create-workorder-status', [VendorSettingsController::class, 'createWorkOrderStatus'])->name('vendor-settings.createWorkOrderStatus');
    Route::post('vendor-settings/save-workorder-status', [VendorSettingsController::class, 'saveWorkOrderStatus'])->name('vendor-settings.saveWorkOrderStatus');
    Route::get('vendor-settings/create-sow-title', [VendorSettingsController::class, 'createSOWTitle'])->name('vendor-settings.createSOWTitle');
    Route::post('vendor-settings/save-sow-title', [VendorSettingsController::class, 'saveSOWTitle'])->name('vendor-settings.saveSOWTitle');
    Route::post('vendor-settings/self-notify-mail', [VendorSettingsController::class, 'saveSelfNotifyMail'])->name('vendor-settings.saveSelfNotifyMail');
    Route::post('vendor-settings/toggle-duplicate-entry', [VendorSettingsController::class, 'toggleDuplicateEntry'])->name('vendor-settings.toggleDuplicateEntry');
    Route::resource('vendor-settings', VendorSettingsController::class);
});

Route::group(['middleware' => 'auth', 'prefix' => 'account'], function () {

    Route::resource('company-settings', SettingsController::class)->only(['edit', 'update', 'index', 'change_language']);

    // Update App
    Route::post('update-settings/deleteFile', [UpdateAppController::class, 'deleteFile'])->name('update-settings.deleteFile');
    Route::get('update-settings/install', [UpdateAppController::class, 'install'])->name('update-settings.install');
    Route::resource('update-settings', UpdateAppController::class);
});
