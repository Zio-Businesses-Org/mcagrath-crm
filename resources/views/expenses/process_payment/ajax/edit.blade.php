<div class="modal-header">
    <h5 class="modal-title" id="modelHeading">@lang('Edit Expense Payment Info')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">×</span></button>
</div>

<div class="modal-body">
    <div class="row">
        <div class="col-sm-12">
            <x-form id="update-expense-payment-info" method="PUT">

                <div class="add-client bg-white rounded">

                    <div class="row p-20">
                        
                        <div class="col-md-3">
                            <x-forms.datepicker fieldId="pay_date" :fieldLabel="__('Payment Date')" fieldName="pay_date" fieldRequired="true"
                                :fieldPlaceholder="__('placeholders.date')" :fieldValue="$expensePayment->payment_date?->translatedFormat(company()->date_format)"/>
                        </div>
                        <div class="col-md-3">
                            <x-forms.number class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('app.price')" fieldName="price"
                                fieldRequired="true" fieldId="price" :fieldPlaceholder="__('placeholders.price')" :fieldValue="$expensePayment->price ?? ''"/>

                        </div>

                        <div class="col-md-3">
                            <x-forms.label class="mt-3" fieldId="payment_method" :fieldLabel="__('Payment Method')">
                            </x-forms.label>
                            <x-forms.input-group>
                                <select class="form-control select-picker" name="payment_method" id="payment_method_id" data-live-search="true">
                                    <option value="">--</option>
                                    @foreach ($paymentMethods as $method)
                                    <option value="{{ $method->payment_method }}" @selected($expensePayment->payment_method == $method->payment_method)>
                                        {{ $method->payment_method }}
                                    </option>
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
                                    @foreach ($feeMethods as $feeMethod)
                                        <option value="{{ $feeMethod->fee_method }}" @selected($expensePayment->additional_fee == $feeMethod->fee_method)>
                                            {{ $feeMethod->fee_method }}
                                        </option>
                                    @endforeach
                                </select>
                            </x-forms.input-group>
                        </div>
                        <div class="col-md-6">
                            <x-forms.text class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('Note')" fieldName="note"
                                fieldId="note" :fieldPlaceholder="__('Enter a note')" :fieldValue="$pending_price" :fieldValue="$expensePayment->note"/>
                        </div>

                        <div class="col-md-3">
                            <x-forms.file :fieldLabel="__('app.bill')" fieldName="bill" fieldId="bill"
                                allowedFileExtensions="txt pdf doc xls xlsx docx rtf png jpg jpeg svg"
                                :fieldValue="$expensePayment->bill_url" :popover="__('messages.fileFormat.multipleImageFile')" />
                        </div>
                    </div>

                    <x-form-actions>
                        <x-forms.button-primary id="update-payment" class="mr-3" icon="check">@lang('app.save')
                        </x-forms.button-primary>
                        <x-forms.button-cancel :link="route('expenses.index')" class="border-0">@lang('app.cancel')
                        </x-forms.button-cancel>
                    </x-form-actions>

                </div>
            </x-form>

        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        $("#update-expense-payment-info .select-picker").selectpicker()
        init(RIGHT_MODAL);
        const dp1 = datepicker('#pay_date', {
            position: 'bl',
            ...datepickerConfig
        });
        $('#update-payment').click(function() {

            const url = "{{ route('expensePayment.update', $expensePayment->id) }}";
            var data = $('#update-expense-payment-info').serialize();

            $.easyAjax({
                url: url,
                container: '#update-expense-payment-info',
                type: "POST",
                disableButton: true,
                blockUI: true,
                buttonSelector: "#update-payment",
                data: data,
                file: true,
                success: function(response) {
                    if (response.status == 'success') {
                        window.location.href = response.redirectUrl;
                    }
                }
            });
        });

    });
    
</script>