<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="icon"
        href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAABmJLR0QA/wD/AP+gvaeTAAADt0lEQVR4nO2bz2sTQRTHPxtrUpNui7UkQUuRttp/wYp/QYW2eCsK9Sj466D1IHhSD1L/AEU8KGprsWrBg9SjCD3pVZCCoDeRorW0tU3Ww+wkbU2yM+lsspP2AyFkmfnuzJv33rydJLDDcWp8vy5gCDgJHAY6/evfga/AG2AG+FbjcYXOIeA+sA54Aa8cMIUwUEMwDCwiJrcKTAIjQB+Q8l99/rXnfhsP+A0M1mG8RrmMWFEPeAF0K/TpAaYpesOl0EYXMsOICawDV6rof9Xvn8NCT+ik6PbVTF4yRjEcDhoYV814SNHtt8srX+uBAa2a0IVw+1XUYj6IXl9rneK2GWkuIlZs0qDmlK953qAmADHTgsCA/z5jUFNqDVRsFRG+IFbriEHNPl/zs0HN0JDZv8WgZouvuWhQMzRkSWuFbhg5wCp2DVDvAdQbXQO8JfhxVhLUTveloptHPHYro3Mg4iJq8qjzE+hQbdykIZwF6O6IMX+rrWwj59wCAN69/RrSwQTpeh4kLiywlqMdSCDK50B0QiADkG2LZtpwHEi7MRBenVbtp22AjFvrY0R1sq2FsWVV++gboDWaHgCbvDNMA0TZA8I1QBYg40bYA0IOgTSUD4G1HIxNLxc+X3u5zFpOQ70MOrqZKjxAZxusGALXXy9z991K4fP47AoOcOfUPo1bbE+3rknw0ZzYdieeTfL0yQQAj+f+asiXRkd3QxLMqOpXkQNKe4C8ms97eH7lauLZVUe3miSoGgIukEzGHdzm0gYY7U8wPrvC6TMjhWtn++Oq4yiLjm41IaBqgMyWG/zH7SERk9I9R4/FuTm4vfjX1XWbHVIJh6VVL4VYtMATJNVN/QTw/nhPEx/GXMUu9aH3xi/mf+QBjiLOJyuimgMiXwZLdPOAngEiXAZLQjaABR7QppcIVQ2QhU3WjSwbSnWlWqDxQiAkD9jxSVBUgTZ4gGYxpDqj9BbxyKJ7KKJiABdIphKiyoo6GTeGI4aZQWF+Kgbwd4DoTx4g3gTtSQdEmX8gqL2KAazZASQ6YaBuAAt2AIlOImxMD9DYCjUMYJEHGA4Ba8pgyYZwDSyHGzMEdpOg2SQoQiCiX4qWwnQSFF+IWOUB5gxgVRks6Whx2LsHoPBbgbIEGcCqMlii81uBIANYtwNIVBOhmgEsin+J6laoZACbdgCJaiJU9AAbDWAmBPyjMPtCYEPeqlgO7ybBAJ0dnwStK4MlqkkwaGn/IP7ZaTNLVPjzRtDSfjI7lrrwsd4DiDT/ACw17TL5rFETAAAAAElFTkSuQmCC">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <Admin />
    </div>
</body>

</html>
