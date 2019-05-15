
@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
             Japan
        @endcomponent
    @endslot 
    Dear {{ Base64::url_decode($email) }},


    You just unsubscribe to our newsletter.    

    
    {{ $message }}

    Thanks, <br />
    {{ config('app.name') }}

    
{{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }} - follow the link to manage <a href="{{ $UnsubscribeURL }}">@lang('subscriptions')</a>. @lang('All rights reserved.')
        @endcomponent
    @endslot
@endcomponent
