<div class="modal-header">
    <h5 class="modal-title" id="modelHeading">@lang('Add Payment Info')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">×</span></button>
</div>
<x-form id="addExpensePaymentInfo">
    <div class="modal-body">
        <input type="hidden" name="expense_id" value="{{ $expense_id }}">
        <div class="row">
            <div class="col-md-3">
                <x-forms.datepicker fieldId="pay_date" :fieldLabel="__('Payment Date')" fieldName="pay_date" fieldRequired="true"
                    :fieldPlaceholder="__('placeholders.date')" />
            </div>
            <div class="col-md-3">
                <x-forms.number class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('app.price')" fieldName="price"
                    fieldRequired="true" fieldId="price" :fieldPlaceholder="__('placeholders.price')" />

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
            <div class="col-md-3">
                <x-forms.number class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Pending Amount')" fieldName="pending_amount"
                    fieldId="pending_amount" :fieldPlaceholder="__('placeholders.price')" :fieldValue="$pending_price"/>

            </div>
            <div class="col-md-9">
                <x-forms.file :fieldLabel="__('app.bill')" fieldName="bill" fieldId="bill"
                    allowedFileExtensions="txt pdf doc xls xlsx docx rtf png jpg jpeg svg"
                    :popover="__('messages.fileFormat.multipleImageFile')"/>
            </div>
                    
        </div>
    </div>
    <div class="modal-footer">
        <x-forms.button-cancel data-dismiss="modal" class="border-0 mr-3">@lang('app.close')</x-forms.button-cancel>
        <x-forms.button-primary id="save-expense-payment" icon="check">@lang('app.save')</x-forms.button-primary>
    </div>

</x-form>
  
<script>
    $(document).ready(function() {
        $("#addExpensePaymentInfo .select-picker").selectpicker()
        init(RIGHT_MODAL);
        const dp1 = datepicker('#pay_date', {
            position: 'bl',
            ...datepickerConfig
        });
        $('#save-expense-payment').click(function() {

            const url = "{{ route('expensePayment.store') }}";
            var data = $('#addExpensePaymentInfo').serialize();

            $.easyAjax({
                url: url,
                container: '#addExpensePaymentInfo',
                type: "POST",
                disableButton: true,
                blockUI: true,
                buttonSelector: "#save-expense-form",
                data: {
                    data:data,
                },
                file: true,
                success: function(response) {
                    
                    $(MODAL_LG).modal('hide');
                    $('.expense-payment tbody').prepend(response.html);
                }
            });
        });
        
    });
</script>
