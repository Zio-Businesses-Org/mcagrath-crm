<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Template CSS -->
    <!-- <link type="text/css" rel="stylesheet" media="all" href="css/main.css"> -->

    <title>@lang('waiverform') - #{{ $vendorid->id }}</title>
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

<body class="content-wrapper">
    <div class="content-wrapper container">

        <div class="card border-0 invoice">
            <!-- CARD BODY START -->
            <div class="card-body">
                <div class="invoice-table-wrapper">
                    <table width="100%" class="">
                        <tr class="inv-logo-heading">
                            <td><img src="{{$company->logo_url}}" alt="{{ $company->company_name }}"
                                    class="logo"/></td>
                            <td align="right" class="font-weight-bold f-21 text-dark text-uppercase mt-4 mt-lg-0 mt-md-0">
                                @lang('Subcontractor Release and Waiver of Liability Form')</td>
                        </tr>
                        <tr class="inv-num">
                            <td class="f-14 text-dark">
                                <p class="mt-3 mb-0">
                                    {{ $company->company_name }}<br>
                                    {!! nl2br($company->defaultAddress->address) !!}<br>
                                    Phone #: {{ $company->company_phone }}<br>
                                    Email: <a href="{{$company->website}}">{{ $company->company_email }}</a><br>
                                    Website: <a href="{{$company->website}}">{{ $company->website }}</a>
                                </p><br>
                            </td>
                        </tr>
                        <tr>
                            <td height="20"></td>
                        </tr>
                    </table>
                    <!-- <table width="100%">
                        <tr class="inv-unpaid">
                            <td class="f-14 text-dark">
                                <p class="mb-0 text-left"><span
                                        class="text-dark-grey text-capitalize">@lang("app.menu.vendor")</span><br>
                                        <strong>{{$vendorid->vendor_name}}</strong>
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
                    </table> -->
                </div>

                <div class="d-flex flex-column">
                    <h5>@lang('app.subject')</h5>
                    <p class="f-15">Wc Waiver Form</p>
                    <h5>@lang('modules.contracts.notes')</h5>
                    <p class="f-15"></p>
                    <h5>@lang('app.description')</h5>
                    <div class="ql-editor p-0 pb-3">
                        {!! $templateid->waiver_template !!}
                        
                    </div>
                </div>
            </div>

        </div>
        <hr class="mt-1 mb-1">
        @if ($vendorid->waiver_signed_date)
            <div style="text-align: left; margin-top: 20px">
                <h4 class="name" style="margin-bottom: 20px;">@lang('Sub Contractor Details:')</h4>
                <img src="{{ $vendorid->secondary_image_url }}" style="width: 200px;">
                <p>Vendor Name:- {{ $vendorid->vendor_name }}<br>
                   Company Name:- {{$vendorid->company_name}}<br>
                   Address :- {{$vendorid->street_address}}, {{$vendorid->city}}, {{$vendorid->state}}, {{$vendorid->zip_code}}<br>
                   Date:- {{ $vendorid->waiver_signed_date}}
                </p>
            </div>
        @endif
    </div>

</body>

</html>
