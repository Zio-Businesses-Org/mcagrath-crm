<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LoginController;

use App\Http\Controllers\RegisterController;

use App\Http\Controllers\PublicUrlController;
use App\Http\Controllers\OneTimeAgreeController;
use App\Http\Controllers\Payment\MollieController;
use App\Http\Controllers\Payment\PaypalController;
use App\Http\Controllers\Payment\SquareController;
use App\Http\Controllers\Payment\StripeController;
use App\Http\Controllers\Payment\PayfastController;
use App\Http\Controllers\Payment\PaystackController;
use App\Http\Controllers\Payment\RazorPayController;
use App\Http\Controllers\Payment\AuthorizeController;
use App\Http\Controllers\Payment\FlutterwaveController;
use App\Http\Controllers\Payment\StripeWebhookController;
use App\Http\Controllers\PublicLeadGdprController;
use App\Http\Controllers\PublicWorkOrderController;
use App\Http\Controllers\PublicWaiverFormController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PublicProjectFileController;
use App\Http\Controllers\PublicVendorEstimateController;

Route::get('/', function () {
    return redirect(route('login'));
});

Route::get('/invitation/{code}', [RegisterController::class, 'invitation'])->name('invitation');
Route::post('/invitation/accept-invite', [RegisterController::class, 'acceptInvite'])->name('accept_invite');



Route::get('/change-lang/{locale}', [HomeController::class, 'changeLang'])->name('front.changeLang');
Route::get('front/show-image', [HomeController::class, 'showImage'])->name('front.public.show_image');

Route::get('/invoice-stripe/stripe-modal/', [HomeController::class, 'stripeModal'])->name('front.stripe_modal');
Route::get('/invoice-paystack/paystack-modal/', [HomeController::class, 'paystackModal'])->name('front.paystack_modal');
Route::get('/invoice-flutterwave/flutterwave-modal/', [HomeController::class, 'flutterwaveModal'])->name('front.flutterwave_modal');
Route::get('/invoice-mollie/mollie-modal/', [HomeController::class, 'mollieModal'])->name('front.mollie_modal');
Route::get('/invoice-authorize/authorize-modal/', [HomeController::class, 'authorizeModal'])->name('front.authorize_modal');
Route::post('invoice-stripe/save-stripe-detail/', [HomeController::class, 'saveStripeDetail'])->name('front.save_stripe_detail');
Route::get('/invoice/download/{id}', [HomeController::class, 'downloadInvoice'])->name('front.invoice_download');
Route::post('/invoice-payment-failed/{invoiceId}', [HomeController::class, 'invoicePaymentfailed'])->name('front.invoice_payment_failed');

Route::get('/lead-form/{id}', [HomeController::class, 'leadForm'])->name('front.lead_form');
Route::post('/lead-form/leadStore', [HomeController::class, 'leadStore'])->name('front.lead_store');
Route::get('/ticket-form/{id}', [HomeController::class, 'ticketForm'])->name('front.ticket_form');
Route::post('/lead-form/ticket-store', [HomeController::class, 'ticketStore'])->name('front.ticket_store');

Route::post('/contract/sign/{id}', [PublicUrlController::class, 'contractSign'])->name('front.contract.sign');
Route::get('/contract/download/{id}', [PublicUrlController::class, 'contractDownload'])->name('front.contract.download');
Route::get('/check-env', [PublicUrlController::class, 'checkEnv'])->name('front.check-env');
// Estimate Public url

Route::post('/estimate/decline/{id}', [PublicUrlController::class, 'estimateDecline'])->name('front.estimate.decline');
Route::post('/estimate/accept/{id}', [PublicUrlController::class, 'estimateAccept'])->name('front.estimate.accept');
Route::get('/estimate/download/{id}', [PublicUrlController::class, 'estimateDownload'])->name('front.estimate.download');



Route::post('/gantt-chart-data/{id}', [HomeController::class, 'ganttData'])->name('front.gantt_data');
Route::get('/gantt-chart/{hash}', [HomeController::class, 'gantt'])->name('front.gantt');

Route::get('/task-board/load-more/{hash}', [HomeController::class, 'taskboardLoadMore'])->name('front.taskboard.load_more');



Route::post('/proposal-action/{id}', [HomeController::class, 'proposalActionStore'])->name('front.proposal_action');
Route::get('/proposal/download/{id}', [HomeController::class, 'downloadProposal'])->name('front.download_proposal');



Route::get('/consent/l/{hash}', [PublicLeadGdprController::class, 'consent'])->name('front.gdpr.consent');
Route::post('/consent/remove-lead-request', [PublicLeadGdprController::class, 'learemoveLeadRequestd'])->name('front.gdpr.remove_lead_request');
Route::post('/consent/l/update/{lead}', [PublicLeadGdprController::class, 'updateConsent'])->name('front.gdpr.consent.update');

// Socialite routes
Route::get('/redirect/{provider}', [LoginController::class, 'redirect'])->name('social_login');
Route::get('/callback/{provider}', [LoginController::class, 'callback'])->name('social_login_callback');
Route::post('check-email', [LoginController::class, 'checkEmail'])->name('check_email');
Route::post('check-code', [LoginController::class, 'checkCode'])->name('check_code');
Route::get('resend-code', [LoginController::class, 'resendCode'])->name('resend_code');

// Payment routes
Route::post('stripe/{invoiceId}', [StripeController::class, 'paymentWithStripe'])->name('stripe');
Route::post('stripe-public/{hash}', [StripeController::class, 'paymentWithStripePublic'])->name('stripe_public');

Route::post('paystack-public/{id}/{hash}', [PaystackController::class, 'paymentWithPaystackPublic'])->name('paystack_public');
Route::get('paystack/callback/{id}/{type}/{hash}', [PaystackController::class, 'handleGatewayCallback'])->name('paystack.callback');
Route::post('paystack-webhook/{hash}', [PaystackController::class, 'handleGatewayWebhook'])->name('paystack.webhook');
Route::get('paystack-webhook/{hash}', [PaystackController::class, 'getWebhook'])->name('get_paystack.webhook');

Route::post('flutterwave-public/{id}', [FlutterwaveController::class, 'paymentWithFlutterwavePublic'])->name('flutterwave_public');
Route::get('flutterwave/callback/{id}/{type}/{hash}', [FlutterwaveController::class, 'handleGatewayCallback'])->name('flutterwave.callback');
Route::post('flutterwave-webhook/{hash}', [FlutterwaveController::class, 'handleGatewayWebhook'])->name('flutterwave.webhook');
Route::get('flutterwave-webhook/{hash}', [FlutterwaveController::class, 'getWebhook'])->name('get_flutterwave.webhook');

Route::post('mollie-public/{id}/{hash}', [MollieController::class, 'paymentWithMolliePublic'])->name('mollie_public');
Route::get('mollie/callback/{id}/{type}/{hash}', [MollieController::class, 'handleGatewayCallback'])->name('mollie.callback');
Route::post('mollie-webhook/{hash}', [MollieController::class, 'handleGatewayWebhook'])->name('mollie.webhook');
Route::get('mollie-webhook/{hash}', [MollieController::class, 'getWebhook'])->name('get_mollie.webhook');

Route::post('payfast-public', [PayfastController::class, 'paymentWithPayfastPublic'])->name('payfast_public');
Route::get('payfast/callback/{id}/{type}/{status}', [PayfastController::class, 'handleGatewayCallback'])->name('payfast.callback');
Route::post('payfast-webhook/{hash}', [PayfastController::class, 'handleGatewayWebhook'])->name('payfast.webhook');
Route::get('payfast-webhook/{hash}', [PayfastController::class, 'getWebhook'])->name('get_payfast.webhook');

Route::post('authorize-public/{id}', [AuthorizeController::class, 'paymentWithAuthorizePublic'])->name('authorize_public');

Route::post('square-public', [SquareController::class, 'paymentWithSquarePublic'])->name('square_public');
Route::get('square/callback/{id}/{type}/{hash}', [SquareController::class, 'handleGatewayCallback'])->name('square.callback');
Route::post('square-webhook/{hash}', [SquareController::class, 'handleGatewayWebhook'])->name('square.webhook');

Route::post('pay-with-razorpay/{hash}', [RazorPayController::class, 'payWithRazorPay'])->name('pay_with_razorpay');
Route::post('razorpay-webhook/{hash}', [RazorPayController::class, 'handleGatewayWebhook'])->name('razorpay.webhook');
Route::get('razorpay-webhook/{hash}', [PaypalController::class, 'getWebhook'])->name('get_razorpay.webhook');

Route::get('paypal-public/{invoiceId}', [PaypalController::class, 'paymentWithpaypalPublic'])->name('paypal_public');
Route::get('paypal/{invoiceId}', [PaypalController::class, 'paymentWithpaypal'])->name('paypal');
Route::get('paypal', [PaypalController::class, 'getPaymentStatus'])->name('get_paypal_status');
Route::get('paypal-recurring', [PaypalController::class, 'payWithPaypalRecurring'])->name('paypal_recurring');

// Paypal IPN
Route::post('paypal-webhook/{hash}', [PaypalController::class, 'webhook'])->name('paypal.webhook');
Route::get('paypal-webhook/{hash}', [PaypalController::class, 'getWebhook'])->name('get_paypal.webhook');

// Stripe webhook
Route::get('/verify-webhook/{hash?}', [StripeWebhookController::class, 'getWebhook'])->name('get_stripe_webhook');
Route::post('/verify-webhook/{hash}', [StripeWebhookController::class, 'verifyStripeWebhook'])->name('stripe.webhook');

Route::post('setup-account', [RegisterController::class, 'setupAccount'])->name('setup_account');

// Get quill image uploaded
Route::get('quill-image/{image}', [ImageController::class, 'getImage'])->name('image.getImage');

// Cropper Model
Route::get('cropper/{element}', [ImageController::class, 'cropper'])->name('cropper');

// Sync user permissions
Route::get('sync-user-permissions', [HomeController::class, 'syncPermissions'])->name('sync_user_permissions');

Route::get('file/{type}/{path}', [FileController::class, 'getFile'])->name('file.getFile');

// SIGNED URLS ->middleware('signed')
Route::get('/proposal/{hash}', [HomeController::class, 'proposal'])->name('front.proposal')->middleware('signed');
Route::get('/contract/{hash}', [PublicUrlController::class, 'contractView'])->name('front.contract.show')->middleware('signed');
Route::get('/ota', [OneTimeAgreeController::class, 'OtaView'])->name('front.ota.show')->middleware('signed');
Route::get('/wo', [PublicWorkOrderController::class, 'WoView'])->name('front.wo.show')->middleware('signed');
Route::get('/download-contract', [OneTimeAgreeController::class, 'downloadPdf'])->name('front.ota.download')->middleware('signed');
Route::get('/external-file', [PublicProjectFileController::class, 'FileView'])->name('external.file.view')->middleware('signed');
Route::resource('external-file-upload', PublicProjectFileController::class);
Route::get('external-file/download/{id}', [PublicProjectFileController::class, 'download'])->name('external-file.download');

Route::get('/shared-files/{key}', [PublicProjectFileController::class, 'accessSharedFiles'])->name('shared.files.access')->middleware('signed');
Route::get('/downloadpdf', [PublicWorkOrderController::class, 'downloadPdf'])->name('front.wo.download')->middleware('signed');
Route::get('/waiver', [PublicWaiverFormController::class, 'WaiverView'])->name('front.waiver.show')->middleware('signed');
Route::post('/waiverstore', [PublicWaiverFormController::class, 'WaiverStore'])->name('front.waiver.store');
Route::get('/waiver/download/{id}', [PublicWaiverFormController::class, 'downloadPdf'])->name('front.waiver.download');
Route::get('/form-vendor', [OneTimeAgreeController::class, 'vendorfredirect'])->name('front.form.show');
Route::post('/vendor-store', [OneTimeAgreeController::class, 'vendorstore'])->name('front.vendor.save');
Route::post('/wostore', [PublicWorkOrderController::class, 'WoStore'])->name('front.wo.store');
Route::post('/changenotifystore', [PublicWorkOrderController::class, 'ChangeNotifyStore'])->name('front.wo.changenotifystore');
Route::get('/form-vendor-show', [OneTimeAgreeController::class, 'vendorformshow'])->name('front.formv.show');
Route::get('/estimate/{hash}', [PublicUrlController::class, 'estimateView'])->name('front.estimate.show')->middleware('signed');
Route::get('/invoice/{hash}', [HomeController::class, 'invoice'])->name('front.invoice')->middleware('signed');
Route::get('/task-board/{hash}', [HomeController::class, 'taskboard'])->name('front.taskboard');
Route::get('/task/{id}', [HomeController::class, 'taskDetail'])->name('front.task_detail');

//Locations

Route::get('counties/{state}', [LocationController::class, 'getCounties'])->name('locations.counties');
Route::get('cities/{county}', [LocationController::class, 'getCities'])->name('locations.cities');
Route::resource('locations', LocationController::class);

//Public Vendor Estimate
Route::get('vendor-estimates/generate', [PublicVendorEstimateController::class, 'generateDialog'])->name('vendor-estimates.generate');
Route::post('vendor-estimates/generate-link', [PublicVendorEstimateController::class, 'generateLink'])->name('vendor-estimates.generateLink');
Route::get('/external-expense', [PublicVendorEstimateController::class, 'ExpenseView'])->name('external.expense.view')->middleware('signed');
Route::post('vendor-estimates/store', [PublicVendorEstimateController::class, 'storeExternalEst'])->name('vendor-estimates.storeext');
Route::post('vendor-estimates/store-file', [PublicVendorEstimateController::class, 'storeExternalEstFiles'])->name('vendor-estimates.storeext.file');
Route::get('/estimate-download-pdf', [PublicVendorEstimateController::class, 'downloadPdf'])->name('front.vendorestimate.download')->middleware('signed');