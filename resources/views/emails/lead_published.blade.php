<!DOCTYPE html>
<html>
<head>
    <title>{{ __('messages.lead_published.title') }}</title>
</head>
<body>
    <p>{{ __('messages.lead_published.greeting') }}</p>
    <p>{{ __('messages.lead_published.intro') }}</p>
    <p><strong>{{ __('messages.lead_published.job_type') }}</strong> {{ $lead->job_type }}</p>
    <p><strong>{{ __('messages.lead_published.budget') }}</strong> {{ $lead->budget }}</p>
    <p><strong>{{ __('messages.lead_published.price') }}</strong> €{{ $lead->price }}</p>
    <p>{{ __('messages.lead_published.outro') }}</p>
    <p>{{ __('messages.lead_published.regards') }}<br>{{ __('messages.lead_published.team') }}</p>
</body>
</html>
