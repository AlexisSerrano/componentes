<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{url('api/valAbogadoUAT')}}" method="post">
        <input type="text" name="nombres">
        <input type="text" name="primerAp">
        <input type="text" name="segundoAp">
        <input type="submit">
    </form>
</body>
</html>