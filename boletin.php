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

    /*Para imprimir la fecha en formato d/m/y*/
    //$FechaHoy = date('d/m/y');
    $FechaHoy =  strftime("%d") . ' ' . 'de' . ' '. strftime("%B") . ' ' . 'del'. ' '. strftime("%Y");


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
            $juega3;
            $juega;
            /*print_r($diaria);
           // print_r($supercombo[0]->par2);
            print_r('<br>');
            print_r($supercombo);
            print_r('<br>');
            print_r($juga3);
            print_r('<br>');
            print_r($t2);
            print_r('<br>');
            print_r($lagrande);*/

        
            //array concatenado para jugá3 de las 2:00 pm;
            if(isset($juga3))
                {
                 if(isset($juga3[0]->par1)){
                    $array =  $juga3[0]->par1;          
                if(isset( $juga3[0]->par2)){
                    $array2 =  $juga3[0]->par2;
                if(isset($juga3[0]->par3)){
                    $array3 = $juga3[0]->par3;
                    $juega3 = $array . $array2 . $array3;
                }
            }
        }
    } 

            //array concatenado para jugá3 de las 9:00 pm;
            if(isset($juga3))
                {
                if(isset($juga3[1]->par1)){
                    $arreglo =  $juga3[1]->par1;          
                if(isset( $juga3[1]->par2)){
                    $arreglo2 =  $juga3[1]->par2;
                if(isset($juga3[1]->par3)){
                    $arreglo3 = $juga3[1]->par3;
                    $juega = $arreglo . $arreglo2 . $arreglo3;
                }
            }
        }
    }
            
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
                    <!-- Fecha -->
                        <div class="" style="position: absolute; margin-top: 3.7%; margin-left: 33.6%;"><h1 class="mifuente" style=""><?php print_r($FechaHoy) ?></h1></div>
                        
                        <div class="" style="position: absolute; margin-top: 91.0%; margin-left: 23.9%;"><h1 class="mifuente2" style=""><?php if(isset($diaria[0]->par1)){echo $diaria[0]->par1;} ?></h1></div>
                        <div class="" style="position: absolute; margin-top: 90.9%; margin-left: 45.5%;"><h1 class="mifuente2" style=""><?php if(isset($juega3)){echo $juega3;} ?></h1></div> 
                        <div class="" style="position: absolute; margin-top: 91.2%; margin-left: 64.2%;"><h1 class="mifuente2" style=""><?php if(isset($supercombo[0]->par1)){echo $supercombo[0]->par1;} ?></h1></div> 
                        <div class="" style="position: absolute; margin-top: 91.2%; margin-left: 76.0%;"><h1 class="mifuente2" style=""><?php if(isset($supercombo[0]->par2)){echo $supercombo[0]->par2;} ?></h1></div>  
                </div>
                <?php 
            }else if($_REQUEST['option'] == '2'){
                ?>
                <div id="position2">
                    <img id="img" src="img/img2.jpg" class="position-boletin" alt="img">
                    <!-- Fecha -->
                    <div class="" style="position: absolute; margin-top: 3.0%; margin-left:33.3%;"><h1 class="mifuente" style=""><?php print_r($FechaHoy) ?></h1></div>
                    
                        <!--Sorteo de las 2:00 pm -->
                        <div class="" style="position: absolute; margin-top: 70.5%; margin-left: 28.4%;"><h1 class="mifuente2" style=""><?php if(isset($diaria[0]->par1)){echo $diaria[0]->par1;} ?></h1></div>
                        <div class="" style="position: absolute; margin-top: 70.5%; margin-left: 45.6%;"><h1 class="mifuente2" style=""><?php if(isset($juega3)){echo $juega3;} ?></h1></div> 
                        <div class="" style="position: absolute; margin-top: 70.8%; margin-left: 60.9%;"><h1 class="mifuente2" style=""><?php if(isset($supercombo[0]->par1)){echo $supercombo[0]->par1;} ?></h1></div> 
                        <div class="" style="position: absolute; margin-top: 70.8%; margin-left: 70.4%;"><h1 class="mifuente2" style=""><?php if(isset($supercombo[0]->par2)){echo $supercombo[0]->par2;} ?></h1></div>
                
                        <!--Sorteo de las 9:00 pm -->
                        <div class="" style="position: absolute; margin-top: 102.5%; margin-left: 28.2%;"><h1 class="mifuente2" style=""><?php if(isset($diaria[1]->par1)){echo $diaria[1]->par1;} ?></h1></div>
                        <div class="" style="position: absolute; margin-top: 102.2%; margin-left: 45.5%;"><h1 class="mifuente2" style=""><?php if(isset($juega)){echo $juega;} ?></h1></div> 
                        <div class="" style="position: absolute; margin-top: 102.7%; margin-left: 60.9%;"><h1 class="mifuente2" style=""><?php if(isset($supercombo[1]->par1)){echo $supercombo[1]->par1;} ?></h1></div> 
                        <div class="" style="position: absolute; margin-top: 102.7%; margin-left: 70.4%;"><h1 class="mifuente2" style=""><?php if(isset($supercombo[1]->par2)){echo $supercombo[1]->par2;} ?></h1></div>

                </div>

                <?php
            }else if($_REQUEST['option'] == 3){
                ?>
                <div id="position2">
                    <img id="img" src="img/img3.jpg" class="position-boletin" alt="img">
                    <!-- Fecha -->
                    <div class="" style="position: absolute; margin-top: 3.9%; margin-left:32.3%;"><h1 class="mifuente" style=""><?php print_r($FechaHoy) ?></h1></div>

                        <!--Sorteo de las 2:00 pm -->
                        <div class="" style="position: absolute; margin-top: 83.5%; margin-left: 19.2%;"><h1 class="mifuente2" style=""><?php if(isset($diaria[0]->par1)){echo $diaria[0]->par1;}  ?></h1></div>
                        <div class="" style="position: absolute; margin-top: 83.5%; margin-left: 36.6%;"><h1 class="mifuente2" style=""><?php if(isset($juega3)){echo $juega3;}  ?></h1></div> 
                        <div class="" style="position: absolute; margin-top: 83.8%; margin-left: 52.2%;"><h1 class="mifuente2" style=""><?php if(isset($supercombo[0]->par1)){echo $supercombo[0]->par1;}  ?></h1></div> 
                        <div class="" style="position: absolute; margin-top: 83.8%; margin-left: 61.7%;"><h1 class="mifuente2" style=""><?php if(isset($supercombo[0]->par2)){echo $supercombo[0]->par2;}  ?></h1></div>
                        <div class="" style="position: absolute; margin-top: 101.1%; margin-left: 76.2%;"><h1 class="mifuente2" style=""><?php if(isset($t2[0]->par1)){echo $t2[0]->par1;}  ?></h1></div>
                       
                </div>
                <?php
            }else if($_REQUEST['option'] == 4){
                ?>
                <div id="position2">
                    <img id="img" src="img/img4.jpg" class="position-boletin" alt="img">
                    <!-- Fecha -->
                    <div class="" style="position: absolute; margin-top: 4.5%; margin-left:32.0%;"><h1 class="mifuente" style=""><?php print_r($FechaHoy) ?></h1></div>

                        <!--Sorteo de las 2:00 pm -->
                        <div class="" style="position: absolute; margin-top: 70.2%; margin-left: 18.7%;"><h1 class="lagrande" style=""><?php if(isset($diaria[0]->par1)){echo $diaria[0]->par1;} ?></h1></div>
                        <div class="" style="position: absolute; margin-top: 70.2%; margin-left: 36.3%;"><h1 class="lagrande" style=""><?php if(isset($juega3)){echo $juega3;} ?></h1></div> 
                        <div class="" style="position: absolute; margin-top: 70.6%; margin-left: 51.5%;"><h1 class="lagrande" style=""><?php if(isset($supercombo[0]->par1)){echo $supercombo[0]->par1;} ?></h1></div> 
                        <div class="" style="position: absolute; margin-top: 70.6%; margin-left: 61.1%;"><h1 class="lagrande" style=""><?php if(isset($supercombo[0]->par2)){echo $supercombo[0]->par2;} ?></h1></div>
                        <div class="" style="position: absolute; margin-top: 70.2%; margin-left: 75.9%;"><h1 class="lagrande" style=""><?php if(isset($t2[0]->par1)){echo $t2[0]->par1;}  ?>88</h1></div>
                        
                        <!--Sorteo de las 9:00 pm -->
                        <div class="" style="position: absolute; margin-top: 103.0%; margin-left: 28.5%;"><h1 class="lagrande" style=""><?php if(isset($diaria[1]->par1)){echo $diaria[1]->par1;}  ?></h1></div>
                        <div class="" style="position: absolute; margin-top: 103.0%; margin-left: 46.0%;"><h1 class="lagrande" style=""><?php if(isset($juega)){echo $juega;}  ?></h1></div> 
                        <div class="" style="position: absolute; margin-top: 103.5%; margin-left: 61.2%;"><h1 class="lagrande" style=""><?php if(isset($supercombo[1]->par1)){echo $supercombo[1]->par1;}  ?></h1></div> 
                        <div class="" style="position: absolute; margin-top: 103.5%; margin-left: 70.7%;"><h1 class="lagrande" style=""><?php if(isset($supercombo[1]->par2)){echo $supercombo[1]->par2;} ?></h1></div>
                    
            
                </div>
                <?php
            }else if($_REQUEST['option'] == 5){
                ?>
                <div id="position2">
                    <img id="img" src="img/img5.jpg" class="position-boletin"alt="img">
                    <!-- Fecha -->
                   <div class="" style="position: absolute; margin-top: 4.8%; margin-left:31.9%;"><h1 class="mifuente" style=""><?php print_r($FechaHoy) ?></h1></div>
                        
                        <!--Sorteo de las 2:00 pm -->
                        <div class="" style="position: absolute; margin-top: 78.2%; margin-left: 12.0%;"><h1 class="lagrandeT2" style=""><?php if(isset($diaria[0]->par1)){echo $diaria[0]->par1;} ?></h1></div>
                        <div class="" style="position: absolute; margin-top: 78.0%; margin-left: 24.1%;"><h1 class="lagrandeT2" style=""><?php if(isset($juega3)){echo $juega3;}  ?></h1></div> 
                        <div class="" style="position: absolute; margin-top: 78.3%; margin-left: 35.0%;"><h1 class="lagrandeT2" style=""><?php if(isset($supercombo[0]->par1)){echo $supercombo[0]->par1;}  ?></h1></div> 
                        <div class="" style="position: absolute; margin-top: 78.3%; margin-left: 41.7%;"><h1 class="lagrandeT2" style=""><?php if(isset($supercombo[0]->par2)){echo $supercombo[0]->par2;}  ?></h1></div>

                        <!--Sorteo de las 9:00 pm -->
                        <div class="" style="position: absolute; margin-top: 78.2%; margin-left: 57.3%;"><h1 class="lagrandeT2" style=""><?php if(isset($diaria[1]->par1)){echo $diaria[1]->par1;}  ?></h1></div>
                        <div class="" style="position: absolute; margin-top: 78.0%; margin-left: 69.5%;"><h1 class="lagrandeT2" style=""><?php if(isset($juega)){echo $juega;}  ?></h1></div> 
                        <div class="" style="position: absolute; margin-top: 78.3%; margin-left: 80.3%;"><h1 class="lagrandeT2" style=""><?php if(isset($supercombo[1]->par1)){echo $supercombo[1]->par1;}  ?></h1></div> 
                        <div class="" style="position: absolute; margin-top: 78.3%; margin-left: 87.0%;"><h1 class="lagrandeT2" style=""><?php if(isset($supercombo[1]->par2)){echo $supercombo[1]->par2;}  ?></h1></div>

                        <!--Sorteo la grande 9:00 pm-->
                        <div class="" style="position: absolute; margin-top: 98.5%; margin-left: 33.5%;"><h1 class="lagrandeT2" style=""><?php if(isset($lagrande[0]->par1)){echo $lagrande[0]->par1;} ?></h1></div>
                        <div class="" style="position: absolute; margin-top: 98.5%; margin-left: 42.9%;"><h1 class="lagrandeT2" style=""><?php if(isset($lagrande[0]->par2)){echo $lagrande[0]->par2;} ?></h1></div>
                        <div class="" style="position: absolute; margin-top: 98.5%; margin-left: 52.0%;"><h1 class="lagrandeT2" style=""><?php if(isset($lagrande[0]->par3)){echo $lagrande[0]->par3;} ?></h1></div> 
                        <div class="" style="position: absolute; margin-top: 98.5%; margin-left: 60.8%;"><h1 class="lagrandeT2" style=""><?php if(isset($lagrande[0]->par4)){echo $lagrande[0]->par4;} ?></h1></div> 
                        <div class="" style="position: absolute; margin-top: 98.5%; margin-left: 70.1%;"><h1 class="lagrandeT2" style=""><?php if(isset($lagrande[0]->par5)){echo $lagrande[0]->par5;} ?></h1></div>
                        <div class="" style="position: absolute; margin-top: 98.5%; margin-left: 80.0%;"><h1 class="lagrandeT2" style=""><?php if(isset($lagrande[0]->par6)){echo $lagrande[0]->par6;} ?></h1></div>
                        
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
  
/*	$(document).ready(function(){
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

