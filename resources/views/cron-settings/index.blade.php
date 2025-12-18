@extends('layouts.app')

@section('content')

    <!-- SETTINGS START -->
    <div class="w-100 d-flex ">

        @include('sections.setting-sidebar')

        <x-setting-card>

            <x-slot name="header">
                <div class="s-b-n-header" id="tabs">
                    <h2 class="mb-0 p-20 f-21 font-weight-normal text-capitalize border-bottom-grey">
                        @lang($pageTitle)</h2>
                </div>
            </x-slot>

            <div class="col-lg-12 col-md-12 ntfcn-tab-content-left w-100 p-4 ">
                <x-table class="border-0 pb-3 admin-dash-table table-hover">

                    <x-slot name="thead">
                        <th class="pl-20">#</th>
                        <th>@lang('Queue')</th>
                        <th>@lang('Queue Command')</th>
                        <th>@lang('Queue Description')</th>
                        <th>@lang('Remaining Jobs')</th>
                        <th>@lang('Failed Jobs')</th>
                        <th>@lang('Latest Execution')</th>
                        <th class="text-right pr-20">@lang('app.action')</th>
                    </x-slot>
                </x-table>
            </div>


        </x-setting-card>

    </div>
    <!-- SETTINGS END -->
@endsection

@push('scripts')
    <script>

        
    </script>
@endpush
