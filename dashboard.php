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
                <input id="space" type="radio" name="option" value="one"> Uno<br>
                <input id="space" type="radio" name="option" value="Two"> dos<br>
                <input id="space" type="radio" name="option" value="Three">Tres <br>
                <input id="space" type="radio" name="option" value="Three">cuatro <br>
                <input id="space" type="radio" name="option" value="Three">cinco <br>
                <input id="submit" type="submit" value="Generar">
            </div>    
        </form>
    </div>
   

    <div id="position2">
        <img src="img.jpg" alt="img">
    </div>
</body>
<script src="dashboard.js" type="document/javascript"></script>
</html>