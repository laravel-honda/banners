<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <style>
        * {
            font-family: "Nunito", sans-serif;
        }
    </style>
</head>
<body class="p-6 bg-gray-900 h-screen overflow-hidden ">
<div class="h-full p-16 rounded-lg flex space-y-16 justify-center & flex-col">
    @isset($image)
        <img src="{{ $image }}" alt="Image"
             style="width: {{ $image_width ?? '100px' }}; height: {{ $image_height ?? '100px' }}" class="rounded-lg">
    @endisset
    <h1 class="font-bold text-blue-300 leading-tight" style="font-size: 110px;">{{ $title }}</h1>
    <p class="text-2xl text-gray-300" style="line-height:62px; font-size: 48px">{{ $body }}</p>
</div>
</body>

</html>

