<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('vendor/css/all.min.css') }}">

    <!-- Simple Line Icons -->
    <link rel="stylesheet" href="{{ asset('vendor/css/simple-line-icons.css') }}">

    <!-- Template CSS -->
    <link type="text/css" rel="stylesheet" media="all" href="{{ asset('css/main.css') }}">

    <title>@lang($pageTitle)</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ $company->favicon_url }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ $company->favicon_url }}">
    <meta name="theme-color" content="#ffffff">

    @include('sections.theme_css', ['company' => $company])

    @isset($activeSettingMenu)
        <style>
            .preloader-container {
                margin-left: 510px;
                width: calc(100% - 510px)
            }

        </style>
    @endisset

    <style>
        .logo {
            height: 50px;
        }

    </style>

    @stack('styles')

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


    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery/modernizr.min.js') }}"></script>

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
                        <td><img src="{{$company->logo_url}}" alt="{{ $company->company_name }}"
                                 class="logo"/></td>
                        <td align="right" class="font-weight-bold f-21 text-dark text-uppercase mt-4 mt-lg-0 mt-md-0">
                            @lang('Wc Waiver Form')</td>
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
                <p class="f-15">Subcontractor Release and Waiver of Liability Form</p>
                <h5>@lang('modules.contracts.notes')</h5>
                <p class="f-15"></p>
                <h5>@lang('app.description')</h5>
                <div class="ql-editor p-0 pb-3">
                    {!! $templateid->waiver_template !!}
                    
                </div>
            </div>
        </div>
        <!-- CARD BODY END -->

        <!-- CARD FOOTER START -->
         @if($vendorid->waiver_form_status=='Pending')
        <div class="card-footer bg-white border-0 d-flex justify-content-end py-0 py-lg-4 py-md-4 mb-4 mb-lg-3 mb-md-3 ">
            <x-forms.button-success class="border-0 mr-3 mb-2" id="accept" icon="check">Accept
            </x-forms.button-success>
            <x-forms.button-success id="reject" class="border-0 mr-3 mb-2 btn btn-danger" icon="times">Reject
            </x-forms.button-success>
        </div>
        @endif
        <hr class="mt-1 mb-1">
        @if ($vendorid->waiver_signed_date)
            <div style="margin-left: 20px">
                <h5 style="margin-bottom: 20px;">@lang('Sub Contractor Details:')</h5>
                <img src="{{ $vendorid->secondary_image_url }}" style="width: 200px;">
                <p>Vendor Name:- {{ $vendorid->vendor_name }}<br>
                   Company Name:- {{$vendorid->company_name}}<br>
                   Address :- {{$vendorid->street_address}}, {{$vendorid->city}}, {{$vendorid->state}}, {{$vendorid->zip_code}}<br>
                   Date:- {{ $vendorid->waiver_signed_date}}
                </p>
            </div>
        @endif
        <!-- CARD FOOTER END -->
    </div>
</div>

<!-- Global Required Javascript -->
<script src="{{ asset('js/main.js') }}"></script>

<script>
    $('#accept').click(function () {
        var token="{{ csrf_token() }}";
        var data="{{$vendorid->id}}";
        $.easyAjax({
            url: "{{ route('front.waiver.store') }}",
            type: "POST",
            blockUI: true,
            disableButton: true,
            buttonSelector: '#accept',
            data: {
                    '_token': token,
                    'data':data,
                    'action':'accept'
                },
            success: function(response) {
                window.location.reload();
            },
        });
    });

    $('#reject').click(function () {
        var token="{{ csrf_token() }}";
        var data="{{$vendorid->id}}";
        $.easyAjax({
            url: "{{ route('front.waiver.store') }}",
            type: "POST",
            blockUI: true,
            disableButton: true,
            buttonSelector: '#reject',
            data: {
                    '_token': token,
                    'data':data,
                    'action':'reject'
                },
            success: function(response) {
                window.location.reload();
            },
        });
    });
   

</script>


</body>

</html>
