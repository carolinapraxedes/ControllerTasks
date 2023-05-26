<x-mail::message>
# {{$task}}

Date end: {{$date-end}}


<x-mail::button :url="'$url'">
More details about new task
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
