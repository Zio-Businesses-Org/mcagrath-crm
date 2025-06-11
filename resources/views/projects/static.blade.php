    <style>
    .btn-xs {
    padding: .25rem .4rem;
    font-size: .875rem;
    line-height: .5;
    border-radius: .2rem; 
    }

    </style>
    <div class=" d-flex flex-col">
        <div class="col-sm border-right-grey">
            <div class="row border-bottom-grey">
                <div class="col">
                    <h5 class="f-15 f-w-500 text-darkest-grey mb-0 py-2">Project Details</h5>
                </div>
            </div>
            <div class="row border-bottom-grey">
                <div class="col">
                     Work Order # - {{$project->project_short_code ?? ''}}
                </div>
                <div class="col border-left-grey">
                     Project Status - {{$project->status ?? ''}} 
                </div>
            </div>
            <div class="row border-bottom-grey">
                <div class="col">
                     Project Type - {{$project->type ?? ''}}
                </div>
                <div class="col border-left-grey">
                     Client Name - {{$project->client?->name_salutation ?? ''}} 
                </div>
            </div>
            <div class="row border-bottom-grey">
                <div class="col">
                     Priority - {{$project->priority ?? ''}}
                </div>
                <div class="col border-left-grey">
                     Project Date - {{$project->start_date?->format(company()->date_format)}} 
                </div>
            </div>
            <div class="row border-bottom-grey">
                <div class="col">
                    Project Category - {{$project->category->category_name ?? ''}}
                </div>
                <div class="col border-left-grey">
                    Due Date - {{$project->deadline?->format(company()->date_format)}} 
                </div>
            </div>
            <div class="row border-bottom-grey">
                <div class="col">
                    Project SubCategory - {{$project->sub_category ?? ''}}
                </div>
                <div class="col border-left-grey">
                    Not To Exceed - {{$project->nte}} 
                </div>
            </div>
            <div class="row border-bottom-grey">
                <div class="col">
                    Next Follow Up Date - {{$project->nxt_follow_up_date?->format(company()->date_format)}}
                </div>
                <div class="col border-left-grey">
                    Next Follow Up Time - {{$project->nxt_follow_up_time ? \Carbon\Carbon::createFromFormat('H:i:s', $project->nxt_follow_up_time)->format(company()->time_format) : ''}} 
                </div>
            </div>
        </div>
        <div class="col-sm border-right-grey">
            <div class="row border-bottom-grey">
                <div class="col">
                    <h5 class="f-15 f-w-500 text-darkest-grey mb-0 py-2">Property Information</h5>
                </div>
            </div>
            <div class="row border-bottom-grey">
                <div class="col">
                        Property Address - {{$project->propertyDetails->street_address ?? ''}} @if($project->propertyDetails->optional), {{$project->propertyDetails->optional ?? ''}} @endif
                </div>
                <div class="col border-left-grey">
                        Property Type - {{$project->propertyDetails->property_type ?? ''}} 
                </div>
            </div>
            <div class="row border-bottom-grey">
                <div class="col">
                        City - {{$project->propertyDetails->city ?? ''}}
                </div>
                <div class="col border-left-grey">
                        Bed - {{$project->propertyDetails->bedrooms ?? ''}}
                        <span class="ml-2">Bath - {{$project->propertyDetails->bathrooms ?? ''}}</span>
                </div>
            </div>
            <div class="row border-bottom-grey">
                <div class="col">
                        State - {{$project->propertyDetails->state ?? ''}}
                </div>
                <div class="col border-left-grey">
                    House Size - {{$project->propertyDetails->house_size ?? ''}} 
                </div>
            </div>
            <div class="row border-bottom-grey">
                <div class="col">
                        Zipcode - {{$project->propertyDetails->zipcode ?? ''}}
                        
                </div>
                <div class="col border-left-grey">
                        Occupied - {{$project->propertyDetails->occupancy_status ?? ''}}
                </div>
            </div>
            <div class="row border-bottom-grey">
                <div class="col">
                        County - {{$project->propertyDetails->county ?? ''}}                        
                </div>
                <div class="col border-left-grey">
                        Lock Box Code - {{$project->propertyDetails->lockboxcode ?? ''}} 
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="row border-bottom-grey">
                <div class="col">
                    <h5 class="f-15 f-w-500 text-darkest-grey mb-0 py-2">Contact Information</h5>
                </div>
            </div>
            <div class="row border-bottom-grey">
                <div class="col">
                        Asset Manager Details - 
                        @if($project->projectContacts->amname)
                        {{$project->projectContacts->amname ?? ''}}
                        @endif
                        @if($project->projectContacts->amph)
                        , {{$project->projectContacts->amph ?? ''}}
                        @endif
                        @if($project->projectContacts->amemail)
                        , {{$project->projectContacts->amemail ?? ''}}
                        @endif
                </div>
            </div>
            <div class="row border-bottom-grey">
                <div class="col">
                    Tenant Details - 
                    <span class=" float-right">
                        <a class="btn btn-secondary m-2 btn-xs view-tenants" href="javascript:;">
                            <i class="fa fa-eye mr-2"></i>
                            @lang('View')
                        </a>
                    </span>
                </div>
            </div>
            <div class="row border-bottom-grey">
                <div class="col">
                        Project Coordinators - 
                        @foreach($project->projectMembersWithoutScope as $pm)
                            @if($pm->name)
                            {{$pm->name ?? ''}}
                            @endif
                            @if($pm->mobile)
                            , {{$pm->mobile}}
                            @endif
                            @if($pm->email)
                            , {{$pm->email}}
                            @endif
                        @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col">
                    Assigned Vendors -
                    <span class=" float-right">
                        <a class="btn btn-secondary m-2 btn-xs view-vendors" href="javascript:;">
                                <i class="fa fa-eye mr-2"></i>
                                @lang('View')
                            </a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function() {
        $('body').on('click', '.view-tenants', function() {
            var id = "{{$project->id}}";
            var url = "{{ route('projects.viewTenants',':id') }}";
            url = url.replace(':id', id);
            $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
            $.ajaxModal(MODAL_LG, url);
        });
        $('body').on('click', '.view-vendors', function() {
            var id = "{{$project->id}}";
            var url = "{{ route('projects.viewVendors',':id') }}";
            url = url.replace(':id', id);
            $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
            $.ajaxModal(MODAL_LG, url);
        });
    });
    </script>