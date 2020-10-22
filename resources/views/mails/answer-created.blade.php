@component('mail::message')
# {{ $answer->question->title }}

{{ $answer->answer }}

@component('mail::button', ['url' => ''])
Open Solution
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
