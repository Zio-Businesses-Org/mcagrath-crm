<tr id="row-{{ $item->id }}">
    <td class="pl-20">{{ $item->id }}</td>
    <td>
        <a href="javascript:;" class="sow-detail text-darkest-grey f-w-500"
            data-sow-id="{{ $item->id }}">{{ $item->payment_date?->translatedFormat(company()->date_format)}}</a>
    </td>
    <td>
        {{$item->price??''}}
    </td>
    <td>
        {{$item->payment_method??''}}
    </td>
    <td>
        {{$item->additional_fee??''}}
    </td>
    <td>
        {{$item->user->name ?? ''}}
    </td>
    <td>
        {{$item->created_at->translatedFormat(company()->date_format)}}
    </td>
    <td class="text-right pr-20">
        <div class="task_view">
            @if($item->bill)
            <a class="taskView sow-detail text-darkest-grey f-w-500"
                target="_blank" href="{{ $item->bill_url }}"><i class="fa fa-paperclip"></i></a>
            @endif
            <div class="dropdown">
                <a class="task_view_more d-flex align-items-center justify-content-center dropdown-toggle"
                    type="link" id="dropdownMenuLink-{{ $item->id }}" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="icon-options-vertical icons"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right"
                    aria-labelledby="dropdownMenuLink-{{ $item->id }}" tabindex="0">

                    <a class="dropdown-item edit-exppay" href="javascript:;"
                        data-row-id="{{ $item->id }}">
                        <i class="fa fa-edit mr-2"></i>
                        @lang('app.edit')
                    </a>
                    
                    <a class="dropdown-item delete-row-payment" href="javascript:;"
                        data-row-id="{{ $item->id }}">
                        <i class="fa fa-trash mr-2"></i>
                        @lang('app.delete')
                    </a>
                    
                </div>
            </div>
        </div>

    </td>
</tr>