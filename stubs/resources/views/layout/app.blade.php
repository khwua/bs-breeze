<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>
            {{ $title ?? config('app.name') }}
        </title>

        {{-- Initial Application stylesheet & scripts --}}
        @vite(['resources/scss/style.scss', 'resources/js/scripts.js'])
    </head>
    <body>
        <div id="wrapper">
            {{-- Include the application header --}}
            @include('layout.header')

            {{-- Main content should be here --}}
            <main {{ $attributes->merge(['id' => 'main-container']) }}>
                {{ $slot  }}
            </main>

            {{-- Include the applicaiton footer --}}
            @include('layout.footer')
        </div>
    </body>
</html>
