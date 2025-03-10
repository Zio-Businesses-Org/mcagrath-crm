@extends('layouts.app')

@section('content')


    <!-- SETTINGS START -->
    <div class="w-100 d-flex ">

        @include('sections.setting-sidebar')

        <x-setting-card>
            <x-slot name="header">
                <div class="s-b-n-header" id="tabs">
                    <nav class="tabs px-4 border-bottom-grey">
        
                        <div class="nav" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link f-15 active sendReminder"
                               href="{{ route('project-settings.index') }}" role="tab"
                               aria-controls="nav-sendReminder" aria-selected="true">@lang($pageTitle)
                            </a>

                            <a class="nav-item nav-link f-15 status"
                               href="{{ route('project-settings.index') }}?tab=status" role="tab"
                               aria-controls="nav-status"
                               aria-selected="true">@lang('modules.projects.projectStatusSettings')
                            </a>

                            <a class="nav-item nav-link f-15 category"
                               href="{{ route('project-settings.index') }}?tab=category" role="tab"
                               aria-controls="nav-category"
                               aria-selected="true">@lang('modules.projects.projectCategory')
                            </a>

                            <a class="nav-item nav-link f-15 sub-category"
                               href="{{ route('project-settings.index') }}?tab=sub-category" role="tab"
                               aria-controls="nav-sub-category"
                               aria-selected="true">@lang('modules.projects.projectsubcategory')
                            </a>

                            <a class="nav-item nav-link f-15 type"
                               href="{{ route('project-settings.index') }}?tab=type" role="tab"
                               aria-controls="nav-type"
                               aria-selected="true">@lang('Project Type')
                            </a>
                            <a class="nav-item nav-link f-15 priority"
                               href="{{ route('project-settings.index') }}?tab=priority" role="tab"
                               aria-controls="nav-priority"
                               aria-selected="true">@lang('Project Priority')
                            </a>
                            <a class="nav-item nav-link f-15 propertytype"
                               href="{{ route('project-settings.index') }}?tab=propertytype" role="tab"
                               aria-controls="nav-propertytype"
                               aria-selected="true">@lang('Property Type')
                            </a> <a class="nav-item nav-link f-15 occupancystatus"
                               href="{{ route('project-settings.index') }}?tab=occupancystatus" role="tab"
                               aria-controls="nav-occupancystatus"
                               aria-selected="true">@lang('Occupancy Status')
                            </a>
                            </a> <a class="nav-item nav-link f-15 delayedby"
                               href="{{ route('project-settings.index') }}?tab=delayedby" role="tab"
                               aria-controls="nav-delayedby"
                               aria-selected="true">@lang('Delayed By')
                            </a> <a class="nav-item nav-link f-15 contractortype"
                               href="{{ route('project-settings.index') }}?tab=contractortype" role="tab"
                               aria-controls="nav-contractortypr"
                               aria-selected="true">@lang('Contractor Type')
                            </a> <a class="nav-item nav-link f-15 cancelledreason"
                               href="{{ route('project-settings.index') }}?tab=cancelledreason" role="tab"
                               aria-controls="nav-cancelledreason"
                               aria-selected="true">@lang('Cancelled Reason')
                            </a>
                            <a class="nav-item nav-link f-15 filetype"
                               href="{{ route('project-settings.index') }}?tab=filetype" role="tab"
                               aria-controls="nav-filetype"
                               aria-selected="true">@lang('External File Type')
                            </a>

                        </div>
                      
                    </nav>
                </div>
            </x-slot>

            <x-slot name="buttons">
                <div class="row">

                    <div class="col-md-12 mb-2">

                        <x-forms.button-primary icon="plus" id="add-status" class="status-btn mb-2 actionBtn d-none">
                            @lang('modules.statusFields.addstatus')
                        </x-forms.button-primary>

                        <x-forms.button-primary icon="plus" id="addProjectCategory"
                                    class="category-btn d-none mb-2 actionBtn"> @lang('modules.statusFields.addCategory')
                        </x-forms.button-primary>

                        <x-forms.button-primary icon="plus" id="addProjectSubCategory"
                                    class="sub-category-btn d-none mb-2 actionBtn"> @lang('Add Sub-Category')
                        </x-forms.button-primary>
                        <x-forms.button-secondary icon="file-upload" id="importProjectSubCategory"
                                    class="sub-category-btn d-none mb-2 actionBtn ml-2"> @lang('Import')
                        </x-forms.button-secondary>
                        <!-- <x-forms.button-secondary id="exportProjectSubCategory"
                                    class="sub-category-btn d-none mb-2 actionBtn ml-2"> @lang('Export')
                        </x-forms.button-secondary> -->
                        
                        <x-forms.link-secondary :link="route('project-settings.exportProjectSubCategory')" class="sub-category-btn d-none mb-2 actionBtn mt-1 ml-2" >
                        <i class="fa fa-file-export"></i> @lang('Export')
                        </x-forms.link-secondary>
                        <x-forms.button-primary icon="plus" id="addProjectType"
                                    class="type-btn d-none mb-2 actionBtn"> @lang('Add Type')
                        </x-forms.button-primary>
                        <x-forms.button-primary icon="plus" id="addProjectPriority"
                                    class="priority-btn d-none mb-2 actionBtn"> @lang('Add Priority')
                        </x-forms.button-primary>
                        <x-forms.button-primary icon="plus" id="addPropertyType"
                                    class="propertytype-btn d-none mb-2 actionBtn"> @lang('Add Property Type')
                        </x-forms.button-primary>
                        <x-forms.button-primary icon="plus" id="addOccupancyStatus"
                                    class="occupancystatus-btn d-none mb-2 actionBtn"> @lang('Add Occupancy Status')
                        </x-forms.button-primary>
                        <x-forms.button-primary icon="plus" id="addDelayedBy"
                                    class="delayedby-btn d-none mb-2 actionBtn"> @lang('Add Delayed By')
                        </x-forms.button-primary>
                        <x-forms.button-primary icon="plus" id="addContractorType"
                                    class="contractortype-btn d-none mb-2 actionBtn"> @lang('Add Contractor Type')
                        </x-forms.button-primary>
                        <x-forms.button-primary icon="plus" id="addCancelledReason"
                                    class="cancelledreason-btn d-none mb-2 actionBtn"> @lang('Add Cancelled Reason')
                        </x-forms.button-primary>
                        <x-forms.button-primary icon="plus" id="addFileType"
                                    class="filetype-btn d-none mb-2 actionBtn"> @lang('Add External File Type')
                        </x-forms.button-primary>
                    </div>

                </div>
            </x-slot>

            @include($view)

        </x-setting-card>
        
    </div>
    <!-- SETTINGS END -->
@endsection

@push('scripts')
    <script>

        $('.nav-item').removeClass('active');
        const activeTab = "{{ $activeTab }}";
        $('.' + activeTab).addClass('active');

        $("body").on("click", "#editSettings .nav a", function(event) {
            event.preventDefault();

            $('.nav-item').removeClass('active');
            $(this).addClass('active');

            const requestUrl = this.href;
            $.easyAjax({
                url: requestUrl,
                blockUI: true,
                container: "#nav-tabContent",
                historyPush: true,
                success: function(response) {
                    showBtn(response.activeTab);
                    if (response.status == "success") {
                        $('#nav-tabContent').html(response.html);
                        init('#nav-tabContent');
                    }
                }
            });
        });

        function showBtn(activeTab) {
            $('.actionBtn').addClass('d-none');
            $('.' + activeTab + '-btn').removeClass('d-none');
        }

        showBtn(activeTab);
    </script>
@endpush
