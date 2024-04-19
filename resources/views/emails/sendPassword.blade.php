<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
    <h3 class="font-bold text-xl text-red-500"> Soy un correo </h3>
    <div class="bg-gray-400">
        <p class="bg-blue-600 text-green-400"> {{ $password }} </p>
        <div class="bg-custom_red"></div>

    </div>
</body>
</html>
