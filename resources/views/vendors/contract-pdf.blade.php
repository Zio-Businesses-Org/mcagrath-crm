<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Template CSS -->
    <!-- <link type="text/css" rel="stylesheet" media="all" href="css/main.css"> -->

    <title>@lang('modules.contracts.contractNumber') - #{{ $contract->id }}</title>
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ $company->favicon_url }}">
    <meta name="theme-color" content="#ffffff">

    <style>

@font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ storage_path('fonts/THSarabunNew.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url("{{ storage_path('fonts/THSarabunNew_Bold.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: bold;
            src: url("{{ storage_path('fonts/THSarabunNew_Bold_Italic.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: bold;
            src: url("{{ storage_path('fonts/THSarabunNew_Italic.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'BeVietnamPro';
            font-style: normal;
            font-weight: normal;
            src: url("{{ storage_path('fonts/BeVietnamPro-Black.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'BeVietnamPro';
            font-style: italic;
            font-weight: normal;
            src: url("{{ storage_path('fonts/BeVietnamPro-BlackItalic.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'BeVietnamPro';
            font-style: italic;
            font-weight: bold;
            src: url("{{ storage_path('fonts/BeVietnamPro-bold.ttf') }}") format('truetype');
        }

       

       body {
            margin: 0;
            font-family: DejaVu Sans, sans-serif;
        }

        .bg-grey {
            background-color: #F2F4F7;
        }

        .bg-white {
            background-color: #fff;
        }

        .border-radius-25 {
            border-radius: 0.25rem;
        }

        .p-25 {
            padding: 1.25rem;
        }

        .f-13 {
            font-size: 13px;
        }

        .f-14 {
            font-size: 14px;
        }

        .f-15 {
            font-size: 15px;
        }

        .f-21 {
            font-size: 21px;
        }

        .text-black {
            color: #28313c;
        }

        .text-grey {
            color: #616e80;
        }

        .font-weight-700 {
            font-weight: 700;
        }

        .text-uppercase {
            text-transform: uppercase;
        }

        .text-capitalize {
            text-transform: capitalize;
        }

        .line-height {
            line-height: 24px;
        }

        .mt-1 {
            margin-top: 1rem;
        }

        .mb-0 {
            margin-bottom: 0px;
        }

        .b-collapse {
            border-collapse: collapse;
        }

        .heading-table-left {
            padding: 6px;
            border: 1px solid #DBDBDB;
            font-weight: bold;
            background-color: #f1f1f3;
            border-right: 0;
        }

        .heading-table-right {
            padding: 6px;
            border: 1px solid #DBDBDB;
            border-left: 0;
        }

        .unpaid {
            color: #000000;
            position: relative;
            padding: 11px 22px;
            font-size: 15px;
            border-radius: 0.25rem;
            width: 100px;
            text-align: center;
        }

        .main-table-heading {
            border: 1px solid #DBDBDB;
            background-color: #f1f1f3;
            font-weight: 700;
        }

        .main-table-heading td {
            padding: 11px 10px;
            border: 1px solid #DBDBDB;
        }

        .main-table-items td {
            padding: 11px 10px;
            border: 1px solid #e7e9eb;
        }

        .total-box {
            border: 1px solid #e7e9eb;
            padding: 0px;
            border-bottom: 0px;
        }

        .subtotal {
            padding: 11px 10px;
            border: 1px solid #e7e9eb;
            border-top: 0;
            border-left: 0;
        }

        .subtotal-amt {
            padding: 11px 10px;
            border: 1px solid #e7e9eb;
            border-top: 0;
            border-right: 0;
        }

        .total {
            padding: 11px 10px;
            border: 1px solid #e7e9eb;
            border-top: 0;
            font-weight: 700;
            border-left: 0;
        }

        .total-amt {
            padding: 11px 10px;
            border: 1px solid #e7e9eb;
            border-top: 0;
            border-right: 0;
            font-weight: 700;
        }

        .balance {
            font-size: 16px;
            font-weight: bold;
            background-color: #f1f1f3;
        }

        .balance-left {
            padding: 11px 10px;
            border: 1px solid #e7e9eb;
            border-top: 0;
            border-left: 0;
        }

        .balance-right {
            padding: 11px 10px;
            border: 1px solid #e7e9eb;
            border-top: 0;
            border-right: 0;
        }

        .centered {
            margin: 0 auto;
        }

        .rightaligned {
            margin-right: 0;
            margin-left: auto;
        }

        .leftaligned {
            margin-left: 0;
            margin-right: auto;
        }

        .page_break {
            page-break-before: always;
        }

        .logo {
            height: 50px;
        }

    </style>
</head>

<body id="body" class="h-100">
    <table class="bg-white" border="0" cellpadding="0" cellspacing="0" width="100%" role="presentation">
        <tbody>
            <!-- Table Row Start -->
            <tr>
                <td><img src="{{ $company->logo_url }}" alt="{{ $company->company_name }}"
                        class="logo" /></td>
                <td align="right" class="f-21 text-black font-weight-700 text-uppercase">@lang('app.menu.contract')</td>
            </tr>
            <!-- Table Row End -->
            <!-- Table Row Start -->
            <tr>
                <td>
                    <p class="line-height mt-1 mb-0 f-14 text-black">
                    {{ $company->company_name }}<br>
                    {!! nl2br($company->defaultAddress->address) !!}<br>
                    Phone #: {{ $company->company_phone }}<br>
                    Email: <a href="{{$company->website}}">vendors@mcresi.com</a><br>
                    Website: <a href="{{$company->website}}">{{ $company->website }}</a>

                    </p>
                </td>
                <td>
                    <table class="text-black mt-1 f-13 b-collapse rightaligned">
                        <tr>
                            <td class="heading-table-left">@lang('modules.contracts.contractNumber')</td>
                            <td class="heading-table-right">#{{ $contract->id }}</td>
                        </tr>
                        <tr>
                            <td class="heading-table-left">@lang('modules.projects.startDate')</td>
                            <td class="heading-table-right">{{ $contract->contract_start  }}</td>
                        </tr>
                        @if ($contract->contract_end != null)
                            <tr>
                                <td class="heading-table-left">@lang('modules.contracts.endDate')</td>
                                <td class="heading-table-right">
                                    {{ $contract->contract_end }}
                                </td>
                            </tr>
                        @endif
                        <tr class="description">
                            <td class="heading-table-left description">@lang('modules.contracts.contractType')</td>
                            <td class="heading-table-right description">OTA
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <!-- Table Row End -->
            <!-- Table Row Start -->
            <tr>
                <td height="30"></td>
            </tr>
            <!-- Table Row End -->
            <!-- Table Row Start -->
            <tr>
                <td colspan="2">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td class="f-14 text-black">

                                <p class="line-height mb-0">
                                    <span class="text-grey text-capitalize">@lang('app.menu.vendor')</span><br>
                                    
                                    {{ $contract->vendor_name }}<br/>
                                    {!! nl2br($contract->street_address) !!}<br/>
                                    {{ $contract->city }}, {{ $contract->state }}, {{$contract->zip_code}}<br/>
                                </p>

                            </td>

                            <td align="right">
                                @if ($contract->company_logo)
                                    <div class="text-uppercase bg-white unpaid rightaligned">
                                        <img src="{{ $contract->image_url }}"
                                            alt="{{ $contract->company_name }}"
                                            class="logo" />
                                    </div>
                                @endif
                            </td>
                        </tr>
                    </table>
                </td>


            </tr>
            <!-- Table Row End -->
            <!-- Table Row Start -->
            <tr>
                <td height="20" colspan="2"></td>
            </tr>
            <!-- Table Row End -->

        </tbody>
    </table>

    <div>
        <h5 class="text-grey text-capitalize">@lang('app.subject')</h5>
        <p class="f-15 text-black">One Time Service Agreement</p>

        <h5 class="text-grey text-capitalize">@lang('modules.contracts.notes')</h5>
        <p class="f-15 text-black"></p>

        <h5 class="text-grey text-capitalize">@lang('app.description')</h5>
        <div class="ql-editor p-0 pb-3">
        I.         RECITALS:

        <br/> 
        <br/> 
1)     WHEREAS <strong>MCGRATH CONSULTING</strong> is in the business of, among other things, Servicing Clients Who Are managing certain residential properties on behalf of their respective owners (the “Owners”) of such properties.

<br/>

2)      WHEREAS <strong>MCGRATH CONSULTING</strong> wishes to engage Sub-Contractor as an independent contractor for the purpose of providing the services (collectively, the “Services”) as set forth in the “Statement of Work”, in connection with certain of these residential properties (individually, a “Property” and collectively, the “Properties”), on the terms and conditions set forth below; and

<br/> 

3)      WHEREAS Sub-Contractor wishes to provide the Services for the Properties in accordance with the terms of this Agreement, and has indicated its agreement by submitting this Agreement to <strong>MCGRATH CONSULTING</strong> electronically and acknowledging acceptance by entering the “Agree” button associated with this Agreement

 
<br/>
<br/>
       II.         AGREEMENT:
<br/>
<br/>

NOW THEREFORE, in consideration of the above recitals and the mutual promises and benefits contained herein and for other good and valuable consideration, the receipt and sufficiency of which are hereby acknowledged, the Parties agree as follows:

 
    <br/>
1)      ENGAGEMENT:
<br/>
<strong>MCGRATH CONSULTING</strong> hereby engages Sub-Contractor as an independent contractor, and Sub-Contractor accepts such engagement to provide the Services for the Properties in accordance with the Scope of Work (SOW) and the terms and conditions set forth herein.
<br/>
2)      SCOPE OF WORK (SOW):
<br/>

 
                                                     i.    The scope of Services shall be as described in the SOW, and shall include all labor, equipment, materials and supplies necessary to perform the Services. Changes to the scope of Services under the SOW shall not be effective unless and until agreed upon in writing by the Parties, including, without limitation, pursuant to an approved bid. Notwithstanding the foregoing, (a) any services approved by <strong>MCGRATH CONSULTING</strong> and for work performed by or delivered by Sub-Contractor (including any of its subcontractors), whether reflected in the SOW or otherwise, shall be governed by, and subject to, the terms and conditions of this Agreement and (b) any bid or other written agreement that reflects Services to be performed or work to be delivered and is approved by the Parties, shall be incorporated by reference into, and governed by the terms and conditions of this Agreement. Sub-Contractor acknowledges and agrees that the Current SOW and Bid Sheet Pricing in the market where the Property is located shall govern for purposes of both maintenance and make ready/construction.
                                                     <br/>
 

                                                    ii.    Sub-Contractor shall perform the Services for the Properties in compliance with all applicable federal, state and local laws, ordinances, regulations, and industry guidelines, including all local building codes (collectively, “Laws”), in a good workmanlike manner consistent with best industry practices, within the time frames set forth in the SOW. In addition, by accepting this Agreement, Sub-Contractor agrees at all times and under all circumstances to conform to <strong>MCGRATH CONSULTING</strong> policies and procedures regarding a safe and secure worksite, as set out in the <strong>MCGRATH CONSULTING</strong> Sub-Contractor agrees and represents that it will ensure that individuals contracted to make repairs in fields of work requiring additional expertise, training, or licensing (“Specialty Areas”) shall have such expertise, training, and/or licensing and shall ensure that such expertise, training and/or licensing is current at the time the Services are executed. “Specialty Areas” shall include, but are not limited

                                                    <br/>
                                                    <br/>
                                                    
      III.         CONTRACT TERMS and CONDITIONS:
      <br/>
      <br/>
 

1)      BILLING and FINAL ACCEPTANCE:
<br/>
Service shall be completed and considered finished and Billable upon Final Inspection, Photographic verification of which Must Be Provided By Sub-Contractor To <strong>MCGRATH CONSULTING</strong>, and Shall be accepted by Tenant or Homeowner. Payment shall be made via credit card to Vendor post completion of work. Time is of the essence as this is a Time Decaying Service Agreement, and if terms are not met according to scheduling, <strong>MCGRATH CONSULTING</strong> has a right to cancel this agreement and reassign to another Sub-Contractor so as to meet Contractor’s scheduling requirements to its Clients demands. Cancellation due to Vendor (Sub-Contractor) issues does not negate any terms of this agreement nor absolve Vendor from any liabilities.

<br/>

2)      WARRANTY:
<br/>
Vendor shall provide its services and meet its obligations under this Contract in a timely and workmanlike manner, according to industry standards and adhere to any specs or instructions as outlined in the SOW from <strong>MCGRATH CONSULTING</strong>. Vendor shall warrant all workmanship, parts and labor for a period of not less than 90 days unless otherwise agreed in writing. This is just to prevent any immediate recalls for any additional wok due to failure on the part of any immediate Installation or repair. As a service company we have to warranty to our clients one year, we changed it for you for 90 days.

 
<br/>
3)      COMPLIANCE WITH LAWS:
<br/>
Vendor shall provide the Services in a workmanlike manner, and in compliance with all applicable federal, state and local laws and regulations, including, but not limited to all provisions of the Fair Labor Standards Act and shall supply to Contractor any permits, inspections and shall warrant that all work will be in compliance with local, state, and federal code.

 
<br/>
<br/>
     IV.         LEGAL CAPACITY:
     <br/>
     <br/>
<strong>MCGRATH CONSULTING</strong> warrants that <strong>MCGRATH CONSULTING</strong> is the GENERAL CONTRACTOR for its Client and that <strong>MCGRATH CONSULTING</strong> warrants that it has the legal capacity to contract for and in behalf of its client at the above Service Address. JURISDICTION: Vendor agrees This service agreement shall be legally bound to Ocean County, New Jersey with all rights to any claims which may need to be legally addressed by this agreement and or in the state of which service was performed.

 
<br/>
<br/>
      V.         INSURANCE:
      <br/>
      <br/>
Before work begins under this Contract, vendor through their Insurance Carrier shall furnish to Contractor a certificate of liability, certificates of insurance to <strong>MCGRATH CONSULTING</strong> substantiating that Vendor has placed in force valid insurances covering its full liability under the Workers' Compensation laws of the State and shall furnish and maintain general liability insurance, and builder's risk insurance for injury to or death of a person or persons, and for personal injury or death suffered in any construction related accident and property damage incurred in rendering the Services.
<br/><br/>
 

     VI.         CONFIDENTIALITY:
     <br/>
     <br/>
Vendor, and its employees, agents, or representatives will not at any time or in any manner, either directly or indirectly, use for the personal benefit of Vendor or divulge, disclose, or communicate in any manner, any information that is proprietary to <strong>MCGRATH CONSULTING</strong> to any other parties including Tenants, Occupants, or Homeowners, Further, Vendor and its employees, agents, and representatives will protect such information and treat it as strictly confidential. This provision will continue to be effective after the termination of this Contract, and if Confidentiality is NOT adhered to, Contractor shall effectively be harmed and may hold Vendor responsible for up to 10 times the total contract amount of which shall be agreed in advance for injury or breach by the vendor.

<br/>
<br/>
    VII.         INDEMNIFICATION. HOLD HARMLESS:
    <br/>
    <br/>
Vendor agrees to indemnify <strong>MCGRATH CONSULTING</strong> against, hold it harmless from and defend <strong>MCGRATH CONSULTING</strong> from all claims, loss, liability, and expense, including actual attorneys' fees, arising out of or in connection with Vendor's Services performed under this Contract. This indemnity shall be provided even if <strong>MCGRATH CONSULTING</strong> is partly responsible for the claim, damage, injury or loss, but Vendor shall not provide indemnity against claims or losses deemed to be caused by the negligence, wilful misconduct, or breach of contract of <strong>MCGRATH CONSULTING</strong> or <strong>MCGRATH CONSULTING</strong>'s agents or employees.
<br/>
<br/>

   VIII.         INSPECTIONS:
   <br/>
   <br/>
<strong>MCGRATH CONSULTING</strong> shall have the right to inspect all work performed under this Contract. All defects and uncompleted items shall be reported immediately by Vendor to Contractor. All work that needs to be inspected or tested and certified by an engineer as a condition of any government departments or other state agency, or inspected and certified by the local health officer, shall be done at each necessary stage of construction and before further construction can continue. All inspection and certification will be done at Vendor's expense in connection with the SOW. Should Contractor have to perform inspections to certify vendors work, Vendor shall be responsible for all costs and fees Contractor shall have to cover to certify work by Vendor so that it may bill its Client at required times. DEFAULT. The occurrence of any of the following shall constitute a material default under this Contract: A.) The failure of <strong>MCGRATH CONSULTING</strong> to make a required payment when due. B.) The insolvency of either party or if either party shall, either voluntarily or involuntarily, become a debtor of or seek protection under Title 11 of the United States Bankruptcy Code. C.) A lawsuit is brought on any claim, seizure, lien or levy for labor performed or materials used on or furnished to the project by either party, or there is a general assignment for the benefit of creditors, application or sale for or by any creditor or government agency brought against either party.; D.) The failure of Vendor to meet its obligations by or the SOW or to deliver the Services in the time and manner provided for in this Agreement.

<br/>
<br/>
      IX.         REMEDIES:
      <br/>
      <br/>
In addition to any and all other rights a party may have available according to laws of the State of New Jersey, or State where service is performed, if a party defaults by failing to substantially perform any provision, term or condition of this Contract (including without limitation the failure to make a monetary payment when due), the other party may terminate the Contract by providing written notice to the defaulting party. This notice shall describe with sufficient detail the nature of the default. The party receiving said notice shall have 1 days from the effective date of said notice to cure the default(s) or finalize immediately substantial completion, if completion cannot be made in 2 days. Unless waived by a party providing notice, the failure to cure or begin curing, the default(s) within such time period shall result in the automatic termination of this Contract. Any monies owed back to Contractor by Vendor if work was not completed accordingly shall be paid back immediately, and any monies owed to Vendor by Quantum meruit, Vendor shall be paid immediately for all completed work according to the schedule of values assigned in the SOW. If Contractor is in breach, Vendor shall have all rights to collect and if not paid within 60 days, shall have the right to lien the property unless Contractor shall pay for and assign a payment bond to satisfy the total cost of work should litigation be required. If Vendor is in breach or has committed fraud by any nature of inspection, warranty, or workmanship, then Contractor shall have limits of remuneration of up to 10 times the value of the total contract plus any Anticipatory breach, Minor or partial breach, Material or total breach and such Liquidated damages shall be binding on both parties and any Punitive damages which shall be allowed in a court of law.

 
<br/>
<br/>

      X.         ENTIRE AGREEMENT:
      <br/>
      <br/>
This Contract contains the entire Agreement of the parties, and there are no other promises or conditions in any other contract or agreement whether oral or written concerning the subject matter of this Agreement. Any amendments must be in writing and signed by each party. This Agreement supersedes any prior written or oral agreements between the parties.

<br/>
<br/>
      XI.         SEVERABILITY:
<br/>
<br/>
If any provision of this Agreement will be held to be invalid or unenforceable for any reason, the remaining provisions will continue to be valid and enforceable. If a court finds that any provision of this Agreement is invalid or unenforceable, but that by limiting such provision it would become valid and enforceable, then such provision will be deemed to be written, construed, and enforced as so limited.
<br/>
<br/>

     XII.         GOVERNING LAW:
<br/>
<br/>
This Agreement shall be construed in accordance with and governed by the laws of the State of New Jersey, without regard to any choice of law provisions of or any other jurisdiction.

<br/>
<br/>
    XIII.         NOTICE:
<br/>
<br/>
Any notice or communication required or permitted under this Agreement shall be sufficiently given if delivered in person or by email, or certified mail, return receipt requested, to the address set forth in the opening paragraph or to such other address as one party may have furnished to the other in writing.

<br/>
<br/>
   XIV.         WAIVER OF CONTRACTUAL RIGHT:
<br/>
<br/>
The failure of either party to enforce any provision of this Contract shall not be construed as a waiver or limitation of that party's right to subsequently enforce and compel strict compliance with every provision of this Contract.

<br/>
<br/>
    XV.         ASSIGNMENT:
<br/>
<br/>
Neither party may assign or transfer this Agreement without the prior written consent of the non-assigning party, which approval shall not be unreasonably withheld.
<br/>
<br/>

   XVI.         NON-DISCLOSURE AGREEMENT:
<br/>
<br/>
 <strong>MCGRATH CONSULTING</strong> operates as a private network. We will hire you and compensate you for the work order. You are required to communicate exclusively with us regarding this work order and must not engage with our tenant or provide any information to the tenant or our client. Breach of this agreement will result in direct termination of this contract and your vendor profile there by restricting you from receiving future work orders.
        
    
    
</div>


        <hr class="mt-1 mb-1">
        @if ($contract->contract_sign)
            <div style="text-align: left; margin-top: 10px">
                <h4 class="name" style="margin-bottom: 20px;">@lang('Vendor Signature')</h4>
                <img src="{{ $contract->secondary_image_url }}" style="width: 200px;">
                <p>Vendor Name:- {{ $contract->vendor_name }}<br>
                   Company Name:- {{$contract->company_name}}<br>
                   Date:- {{ $contract->signed_date}}
                </p>
            </div>
        @endif

        @if ($contract->company_sign)
            <div style="text-align: right; margin-top: -240px">
                <h4 class="name" style="margin-bottom: 20px;">@lang('Company Signature')</h4>
                <img src="{{$contract->tertiary_image_url }}" style="width: 200px;"><br>
                <p>Company Name:- {{ $company->company_name }}<br>
                    Date:- {{ $contract->company_sign_date }}<br>
                </p>
            </div>
        @endif
    </div>

</body>

</html>
