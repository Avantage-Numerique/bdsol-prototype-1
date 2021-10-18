<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @if ($title)
        <title>{{$title}}</title>
    @else
        <title>{{config('app.name')}} v.{{config('app.version')}}</title>
    @endif
    @include('public.inc.head')
</head>
<body class="antialiased" style="background-image:url({{asset('images/fond-avantage-numeriqe.png')}});">

<div class="relative flex items-top justify-center min-h-screen bg-gray-100 sm:items-center sm:pt-0">
    <div class="zone-centered">
        @if ($title)
            <h1 class="text-center">{{$title}}</h1>
        @else
            <h1 class="text-center">{{config('app.name')}} v.{{config('app.version')}}</h1>
        @endif
        <figure>
            <img src="{{asset('images/avantage-numerique-noire-nopadding.svg')}}" alt="{{config('app.name')}}" style="width:100%; height: auto;" />
        </figure>
    </div>
</div>

@include('public.inc.footer-script')
</body>
</html>
