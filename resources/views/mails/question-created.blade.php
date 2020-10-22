@component('mail::message')
# {{ $question->title }}

{{ $question->desc }}

@component('mail::button', ['url' => ''])
Answer Now
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
