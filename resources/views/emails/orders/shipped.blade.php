@component('mail::message')
# Introduction

The body of your message.

## Content

Hello, my name is LiMing.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
