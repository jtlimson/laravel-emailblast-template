

@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
        {{ $template->category->name }}
        @endcomponent
    @endslot

    {{-- Body --}}           
    {!! $body !!}        
    @lang('Thanks'),  
    @lang('Metrobank Japan')
    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset
    @slot('footer')
    @component('mail::footer')
        © {{ date('Y') }} {{ config('app.name') }} - follow the link to manage <a href="{{ $UnsubscribeURL }}">@lang('subscriptions')</a>. @lang('All rights reserved.')
    @endcomponent
@endslot
@endcomponent
