<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Boletines</title>
    <link rel="stylesheet" type="text/css" href="style.css" >
</head>
<body>
    <div id="position">
        <form action="boletin.php" type="POST">
            <div id = "Back1">
                <label>Seleccione el tipo de Boletín</label><br>
                <input id="r1" type="radio" class="space"  name="option" value="1">Boletín uno<br>
                <input id="r2" type="radio" class="space"   name="option" value="2">Boletín dos<br>
                <input id="r3" type="radio" class="space"   name="option" value="3">Boletín tres <br>
                <input id="r4" type="radio" class="space"   name="option" value="4">Boletín cuatro <br>
                <input id="r5" type="radio" class="space"   name="option" value="5">Boletín cinco <br>
                <input id="submit" type="submit" value="Generar">
            </div>    
        </form>
    </div>
   

    <div id="position2">
        <img id="img" class="position-boletin" src="nuevo-tapiz.jpg" alt="img">
    </div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="dashboard.js"></script>
</html>