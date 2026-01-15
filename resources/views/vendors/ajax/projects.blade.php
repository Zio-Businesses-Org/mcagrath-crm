

<!-- ROW START -->
<div class="row pb-5">
    <div class="col-lg-12 col-md-12 mb-4 mb-xl-0 mb-lg-4 mt-3 mt-lg-5 mt-md-5">
        <!-- Add Task Export Buttons Start -->
        <div class="d-flex" id="table-actions">
            <x-forms.link-primary :link="route('projects.create')"
                class="mr-3 openRightModal float-left mb-2 mb-lg-0 mb-md-0" icon="plus">
                @lang('app.addProject')
            </x-forms.link-primary>
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
        $('#projects-table').on('preXhr.dt', function(e, settings, data) {
            var vendorID = "{{ $vendorDetail->id }}";
            data['vendor_id'] = vendorID;
            
        });

        const showTable = () => {
            window.LaravelDataTables["projects-table"].draw(false);
        }

</script>
