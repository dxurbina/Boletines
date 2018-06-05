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
                <h1>Boletines</h1><br>
                <input id="b1" type="radio" class="space"  name="option" value="1">Boletín uno<br>
                <input id="b2" type="radio" class="space"  name="option" value="2">Boletín dos<br>
                <input id="b3" type="radio" class="space"  name="option" value="3">Boletín tres <br>
                <input id="b4" type="radio" class="space"  name="option" value="4">Boletín cuatro <br>
                <input id="b5" type="radio" class="space"  name="option" value="5">Boletín cinco <br>
                <input id="submit" type="submit" value="Generar">
            </div>    
        </form>
    </div>
    <div id="position">
    <form action="resultados.php">
            <div id="Back2">
                <h1>Resultados</h1><br>
                <input id="r1" type="radio" class="space2"  name="option" value="1">Diaria<br>
                <input id="r2" type="radio" class="space2"  name="option" value="2">SuperCombo<br>
                <input id="r3" type="radio" class="space2"  name="option" value="3">Juga3<br>
                <input id="r4" type="radio" class="space2"  name="option" value="4">La Grande<br>
                <input id="r5" type="radio" class="space2"  name="option" value="5">T2<br>
                <input id="r6" type="radio" class="space2"  name="option" value="6">Premio Mayor<br>
                <input id="r7" type="radio" class="space2"  name="option" value="7">Pack Sorteo<br>
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