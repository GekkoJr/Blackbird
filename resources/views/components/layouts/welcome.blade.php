<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/welcome.scss')
    <title>{{ $title ?? 'Page Title' }}</title>
</head>
<body>
<header>
    <a href="/" wire:navigate class="headerLink"><p><span  class="headerFunColor">// </span>Blackbird</p></a>
    @auth
        <a class="headerLink" href="/app" wire:navigate><p>Chat</p></a>
    @endauth
    @guest
        <a href="/login" class="headerLink" wire:navigate><p>Login</p></a>
    @endguest
</header>
<main>
{{ $slot }}
</main>
</body>
</html>
