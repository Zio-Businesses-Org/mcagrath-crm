

<div class="row">
    <div class="col-sm-12">
        <x-form id="save-partial-pay-form">

            <div class="add-client bg-white rounded">
                <h4 class="mb-0 p-20 f-21 font-weight-normal text-capitalize border-bottom-grey">
                    @lang('app.expenseDetails')</h4>
                <div class="row p-20">
                    <input type="hidden" id="expense_id"  name="expense_id" value ="{{$expense_id}}"/>
                    <div class="col-md-6 col-lg-3 d-none">
                        <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('modules.expenses.itemName')" fieldName="item_name"
                            fieldRequired="true" fieldId="item_name" :fieldPlaceholder="__('placeholders.expense.item')" />
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <input type="hidden" id="project_id"  name="project_id" value ="{{$project->id}}"/>
                        <x-forms.text :fieldLabel="__('Project')" fieldName="projectName" fieldId="projectName"
                            :fieldValue="$project->project_short_code" fieldReadOnly="true" />
                      
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <input type="hidden" id="vendor_id"  name="vendor_id" value ="{{$vendor->id}}"/>
                        <x-forms.text :fieldLabel="__('Vendor')" fieldName="vendorName" fieldId="vendorName"
                            :fieldValue="$vendor->vendor_name" fieldReadOnly="true" />
                    </div>
                    
                    <div class="col-md-6 col-lg-3">
                        <x-forms.datepicker fieldId="pay_date" :fieldLabel="__('Payment Date')" fieldName="pay_date" fieldRequired="true"
                            :fieldPlaceholder="__('placeholders.date')" />
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <x-forms.number class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('app.price')" fieldName="price"
                            fieldRequired="true" fieldId="price" :fieldPlaceholder="__('placeholders.price')" />

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
                        </x-forms.input-group>
                    </div>
                    
                    <div class="col-lg-12">
                        <x-forms.file :fieldLabel="__('app.bill')" fieldName="bill" fieldId="bill"
                            allowedFileExtensions="txt pdf doc xls xlsx docx rtf png jpg jpeg svg"
                            :popover="__('messages.fileFormat.multipleImageFile')" />
                    </div>
                </div>

                <x-form-actions>
                    <x-forms.button-primary id="save-partial-pay" class="mr-3" icon="check">@lang('app.save')
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
        init(RIGHT_MODAL);
        
        const dp1 = datepicker('#pay_date', {
            position: 'bl',
            ...datepickerConfig
        });
        $('#save-partial-pay').click(function() {
           
            var data = $('#save-partial-pay-form').serialize();
            const url = "{{ route('partial-pay.store') }}";
            $.easyAjax({
                url: url,
                container: '#save-partial-pay-form',
                type: "POST",
                disableButton: true,
                blockUI: true,
                buttonSelector: "#save-partial-pay",
                data: data,
                file: true,
                success: function(response) {
                    window.location.href = response.redirectUrl;
                }
            });
        });
    });

</script>
