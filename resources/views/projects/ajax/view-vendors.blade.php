
<div class="modal-header">
    <h5 class="modal-title" id="modelHeading">@lang('Assigned Vendor Details')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">×</span></button>
</div>
<div class="modal-body">
    <div class="row py-5">
        
        <div class="col-lg-12 col-md-12 mb-4 mb-xl-0 mb-lg-4">
            
            <x-table class="border-0 pb-3 admin-dash-table table-hover">

                <x-slot name="thead">
                    <th class="pl-20">#</th>
                    <th>@lang('Vendor Name')</th>
                    <th>@lang('Vendor Phone')</th>
                    <th>@lang('Vendor Office #')</th>
                    <th>@lang('Vendor Company Name')</th>
                    <th>@lang('Vendor Email')</th>
                </x-slot>

                @forelse($projectvendor as $key=>$item)
                    <tr>
                        <td class="pl-20">{{$key+1}}</td>
                        <td>
                            {{$item->vendor_name??''}}
                        </td>
                        <td>
                            {{$item->vendor_phone??''}}
                        </td>
                        <td>
                            {{$item->vendors->office??''}}
                        </td>
                        <td>
                            {{$item->vendors->company_name??''}}
                        </td>
                        <td>
                            {{$item->vendor_email_address}}
                        </td>
                    </tr>
                @empty
                    <x-cards.no-record-found-list colspan="7"/>
                @endforelse
            </x-table>

        </div>

    </div>
</div>

