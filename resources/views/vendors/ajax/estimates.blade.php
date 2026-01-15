

<!-- ROW START -->
<div class="row pb-5">
    <div class="col-lg-12 col-md-12 mb-4 mb-xl-0 mb-lg-4 mt-3 mt-lg-5 mt-md-5">
        <!-- Add Task Export Buttons Start -->
        <div class="flex-grow-1 align-items-center mb-2 mb-lg-0 mb-md-0" id="table-actions">
            <x-forms.link-primary :link="route('vendor-estimates.create')" class="mr-3 float-left mb-2 mb-lg-0 mb-md-0" icon="plus">
                @lang('modules.estimates.createEstimate')
            </x-forms.link-primary>

            <x-forms.button-secondary icon="share" id="estimate-share-link" class="type-btn mb-3">
                @lang('Generate Link')
            </x-forms.button-secondary>
        </div>
        <!-- Add Task Export Buttons End -->
        <!-- Task Box Start -->
        <div class="d-flex flex-column w-tables rounded mt-3 bg-white table-responsive">

            {!! $dataTable->table(['class' => 'table table-hover border-0 w-100']) !!}

        </div>
        <!-- Task Box End -->
    </div>
</div>

@include('sections.datatable_js')

<script>
    $('#vendor-estimates-table').on('preXhr.dt', function(e, settings, data) {
        var vendorID = "{{ $vendorDetail->id }}";
        data['vendor_id'] = vendorID;
        
    });

    const showTable = () => {
        window.LaravelDataTables["vendor-estimates-table"].draw(false);
    }
    $('#estimate-share-link').click(function() {

        var url = "{{ route('vendor-estimates.generate') }}";
        $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
        $.ajaxModal(MODAL_LG, url);

    });

</script>
