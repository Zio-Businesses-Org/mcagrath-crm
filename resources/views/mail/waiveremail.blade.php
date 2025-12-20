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

@lang('Thank You!'),<br>
{{ config('app.name') }}<br>
6094884290<br>
COI@mcresi.com

@endcomponent
