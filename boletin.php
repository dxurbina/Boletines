<?php 
    function conex(){
        try{      
        $con = new PDO('mysql:host=192.168.253.40;dbname=lotoni;charset=utf8mb4', 'remote-user', 'L0to2288!',
        array(PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES 'utf8' "));
        return $con;
        
        } catch (PDOException $e) {
            return null;
            
        }
    }
   
    setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
    $db = conex();
    date_default_timezone_set('America/Managua');

    $hoy = getdate();
    $fechaActual = date('Y-m-d');
    
    echo strftime("%d");
    echo strftime("%B");
    echo strftime("%Y");

    
    
    /** Boletín Diaria */
    $diaria = array();
    $consult = $db->prepare("select par1 from loto_sorteos where fecha = ? and juego = 1
    order by id;");
        $consult->execute(array($fechaActual)); 
            while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                $diaria = $row; 
            }
    /* Boletín Supercombo */
    $supercombo = array();
    $consult = $db->prepare("select par1, par2 from loto_sorteos where fecha = ? and juego = 2
    order by id;");
        $consult->execute(array($fechaActual)); 
            while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                $supercombo = $row; 
            }
    /* Boletín Jugá 3*/
    $juga3 = array();
    $consult = $db->prepare("select par1, par2, par3 from loto_sorteos where fecha = ? and juego = 9
    order by id;");
        $consult->execute(array($fechaActual)); 
            while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                $juga3 = $row; 
            }
    /* Boletín T2*/
    $t2 = array();
    $consult = $db->prepare("select par1 from loto_sorteos where fecha = ? and juego = 5
    order by id;");
        $consult->execute(array($fechaActual)); 
            while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
               $t2 = $row; 
            }
    /* Boletín La grande*/ 
    $lagrande = array();
    $consult = $db->prepare("select par1, par2, par3, par4, par5, par6 from loto_sorteos where fecha = ? and juego = 3
    order by id;");
        $consult->execute(array($fechaActual)); 
            while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                $lagrande = $row; 
            }   
            /*
            print_r($diaria);
           // print_r($supercombo[0]->par2);
            print_r('<br>');
            print_r($supercombo);
            print_r('<br>');
            print_r($juga3);
            print_r('<br>');
            print_r($t2);
            print_r('<br>');
            print_r($lagrande); */
            
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="boletin.css">
    <title>Boletín</title>
</head>
<body>
<a id="download" style="visibility:hidden">Tomar screenshot y descargar</a>
    <?php 
        if(isset($_REQUEST['option'])){
            if($_REQUEST['option'] == '1'){
                ?>
                <div id="position2">
                    <img id="img" src="img/img1.jpg" class="position-boletin" alt="img">
                    <div class="" style="position: absolute; margin-top: 38.7%; margin-left: 10.5%;"><h1 class="mifuente2" style=""><?php  ?> 88</h1></div> 
                    <div class="" style="position: absolute; margin-top: 38.7%; margin-left: 20.2%;"><h1 class="mifuente2" style=""><?php  ?>888</h1></div> 
                    <div class="" style="position: absolute; margin-top: 38.7%; margin-left: 28.5%;"><h1 class="mifuente2" style=""><?php  ?> 88</h1></div> 
                    <div class="" style="position: absolute; margin-top: 38.7%; margin-left: 33.8%;"><h1 class="mifuente2" style=""><?php  ?> 88</h1></div>    
                </div>
                <?php 
            }else if($_REQUEST['option'] == '2'){
                ?>
                <div id="position2">
                <img id="img" src="img/img2.jpg" class="position-boletin" alt="img">
                </div>
                <?php
            }else if($_REQUEST['option'] == 3){
                ?>
                <div id="position2">
                <img id="img" src="img/img3.jpg" class="position-boletin" alt="img">
                </div>
                <?php
            }else if($_REQUEST['option'] == 4){
                ?>
                <div id="position2">
                <img id="img" src="img/img4.jpg" class="position-boletin" alt="img">
                </div>
                <?php
            }else if($_REQUEST['option'] == 5){
                ?>
                <div id="position2">
                <img id="img" src="img/img5.jpg" class="position-boletin"alt="img">
                </div>
                <?php
            }
            else{
                echo 'Nada que mostrar';
            }
        }
    ?>
    
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
  <script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script>
  /*
	$(document).ready(function(){
		html2canvas($('#position2'), {
		onrendered (canvas) {
		    var link = document.getElementById('download');;
		    var image = canvas.toDataURL();
		    link.href = image;
		    link.download = 'screenshot.png';
		    link.click();
		}
		});
	})*/
		
    </script>
</html>

