<style>
.btn-xs {
  padding: .25rem .4rem;
  font-size: .875rem;
  line-height: .5;
  border-radius: .2rem; 
}

</style>
<div class="row py-5">
    <div class="col-lg-12 col-md-12 mb-4 mb-xl-0 mb-lg-4">
        
            <x-forms.button-primary icon="plus" id="add-project-sow" class="type-btn mb-3">
                @lang('Add Vendors')
            </x-forms.button-primary>
              <x-cards.data :title="__('Vendors')"
                otherClasses="border-0 p-0 d-flex justify-content-between align-items-center ">
                <x-table class="border-0 pb-3 admin-dash-table table-hover table-responsive-sm">
                    <x-slot name="thead">
                        <th class="pl-20">#</th>
                        <th>@lang('Vendor Name')</th>
                        <th>@lang('Company Name')</th>
                        <th>@lang('app.mobile')</th>
                        <th>@lang('app.email')</th>
                        <th>@lang('Project Amount')</th>
                        <th>@lang('Sow')</th>
                        <th>@lang('Link Sent By')</th>
                        <th>@lang('Link Date')</th>
                        <th>@lang('Work Order Status')</th>
                        <th>@lang('Link Status')</th>
                        <th>@lang('Change Notification Status')</th>
                        
                        <th class="text-right pr-20">@lang('app.action')</th>
                    </x-slot>

                    @forelse($project->projectvendor as $key => $item)
                        <tr id="row-{{ $item->id }}">
                            <td class="pl-20">{{ $key + 1 }}</td>
                            <td>
                                <a href="javascript:;" class="sow-detail text-darkest-grey f-w-500"
                                    data-sow-id="{{ $item->id }}">{{ $item->vendor_name }}</a>
                            </td>
                            <td>
                                {{ $item->vendors->company_name ?? ''}}
                            </td>
                            <td>
                                {{$item->vendor_phone}}
                            </td>
                            <td>
                                {{$item->vendor_email_address}}
                            </td>
                            <td>
                                {{$item->project_amount??''}}
                            </td>
                            <td>
                                @if($item->sow_id)
                                    @foreach($item->sow_id as $sow)
                                       @php
                                        $sowData = $item->sowname($sow); // Get the related model instance
                                       @endphp
                                        {{ $sowData?->sow_title }}- {{ $sowData?->category }} - {{ $sowData?->sub_category }}<br/>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                {{ $item->linksentby->name??'' }}
                            </td>
                            <td>
                                {{ $item->created_at->format(company()->date_format) }}
                            </td>
                            <td>
                                <select class="form-control select-picker update-select-wo" name="wo_status" id="wo_status-{{ $item->id }}" data-wo-status-id="{{ $item->id }}">
                                    <option value="">--</option>
                                    @foreach ($wostatus as $category)
                                        <option @selected($item->wo_status == $category->wo_status) value="{{ $category->wo_status }}">
                                        {{ $category->wo_status }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select class="form-control select-picker update-select" name="link_status" id="link_status" data-status-id="{{ $item->id }}">
                                    <option @selected($item->link_status == 'Accepted') value="Accepted" data-content='<i class="fa fa-circle mr-2" style="color:#679c0d;"></i>Accepted'>
                                    </option>
                                    <option @selected($item->link_status == 'Rejected') value="Rejected" data-content='<i class="fa fa-circle mr-2" style="color:#f5c308;"></i>Rejected'>
                                    </option>
                                    <option @selected($item->link_status == 'Sent') value="Sent" data-content='<i class="fa fa-circle mr-2" style="color:#00b5ff;"></i>Sent'>
                                    </option>
                                    <option @selected($item->link_status == 'Removed') data-content='<i class="fa fa-circle mr-2" style="color:#d21010;"></i>Removed'>
                                    Removed</option>
                                </select>
                            </td>
                            <td>
                                {{ $vendor->latestChangeNotification?->link_status ?? '--' }}
                            </td>
                            <td class="text-right pr-20">
                                <a href="javascript:;" class="text-dark toggle-contact-information" data-target="#contact-information-{{ $item->id }}" data-date="{{$item->id}}">
                                    <i class="fa fa-chevron-down"></i> @lang('Show More')
                                </a>
                            </td>
                        </tr>
                        <tr id="contact-information-{{ $item->id }}" class="contact-information-row d-none">
                            <td colspan="13">
                                <x-form id="updateProjectVendor-{{ $item->id }}" method="PUT">
                                    <a href="javascript:;" class="text-dark toggle-original" data-original-id="{{ $item->id }}"><i
                                            class="fa fa-chevron-down"></i>
                                        @lang('Original')</a>
                                    <div class="row border rounded mr-0 bg-additional-grey d-none" id="original-{{ $item->id }}">
                                        
                                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                                        <div class="col-lg-2">
                                            <x-forms.datepicker fieldId="inspection_date-{{ $item->id }}" custom="true"
                                                :fieldLabel="__('Inspection Date')" fieldName="inspection_date"
                                                :fieldValue="($item->inspection_date ? $item->inspection_date->format(company()->date_format) : '')"
                                                :fieldPlaceholder="__('placeholders.date')" />
                                        </div>
                                        <div class="col-md-2 col-lg-2">
                                            <div>
                                            <x-forms.text :fieldLabel="__('Inspection Time')"
                                                :fieldPlaceholder="__('placeholders.hours')" fieldName="inspection_time"
                                                fieldId="inspection_time-{{ $item->id }}" 
                                                :fieldValue="($item->inspection_time ? \Carbon\Carbon::createFromFormat('H:i:s', $item->inspection_time)->format(company()->time_format) : '')" />        
                                            </div>          
                                        </div>
                                        <div class="col-md-2 col-lg-2">
                                            <x-forms.datepicker fieldId="re_inspection_date-{{ $item->id }}" custom="true"
                                                :fieldLabel="__('Re-Inspection Date')" fieldName="re_inspection_date"
                                                :fieldValue="($item->re_inspection_date ? $item->re_inspection_date->format(company()->date_format) : '')"
                                                :fieldPlaceholder="__('placeholders.date')" />
                                        </div>
                                        <div class="col-md-2 col-lg-2">
                                            <x-forms.text :fieldLabel="__('Re-inspection Time')"
                                                        :fieldPlaceholder="__('placeholders.hours')" fieldName="re_inspection_time"
                                                        fieldId="re_inspection_time-{{ $item->id }}" 
                                                        :fieldValue="($item->re_inspection_time ? \Carbon\Carbon::createFromFormat('H:i:s', $item->re_inspection_time)->format(company()->time_format) : '')" />
                                        </div>
                                        <div class="col-md-2 col-lg-2">
                                            <x-forms.datepicker fieldId="bid_ecd-{{ $item->id }}" custom="true"
                                                :fieldLabel="__('Bid Ecd Date')" fieldName="bid_ecd"
                                                :fieldValue="($item->bid_ecd ? $item->bid_ecd->format(company()->date_format) : '')"
                                                :fieldPlaceholder="__('placeholders.date')" />
                                        </div>
                                        <div class="col-md-2 col-lg-2">
                                            <x-forms.datepicker fieldId="bid_submitted_date-{{ $item->id }}" custom="true"
                                                :fieldLabel="__('Bid Submitted Date')" fieldName="bid_submitted_date"
                                                :fieldValue="($item->bid_submitted_date ? $item->bid_submitted_date->format(company()->date_format) : '')"
                                                :fieldPlaceholder="__('placeholders.date')" />
                                        </div>
                                        <div class="col-lg-2 col-md-2">
                                            <x-forms.text class="" :fieldLabel="__('Bid Amount')"
                                                        fieldName="bid_amount"  fieldId="bid_amount-{{ $item->id }}"
                                                        :fieldPlaceholder="__('Bid Amount')" :fieldValue="$item->bid_amount" />
                                        </div>
                                        <div class="col-md-2 col-lg-2">
                                            <x-forms.datepicker fieldId="bid_rejected_date-{{ $item->id }}" custom="true"
                                                :fieldLabel="__('Bid Rejected Date')" fieldName="bid_rejected_date"
                                                :fieldValue="($item->bid_rejected_date ? $item->bid_rejected_date->format(company()->date_format) : '')"
                                                :fieldPlaceholder="__('placeholders.date')" />
                                        </div>
                                        <div class="col-md-1 col-lg-2">
                                            <x-forms.datepicker fieldId="cancelled_date-{{ $item->id }}" custom="true"
                                                :fieldLabel="__('Cancelled Date')" fieldName="cancelled_date"
                                                :fieldValue="($item->cancelled_date ? $item->cancelled_date->format(company()->date_format) : '')"
                                                :fieldPlaceholder="__('placeholders.date')" />
                                        </div>
                                        <div class="col-md-2">
                                            <x-forms.label class="mb-12 mt-3" fieldId="cancelled_reason"
                                                        :fieldLabel="__('Cancelled Reason')">
                                            </x-forms.label>
                                            <x-forms.input-group>
                                                <select class="form-control select-picker" name="cancelled_reason" id="cancelled_reason-{{ $item->id }}"
                                                        data-live-search="true">
                                                        <option value="">--</option>
                                                    @foreach ($cancelledreason as $category)
                                                        <option @selected($item->cancelled_reason == $category->cancelled_reason) value="{{ $category->cancelled_reason}}">
                                                        {{ $category->cancelled_reason }}</option>
                                                    @endforeach
                                                </select>
                                            </x-forms.input-group>
                                        </div>
                                    </div>
                                    <a href="javascript:;" class="text-dark toggle-change-notify" data-change-id="{{ $item->id }}">
                                        <i class="fa fa-chevron-down"></i>
                                            @lang('Change Order')</a>
                                    <div class="row border rounded mr-0 bg-additional-grey d-none" id="change-notify-group-{{ $item->id }}">
                                        <div class="col-md-2 col-lg-2">
                                            <x-forms.datepicker fieldId="bid_approval_date-{{ $item->id }}" custom="true"
                                                :fieldLabel="__('Bid Approval Date')" fieldName="bid_approval_date"
                                                :fieldValue="($item->bid_approval_date ? $item->bid_approval_date->format(company()->date_format) : '')"
                                                :fieldPlaceholder="__('placeholders.date')" />
                                        </div>
                                        <div class="col-md-2 col-lg-2">
                                            <x-forms.datepicker fieldId="work_schedule_date-{{ $item->id }}" custom="true"
                                                :fieldLabel="__('Work Schedule Date')" fieldName="work_schedule_date"
                                                :fieldValue="($item->work_schedule_date ? $item->work_schedule_date->format(company()->date_format) : '')"
                                                :fieldPlaceholder="__('placeholders.date')" />
                                        </div>
                                        <div class="col-md-2 col-lg-2">
                                                    <div class="">
                                                        <x-forms.text :fieldLabel="__('Work Schedule Time')"
                                                            :fieldPlaceholder="__('placeholders.hours')" fieldName="work_schedule_time"
                                                            fieldId="work_schedule_time-{{ $item->id }}" 
                                                            :fieldValue="($item->work_schedule_time ? \Carbon\Carbon::createFromFormat('H:i:s', $item->work_schedule_time)->format(company()->time_format) : '')" />
                                                    </div>
                                        </div>
                                        <div class="col-md-2 col-lg-2">
                                            <x-forms.datepicker fieldId="work_schedule_re_date-{{ $item->id }}" custom="true"
                                                :fieldLabel="__('Work Re-Schedule Date')" fieldName="work_schedule_re_date"
                                                :fieldValue="($item->work_schedule_re_date ? $item->work_schedule_re_date->format(company()->date_format) : '')"
                                                :fieldPlaceholder="__('placeholders.date')" />
                                        </div>
                                        <div class="col-md-2 col-lg-2">
                                                    <div class="">
                                                        <x-forms.text :fieldLabel="__('Work Re-Schedule Time')"
                                                            :fieldPlaceholder="__('placeholders.hours')" fieldName="work_schedule_re_time"
                                                            fieldId="work_schedule_re_time-{{ $item->id }}" 
                                                            :fieldValue="($item->work_schedule_re_time ? \Carbon\Carbon::createFromFormat('H:i:s', $item->work_schedule_re_time)->format(company()->time_format) : '')" />
                                                    </div>
                                        </div>
                                        <div class="col-md-2 col-lg-2">
                                            <x-forms.datepicker fieldId="work_completion_date-{{ $item->id }}" custom="true"
                                                :fieldLabel="__('Work Completion Date')" fieldName="work_completion_date"
                                                :fieldValue="($item->work_completion_date ? $item->work_completion_date->format(company()->date_format) : '')"
                                                :fieldPlaceholder="__('placeholders.date')" />
                                        </div>
                                        <div class="col-md-2 col-lg-2">
                                            <x-forms.datepicker fieldId="work_ecd-{{ $item->id }}" custom="true"
                                                :fieldLabel="__('Work Ecd')" fieldName="work_ecd"
                                                :fieldValue="($item->work_ecd ? $item->work_ecd->format(company()->date_format) : '')"
                                                :fieldPlaceholder="__('placeholders.date')" />
                                        </div>
                                        <div class="col-lg-2 col-md-2">
                                            <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Bid Approved Amount')"
                                                        fieldName="bid_approved_amount"  fieldId="bid_approved_amount-{{ $item->id }}"
                                                        :fieldPlaceholder="__('Bid Approved Amount')" :fieldValue="$item->bid_approved_amount"/>
                                        </div>
                                    
                                        <div class="col-md-2 col-lg-2">
                                            <x-forms.datepicker fieldId="invoiced_date-{{ $item->id }}" custom="true"
                                                :fieldLabel="__('Invoiced Date')" fieldName="invoiced_date"
                                                :fieldValue="($item->invoiced_date ? $item->invoiced_date->format(company()->date_format) : '')"
                                                :fieldPlaceholder="__('placeholders.date')" />
                                        </div>
                                        <div class="col-lg-2 col-md-2">
                                            <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Invoiced Amount')"
                                                        fieldName="invoiced_amount"  fieldId="invoiced_amount-{{ $item->id }}"
                                                        :fieldPlaceholder="__('Invoiced Amount')" :fieldValue="$item->invoiced_amount"/>
                                        </div>
                                        <div class="col-md-2 col-lg-2">
                                            <x-forms.datepicker fieldId="paid_date-{{ $item->id }}" custom="true"
                                                :fieldLabel="__('Paid Date')" fieldName="paid_date"
                                                :fieldValue="($item->paid_date ? $item->paid_date->format(company()->date_format) : '')"
                                                :fieldPlaceholder="__('placeholders.date')" />
                                        </div>
                                        <div class="col-lg-2 col-md-2">
                                            <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Paid Amount')"
                                                fieldName="paid_amount"  fieldId="paid_amount-{{ $item->id }}"
                                                :fieldPlaceholder="__('Paid Amount')" :fieldValue="$item->paid_amount"/>
                                        </div>
                                        @php
                                        $changeOrderAmounts = $item->changenotification
                                            ->filter(function ($notification) {
                                                return $notification->link_status === 'Accepted' && !is_null($notification->accepted_date);
                                            })
                                            ->pluck('project_amount');

                                        // Convert each value to a float and calculate the total
                                        $totalChangeOrderAmount = $changeOrderAmounts->map(function ($amount) {
                                            return (float) $amount; // Convert VARCHAR to float
                                        })->sum();
                                        @endphp
                                        <div class="col-lg-2 col-md-2">
                                            <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Change Order Amount')"
                                                fieldName="change_order_amount" fieldReadOnly fieldId="change_order_amount-{{ $item->id }}"
                                                :fieldPlaceholder="__('Change Order Amount')" :fieldValue="$totalChangeOrderAmount"/>
                                        </div>
                                        
                                        <input type="text" id="linkInput-{{ $item->id }}" value="{{$item->link}}" class="d-none">
                                    </div>
                                    <div class="row justify-content-end mr-2">
                                            
                                            <a class="btn btn-secondary m-2 btn-xs generate-link-estimate" href="javascript:;"
                                                data-estimate-vendor-id="{{ $item->id }}" data-estimate-project-id="{{$project->id}}">
                                                <i class="fa fa-credit-card mr-2"></i>
                                                @lang('Generate Estimate Link')
                                            </a>
                                            <a class="btn btn-secondary m-2 btn-xs change-notify-history" href="javascript:;"
                                                data-notify-history-id="{{ $item->id }}">
                                                <i class="fa fa-table mr-2"></i>
                                                @lang('Change Notification History')
                                            </a>
                                            <a class="btn btn-secondary m-2 btn-xs change-notify" href="javascript:;"
                                                data-notify-id="{{ $item->id }}">
                                                <i class="fa fa-paper-plane mr-2"></i>
                                                @lang('Change Notification')
                                            </a>
                                            @if(in_array('admin', user_roles()))
                                            <a class="btn btn-secondary m-2 btn-xs delete-row" href="javascript:;"
                                            data-row-id="{{ $item->id }}">
                                                    <i class="fa fa-trash mr-2"></i>
                                                    @lang('Delete')
                                            </a>
                                            @endif
                                            <a class="btn btn-secondary m-2 btn-xs copy-vpro" href="javascript:;"
                                            data-row-id="{{ $item->id }}">
                                                    <i class="fa fa-copy mr-2"></i>
                                                    @lang('Copy Link')
                                            </a>
                                            @if($item->link_status!=='Accepted')
                                            <a class="btn btn-secondary m-2 btn-xs relink-vpro" href="javascript:;"
                                                data-link-id="{{ $item->id }}">
                                                <i class="fa fa-paper-plane mr-2"></i>
                                                @lang('Resend Link')
                                            </a>
                                            @endif
                                            <a class="btn btn-secondary m-2 btn-xs" href="{{route('projectvendors.download', $item->id)}}"
                                                data-row-id="{{ $item->id }}">
                                                <i class="fa fa-download mr-2"></i>
                                                @lang('Download')
                                            </a>
                                            
                                            <a class="btn btn-secondary m-2 btn-xs edit-vpro" href="javascript:;"
                                                data-row-id="{{ $item->id }}">
                                                <i class="fa fa-edit mr-2"></i>
                                                @lang('Save')
                                            </a>
                                    </div>
                                    
                                </x-form>
                            </td>
                        </tr>            
                    @empty
                        <x-cards.no-record-found-list colspan="12"/>
                    @endforelse
                </x-table>

            </x-cards.data>
    </div>

</div>
<!-- ROW END -->

<script>

    $(document).ready(function() {
       
        var firstOpen = true;
        var time;
        
        const toggles = document.querySelectorAll('.toggle-contact-information');
        
        toggles.forEach(toggle => {
            toggle.addEventListener('click', function () {
                var id = $(this).data('date');
                $('#inspection_time-' + id + ', #re_inspection_time-' + id + ', #work_schedule_time-' + id + ', #work_schedule_re_time-' + id).datetimepicker({
                    @if (company()->time_format == 'H:i')
                        showMeridian: false,
                    @endif
                    useCurrent: false,
                    format: "hh:mm A"
                    }).on('dp.show', function() {
                    if(firstOpen) {
                        time = moment().startOf('day');
                        firstOpen = false;
                    } 
                    
                });
                $(this).find('svg').toggleClass('fa-chevron-down fa-chevron-up');
                const targetId = this.getAttribute('data-target');
                const targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    targetElement.classList.toggle('d-none');
                }
            });
        });
        $('.custom-date-picker').each(function(ind, el) {
            datepicker(el, {
                position: 'bl',
                ...datepickerConfig
            });
        });
        
        
    });
    
    $('#add-project-sow').click(function() {
        const url = "{{ route('projectvendors.create') }}" + "?id={{ $project->id }}";
        $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
        $.ajaxModal(MODAL_LG, url);

    });
    $('.toggle-original').click(function () {
            var id = $(this).data('original-id');
            $(this).find('svg').toggleClass('fa-chevron-down fa-chevron-up');
            $('#original-'+id).toggleClass('d-none');
    });
    $('.toggle-change-notify').click(function () {
            var id = $(this).data('change-id');
            $(this).find('svg').toggleClass('fa-chevron-down fa-chevron-up');
            $('#change-notify-group-'+id).toggleClass('d-none');
    });
    
    $('body').on('click', '.change-notify', function() {
        
        var id = $(this).data('notify-id');
        var url = "{{ route('projectvendors.changenotification',':id') }}";
        url = url.replace(':id', id);
        $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
        $.ajaxModal(MODAL_LG, url);

    });

    $('body').on('click', '.change-notify-history', function() {
        
        var id = $(this).data('notify-history-id');
        var url = "{{ route('projectvendors.changenotificationhistory',':id') }}";
        url = url.replace(':id', id);
        $(MODAL_XL + ' ' + MODAL_HEADING).html('...');
        $.ajaxModal(MODAL_XL, url);

    });

    $('body').on('click', '.edit-vpro', function() {
        var id = $(this).data('row-id');
        var url = "{{ route('projectvendors.update', ':id') }}";
        url = url.replace(':id', id);
        var contain = '#updateProjectVendor-:id';
        contain = contain.replace(':id', id);
        $.easyAjax({
            url: url,
            container: contain,
            type: "POST",
            blockUI: true,
            disableButton: true,
            data: $(contain).serialize(),
            success: function(response) {
                if (response.status == 'success') {
                    window.location.reload();
                }
            }
        })

    });
    $('.update-select').change(function() {
        var select = $(this);
        var id = select.data('status-id');
        var value = select.val();
        var url="{{ route('projectvendors.linkstatuschange',':id') }}";
        url = url.replace(':id', id);
        $.easyAjax({
                url: url,
                type: 'POST',
                blockUI: true,
                data: {
                        _token: '{{ csrf_token() }}',
                        value: value
                    },
                success: function(response) {
                    if (response.status == 'success') {
                        window.location.reload();
                    } 
                },
            });
        
    });
    $('.update-select-wo').change(function() {
        var select = $(this);
        var id = select.data('wo-status-id');
        var value = select.val();
        var url="{{ route('projectvendors.wostatuschange',':id') }}";
        url = url.replace(':id', id);
        $.easyAjax({
                url: url,
                type: 'POST',
                blockUI: true,
                data: {
                        _token: '{{ csrf_token() }}',
                        value: value
                    },
                success: function(response) {
                    if (response.status == 'success') {
                        window.location.reload();
                    } 
                },
            });
        
    });


    $('body').on('click', '.copy-vpro', function() {
        var id = $(this).data('row-id');
        var link = document.getElementById('linkInput-'+id).value;
        navigator.clipboard.writeText(link).then(function() {
            Swal.fire({
                icon: 'success',
                text: '{{ __('Link Copied') }}',

                customClass: {
                    confirmButton: 'btn btn-primary',
                },
                showClass: {
                    popup: 'swal2-noanimation',
                    backdrop: 'swal2-noanimation'
                },
                buttonsStyling: false
            });
        }).catch(function(err) {
        console.error('Failed to copy text: ', err);
        });
        
    });

    $('body').on('click', '.relink-vpro', function() {
        var id = $(this).data('link-id');
        var url="{{ route('projectvendors.resentlink',':id') }}";
        url = url.replace(':id', id);
        $.easyAjax({
                url: url,
                type: 'POST',
                blockUI: true,
                data: {
                        _token: '{{ csrf_token() }}',
                    },
                success: function(response) {
                    if (response.status == 'success') {
                        window.location.reload();
                    } 
                },
            });
    });

    $('.delete-row').click(function() {

        var id = $(this).data('row-id');
        var url = "{{ route('projectvendors.destroy', ':id') }}";
        url = url.replace(':id', id);

        var token = "{{ csrf_token() }}";

        Swal.fire({
            title: "@lang('messages.sweetAlertTitle')",
            text: "@lang('messages.recoverRecord')",
            icon: 'warning',
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: "@lang('messages.confirmDelete')",
            cancelButtonText: "@lang('app.cancel')",
            customClass: {
                confirmButton: 'btn btn-primary mr-3',
                cancelButton: 'btn btn-secondary'
            },
            showClass: {
                popup: 'swal2-noanimation',
                backdrop: 'swal2-noanimation'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                $.easyAjax({
                    type: 'POST',
                    url: url,
                    data: {
                        '_token': token,
                        '_method': 'DELETE'
                    },
                    success: function(response) {
                        if (response.status == "success") {
                           window.location.reload();
                        }
                    }
                });
            }
        });

    });
    $('.generate-link-estimate').click(function() {
        
        var vendor_id = $(this).data('estimate-vendor-id');
        var project_id = $(this).data('estimate-project-id');
        var url="{{ route('vendor-estimates.generateLink') }}";
        var token = "{{ csrf_token() }}";
        $.easyAjax({
            url: url,
            type: "POST",
            blockUI: true,
            buttonSelector: ".generate-link-estimate",
            data: {
                '_token': token,
                'vendor_id':vendor_id,
                'project_id':project_id
            },
            success: function(response) {
                if (response.status == 'success') {
                    navigator.clipboard.writeText(response.url).then(function() {
                        Swal.fire({
                            icon: 'success',
                            text: '{{ __('Link Copied') }}',

                            customClass: {
                                confirmButton: 'btn btn-primary',
                            },
                            showClass: {
                                popup: 'swal2-noanimation',
                                backdrop: 'swal2-noanimation'
                            },
                            buttonsStyling: false
                        });
                    }).catch(function(err) {
                        console.error('Failed to copy text: ', err);
                    });
                }
            }
        });

    });

</script>
