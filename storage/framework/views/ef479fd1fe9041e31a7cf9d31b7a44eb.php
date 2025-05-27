<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?php echo e(asset('vendor/css/all.min.css')); ?>">

    <!-- Simple Line Icons -->
    <link rel="stylesheet" href="<?php echo e(asset('vendor/css/simple-line-icons.css')); ?>">

    <!-- Template CSS -->
    <link type="text/css" rel="stylesheet" media="all" href="<?php echo e(asset('css/main.css')); ?>">

    <title><?php echo app('translator')->get($pageTitle); ?></title>
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e($company->favicon_url); ?>">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo e($company->favicon_url); ?>">
    <meta name="theme-color" content="#ffffff">

    <?php echo $__env->make('sections.theme_css', ['company' => $company], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if(isset($activeSettingMenu)): ?>
        <style>
            .preloader-container {
                margin-left: 510px;
                width: calc(100% - 510px)
            }

        </style>
    <?php endif; ?>

    <style>
        .logo {
            height: 50px;
        }

    </style>

    <?php echo $__env->yieldPushContent('styles'); ?>

    <style>
        :root {
            --fc-border-color: #E8EEF3;
            --fc-button-text-color: #99A5B5;
            --fc-button-border-color: #99A5B5;
            --fc-button-bg-color: #ffffff;
            --fc-button-active-bg-color: #171f29;
            --fc-today-bg-color: #f2f4f7;
        }

        .preloader-container {
            height: 100vh;
            width: 100%;
            margin-left: 0;
            margin-top: 0;
        }

        .fc a[data-navlink] {
            color: #99a5b5;
        }

    </style>
    <style>
        #logo {
            height: 50px;
        }

    </style>


    <script src="<?php echo e(asset('vendor/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('vendor/jquery/modernizr.min.js')); ?>"></script>

    <script>
        var checkMiniSidebar = localStorage.getItem("mini-sidebar");

    </script>

</head>

<body id="body" class="h-100 bg-additional-grey">

<div class="content-wrapper container">

    <div class="card border-0 invoice">
        <!-- CARD BODY START -->
        <div class="card-body">
            <div class="invoice-table-wrapper">
                <table width="100%" class="">
                    <tr class="inv-logo-heading">
                        <td><img src="<?php echo e($company->logo_url); ?>" alt="<?php echo e($company->company_name); ?>"
                                 class="logo"/></td>
                        <td align="right" class="font-weight-bold f-21 text-dark text-uppercase mt-4 mt-lg-0 mt-md-0">
                            <?php echo app('translator')->get('app.menu.contract'); ?></td>
                    </tr>
                    <tr class="inv-num">
                        <td class="f-14 text-dark">
                            <p class="mt-3 mb-0">
                            <?php echo e($company->company_name); ?><br>
                            <?php echo nl2br($company->defaultAddress->address); ?><br>
                            Phone #: <?php echo e($company->company_phone); ?><br>
                            Email: <a href="<?php echo e($company->website); ?>">vendors@mcresi.com</a><br>
                            Website: <a href="<?php echo e($company->website); ?>"><?php echo e($company->website); ?></a>
                            </p><br>
                        </td>
                        <td align="right">
                            <table class="inv-num-date text-dark f-13 mt-3">
                                <tr>
                                    <td class="bg-light-grey border-right-0 f-w-500">
                                        <?php echo app('translator')->get('modules.contracts.contractNumber'); ?></td>
                                    <td class="border-left-0"><?php echo e($vendor->id); ?></td>
                                </tr>
                                <tr>
                                    <td class="bg-light-grey border-right-0 f-w-500">
                                        <?php echo app('translator')->get('modules.projects.startDate'); ?></td>
                                    <td class="border-left-0"><?php echo e($startdate); ?>

                                    </td>
                                </tr>
                                
                                    <tr>
                                        <td class="bg-light-grey border-right-0 f-w-500"><?php echo app('translator')->get('modules.contracts.endDate'); ?>
                                        </td>
                                        <td class="border-left-0"><?php echo e($enddate); ?>

                                        </td>
                                    </tr>
                               
                                <tr>
                                    <td class="bg-light-grey border-right-0 f-w-500">
                                        <?php echo app('translator')->get('modules.contracts.contractType'); ?></td>
                                    <td class="border-left-0">OTA
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td height="20"></td>
                    </tr>
                </table>
                <table width="100%">
                    <tr class="inv-unpaid">
                        <td class="f-14 text-dark">
                            <p class="mb-0 text-left"><span
                                    class="text-dark-grey text-capitalize"><?php echo app('translator')->get("app.menu.vendor"); ?></span><br>
                                    <strong><?php echo e($name); ?></strong>
                                                                                    <br>
                                                                                    <br>
                                                                                    </p>
                        </td>
                        <td align="right">
                            
                        </td>
                    </tr>
                    <tr>
                        <td height="30"></td>
                    </tr>
                </table>
            </div>

            <div class="d-flex flex-column">
                <h5><?php echo app('translator')->get('app.subject'); ?></h5>
                <p class="f-15">One Time Service Agreement</p>
                <h5><?php echo app('translator')->get('modules.contracts.notes'); ?></h5>
                <p class="f-15"></p>
                <h5><?php echo app('translator')->get('app.description'); ?></h5>
                <div class="ql-editor p-0 pb-3">
       I.         RECITALS:

 1      WHEREAS <strong>MCGRATH CONSULTING</strong> is in the business of, among other things, Servicing Clients Who Are managing certain residential properties on behalf of their respective owners (the “Owners”) of such properties.

2      WHEREAS <strong>MCGRATH CONSULTING</strong> wishes to engage Sub-Contractor as an independent contractor for the purpose of providing the services (collectively, the “Services”) as set forth in the “Statement of Work”, in connection with certain of these residential properties (individually, a “Property” and collectively, the “Properties”), on the terms and conditions set forth below; and

3      WHEREAS Sub-Contractor wishes to provide the Services for the Properties in accordance with the terms of this Agreement, and has indicated its agreement by submitting this Agreement to <strong>MCGRATH CONSULTING</strong> electronically and acknowledging acceptance by entering the “Agree” button associated with this Agreement

 

       II.         AGREEMENT:

NOW THEREFORE, in consideration of the above recitals and the mutual promises and benefits contained herein and for other good and valuable consideration, the receipt and sufficiency of which are hereby acknowledged, the Parties agree as follows:

1       ENGAGEMENT:

<strong>MCGRATH CONSULTING</strong> hereby engages Sub-Contractor as an independent contractor, and Sub-Contractor accepts such engagement to provide the Services for the Properties in accordance with the Scope of Work (SOW) and the terms and conditions set forth herein.

2      SCOPE OF WORK (SOW):

                    i.    The scope of Services shall be as described in the SOW, and shall include all labor, equipment, materials and supplies necessary to perform the Services. Changes to the scope of Services under the SOW shall not be effective unless and until agreed upon in writing by the Parties, including, without limitation, pursuant to an approved bid. Notwithstanding the foregoing, (a) any services approved by <strong>MCGRATH CONSULTING</strong> and for work performed by or delivered by Sub-Contractor (including any of its subcontractors), whether reflected in the SOW or otherwise, shall be governed by, and subject to, the terms and conditions of this Agreement and (b) any bid or other written agreement that reflects Services to be performed or work to be delivered and is approved by the Parties, shall be incorporated by reference into, and governed by the terms and conditions of this Agreement. Sub-Contractor acknowledges and agrees that the Current SOW and Bid Sheet Pricing in the market where the Property is located shall govern for purposes of both maintenance and make ready/construction.

                    ii.    Sub-Contractor shall perform the Services for the Properties in compliance with all applicable federal, state and local laws, ordinances, regulations, and industry guidelines, including all local building codes (collectively, “Laws”), in a good workmanlike manner consistent with best industry practices, within the time frames set forth in the SOW. In addition, by accepting this Agreement, Sub-Contractor agrees at all times and under all circumstances to conform to <strong>MCGRATH CONSULTING</strong> policies and procedures regarding a safe and secure worksite, as set out in the <strong>MCGRATH CONSULTING</strong> Sub-Contractor agrees and represents that it will ensure that individuals contracted to make repairs in fields of work requiring additional expertise, training, or licensing (“Specialty Areas”) shall have such expertise, training, and/or licensing and shall ensure that such expertise, training and/or licensing is current at the time the Services are executed. “Specialty Areas” shall include, but are not limited

       
       
       III.         CONTRACT TERMS and CONDITIONS:

 1      BILLING and FINAL ACCEPTANCE:

Service shall be completed and considered finished and Billable upon Final Inspection, Photographic verification of which Must Be Provided By Sub-Contractor To <strong>MCGRATH CONSULTING</strong>, and Shall be accepted by Tenant or Homeowner. Payment shall be made via credit card to Vendor post completion of work. Time is of the essence as this is a Time Decaying Service Agreement, and if terms are not met according to scheduling, <strong>MCGRATH CONSULTING</strong> has a right to cancel this agreement and reassign to another Sub-Contractor so as to meet Contractor’s scheduling requirements to its Clients demands. Cancellation due to Vendor (Sub-Contractor) issues does not negate any terms of this agreement nor absolve Vendor from any liabilities.

2      WARRANTY:

Vendor shall provide its services and meet its obligations under this Contract in a timely and workmanlike manner, according to industry standards and adhere to any specs or instructions as outlined in the SOW from <strong>MCGRATH CONSULTING</strong>. Vendor shall warrant all workmanship, parts and labor for a period of not less than 90 days unless otherwise agreed in writing. This is just to prevent any immediate recalls for any additional wok due to failure on the part of any immediate Installation or repair. As a service company we have to warranty to our clients one year, we changed it for you for 90 days.

 

3      COMPLIANCE WITH LAWS:

Vendor shall provide the Services in a workmanlike manner, and in compliance with all applicable federal, state and local laws and regulations, including, but not limited to all provisions of the Fair Labor Standards Act and shall supply to Contractor any permits, inspections and shall warrant that all work will be in compliance with local, state, and federal code.

 

       IV.         LEGAL CAPACITY:

<strong>MCGRATH CONSULTING</strong> warrants that <strong>MCGRATH CONSULTING</strong> is the GENERAL CONTRACTOR for its Client and that <strong>MCGRATH CONSULTING</strong> warrants that it has the legal capacity to contract for and in behalf of its client at the above Service Address. JURISDICTION: Vendor agrees This service agreement shall be legally bound to Ocean County, New Jersey with all rights to any claims which may need to be legally addressed by this agreement and or in the state of which service was performed.

 

       V.         INSURANCE:

Before work begins under this Contract, vendor through their Insurance Carrier shall furnish to Contractor a certificate of liability, certificates of insurance to <strong>MCGRATH CONSULTING</strong> substantiating that Vendor has placed in force valid insurances covering its full liability under the Workers' Compensation laws of the State and shall furnish and maintain general liability insurance, and builder's risk insurance for injury to or death of a person or persons, and for personal injury or death suffered in any construction related accident and property damage incurred in rendering the Services.

 

      VI.         CONFIDENTIALITY:

Vendor, and its employees, agents, or representatives will not at any time or in any manner, either directly or indirectly, use for the personal benefit of Vendor or divulge, disclose, or communicate in any manner, any information that is proprietary to <strong>MCGRATH CONSULTING</strong> to any other parties including Tenants, Occupants, or Homeowners, Further, Vendor and its employees, agents, and representatives will protect such information and treat it as strictly confidential. This provision will continue to be effective after the termination of this Contract, and if Confidentiality is NOT adhered to, Contractor shall effectively be harmed and may hold Vendor responsible for up to 10 times the total contract amount of which shall be agreed in advance for injury or breach by the vendor.

 

     VII.         INDEMNIFICATION. HOLD HARMLESS:

Vendor agrees to indemnify <strong>MCGRATH CONSULTING</strong> against, hold it harmless from and defend <strong>MCGRATH CONSULTING</strong> from all claims, loss, liability, and expense, including actual attorneys' fees, arising out of or in connection with Vendor's Services performed under this Contract. This indemnity shall be provided even if <strong>MCGRATH CONSULTING</strong> is partly responsible for the claim, damage, injury or loss, but Vendor shall not provide indemnity against claims or losses deemed to be caused by the negligence, wilful misconduct, or breach of contract of <strong>MCGRATH CONSULTING</strong> or <strong>MCGRATH CONSULTING</strong>'s agents or employees.

 

     VIII.         INSPECTIONS:

<strong>MCGRATH CONSULTING</strong> shall have the right to inspect all work performed under this Contract. All defects and uncompleted items shall be reported immediately by Vendor to Contractor. All work that needs to be inspected or tested and certified by an engineer as a condition of any government departments or other state agency, or inspected and certified by the local health officer, shall be done at each necessary stage of construction and before further construction can continue. All inspection and certification will be done at Vendor's expense in connection with the SOW. Should Contractor have to perform inspections to certify vendors work, Vendor shall be responsible for all costs and fees Contractor shall have to cover to certify work by Vendor so that it may bill its Client at required times. DEFAULT. The occurrence of any of the following shall constitute a material default under this Contract: A.) The failure of <strong>MCGRATH CONSULTING</strong> to make a required payment when due. B.) The insolvency of either party or if either party shall, either voluntarily or involuntarily, become a debtor of or seek protection under Title 11 of the United States Bankruptcy Code. C.) A lawsuit is brought on any claim, seizure, lien or levy for labor performed or materials used on or furnished to the project by either party, or there is a general assignment for the benefit of creditors, application or sale for or by any creditor or government agency brought against either party.; D.) The failure of Vendor to meet its obligations by or the SOW or to deliver the Services in the time and manner provided for in this Agreement.

 

     IX.         REMEDIES:

In addition to any and all other rights a party may have available according to laws of the State of New Jersey, or State where service is performed, if a party defaults by failing to substantially perform any provision, term or condition of this Contract (including without limitation the failure to make a monetary payment when due), the other party may terminate the Contract by providing written notice to the defaulting party. This notice shall describe with sufficient detail the nature of the default. The party receiving said notice shall have 1 days from the effective date of said notice to cure the default(s) or finalize immediately substantial completion, if completion cannot be made in 2 days. Unless waived by a party providing notice, the failure to cure or begin curing, the default(s) within such time period shall result in the automatic termination of this Contract. Any monies owed back to Contractor by Vendor if work was not completed accordingly shall be paid back immediately, and any monies owed to Vendor by Quantum meruit, Vendor shall be paid immediately for all completed work according to the schedule of values assigned in the SOW. If Contractor is in breach, Vendor shall have all rights to collect and if not paid within 60 days, shall have the right to lien the property unless Contractor shall pay for and assign a payment bond to satisfy the total cost of work should litigation be required. If Vendor is in breach or has committed fraud by any nature of inspection, warranty, or workmanship, then Contractor shall have limits of remuneration of up to 10 times the value of the total contract plus any Anticipatory breach, Minor or partial breach, Material or total breach and such Liquidated damages shall be binding on both parties and any Punitive damages which shall be allowed in a court of law.

 

     X.         ENTIRE AGREEMENT:

This Contract contains the entire Agreement of the parties, and there are no other promises or conditions in any other contract or agreement whether oral or written concerning the subject matter of this Agreement. Any amendments must be in writing and signed by each party. This Agreement supersedes any prior written or oral agreements between the parties.

 

     XI.         SEVERABILITY:

If any provision of this Agreement will be held to be invalid or unenforceable for any reason, the remaining provisions will continue to be valid and enforceable. If a court finds that any provision of this Agreement is invalid or unenforceable, but that by limiting such provision it would become valid and enforceable, then such provision will be deemed to be written, construed, and enforced as so limited.

 

     XII.         GOVERNING LAW:

This Agreement shall be construed in accordance with and governed by the laws of the State of New Jersey, without regard to any choice of law provisions of or any other jurisdiction.

 

    XIII.         NOTICE:

Any notice or communication required or permitted under this Agreement shall be sufficiently given if delivered in person or by email, or certified mail, return receipt requested, to the address set forth in the opening paragraph or to such other address as one party may have furnished to the other in writing.

 

    XIV.         WAIVER OF CONTRACTUAL RIGHT:

The failure of either party to enforce any provision of this Contract shall not be construed as a waiver or limitation of that party's right to subsequently enforce and compel strict compliance with every provision of this Contract.

 

    XV.         ASSIGNMENT:

Neither party may assign or transfer this Agreement without the prior written consent of the non-assigning party, which approval shall not be unreasonably withheld.

 

    XVI.         NON-DISCLOSURE AGREEMENT:

 <strong>MCGRATH CONSULTING</strong> operates as a private network. We will hire you and compensate you for the work order. You are required to communicate exclusively with us regarding this work order and must not engage with our tenant or provide any information to the tenant or our client. Breach of this agreement will result in direct termination of this contract and your vendor profile there by restricting you from receiving future work orders.

 
                </div>
                
                
            </div>
            <?php if($vendor->sign): ?>
                <div class="d-flex flex-column float-right`">
                    <h6><?php echo app('translator')->get('Signature'); ?></h6>
                    <img src="<?php echo e($vendor->image_url); ?>" style="width: 200px;">
                </div>
             <?php endif; ?>
        </div>
        <!-- CARD BODY END -->

        <!-- CARD FOOTER START -->
        <?php if(!$vendor->sign && (!$vendor->v_status=='Declined by Vendor'||$vendor->v_status=='Accepted'||$vendor->v_status=='Proposal Link Sent')): ?>
        <div
            class="card-footer bg-white border-0 d-flex justify-content-end py-0 py-lg-4 py-md-4 mb-4 mb-lg-3 mb-md-3 ">

            <?php if (isset($component)) { $__componentOriginal5586a837a5f7371c36d53423ae34c509 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5586a837a5f7371c36d53423ae34c509 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.forms.button-success','data' => ['class' => 'border-0 mr-3 mb-2','id' => 'accept','icon' => 'check']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.button-success'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'border-0 mr-3 mb-2','id' => 'accept','icon' => 'check']); ?>Accept
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5586a837a5f7371c36d53423ae34c509)): ?>
<?php $attributes = $__attributesOriginal5586a837a5f7371c36d53423ae34c509; ?>
<?php unset($__attributesOriginal5586a837a5f7371c36d53423ae34c509); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5586a837a5f7371c36d53423ae34c509)): ?>
<?php $component = $__componentOriginal5586a837a5f7371c36d53423ae34c509; ?>
<?php unset($__componentOriginal5586a837a5f7371c36d53423ae34c509); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal5586a837a5f7371c36d53423ae34c509 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5586a837a5f7371c36d53423ae34c509 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.forms.button-success','data' => ['id' => 'reject','class' => 'border-0 mr-3 mb-2 btn btn-danger','icon' => 'times']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.button-success'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'reject','class' => 'border-0 mr-3 mb-2 btn btn-danger','icon' => 'times']); ?>Reject
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5586a837a5f7371c36d53423ae34c509)): ?>
<?php $attributes = $__attributesOriginal5586a837a5f7371c36d53423ae34c509; ?>
<?php unset($__attributesOriginal5586a837a5f7371c36d53423ae34c509); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5586a837a5f7371c36d53423ae34c509)): ?>
<?php $component = $__componentOriginal5586a837a5f7371c36d53423ae34c509; ?>
<?php unset($__componentOriginal5586a837a5f7371c36d53423ae34c509); ?>
<?php endif; ?>

        </div>
        <?php endif; ?>
        <!-- CARD FOOTER END -->
    </div>
    <!-- INVOICE CARD END -->
    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading">Reason</h4>
                </div>
                <?php if (isset($component)) { $__componentOriginal18ad2e0d264f9740dc73fff715357c28 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18ad2e0d264f9740dc73fff715357c28 = $attributes; } ?>
<?php $component = App\View\Components\Form::resolve(['method' => 'POST'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Form::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'Rejection','class' => 'ajax-form']); ?>
                    <div class="modal-body">
                        <div class="form-group my-3">
                            <div class="col-lg-12 col-md-12">
                                <?php if (isset($component)) { $__componentOriginal4e45e801405ab67097982370a6a83cba = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4e45e801405ab67097982370a6a83cba = $attributes; } ?>
<?php $component = App\View\Components\Forms\Text::resolve(['fieldLabel' => __(''),'fieldName' => 'reason','fieldId' => 'reason','fieldPlaceholder' => __('Type Here'),'fieldHelp' => __('Optional. You Can Leave It Blank And Click Submit')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\Text::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mr-0 mr-lg-2 mr-md-2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4e45e801405ab67097982370a6a83cba)): ?>
<?php $attributes = $__attributesOriginal4e45e801405ab67097982370a6a83cba; ?>
<?php unset($__attributesOriginal4e45e801405ab67097982370a6a83cba); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4e45e801405ab67097982370a6a83cba)): ?>
<?php $component = $__componentOriginal4e45e801405ab67097982370a6a83cba; ?>
<?php unset($__componentOriginal4e45e801405ab67097982370a6a83cba); ?>
<?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <?php if (isset($component)) { $__componentOriginalcf8d12533ff890e0d6573daf32b7618d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcf8d12533ff890e0d6573daf32b7618d = $attributes; } ?>
<?php $component = App\View\Components\Forms\ButtonPrimary::resolve(['icon' => 'check'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.button-primary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\ButtonPrimary::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'border-0 mr-3 mb-2','id' => 'submit']); ?>Submit
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcf8d12533ff890e0d6573daf32b7618d)): ?>
<?php $attributes = $__attributesOriginalcf8d12533ff890e0d6573daf32b7618d; ?>
<?php unset($__attributesOriginalcf8d12533ff890e0d6573daf32b7618d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcf8d12533ff890e0d6573daf32b7618d)): ?>
<?php $component = $__componentOriginalcf8d12533ff890e0d6573daf32b7618d; ?>
<?php unset($__componentOriginalcf8d12533ff890e0d6573daf32b7618d); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal5e57c6582b8a883148a28bb7ee46d2ad = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5e57c6582b8a883148a28bb7ee46d2ad = $attributes; } ?>
<?php $component = App\View\Components\Forms\ButtonSecondary::resolve(['icon' => 'times'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.button-secondary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\ButtonSecondary::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'cancel','class' => 'border-0 mr-3 mb-2']); ?>Cancel
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5e57c6582b8a883148a28bb7ee46d2ad)): ?>
<?php $attributes = $__attributesOriginal5e57c6582b8a883148a28bb7ee46d2ad; ?>
<?php unset($__attributesOriginal5e57c6582b8a883148a28bb7ee46d2ad); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5e57c6582b8a883148a28bb7ee46d2ad)): ?>
<?php $component = $__componentOriginal5e57c6582b8a883148a28bb7ee46d2ad; ?>
<?php unset($__componentOriginal5e57c6582b8a883148a28bb7ee46d2ad); ?>
<?php endif; ?>
                    </div>    
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18ad2e0d264f9740dc73fff715357c28)): ?>
<?php $attributes = $__attributesOriginal18ad2e0d264f9740dc73fff715357c28; ?>
<?php unset($__attributesOriginal18ad2e0d264f9740dc73fff715357c28); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18ad2e0d264f9740dc73fff715357c28)): ?>
<?php $component = $__componentOriginal18ad2e0d264f9740dc73fff715357c28; ?>
<?php unset($__componentOriginal18ad2e0d264f9740dc73fff715357c28); ?>
<?php endif; ?>  
            </div>
        </div>
    </div>

</div>

<!-- Global Required Javascript -->
<script src="<?php echo e(asset('js/main.js')); ?>"></script>

<script>
    
    $('#reject').click(function () {
            
        $('#ajaxModel').modal('show');
    });
    $('#cancel,#submit').click(function () {
            
        window.location.reload();
    });

    $('#submit').click(function (){
        var id="<?php echo e($id); ?>";
        var reason=document.getElementById('reason').value;

         $.easyAjax({
                url: "<?php echo e(route('front.form.show')); ?>",
                type: "GET",
                
                data:{
                    id:id,
                    status:'rejected',
                    details: reason,
                },
                success: function(response) {
                    setTimeout(() => {
                        window.location.reload();
                    },3000);
                },
            });
    })
   
    $('#accept').click(function () {
        if(confirm("By clicking 'I Agree,' I confirm that I have read, understood, and agree to the Terms & Conditions.")){
        var startDate = "<?php echo e($startdate); ?>";
        var endDate = "<?php echo e($enddate); ?>";
        var id="<?php echo e($id); ?>";
    $.easyAjax({
        url: "<?php echo e(route('front.form.show')); ?>",
        type: "GET",
        data:{
            startdate: startDate,
            enddate: endDate,
            id:id,
            status:'accepted'
        },
        success: function(response) {
            window.location.href=response.redirect_url;
        },
    });
    }
    });

</script>


</body>

</html>
<?php /**PATH C:\laragon\www\mcagrath-crm\resources\views/vendorcontract.blade.php ENDPATH**/ ?>