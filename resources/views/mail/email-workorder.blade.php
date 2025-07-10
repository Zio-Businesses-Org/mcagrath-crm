@component('mail::message')
# @lang('email.hello')@if(!empty($notifiableName)){{ ' '.$notifiableName }}@endif!

@if (!empty($content))

@component('mail::text', ['text' => $content])

@endcomponent
@endif

@if (!empty($url))
    @component('mail::button', ['url' => $url, 'themeColor' => ((!empty($themeColor)) ? $themeColor : '#1f75cb')])
    {{ $actionText }}
    @endcomponent
@endif

@if (!empty($estlink))
@component('mail::button', ['url' => $estlink, 'themeColor' => ((!empty($themeColor)) ? $themeColor : '#1f75cb')])
    Please Click Here To Add an Estimate
@endcomponent
@endif

@lang('email.regards'),<br>
{{ config('app.name') }}<br>
{{ $phone }}
@endcomponent