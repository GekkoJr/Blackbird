<!DOCTYPE html>
<head>
    <title>test</title>
    @vite('resources/js/app.js')
</head>
<form method="post" action="{{ route('sendMessage') }}">
    @csrf
    <input type="text" name="message">
    <input type="submit">
</form>
