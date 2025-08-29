@php
    $addExpenseCategoryPermission = user()->permission('manage_expense_category');
@endphp

<div class="row">
    <div class="col-sm-12">
        <x-form id="save-expense-data-form">

            <div class="add-client bg-white rounded">
                <h4 class="mb-0 p-20 f-21 font-weight-normal text-capitalize border-bottom-grey">
                    @lang('app.expenseDetails')</h4>
                <div class="row p-20">
                    <div class="col-md-6 col-lg-3 d-none">
                        <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('modules.expenses.itemName')" fieldName="item_name"
                            fieldRequired="true" fieldId="item_name" :fieldPlaceholder="__('placeholders.expense.item')" />
                    </div>

                    <div class="col-md-6 col-lg-3">
                        @if (isset($projectName))
                            <input type="hidden" name="project_id" id="project_id" value="{{ $projectId }}">
                            <x-forms.text :fieldLabel="__('app.project')" fieldName="projectName" fieldId="projectName"
                                :fieldValue="$projectShort" fieldReadOnly="true" />
                        @else
                            <x-forms.select fieldId="project_id" fieldName="project_id" :fieldLabel="__('app.project')" search="true"
                                fieldRequired="true">
                                <option value="">--</option>
                                @foreach ($projects as $project)
                                    <option data-currency-id="{{ $project->currency_id }}" @selected($projectId == $project->id)
                                        value="{{ $project->id }}">
                                        {{ $project->project_short_code }}
                                    </option>
                                @endforeach
                            </x-forms.select>
                        @endif
                    </div>

                    <div class="col-md-6 col-lg-3">
                        @if (isset($projectName))
                            <x-forms.select fieldId="vendor_id" fieldName="vendor_id" :fieldLabel="__('Vendor')" search="true">
                                <option value="">--</option>
                                @foreach ($vendor as $vendors)
                                    <option value="{{ $vendors->id }}">
                                        {{ $vendors->vendor_name }}
                                    </option>
                                @endforeach
                            </x-forms.select>
                        @else
                            <x-forms.select fieldId="vendor_id" fieldName="vendor_id" :fieldLabel="__('Vendor')" search="true">
                                <option value="">--</option>
                            </x-forms.select>
                        @endif
                    </div>

                    <!--here...-->
                    <!--readonly textbox-->

                    <div class="col-md-6 col-lg-3">
                        <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('W/O Status')" fieldName="wo_status"
                            fieldRequired="false" fieldReadOnly fieldId="wo_status" />
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Link Status')" fieldName="link_status"
                            fieldRequired="false" fieldReadOnly fieldId="link_status" />
                    </div>
                    
                    <div class="col-md-6 col-lg-3">
                        <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Bid Approved Amount')" fieldName="bid_approved_amount"
                            fieldRequired="false" fieldReadOnly fieldId="bid_approved_amount" />
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Change Order Amount')" fieldName="change_order_amount"
                            fieldRequired="false" fieldReadOnly fieldId="change_order_amount" />
                    </div>
                    
                    <div class="col-md-6 col-lg-3">
                        <x-forms.datepicker fieldId="pay_date" :fieldLabel="__('Payment Date')" fieldName="pay_date" fieldRequired="true"
                            :fieldPlaceholder="__('placeholders.date')" />
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <x-forms.number class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('app.price')" fieldName="price"
                            fieldRequired="true" fieldId="price" :fieldPlaceholder="__('placeholders.price')" />

                    </div>

                    <div class="col-md-6 col-lg-3 d-none">
                        @if (isset($projectName))
                            <input type="hidden" id="currency_id" name="currency_id"
                                value="{{ $project->currency_id }}">
                            <x-forms.text :fieldLabel="__('modules.invoices.currency')" fieldName="project-currency" fieldId="project-currency"
                                :fieldValue="$project->currency->currency_name" fieldReadOnly="true" />
                        @else
                            <input type="hidden" id="currency_id" name="currency_id"
                                value="{{ company()->currency_id }}">
                            <x-forms.select :fieldLabel="__('modules.invoices.currency')" fieldName="currency" fieldRequired="true"
                                fieldId="currency">
                                @foreach ($currencies as $currency)
                                    <option @selected($currency->id == company()->currency_id) value="{{ $currency->id }}"
                                        data-currency-name="{{ $currency->currency_name }}">
                                        {{ $currency->currency_name }} - ({{ $currency->currency_symbol }})
                                    </option>
                                @endforeach
                            </x-forms.select>
                        @endif
                    </div>

                    <div class="col-md-6 col-lg-3 d-none">
                        <x-forms.number fieldId="exchange_rate" :fieldLabel="__('modules.currencySettings.exchangeRate')" fieldName="exchange_rate"
                            fieldRequired="true" :fieldValue="isset($projectName)
                                ? $project->currency->exchange_rate
                                : $companyCurrency->exchange_rate" fieldReadOnly="true" :fieldHelp="' '" />
                    </div>
                    <div class="col-md-6 col-lg-4 d-none">
                        <x-forms.datepicker fieldId="purchase_date" fieldRequired="true" :fieldLabel="__('modules.expenses.purchaseDate')"
                            fieldName="purchase_date" :fieldPlaceholder="__('placeholders.date')" :fieldValue="\Carbon\Carbon::today()->format(company()->date_format)" />
                    </div>

                    @if (user()->permission('add_expenses') == 'all')
                        <div class="col-md-6 col-lg-4 d-none">
                            <x-forms.label class="mt-3" fieldId="user_id" :fieldLabel="__('app.employee')" fieldRequired="true">
                            </x-forms.label>
                            <x-forms.input-group>
                                <select class="form-control select-picker" name="user_id" id="user_id"
                                    data-live-search="true" data-size="8">
                                    <option value="">--</option>
                                    @foreach ($employees as $item)
                                        <x-user-option :user="$item" />
                                    @endforeach
                                </select>
                            </x-forms.input-group>
                        </div>
                    @else
                        <input type="hidden" name="user_id" value="{{ user()->id }}">
                    @endif
                    <div class="col-md-6 col-lg-3">
                        <x-forms.number class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Pending Amount')" fieldName="pending_amount"
                         fieldId="pending_amount" fieldReadOnly/>

                    </div>

                    <div class="col-md-3">
                        <x-forms.label class="mt-3" fieldId="category_id" :fieldLabel="__('modules.expenses.expenseCategory')">
                        </x-forms.label>
                        <x-forms.input-group>
                            <select class="form-control select-picker" name="category_id" id="expense_category_id"
                                data-live-search="true">
                                <option value="">--</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>

                            @if ($addExpenseCategoryPermission == 'all' || $addExpenseCategoryPermission == 'added')
                                <x-slot name="append">
                                    <button id="addExpenseCategory" type="button"
                                        class="btn btn-outline-secondary border-grey" data-toggle="tooltip"
                                        data-original-title="{{ __('modules.expenseCategory.addExpenseCategory') }}">@lang('app.add')</button>
                                </x-slot>
                            @endif
                        </x-forms.input-group>
                    </div>

                    <div class="col-md-3">
                        <x-forms.label class="mt-3" fieldId="payment_method" :fieldLabel="__('Payment Method')">
                        </x-forms.label>
                        <x-forms.input-group>
                            <select class="form-control select-picker" name="payment_method" id="payment_method_id" data-live-search="true">
                                <option value="">--</option>
                                @foreach ($paymentMethods as $method)
                                    <option value="{{ $method->payment_method }}">{{ $method->payment_method }}</option>
                                @endforeach
                            </select>
                            <x-slot name="append">
                                <button id="addPaymentMethod" type="button" class="btn btn-outline-secondary border-grey">
                                    @lang('app.add')
                                </button>
                            </x-slot>
                        </x-forms.input-group>
                    </div>

                    <div class="col-md-3">
                        <x-forms.label class="mt-3" fieldId="fee_method" :fieldLabel="__('Additional Fee Type')">
                        </x-forms.label>
                        <x-forms.input-group>
                            <select class="form-control select-picker" name="fee_method_id" id="fee_method_id" data-live-search="true">
                                <option value="">--</option>
                                @if(isset($feeMethods) && count($feeMethods) > 0)
                                    @foreach ($feeMethods as $method)
                                        <option value="{{ $method->fee_method }}">{{ $method->fee_method }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <x-slot name="append">
                                <button id="addFeeMethod" type="button" class="btn btn-outline-secondary border-grey">
                                    @lang('app.add')
                                </button>
                            </x-slot>
                        </x-forms.input-group>
                    </div>
                    
                    <div class="col-md-4 d-none">
                        <x-forms.text :fieldLabel="__('modules.expenses.purchaseFrom')" fieldName="purchase_from" fieldId="purchase_from"
                            :fieldPlaceholder="__('placeholders.expense.vendor')" />
                    </div>

                    @if ($linkExpensePermission == 'all')
                        <div class="col-md-4 d-none">
                            <x-forms.select fieldId="bank_account_id" :fieldLabel="__('app.menu.bankaccount')" fieldName="bank_account_id"
                                search="true">
                                <option value="">--</option>
                                @if ($viewBankAccountPermission != 'none')
                                    @foreach ($bankDetails as $bankDetail)
                                        <option value="{{ $bankDetail->id }}">
                                            @if ($bankDetail->type == 'bank')
                                                {{ $bankDetail->bank_name }} |
                                            @endif {{ $bankDetail->account_name }}
                                        </option>
                                    @endforeach
                                @endif
                            </x-forms.select>
                        </div>
                    @endif
                    <input type = "hidden" name = "mention_user_ids" id = "mentionUserId" class ="mention_user_ids">

                    <div class="col-md-12">
                        <div class="form-group my-3">
                            <x-forms.label fieldId="description" :fieldLabel="__('app.description')">
                            </x-forms.label>
                            <div id="description"></div>
                            <textarea name="description" id="description-text" class="d-none"></textarea>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <x-forms.file :fieldLabel="__('app.bill')" fieldName="bill" fieldId="bill"
                            allowedFileExtensions="txt pdf doc xls xlsx docx rtf png jpg jpeg svg"
                            :popover="__('messages.fileFormat.multipleImageFile')" />
                    </div>
                </div>
                <x-forms.custom-field :fields="$fields"></x-forms.custom-field>

                <x-form-actions>
                    <x-forms.button-primary id="save-expense-form" class="mr-3" icon="check">@lang('app.save')
                    </x-forms.button-primary>
                    <x-forms.button-cancel :link="route('expenses.index')" class="border-0">@lang('app.cancel')
                    </x-forms.button-cancel>
                </x-form-actions>

            </div>
        </x-form>

    </div>
</div>


<script>
    $(document).ready(function() {
        var pendingAmount = 0;
        quillMention(null, '#description');

        $('.custom-date-picker').each(function(ind, el) {
            datepicker(el, {
                position: 'bl',
                ...datepickerConfig
            });
        });

        const dp1 = datepicker('#pay_date', {
            position: 'bl',
            ...datepickerConfig
        });

        $('#save-expense-form').click(function() {

            let note = document.getElementById('description').children[0].innerHTML;
            document.getElementById('description-text').value = note;
            var mention_user_id = $('#description span[data-id]').map(function() {
                return $(this).attr('data-id')
            }).get();
            $('#mentionUserId').val(mention_user_id.join(','));
            const url = "{{ route('expenses.store') }}";
            var data = $('#save-expense-data-form').serialize();
            var pending_amount = $('#pending_amount').val();
            var bid_approved_amount = parseFloat($('#bid_approved_amount').val());
            var price = parseFloat($('#price').val());
            const fileInput = document.getElementById('bill');
            $.easyAjax({
                url: url,
                container: '#save-expense-data-form',
                type: "POST",
                disableButton: true,
                blockUI: true,
                buttonSelector: "#save-expense-form",
                data: {
                    data:data,
                },
                file: true,
                success: function(response) {
                    window.location.href = response.redirectUrl;
                }
            });
        });

        $('#addExpenseCategory').click(function() {
            let userId = $('#user_id').val();
            const url = "{{ route('expenseCategory.create') }}?user_id=" + userId;
            $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
            $.ajaxModal(MODAL_LG, url);
        });

        $('#addPaymentMethod').click(function() {
            const url = "{{ route('expensePaymentMethod.create') }}";
            $.ajaxModal(MODAL_LG, url);
        });

        $('body').on('change', '#user_id', function() {
            let userId = $(this).val();
            let categoryId = $('#expense_category_id').val();

            const url = "{{ route('expenses.get_employee_projects') }}";
            let data = $('#save-expense-data-form').serialize();

            $.easyAjax({
                url: url,
                type: "GET",
                data: {
                    'userId': userId,
                    'categoryId': categoryId
                },
                success: function(response) {
                    $('#project_id').html('<option value="">--</option>' + response.data);
                    $('#project_id').selectpicker('refresh')
                    $('#expense_category_id').html('<option value="">--</option>' + response.category);
                    $('#expense_category_id').selectpicker('refresh')
                }
            });

        });

        $('body').on('change', '#expense_category_id', function() {
            let categoryId = $(this).val();
            let userId = $('#user_id').val();

            const url = "{{ route('expenses.get_category_employees') }}";
            let data = $('#save-expense-data-form').serialize();

            $.easyAjax({
                url: url,
                type: "GET",
                data: {
                    'categoryId': categoryId,
                    'userId': userId
                },
                success: function(response) {
                    $('#user_id').html('<option value="">--</option>' + response.employees);
                    $('#user_id').selectpicker('refresh')
                }
            });
        });

        init(RIGHT_MODAL);
    });
    $('body').on("change", '#project_id', function() {
        if ($('#project_id').val() != '') {
            var id = $('#project_id').val();
            var url = "{{ route('vendors.vendors_list_expense', ':id') }}";
            url = url.replace(':id', id);
            var token = "{{ csrf_token() }}";

            $.easyAjax({
                url: url,
                container: '#save-expense-data-form',
                type: "POST",
                blockUI: true,
                data: {
                    _token: token
                },
                success: function(response) {
                    if (response.status == 'success') {
                        $('#vendor_id').html(response.data);
                        $('#vendor_id').selectpicker('refresh');
                    }
                }
            });
        }
    });
    $('body').on("change", '#vendor_id', function () {
    var vendorId = $('#vendor_id').val();
    var projectId = $('#project_id').val();
    
        if (vendorId && projectId) {
            var url = "{{ route('projectvendors.get_vendor_details', ['vendorId' => '__vendor__', 'projectId' => '__project__']) }}";
            url = url.replace('__vendor__', vendorId).replace('__project__', projectId);
            $.easyAjax({
                url: url,
                type: "GET",
                container: '#save-expense-data-form',
                blockUI: true,
                success: function (response) {
                    if (response.status === 'success') {
                        $('#wo_status').val(response.data.wo_status);
                        $('#bid_approved_amount').val(response.data.bid_approved_amount);
                        pendingAmount = (parseFloat(response.data.bid_approved_amount) || 0);
                        // console.log(pendingAmount);
                        $('#change_order_amount').val(response.data.change_order_amount);
                        $('#link_status').val(response.data.link_status);
                    } else {
                        $('#wo_status, #bid_approved_amount, #change_order_amount,#link_status').val('');
                    }
                },
                error: function (xhr) {
                    console.error("AJAX Error:", xhr);
                    $('#wo_status, #bid_approved_amount, #change_order_amount,#link_status').val('');
                }
            });
        }
    });
    $('body').on("input", '#price', function (){
        if($('#vendor_id').val()!=''){
        var price= parseFloat($(this).val()) || 0; 
        amt = pendingAmount - price;
        $('#pending_amount').val(amt);
        }
    });
    @if (isset($projectName))
        setExchangeRateHelp();

        function setExchangeRateHelp() {
            $('#exchange_rate').prop('readonly', false);
            var companyCurrencyName = "{{ $companyCurrency->currency_name }}";
            var currentCurrencyName = `{{ $project->currency->currency_name }}`;
            let currencyExchange = (companyCurrencyName != currentCurrencyName) ? '( ' + currentCurrencyName +
                ' @lang('app.add') ' + currentCurrencyName + ' )' : '';
            $('#exchange_rateHelp').html(currencyExchange);
        }
    @endif

    $('#addFeeMethod').click(function() {
        const url = "{{ route('expenseAdditionalFee.create') }}";
        $.ajaxModal(MODAL_LG, url);
    });

</script>
