<style>
    .dropdown-mod{
        position :static;  
    } 
    .button-wrapper::-webkit-scrollbar {
        display: none; /* Hides the scrollbar */
    }
</style>
<x-filters.filter-box-moded>
    <div class="task-search d-flex  py-1 px-lg-3 px-0 align-items-center">
        <form class="w-100 mr-1 mr-lg-0 mr-md-1 ml-md-1 ml-0 ml-lg-0">
            <div class="input-group bg-grey rounded">
                <div class="input-group-prepend">
                    <span class="input-group-text border-0 bg-additional-grey">
                        <i class="fa fa-search f-13 text-dark-grey"></i>
                    </span>
                </div>
                <input type="text" class="form-control f-14 p-1 border-additional-grey" id="search-text-field"
                    placeholder="@lang('app.startTyping')">
            </div>
        </form>
    </div>
    <div class="select-box d-flex py-1 px-lg-2 px-md-2 px-0">
        <x-forms.button-secondary class="btn-xs d-none" id="reset-filters" icon="times-circle">
            @lang('app.clearFilters')
        </x-forms.button-secondary>
    </div>
</x-filters.filter-box-moded>
<div class="container-fluid d-flex position-relative border-bottom-grey mt-1">
    <!-- Left Scroll Button -->
    <button class="btn btn-dark" id="scrollLeftBtn" style="display: none; left: 0;">&#9664;</button>
    <!-- Scrollable Button Wrapper -->
    <div id="buttonWrapper" class="button-wrapper d-flex overflow-auto flex-nowrap my-2">
    @foreach ($clientFilter as $filter)
    <!-- Buttons in a horizontal line -->
        <div class="task_view mx-1">
            
            <div class="taskView text-darkest-grey f-w-500">@if($filter->status=='active')<i class="fa fa-circle mr-2" style="color:#679c0d;"></i>@endif{{$filter->name}}</div>
            <div class="dropdown dropdown-mod">
                <a class="task_view_more d-flex align-items-center justify-content-center dropdown-toggle"
                    type="link" id="dropdownMenuLink-{{$filter->id}}" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="icon-options-vertical icons"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-mod" 
                    aria-labelledby="dropdownMenuLink-{{$filter->id}}" tabindex="0" >
                        @if($filter->status=='inactive')
                        <a class="dropdown-item apply-filter-client" href="javascript:;"
                            data-row-id="{{$filter->id}}">
                            <i class="bi bi-save2 mr-2"></i>
                            @lang('Apply')
                        </a>
                         @endif
                        <a class="dropdown-item edit-filter-client" href="javascript:;"
                            data-row-id="{{$filter->id}}">
                            <i class="fa fa-edit mr-2"></i>
                            @lang('app.edit')
                        </a>
                        <a class="dropdown-item delete-row-client" href="javascript:;"
                            data-row-id="{{$filter->id}}">
                            <i class="fa fa-trash mr-2"></i>
                            @lang('app.delete')
                        </a>
                        @if($filter->status=='active')
                        <a class="dropdown-item clear-filter" href="javascript:;"
                            data-row-id="{{$filter->id}}">
                            <i class="bi bi-save2 mr-2"></i>
                            @lang('Clear')
                        </a>
                        @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <!-- Right Scroll Button -->
    <button class="btn btn-dark" id="scrollRightBtn" style="display: none; right: 0;">&#9654;</button>
</div>

@push('scripts')
    <script>

        $('#search-text-field').on('keyup', function() {
            if ($('#search-text-field').val() != "") {
                $('#reset-filters').removeClass('d-none');
                showTable();
            }
        });

        $('#reset-filters,#reset-filters-2').click(function() {
            $('#filter-form')[0].reset();
            $('.filter-box .select-picker').selectpicker("refresh");
            $('#reset-filters').addClass('d-none');
            showTable();
        });

    </script>
@endpush
