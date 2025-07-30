@php
$addProjectCategoryPermission = user()->permission('manage_project_category');
$addClientPermission = user()->permission('add_clients');
$editProjectMemberPermission = user()->permission('edit_project_members');
$addEmployeePermission = user()->permission('add_employees');
$addProjectMemberPermission = user()->permission('add_project_members');
$addProjectMemberPermission = user()->permission('add_project_members');
$createPublicProjectPermission = user()->permission('create_public_project');

@endphp
<style>
        .tenant-fields {
            display: none;
        }
</style>
<link rel="stylesheet" href="{{ asset('vendor/css/dropzone.min.css') }}">
<div class="row">
    <div class="col-sm-12">
        <x-form id="save-project-data-form" method="PUT">
            <div class="add-client bg-white rounded">
                <h4 class="mb-0 p-20 f-21 font-weight-normal text-capitalize border-bottom-grey">
                    @lang('modules.projects.projectInfo')</h4>
                <div class="row p-20">
                    <div class="col-lg-3 col-md-3">
                        <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Work Order #')"
                            fieldName="project_code" fieldRequired="true" fieldId="project_code"
                            :fieldPlaceholder="__('Project unique work order')" :fieldValue="$project->project_short_code" />
                    </div>
                     <div class="col-md-3">

                        <x-forms.input-group>
                            <x-client-selection-dropdown :clients="$clients" fieldRequired="false"
                                                         :selected="$project->client_id ?? null"/>
{{--                            @if ($addClientPermission == 'all' || $addClientPermission == 'added')--}}
{{--                                <x-slot name="append">--}}
{{--                                    <button id="add-client" type="button"--}}
{{--                                        class="btn btn-outline-secondary border-grey"--}}
{{--                                        data-toggle="tooltip" data-original-title="{{__('modules.client.addNewClient') }}">@lang('app.add')</button>--}}
{{--                                </x-slot>--}}
{{--                            @endif--}}
                        </x-forms.input-group>
                    </div>

                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                    <input type="hidden" name="projectID" value="{{ $projectID }}">
                    <div class="col-md-3">
                        <x-forms.label class="mb-12 mt-3" fieldId="type"
                                       :fieldLabel="__('Project Type')">
                        </x-forms.label>
                        <x-forms.input-group>
                            <select class="form-control select-picker" name="type" id="type"
                                    data-live-search="true">
                                    <option value="">--</option>
                                @foreach ($projecttype as $category)
                                    <option @selected($project->type == $category->type) value="{{ $category->type }}">
                                    {{ $category->type }}</option>
                                @endforeach
                            </select>
                        </x-forms.input-group>
                    </div>
                    <div class="col-md-3">
                        <x-forms.label class="mb-12 mt-3" fieldId="priority"
                                       :fieldLabel="__('Priority')">
                        </x-forms.label>
                        <x-forms.input-group>
                            <select class="form-control select-picker" name="priority" id="priority"
                                    data-live-search="true">
                                <option value="">--</option>
                                @foreach ($projectpriority as $category)
                                    <option @selected($project->priority == $category->priority) value="{{ $category->priority }}">
                                    {{ $category->priority }}</option>
                                @endforeach
                            </select>
                        </x-forms.input-group>
                    </div>
                    <div class="col-md-3">
                        <x-forms.label class="my-3" fieldId="category_id"
                            :fieldLabel="__('modules.projects.projectCategory')">
                        </x-forms.label>
                        <x-forms.input-group>
                            <select class="form-control select-picker" name="category_id" id="project_category_id"
                                data-live-search="true">
                                <option value="">--</option>
                                @foreach ($categories as $category)
                                    <option @selected($project->category_id == $category->id) value="{{ $category->id }}">
                                        {{ $category->category_name }}</option>
                                @endforeach
                            </select>

                            @if ($addProjectCategoryPermission == 'all' || $addProjectCategoryPermission == 'added')
                                <x-slot name="append">
                                    <button id="addProjectCategory" type="button"
                                        class="btn btn-outline-secondary border-grey"
                                        data-toggle="tooltip" data-original-title="{{__('modules.projectCategory.addProjectCategory') }}">@lang('app.add')</button>
                                </x-slot>
                            @endif
                        </x-forms.input-group>
                    </div>

                    <div class="col-md-3">
                        <x-forms.label class="my-3" fieldId="sub_category"
                                       :fieldLabel="__('Project Sub-Category')">
                        </x-forms.label>
                        <x-forms.input-group>
                            <select class="form-control select-picker" name="sub_category" id="sub_category"
                                    data-live-search="true">
                                    <option value="">--</option>
                                @foreach ($subcategories as $category)
                                <option @selected($project->sub_category == $category->sub_category) value="{{ $category->sub_category }}">
                                {{ $category->sub_category }}</option>
                                @endforeach
                            </select>
                        </x-forms.input-group>
                    </div>
                    <div class="col-md-3 col-lg-3">
                        <x-forms.select fieldId="project_status"
                            :fieldLabel="__('app.project') . ' ' . __('app.status')" fieldName="status" search="true">
                            @foreach ($projectStatus as $status)
                                <option
                                data-content="<i class='fa fa-circle mr-1 f-15' style='color:{{$status->color}}'></i>{{ $status->status_name }}"
                                @selected($project->status == $status->status_name)
                                value="{{$status->status_name}}">
                                </option>
                            @endforeach
                        </x-forms.select>
                    </div>
                    <div class="col-md-3 col-lg-3">
                        <x-forms.datepicker fieldId="start_date" fieldRequired="true"
                            :fieldLabel="__('Project Date')" fieldName="start_date"
                            :fieldValue="($project->start_date ? $project->start_date->format(company()->date_format) : '')"
                            :fieldPlaceholder="__('placeholders.date')" />
                    </div>

                    <div class="col-md-3 col-lg-3" id="deadlineBox">
                        <x-forms.datepicker fieldId="deadline" fieldRequired="true"
                            :fieldLabel="__('Due Date')" fieldName="deadline"
                            :fieldValue="($project->deadline ? $project->deadline->format(company()->date_format) : '')"
                            :fieldPlaceholder="__('placeholders.date')" />
                    </div>
                    <div class="col-lg-9 col-md-3">
                        <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Quick Note')"
                            fieldName="quick_notes"  fieldId="quick_notes"
                            :fieldPlaceholder="__('Enter Quick Note')" :fieldValue="$project->quick_notes" />
                    </div>
                    <div class="col-md-6 col-lg-12 my-0 my-lg-3 d-lg-flex" style="border: 1px solid lightgrey; border-radius: 10px;">
                        <label class="f-14 font-weight-bold text-dark-grey float-left"
                        for="usr" style="position: absolute; top: -11px; left: 11px; background-color: white; padding: 2px 5px;">@lang('Next F/U Details')</label>
                        
                        <div class="col-md-3 col-lg-6">
                            <x-forms.datepicker fieldId="nxt_follow_up_date" custom="true"
                            :fieldLabel="__('Next Follow Up Date')" fieldName="nxt_follow_up_date"
                            :fieldValue="($project->nxt_follow_up_date ? $project->nxt_follow_up_date->format(company()->date_format) : '')"
                            :fieldPlaceholder="__('placeholders.date')" />
                        </div>
                        <div class="col-md-3 col-lg-6 curr_nxt">
                            <div class ="mr-3 mt-2 mb-2 float-right">
                            <x-forms.checkbox 
                                    :fieldLabel="__('Current Date and Time')" 
                                    fieldName="curr_date_time" 
                                    fieldId="curr_date_time" 
                                    fieldValue="curr_date_time"/>  
                            </div>

                            <x-forms.text :fieldLabel="__('Next Follow Up Time')"
                                :fieldPlaceholder="__('placeholders.hours')" fieldName="nxt_follow_up_time"
                                fieldId="nxt_follow_up_time" 
                                :fieldValue="($project->nxt_follow_up_time ? \Carbon\Carbon::createFromFormat('H:i:s', $project->nxt_follow_up_time)->format(company()->time_format) : '')" />    
                                
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-3">
                        <x-forms.datepicker fieldId="inspection_date" custom="true"
                            :fieldLabel="__('Inspection Date')" fieldName="inspection_date"
                            :fieldValue="($project->inspection_date ? $project->inspection_date->format(company()->date_format) : '')"
                            :fieldPlaceholder="__('placeholders.date')" />
                    </div>
                    
                    <div class="col-md-3 col-lg-3">
                        <div>
                         <x-forms.text :fieldLabel="__('Inspection Time')"
                            :fieldPlaceholder="__('placeholders.hours')" fieldName="inspection_time"
                            fieldId="inspection_time" 
                            :fieldValue="($project->inspection_time ? \Carbon\Carbon::createFromFormat('H:i:s', $project->inspection_time)->format(company()->time_format) : '')" />        
                        </div>          
                    </div>
                    <div class="col-md-3 col-lg-3">
                        <x-forms.datepicker fieldId="re_inspection_date" custom="true"
                            :fieldLabel="__('Re-Inspection Date')" fieldName="re_inspection_date"
                            :fieldValue="($project->re_inspection_date ? $project->re_inspection_date->format(company()->date_format) : '')"
                            :fieldPlaceholder="__('placeholders.date')" />
                    </div>
                    <div class="col-md-3 col-lg-3">
                                <div class="">
                                    <x-forms.text :fieldLabel="__('Re-inspection Time')"
                                        :fieldPlaceholder="__('placeholders.hours')" fieldName="re_inspection_time"
                                        fieldId="re_inspection_time" 
                                        :fieldValue="($project->re_inspection_time ? \Carbon\Carbon::createFromFormat('H:i:s', $project->re_inspection_time)->format(company()->time_format) : '')" />
                                </div>
                    </div>
                    <div class="col-md-3 col-lg-3">
                        <x-forms.datepicker fieldId="bid_submitted" custom="true"
                            :fieldLabel="__('Bid Submitted Date')" fieldName="bid_submitted"
                            :fieldValue="($project->bid_submitted ? $project->bid_submitted->format(company()->date_format) : '')"
                            :fieldPlaceholder="__('placeholders.date')" />
                    </div>
                    <div class="col-md-3 col-lg-3">
                        <x-forms.datepicker fieldId="bid_rejected" custom="true"
                            :fieldLabel="__('Bid Rejected Date')" fieldName="bid_rejected"
                            :fieldValue="($project->bid_rejected ? $project->bid_rejected->format(company()->date_format) : '')"
                            :fieldPlaceholder="__('placeholders.date')" />
                    </div>
                    <div class="col-md-3 col-lg-3">
                        <x-forms.datepicker fieldId="bid_approval" custom="true"
                            :fieldLabel="__('Bid Approval Date')" fieldName="bid_approval"
                            :fieldValue="($project->bid_approval ? $project->bid_approval->format(company()->date_format) : '')"
                            :fieldPlaceholder="__('placeholders.date')" />
                    </div>
                    
                    <div class="col-md-3 col-lg-3">
                        <x-forms.datepicker fieldId="work_schedule_date" custom="true"
                            :fieldLabel="__('Work Schedule Date')" fieldName="work_schedule_date"
                            :fieldValue="($project->work_schedule_date ? $project->work_schedule_date->format(company()->date_format) : '')"
                            :fieldPlaceholder="__('placeholders.date')" />
                    </div>
                    <div class="col-md-3 col-lg-3">
                                <div class="">
                                    <x-forms.text :fieldLabel="__('Work Schedule Time')"
                                        :fieldPlaceholder="__('placeholders.hours')" fieldName="work_schedule_time"
                                        fieldId="work_schedule_time" 
                                        :fieldValue="($project->work_schedule_time ? \Carbon\Carbon::createFromFormat('H:i:s', $project->work_schedule_time)->format(company()->time_format) : '')" />
                                </div>
                    </div>
                    <div class="col-md-3 col-lg-3">
                        <x-forms.datepicker fieldId="work_schedule_re_date" custom="true"
                            :fieldLabel="__('Work Re-Schedule Date')" fieldName="work_schedule_re_date"
                            :fieldValue="($project->work_schedule_re_date ? $project->work_schedule_re_date->format(company()->date_format) : '')"
                            :fieldPlaceholder="__('placeholders.date')" />
                    </div>
                    <div class="col-md-3 col-lg-3">
                                <div class="">
                                    <x-forms.text :fieldLabel="__('Work Re-Schedule Time')"
                                        :fieldPlaceholder="__('placeholders.hours')" fieldName="work_schedule_re_time"
                                        fieldId="work_schedule_re_time" 
                                        :fieldValue="($project->work_schedule_re_time ? \Carbon\Carbon::createFromFormat('H:i:s', $project->work_schedule_re_time)->format(company()->time_format) : '')" />
                                </div>
                    </div>
                    <div class="col-md-3">
                        <x-forms.label class="mb-12 mt-3" fieldId="type"
                                       :fieldLabel="__('Delayed By')">
                        </x-forms.label>
                        <x-forms.input-group>
                            <select class="form-control select-picker" name="delayed_by" id="delayed_by"
                                    data-live-search="true">
                                    <option value="">--</option>
                                @foreach ($delayedby as $category)
                                    <option @selected($project->delayed_by == $category->delayed_by) value="{{ $category->delayed_by}}">
                                    {{ $category->delayed_by }}</option>
                                @endforeach
                            </select>
                        </x-forms.input-group>
                    </div>
                    <div class="col-md-3 col-lg-3">
                        <x-forms.datepicker fieldId="work_completion_date" custom="true"
                            :fieldLabel="__('Work Completion Date')" fieldName="work_completion_date"
                            :fieldValue="($project->work_completion_date ? $project->work_completion_date->format(company()->date_format) : '')"
                            :fieldPlaceholder="__('placeholders.date')" />
                    </div>
                    <div class="col-md-3 col-lg-3">
                        <x-forms.datepicker fieldId="cancelled_date" custom="true"
                            :fieldLabel="__('Cancelled Date')" fieldName="cancelled_date"
                            :fieldValue="($project->cancelled_date ? $project->cancelled_date->format(company()->date_format) : '')"
                            :fieldPlaceholder="__('placeholders.date')" />
                    </div>
                    <div class="col-md-3">
                        <x-forms.label class="mb-12 mt-3" fieldId="cancelled_reason"
                                       :fieldLabel="__('Cancelled Reason')">
                        </x-forms.label>
                        <x-forms.input-group>
                            <select class="form-control select-picker" name="cancelled_reason" id="cancelled_reason"
                                    data-live-search="true">
                                    <option value="">--</option>
                                @foreach ($cancelledreason as $category)
                                    <option @selected($project->cancelled_reason == $category->cancelled_reason) value="{{ $category->cancelled_reason}}">
                                    {{ $category->cancelled_reason }}</option>
                                @endforeach
                            </select>
                        </x-forms.input-group>
                    </div>
                    <div class="col-md-3">
                        <x-forms.text :fieldLabel="__('Invoiced Date')" fieldReadOnly
                            :fieldPlaceholder="__('placeholders.date')" fieldName="invoiced_date"
                            fieldId="invoiced_date" 
                            :fieldValue="($project->latestInvoice?->created_at ? $project->latestInvoice->created_at->timezone(company()->timezone)->format(company()->date_format) : '')" />
                               
                    </div>
                   
                    <div class="col-md-3 col-lg-3">
                    
                        <x-forms.text :fieldLabel="__('Client Paid Date')"
                            :fieldPlaceholder="__('placeholders.hours')" fieldName="client_paid_on"
                            fieldId="client_paid_on" fieldReadOnly
                            :fieldValue="($project->latestPayment ? $project->latestPayment->paid_on->format(company()->date_format) : '')" />
                                
                    </div>
                    
                    
                    <div class="col-md-12 col-lg-12">
                        <div class="form-group my-3">
                            <x-forms.label class="my-3" fieldId="project_summary"
                                :fieldLabel="__('Client Instructions')">
                            </x-forms.label>
                            <div id="project_summary">{!! $project->project_summary !!}</div>
                            <textarea name="project_summary" id="project_summary-text"
                                class="d-none">{!! $project->project_summary !!}</textarea>
                        </div>
                    </div>
                    
                    <x-forms.custom-field :fields="$fields" :model="$project"></x-forms.custom-field>
                    <!-- @if ($project->public == 1 && $createPublicProjectPermission == 'all')
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="d-flex mt-2">
                                    <x-forms.checkbox fieldId="is_private"
                                        :fieldLabel="__('modules.projects.createPrivateProject')" fieldName="private" />
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($project->public == 0 && $createPublicProjectPermission == 'all')
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="d-flex mt-2">
                                    <x-forms.checkbox fieldId="is_public"
                                        :fieldLabel="__('modules.projects.changeToPublicProject')" fieldName="public" />
                                </div>
                            </div>
                        </div>
                    @endif -->


                    

                    <!-- @if ($project->public == 1 && $editProjectMembersPermission || $editPermission == 'all')
                        <div class="col-md-12 d-none" id="add_members">
                            <div class="form-group my-3">
                                <x-forms.label class="my-3" fieldId="selectEmployee" fieldRequired="true"
                                    :fieldLabel="__('modules.projects.addMemberTitle')">
                                </x-forms.label>
                                <x-forms.input-group>
                                    <select class="form-control multiple-users" multiple name="user_id[]"
                                        id="selectEmployee" data-live-search="true" data-size="8">
                                        @if ($employees != '')

                                            @foreach ($employees as $item)
                                                <x-user-option
                                                    :user="$item"
                                                    :pill="true"
                                                    :selected="request()->has('default_assign') && request('default_assign') == $item->id ||(isset($projectTemplateMembers) && in_array($item->id, $projectTemplateMembers))"
                                                />

                                            @endforeach
                                        @endif
                                    </select>

                                    @if ($addEmployeePermission == 'all' || $addEmployeePermission == 'added')
                                        <x-slot name="append">
                                            <button id="add-employee" type="button"
                                                class="btn btn-outline-secondary border-grey">@lang('app.add')</button>
                                        </x-slot>
                                    @endif
                                </x-forms.input-group>
                            </div>
                        </div>
                    @elseif(in_array('employee', user_roles()))
                        <input type="hidden" name="user_id[]" value="{{ user()->id }}">
                    @endif -->

                   

                    <!-- <div class="col-md-12 col-lg-4">
                        <x-forms.range class="mr-0 mr-lg-2 mr-md-2"
                            :disabled="($project->calculate_task_progress == 'true' ? 'true' : 'false')"
                            :fieldLabel="__('modules.projects.projectCompletionStatus')" fieldName="completion_percent"
                            fieldId="completion_percent" :fieldValue="$project->completion_percent" />
                    </div>

                    <div class="col-md-12 col-lg-4">
                        <div class="form-group">
                            <div class="d-flex mt-5">
                                <x-forms.checkbox fieldId="calculate-task-progress"
                                    :checked="($project->calculate_task_progress == 'true') ? true : false"
                                    :fieldLabel="__('modules.projects.calculateTasksProgress')"
                                    fieldName="calculate_task_progress" />
                                    <i class="fa fa-question-circle mt-2" title="{{__('messages.calculateTaskProgress')}}" data-toggle="tooltip"></i>
                            </div>
                        </div>
                    </div> -->


                </div>

                <!-- <h4 class="mb-0 p-20 f-21 font-weight-normal text-capitalize border-top-grey">
                    @lang('modules.client.clientOtherDetails')</h4>

                <div class="row p-20">
                    <div class="col-lg-4">
                        <x-forms.select fieldId="currency_id" :fieldLabel="__('modules.invoices.currency')"
                            fieldName="currency_id" search="true">
                            @foreach ($currencies as $currency)
                                <option @selected($currency->id == $project->currency_id) value="{{ $currency->id }}">
                                    {{ $currency->currency_symbol . ' (' . $currency->currency_code . ')' }}
                                </option>
                            @endforeach
                        </x-forms.select>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <x-forms.number class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('modules.projects.projectBudget')"
                            fieldName="project_budget" fieldId="project_budget" :fieldValue="$project->project_budget"
                            :fieldPlaceholder="__('placeholders.price')" />
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <x-forms.number class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('modules.projects.hours_allocated')"
                            fieldName="hours_allocated" fieldId="hours_allocated"
                            :fieldValue="$project->hours_allocated" :fieldPlaceholder="__('placeholders.hourEstimate')" />
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <div class="d-flex mt-5">
                                <x-forms.checkbox fieldId="manual_timelog"
                                    :fieldLabel="__('modules.projects.manualTimelog')" :checked="($project->manual_timelog
                                    == 'enable')" fieldName="manual_timelog" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4" id="clientNotification">
                        <div class="form-group">
                            <div class="d-flex mt-5">
                                <x-forms.checkbox fieldId="client_task_notification" :checked="($project->allow_client_notification
                                == 'enable')"
                                    :fieldLabel="__('modules.projects.clientTaskNotification')"
                                    fieldName="client_task_notification" />
                            </div>
                        </div>
                    </div>

                    @if ($editPermission == 'all')
                        <div class="col-lg-3 col-md-6">
                            <x-forms.select fieldId="added_by" :fieldLabel="__('app.added').' '.__('app.by')"
                                fieldName="added_by">
                                <option value="">--</option>
                                @foreach ($employees as $item)
                                    <x-user-option :user="$item" :selected="$project->added_by == $item->id" />
                                @endforeach
                            </x-forms.select>
                        </div>
                    @endif



                </div> -->

                <!-- <div class="row p-20">
                    <div class="col-md-6 col-lg-3">
                        <div class="form-group">
                            <div class="d-flex mt-5">
                                <x-forms.checkbox fieldId="miroboard_checkbox"
                                    :fieldLabel="__('modules.projects.enableMiroboard')" fieldName="miroboard_checkbox"
                                    :checked="$project ? $project->enable_miroboard : ''"/>
                            </div>
                        </div>
                    </div>
                    <input type = "hidden" name = "mention_user_ids" id = "mentionUserId" class ="mention_user_ids">

                    <div class="col-md-6 col-lg-6 {{!is_null($project) && $project->enable_miroboard ? '' : 'd-none'}}" id="miroboard_detail">
                        <div class="form-group my-3">
                            <div class="row">
                                <div class="col-md-6 mt-6">
                                    <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('modules.projects.miroBoardId')"
                                        fieldName="miro_board_id" fieldRequired="true" fieldId="miro_board_id" :fieldValue="$project->miro_board_id"/>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <div class="d-flex mt-5">
                                    <x-forms.checkbox fieldId="client_access"
                                        :fieldLabel="__('modules.projects.clientMiroAccess')" fieldName="client_access"
                                        :checked="$project ? $project->client_access : ''"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <h4 class="mb-0 p-20 f-21 font-weight-normal text-capitalize border-top-grey">
                    <a href="javascript:;" class="text-dark toggle-property-details"><i
                            class="fa fa-chevron-down"></i>
                        @lang('Property Details')</a>
                </h4>

                <div class="row p-20 d-none" id="property-details">
                    <div class="col-lg-10 col-md-3 ">
                        <x-forms.text class="" :fieldLabel="__('Full Property Address')"
                                      fieldName="property_address" fieldRequired="true" fieldId="property_address"
                                      :fieldPlaceholder="__('Property Address')" :fieldValue="$project->propertyDetails->property_address"/>
                    </div>
                    <div>
                    <button id="autoFill" type="button"
                                            class="btn btn-outline-secondary border-grey mt-0 mt-md-5 ml-3 ml-md-0"
                                            data-toggle="tooltip" data-original-title="{{__('Auto Fill Other Fields') }}">@lang('Auto Fill')</button>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <x-forms.text class="mr-0 mr-lg-2 mr-md-2 " :fieldLabel="__('Street Address')"
                                      fieldName="street_address" fieldRequired="true" fieldId="street_address"
                                      :fieldPlaceholder="__('Street Address')" :fieldValue="$project->propertyDetails->street_address"/>
                    </div>
                    <div class="col-lg-3 col-md-3">
                            <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('suite # / house #')"
                                        fieldName="optional" fieldRequired="true" fieldId="optional"
                                        :fieldPlaceholder="__('optional')" :fieldValue="$project->propertyDetails->optional"/>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('City')"
                                      fieldName="city" fieldRequired="true" fieldId="city"
                                      :fieldPlaceholder="__('City')" :fieldValue="$project->propertyDetails->city"/>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('State')"
                                      fieldName="state" fieldRequired="true" fieldId="state"
                                      :fieldPlaceholder="__('State')" :fieldValue="$project->propertyDetails->state"/>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Zip Code')"
                                      fieldName="zipcode" fieldRequired="true" fieldId="zipcode"
                                      :fieldPlaceholder="__('Zip Code')" :fieldValue="$project->propertyDetails->zipcode"/>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('County')"
                                      fieldName="county" fieldRequired="true" fieldId="county"
                                      :fieldPlaceholder="__('County')" :fieldValue="$project->propertyDetails->county"/>
                    </div>
                    <div class="col-md-3">
                        <x-forms.label class="my-3" fieldId="property_type"
                                       :fieldLabel="__('Property Type')">
                        </x-forms.label>
                        <x-forms.input-group>
                            <select class="form-control select-picker" name="property_type" id="property_type"
                                    data-live-search="true">
                                    <option value="">--</option>
                                    @foreach ($propertytype as $category)
                                    <option @selected($project->propertyDetails->property_type == $category->property_type) value="{{ $category->property_type }}">
                                    {{ $category->property_type }}</option>
                                    @endforeach
                            </select>
                        </x-forms.input-group>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Year Built')"
                                      fieldName="yearbuilt" fieldRequired="true" fieldId="yearbuilt"
                                      :fieldPlaceholder="__('Year Built')" :fieldValue="$project->propertyDetails->yearbuilt"/>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Bedrooms')"
                                      fieldName="bedrooms" fieldRequired="true" fieldId="bedrooms"
                                      :fieldPlaceholder="__('Bedrooms')" :fieldValue="$project->propertyDetails->bedrooms"/>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Bathrooms')"
                                      fieldName="bathrooms" fieldRequired="true" fieldId="bathrooms"
                                      :fieldPlaceholder="__('bathrooms')" :fieldValue="$project->propertyDetails->bathrooms"/>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('House Size')"
                                      fieldName="house_size" fieldRequired="true" fieldId="house_size"
                                      :fieldPlaceholder="__('House Size')" :fieldValue="$project->propertyDetails->house_size"/>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Lot Size')"
                                      fieldName="lotsize" fieldRequired="true" fieldId="lotsize"
                                      :fieldPlaceholder="__('Lot Size')" :fieldValue="$project->propertyDetails->lotsize"/>
                    </div>
                    <div class="col-md-3">
                        <x-forms.label class="my-3" fieldId="occupancy_status"
                                       :fieldLabel="__('Occupancy Status')">
                        </x-forms.label>
                        <x-forms.input-group>
                            <select class="form-control select-picker" name="occupancy_status" id="occupancy_status"
                                    data-live-search="true">
                                    <option value="">--</option>
                                    @foreach ($occupancystatus as $category)
                                    <option @selected($project->propertyDetails->occupancy_status == $category->occupancy_status) value="{{ $category->occupancy_status }}">
                                    {{ $category->occupancy_status }}</option>
                                    @endforeach
                            </select>
                        </x-forms.input-group>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Lock Box Location')"
                                      fieldName="lockboxlocation" fieldRequired="true" fieldId="lockboxlocation"
                                      :fieldPlaceholder="__('Lock Box Location')" :fieldValue="$project->propertyDetails->lockboxlocation"/>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Lock Box Code')"
                                      fieldName="lockboxcode" fieldRequired="true" fieldId="lockboxcode"
                                      :fieldPlaceholder="__('Lock Box Code')" :fieldValue="$project->propertyDetails->lockboxcode"/>
                    </div>
                        <div class="col-lg-10 mt-2">
                            <div class="row">
                                <div class="col-lg-10 mb-2">
                                    <label class='f-14 text-dark-grey mb-12'>Utility Status<sup class="f-14 mr-1">*</sup></label><br>
                                    @php
                                         $utilityStatus = json_decode($project->propertyDetails->utility_status, true) ?? [];
                                         
                                    @endphp
                                </div>
                                <div class="col-lg-3">
                                    <x-forms.checkbox 
                                    :fieldLabel="__('Water')" 
                                    fieldName="utility_status[]" 
                                    fieldValue="water"
                                    fieldId="water" 
                                    :checked="in_array('water', $utilityStatus)"/>
                                </div>
                                <div class="col-lg-3">
                                    <x-forms.checkbox 
                                        :fieldLabel="__('Gas')" 
                                        fieldName="utility_status[]" 
                                        fieldValue="gas"
                                        fieldId="gas" 
                                        :checked="in_array('gas', $utilityStatus)"/>
                                 </div>
                                <div class="col-lg-3">
                                    <x-forms.checkbox 
                                    :fieldLabel="__('Electric')" 
                                    fieldName="utility_status[]"
                                    fieldValue="electric" 
                                    fieldId="electric" 
                                    :checked="in_array('electric', $utilityStatus)"/>
                                </div>
                                
                            </div>                                     
                        </div>
                    
                </div>
                <h4 class="mb-0 p-20 f-21 font-weight-normal text-capitalize border-top-grey">
                    <a href="javascript:;" class="text-dark toggle-contact-information"><i
                            class="fa fa-chevron-down"></i>
                        @lang('Contact Information')</a>
                </h4>
                    <div class="row p-20 d-none" id="contact-information">
                        <div class="col-lg-4 col-md-3">
                            <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Asset Manager Name')"
                                        fieldName="amname" fieldRequired="true" fieldId="amname"
                                        :fieldPlaceholder="__('Asset Manager Name')" :fieldValue="$project->projectContacts->amname"/>
                        </div>
                        <div class="col-lg-4 col-md-3">
                            <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Asset Manager Phone Number')"
                                        fieldName="amph" fieldRequired="true" fieldId="amph"
                                        :fieldPlaceholder="__('Asset Manager Phone Number')" :fieldValue="$project->projectContacts->amph"/>
                        </div>
                        <div class="col-lg-4 col-md-3">
                            <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Asset Manager Email Address')"
                                        fieldName="amemail" fieldRequired="true" fieldId="amemail"
                                        :fieldPlaceholder="__('Asset Manager Email Address')" :fieldValue="$project->projectContacts->amemail"/>
                        </div>
                        <div class="w-100 m-2" style="border: 1px solid lightgrey; border-radius: 10px; padding: 10px;">
                            <div class="form-group row tenant-row mx-1">
                                <div class="col-lg-4 col-md-3">
                                    <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Tenant 1 Name')"
                                                fieldName="tenant_name_1" fieldRequired="true" fieldId="tenant_name_1"
                                                :fieldPlaceholder="__('Tenant 1 Name')" :fieldValue="$project->projectContacts->tenant_name_1" />
                                </div>
                                <div class="col-lg-4 col-md-3">
                                    <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Tenant 1 Email')"
                                                fieldName="tenant_email_1" fieldRequired="true" fieldId="tenant_email_1"
                                                :fieldPlaceholder="__('Tenant 1 Email')" :fieldValue="$project->projectContacts->tenant_email_1"/>
                                </div>
                                <div class="col-lg-4 col-md-3">
                                    <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Tenant 1 Phone')"
                                                fieldName="tenant_phone_1" fieldRequired="true" fieldId="tenant_phone_1"
                                                :fieldPlaceholder="__('Tenant 1 Phone')" :fieldValue="$project->projectContacts->tenant_phone_1"/>
                                </div>
                                <div class="col-lg-4 col-md-3 d-flex align-items-end">
                                    <button type="button" class="btn btn-primary  btn-sm add-more">More</button>
                                </div>
                            </div>
                            <!-- Tenant 2 to 5 -->
                            <div class="tenant-fields" id="tenant_fields_2">
                                <div class="form-group row tenant-row mx-1">
                                    <div class="col-lg-4 col-md-3">
                                        <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Tenant 2 Name')"
                                                    fieldName="tenant_name_2" fieldId="tenant_name_2"
                                                    :fieldPlaceholder="__('Tenant 2 Name')" :fieldValue="$project->projectContacts->tenant_name_2"/>
                                    </div>
                                    <div class="col-lg-4 col-md-3">
                                        <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Tenant 2 Email')"
                                                    fieldName="tenant_email_2" fieldId="tenant_email_2"
                                                    :fieldPlaceholder="__('Tenant 2 Email')" :fieldValue="$project->projectContacts->tenant_email_2"/>
                                    </div>
                                    <div class="col-lg-4 col-md-3">
                                        <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Tenant 2 Phone')"
                                                    fieldName="tenant_phone_2" fieldId="tenant_phone_2"
                                                    :fieldPlaceholder="__('Tenant 2 Phone')" :fieldValue="$project->projectContacts->tenant_phone_2"/>
                                    </div>
                                    <div class="col-lg-4 col-md-3 d-flex align-items-end">
                                        <button type="button" class="btn btn-danger btn-sm remove-tenant">Remove</button>
                                    </div>
                                </div>
                            </div>
                            <div class="tenant-fields " id="tenant_fields_3">
                                <div class="form-group row tenant-row mx-1">
                                    <div class="col-lg-4 col-md-3">
                                        <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Tenant 3 Name')"
                                                    fieldName="tenant_name_3" fieldId="tenant_name_3"
                                                    :fieldPlaceholder="__('Tenant 3 Name')" :fieldValue="$project->projectContacts->tenant_name_3"/>
                                    </div>
                                    <div class="col-lg-4 col-md-3">
                                        <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Tenant 3 Email')"
                                                    fieldName="tenant_email_3" fieldId="tenant_email_3"
                                                    :fieldPlaceholder="__('Tenant 3 Email')" :fieldValue="$project->projectContacts->tenant_email_3"/>
                                    </div>
                                    <div class="col-lg-4 col-md-3">
                                        <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Tenant 3 Phone')"
                                                    fieldName="tenant_phone_3" fieldId="tenant_phone_3"
                                                    :fieldPlaceholder="__('Tenant 3 Phone')" :fieldValue="$project->projectContacts->tenant_phone_3"/>
                                    </div>
                                    <div class="col-lg-4 col-md-3 d-flex align-items-end">
                                        <button type="button" class="btn btn-danger btn-sm remove-tenant">Remove</button>
                                    </div>
                                </div>
                            </div>
                            <div class="tenant-fields " id="tenant_fields_4">
                                <div class="form-group row tenant-row mx-1">
                                    <div class="col-lg-4 col-md-3">
                                        <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Tenant 4 Name')"
                                                    fieldName="tenant_name_4" fieldId="tenant_name_4"
                                                    :fieldPlaceholder="__('Tenant 4 Name')" :fieldValue="$project->projectContacts->tenant_name_4"/>
                                    </div>
                                    <div class="col-lg-4 col-md-3">
                                        <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Tenant 4 Email')"
                                                    fieldName="tenant_email_4" fieldId="tenant_email_4"
                                                    :fieldPlaceholder="__('Tenant 4 Email')" :fieldValue="$project->projectContacts->tenant_email_4"/>
                                    </div>
                                    <div class="col-lg-4 col-md-3">
                                        <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Tenant 4 Phone')"
                                                    fieldName="tenant_phone_4" fieldId="tenant_phone_4"
                                                    :fieldPlaceholder="__('Tenant 4 Phone')" :fieldValue="$project->projectContacts->tenant_phone_4"/>
                                    </div>
                                    <div class="col-lg-4 col-md-3 d-flex align-items-end">
                                        <button type="button" class="btn btn-danger btn-sm remove-tenant">Remove</button>
                                    </div>
                                </div>
                            </div>
                            <div class="tenant-fields " id="tenant_fields_5">
                                <div class="form-group row tenant-row mx-1">
                                    <div class="col-lg-4 col-md-3">
                                        <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Tenant 5 Name')"
                                                    fieldName="tenant_name_5" fieldId="tenant_name_5"
                                                    :fieldPlaceholder="__('Tenant 5 Name')" :fieldValue="$project->projectContacts->tenant_name_5"/>
                                    </div>
                                    <div class="col-lg-4 col-md-3">
                                        <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Tenant 5 Email')"
                                                    fieldName="tenant_email_5" fieldId="tenant_email_5"
                                                    :fieldPlaceholder="__('Tenant 5 Email')" :fieldValue="$project->projectContacts->tenant_email_5"/>
                                    </div>
                                    <div class="col-lg-4 col-md-3">
                                        <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Tenant 5 Phone')"
                                                    fieldName="tenant_phone_5" fieldId="tenant_phone_5"
                                                    :fieldPlaceholder="__('Tenant 5 Phone')" :fieldValue="$project->projectContacts->tenant_email_5"/>
                                    </div>
                                    <div class="col-lg-4 col-md-3 d-flex align-items-end">
                                        <button type="button" class="btn btn-danger btn-sm remove-tenant">Remove</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($editProjectMembersPermission == 'all' || $editPermission == 'all')
                        <div class="col-md-3 " id="edit_members">
                           <div class="form-group my-3">
                                <x-forms.label fieldId="selectAssignee" :fieldLabel="__('Project Manager')" fieldRequired="true"> 
                                </x-forms.label>
                                <x-forms.input-group>
                                    <select class="form-control multiple-users" multiple name="member_id[]"
                                        id="selectEmployee" data-live-search="true" data-size="8">
                                        @foreach ($employees as $item)
                                            @php
                                                $selected = '';
                                            @endphp

                                            @foreach ($project->members as $member)
                                                @if ($member->user->id == $item->id)
                                                    @php
                                                        $selected = 'selected';
                                                    @endphp
                                                @endif
                                            @endforeach
                                            <x-user-option :user="$item" :selected="$selected" :pill="true"/>
                                        @endforeach
                                    </select>
                                    @if ($addEmployeePermission == 'all' || $addEmployeePermission == 'added')
                                        <x-slot name="append">
                                            <button id="add-employee" type="button"
                                                class="btn btn-outline-secondary border-grey">@lang('app.add')</button>
                                        </x-slot>
                                    @endif
                                </x-forms.input-group>
                            </div>
                        </div>
                        @endif
                        <div class="col-md-3" id="add_members">
                            <div class="form-group my-3">
                                <x-forms.label fieldId="selectEmployee" 
                                               :fieldLabel="__('Project Coordinator')">
                                </x-forms.label>
                                <x-forms.input-group>
                                    <select class="form-control multiple-users" name="project_coordinator"
                                            id="project_coordinator" data-live-search="true" data-size="8">
                                            <option value="">--</option>
                                            @foreach ($all_employees as $item)
                                            @php
                                                $selected = '';
                                            @endphp

                                            @if ($project->project_coordinator_id == $item->id)
                                                @php
                                                    $selected = 'selected';
                                                @endphp
                                            @endif
                                            
                                            <x-user-option :user="$item" :selected="$selected" :pill="true"/>
                                            @endforeach
                                    </select>
                                </x-forms.input-group>
                            </div>
                        </div>
                        <div class="col-md-3" id="add_members">
                            <div class="form-group my-3">
                                <x-forms.label fieldId="selectEmployee" 
                                               :fieldLabel="__('Project Estimators')">
                                </x-forms.label>
                                <x-forms.input-group>
                                    <select class="form-control multiple-users" multiple name="estimator_id[]"
                                            id="selectEstimator" data-live-search="true" data-size="8">
                                        @foreach ($estimators as $item)
                                            @php
                                                $selected = '';
                                            @endphp

                                            @foreach ($project->est_users as $member)
                                                @if ($member->id == $item->id)
                                                    @php
                                                        $selected = 'selected';
                                                    @endphp
                                                @endif
                                            @endforeach
                                            <x-user-option :user="$item" :selected="$selected" :pill="true"/>
                                        @endforeach
                                    </select>
                                </x-forms.input-group>
                            </div>
                        </div>
                        <div class="col-md-3" id="add_members">
                            <div class="form-group my-3">
                                <x-forms.label fieldId="selectEmployee" 
                                               :fieldLabel="__('Project Accounting Analyst')">
                                </x-forms.label>
                                <x-forms.input-group>
                                    <select class="form-control multiple-users" multiple name="accounting_id[]"
                                            id="selectAccountingAnalyst" data-live-search="true" data-size="8">
                                            @foreach ($accounting as $item)
                                            @php
                                                $selected = '';
                                            @endphp

                                            @foreach ($project->acct_users as $member)
                                                @if ($member->id == $item->id)
                                                    @php
                                                        $selected = 'selected';
                                                    @endphp
                                                @endif
                                            @endforeach
                                            <x-user-option :user="$item" :selected="$selected" :pill="true"/>
                                        @endforeach
                                    </select>
                                </x-forms.input-group>
                            </div>
                        </div>
                        <div class="col-md-3" id="add_members">
                            <div class="form-group my-3">
                                <x-forms.label fieldId="selectEmployee" 
                                               :fieldLabel="__('Project Escalation Manager')">
                                </x-forms.label>
                                <x-forms.input-group>
                                    <select class="form-control multiple-users" multiple name="emanager_id[]"
                                            id="selectEscalationManager" data-live-search="true" data-size="8">
                                            @foreach ($emanager as $item)
                                            @php
                                                $selected = '';
                                            @endphp

                                            @foreach ($project->emanager_users as $member)
                                                @if ($member->id == $item->id)
                                                    @php
                                                        $selected = 'selected';
                                                    @endphp
                                                @endif
                                            @endforeach
                                            <x-user-option :user="$item" :selected="$selected" :pill="true"/>
                                            @endforeach
                                    </select>
                                </x-forms.input-group>
                            </div>
                        </div>
                        
                        <div class="col-md-3" id="add_members">
                            <div class="form-group my-3">
                                <x-forms.label fieldId="selectEmployee" 
                                               :fieldLabel="__('Vendor Recruiter')">
                                </x-forms.label>
                                <x-forms.input-group>
                                    <select class="form-control multiple-users" name="vendor_recruiter"
                                            id="vendor_recruiter" data-live-search="true" data-size="8">
                                            <option value="">--</option>
                                            @foreach ($all_employees as $item)
                                            @php
                                                $selected = '';
                                            @endphp

                                            @if ($project->vendor_recruiter_id == $item->id)
                                                @php
                                                    $selected = 'selected';
                                                @endphp
                                            @endif

                                            <x-user-option :user="$item" :selected="$selected" :pill="true"/>
                                            @endforeach
                                    </select>
                                </x-forms.input-group>
                            </div>
                        </div>
                        <div class="col-md-3" id="add_members">
                            <div class="form-group my-3">
                                <x-forms.label fieldId="selectEmployee" 
                                               :fieldLabel="__('Project Scheduler')">
                                </x-forms.label>
                                <x-forms.input-group>
                                    <select class="form-control multiple-users" name="project_scheduler"
                                            id="project_scheduler" data-live-search="true" data-size="8">
                                            <option value="">--</option>
                                            @foreach ($all_employees as $item)
                                            @php
                                                $selected = '';
                                            @endphp

                                            @if ($project->project_scheduler_id == $item->id)
                                                @php
                                                    $selected = 'selected';
                                                @endphp
                                            @endif

                                            <x-user-option :user="$item" :selected="$selected" :pill="true"/>
                                            @endforeach
                                    </select>
                                </x-forms.input-group>
                            </div>
                        </div>
                    </div>
                    <h4 class="mb-0 p-20 f-21 font-weight-normal text-capitalize border-top-grey">
                        <a href="javascript:;" class="text-dark toggle-accounting-information"><i
                                class="fa fa-chevron-down"></i>
                            @lang('Accounting Information')</a>
                    </h4>
                    <div class="row p-20 d-none" id="accounting-information">
                        <div class="col-lg-4 col-md-3">
                            <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Not To Exceed')"
                                        fieldName="nte" fieldRequired="true" fieldId="nte"
                                        :fieldPlaceholder="__('Not To Exceed')" :fieldValue="$project->nte"/>
                        </div>
                        <div class="col-lg-4 col-md-3">
                        <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Bid Submitted Amount')"
                                      fieldName="bid_submitted_amount" fieldRequired="true" fieldId="bid_submitted_amount"
                                      :fieldPlaceholder="__('Bid Submitted Amount')" :fieldValue="$project->bid_submitted_amount"/>
                        </div>
                        <div class="col-lg-4 col-md-3">
                        <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Bid Approved Amount')"
                                      fieldName="bid_approved_amount" fieldRequired="true" fieldId="bid_approved_amount"
                                      :fieldPlaceholder="__('Bid Approved Amount')" :fieldValue="$project->bid_approved_amount"/>
                        </div>
                        <div class="col-lg-4 col-md-3">
                        <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Invoiced Amount')" fieldReadOnly
                                      fieldName="iamt" fieldId="iamt"
                                      :fieldPlaceholder="__('Invoiced Amount')" :fieldValue="currency_format($project->totalInvoiceAmount, $project->currency_id)"/>
                        </div>
                        <div class="col-lg-4 col-md-3">
                        <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Vendor Amount')"
                                      fieldName="vamt" fieldId="vamt" fieldReadOnly
                                      :fieldPlaceholder="__('Vendor Amount')" :fieldValue="currency_format($project->TotalExpense, $project->currency_id)"/>
                        </div>
                        <div class="col-md-3 col-lg-4">
                    
                            <x-forms.text :fieldLabel="__('Client Paid Amount')"
                                :fieldPlaceholder="__('placeholders.hours')" fieldName="client_paid_amt"
                                fieldId="client_paid_amt"  fieldReadOnly 
                                :fieldValue="currency_format($project->totalPaymentAmount, $project->currency_id)" />
                                    
                        </div>
                    </div>
                <x-form-actions>
                    <x-forms.button-primary id="save-project-form" class="mr-3" icon="check">@lang('app.save')
                    </x-forms.button-primary>
                    <x-forms.button-cancel :link="route('projects.index')" class="border-0">@lang('app.cancel')
                    </x-forms.button-cancel>
                </x-form-actions>

            </div>
        </x-form>

    </div>
</div>

<script>
    const timeFormat = @json(company()->time_format == 'h:i A' ? 'hh:mm A' : (company()->time_format == 'H:i' ? 'HH:mm' :'HH:mm')); 
</script>
<script>
    $(document).ready(function() {
        let tenantCount = 1;
        var firstOpen = true;
        var time;

        if("{{$project->projectContacts->tenant_name_2}}")
        {
            tenantCount=2;
            $('#tenant_fields_2').show();
        }
        if("{{$project->projectContacts->tenant_name_3}}")
        {
            tenantCount=3;
            $('#tenant_fields_3').show();
        }
        
        if("{{$project->projectContacts->tenant_name_4}}")
        {
            tenantCount=4;
            $('#tenant_fields_4').show();
        }
        if("{{$project->projectContacts->tenant_name_5}}")
        {
            tenantCount=5;
            $('#tenant_fields_5').show();
        }
        
        $('.add-more').on('click', function() {
            if (tenantCount < 5) {
                tenantCount++;
                $('#tenant_fields_' + tenantCount).show();
            }
            if (tenantCount === 5) {
                $(this).hide();
            }
        });

        $(document).on('click', '.remove-tenant', function() {
            $(this).closest('.tenant-row').find('input').val('');
            $(this).closest('.tenant-fields').hide();
            tenantCount--;
            console.log(tenantCount);
            if (tenantCount < 5) {
                $('.add-more').show();
            }
        });

        $('.custom-date-picker').each(function(ind, el) {
            datepicker(el, {
                position: 'bl',
                ...datepickerConfig
            });
        });

        $(".multiple-users").selectpicker({
            actionsBox: true,
            selectAllText: "{{ __('modules.permission.selectAll') }}",
            deselectAllText: "{{ __('modules.permission.deselectAll') }}",
            multipleSeparator: " ",
            selectedTextFormat: "count > 8",
            countSelectedText: function(selected, total) {
                return selected + " {{ __('app.membersSelected') }} ";
            }
        });

        $('#inspection_time,#re_inspection_time,#work_schedule_time,#nxt_follow_up_time,#work_schedule_re_time').datetimepicker({
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

        $('#autoFill').click(function() {
            if($('#property_address').val()=='')
            {
                Swal.fire({
                    icon: 'error',
                    text: '{{ __('Property Address Field Can Not Be Empty') }}',

                    customClass: {
                        confirmButton: 'btn btn-primary',
                    },
                    showClass: {
                        popup: 'swal2-noanimation',
                        backdrop: 'swal2-noanimation'
                    },
                    buttonsStyling: false
                });
                return false;
            }
            
            const url = "{{ route('projects.parseAddress') }}";
            var data = $('#property_address').val();
            var token = "{{ csrf_token() }}";
            $.easyAjax({
                url: url,
                type: "POST",
                disableButton: true,
                blockUI: true,
                buttonSelector: "#autoFill",
                data: {
                        '_token': token,
                        'data': data,
                    },
                success: function (response) {
                    document.getElementById('street_address').value=response.parsed_address.street_address;
                    document.getElementById('city').value=response.parsed_address.city;
                    document.getElementById('state').value=response.parsed_address.state;
                    document.getElementById('zipcode').value=response.parsed_address.zipcode;
                    document.getElementById('county').value=response.parsed_address.county;
                }
            });
        });

        const dp1 = datepicker('#start_date', {
            position: 'bl',
            dateSelected: new Date("{{ str_replace('-', '/', $project->start_date) }}"),
            onSelect: (instance, date) => {
                dp2.setMin(date);
            },
            ...datepickerConfig
        });

        const dp2 = datepicker('#deadline', {
            position: 'bl',
            dateSelected: new Date("{{ $project->deadline ? str_replace('-', '/', $project->deadline) : str_replace('-', '/', now(company()->timezone)) }}"),
            onSelect: (instance, date) => {
                dp1.setMax(date);
            },
            ...datepickerConfig
        });

        @if ($project->deadline == null)
            $('#deadlineBox').hide();
        @endif

        $('#without_deadline').click(function() {
            var check = $('#without_deadline').is(":checked") ? true : false;
            if (check == true) {
                $('#deadlineBox').hide();
            } else {
                $('#deadlineBox').show();
            }
        });
        const atValues = @json($userData);

        quillMention(atValues, '#project_summary');

        $('#save-project-form').click(function() {
            var note = document.getElementById('project_summary').children[0].innerHTML;
            document.getElementById('project_summary-text').value = note;

            var user = $('#project_summary span[data-id]').map(function(){
                            return $(this).attr('data-id')
                        }).get();

            var mention_user_id  =  $.makeArray(user);
            $('#mentionUserId').val(mention_user_id.join(','));
            const url = "{{ route('projects.update', $project->id) }}";

            $.easyAjax({
                url: url,
                container: '#save-project-data-form',
                type: "POST",
                disableButton: true,
                blockUI: true,
                file:true,
                buttonSelector: "#save-project-form",
                data: $('#save-project-data-form').serialize(),
                success: function(response) {
                    if (response.status == 'success') {
                         window.location.href = response.redirectUrl;
                    }
                }
            });
        });
        $('.toggle-property-details').click(function () {
            $(this).find('svg').toggleClass('fa-chevron-down fa-chevron-up');
            $('#property-details').toggleClass('d-none');
        });

        $('.toggle-main-project-details').click(function () {
            $(this).find('svg').toggleClass('fa-chevron-down fa-chevron-up');
            $('#main-project-details').toggleClass('d-none');
        });
        $('.toggle-contact-information').click(function () {
            $(this).find('svg').toggleClass('fa-chevron-down fa-chevron-up');
            $('#contact-information').toggleClass('d-none');
        });
        $('.toggle-accounting-information').click(function () {
            $(this).find('svg').toggleClass('fa-chevron-down fa-chevron-up');
            $('#accounting-information').toggleClass('d-none');
        });

        $('#addProjectCategory').click(function() {
            const url = "{{ route('projectCategory.create') }}";
            $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
            $.ajaxModal(MODAL_LG, url);
        });

        $('#department-setting').click(function() {
            const url = "{{ route('departments.create') }}";
            $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
            $.ajaxModal(MODAL_LG, url);
        });

        $('#client_view_task').change(function() {
            $('#clientNotification').toggleClass('d-none');
        });

        $('#is_private').change(function() {
            $('#add_members').toggleClass('d-none');
            $('#edit_members').addClass('d-none');
        });

        $('#is_public').change(function() {
            $('#edit_members').toggleClass('d-none');
            $('#add_members').addClass('d-none');
        });

        $('#miroboard_checkbox').change(function() {
            $('#miroboard_detail').toggleClass('d-none');
        });

        $('#add-client').click(function() {
            $(MODAL_XL).modal('show');

            const url = "{{ route('clients.create') }}";

            $.easyAjax({
                url: url,
                blockUI: true,
                container: MODAL_XL,
                success: function(response) {
                    if (response.status == "success") {
                        $(MODAL_XL + ' .modal-body').html(response.html);
                        $(MODAL_XL + ' .modal-title').html(response.title);
                        init(MODAL_XL);
                    }
                }
            });
        });

        $('#add-employee').click(function() {
            $(MODAL_XL).modal('show');

            const url = "{{ route('employees.create') }}";

            $.easyAjax({
                url: url,
                blockUI: true,
                container: MODAL_XL,
                success: function(response) {
                    if (response.status == "success") {
                        $(MODAL_XL + ' .modal-body').html(response.html);
                        $(MODAL_XL + ' .modal-title').html(response.title);
                        init(MODAL_XL);
                    }
                }
            });
        });

        $('#calculate-task-progress').change(function() {
            if ($(this).is(':checked')) {
                $('#completion_percent').attr('disabled', 'true');
            } else {
                $('#completion_percent').removeAttr('disabled');
            }
        });

        $('#curr_date_time').change(function() {
            let optionsHtml = `
                <select id="minuteSelect" style="transform: scale(1.5);">
                    <option value="0">0 min</option>
                    <option value="1">1 min</option>
                    <option value="2">2 min</option>
                    <option value="3">3 min</option>
                    <option value="5">5 min</option>
                    <option value="10">10 min</option>
                    <option value="15">15 min</option>
                    <option value="20">20 min</option>
                    <option value="30">30 min</option>
                </select>
            `;
            if ($(this).is(':checked')) {

                Swal.fire({
                title: 'Extend The Time By',
                html: `${optionsHtml}`,
                customClass: {
                    confirmButton: 'btn btn-primary',
                },
                preConfirm: () => {
                    const selected = $('#minuteSelect').val();
                    if (selected === null) {
                        Swal.showValidationMessage('Please select a time');
                        return false;
                    }
                    return selected; 
                }
                }).then((result) => {
                    if (result.isConfirmed) {
                        const addedMinutes = parseInt(result.value);
                        const newTime = moment().add(addedMinutes, 'minutes');
                        const today = moment();
                        $('#nxt_follow_up_date').val(today.format('{{ company()->moment_date_format }}'));
                        $('.curr_nxt #nxt_follow_up_time').val(newTime.format(timeFormat));
                    }
                });

            }
        });

        <x-forms.custom-field-filejs/>

        init(RIGHT_MODAL);
    });

    $('#save-project-data-form').on('change', '#employee_department', function () {
            let id = $(this).val();
            if (id === '') {
                id = 0;
            }
            let url = "{{ route('departments.members', ':id') }}";
            url = url.replace(':id', id);

            $.easyAjax({
                url: url,
                type: "GET",
                container: '#save-project-data-form',
                blockUI: true,
                redirect: true,
                success: function (data) {
                    $('#selectEmployee').html(data.data);
                    $('#selectEmployee').selectpicker('refresh');
                }
            })
        });

</script>
