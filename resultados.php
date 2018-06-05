
    <?php 
        if(isset($_REQUEST['option'])){
            if($_REQUEST['option'] == '1'){
                ?>
                <?php
    date_default_timezone_set('America/Managua');
    $hoy = getdate();
    $fechai = date('Y-m-d');
    $fechaActual = date('Y-m-d');
    
    $fechaf = date('Y-m-d');
    $dateI = "";
    $dateE = "";
    $dateIComplete = '';
    $dateEComplete = '';
    
    function conex(){
        try{      
        $con = new PDO('mysql:host=192.168.253.40;dbname=lotoni;charset=utf8mb4', 'remote-user', 'L0to2288!',
        array(PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES 'utf8' "));
        return $con;
        } catch (PDOException $e) {
            return null;
        }
    }
    
    $db = conex();

    $sql = 'select fecha from loto_sorteos where fecha  = DATE_FORMAT(now(), "%Y-%m-%d")
    and juego = 1;';
    $result = $db->prepare($sql);
    $fechahoy = null;
	$result->execute();
        if($row = $result->fetch(PDO::FETCH_OBJ)){
            $fechahoy = $row->fecha;
        }
        
            

    if($hoy['weekday'] == 'Monday'){
        if($fechahoy == $fechaActual){
            $fechai = strtotime ( '0 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+6 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
        }else{
                $fechai = strtotime ( '-7 day' , strtotime ( $fechaActual ) ) ;
            $fechaf = strtotime ( '-1 day' , strtotime ( $fechaActual ) ) ;
            $dateI = date ( 'd' , $fechai );
            $dateE = date ( 'd' , $fechaf );
            $dateIComplete = date ( 'y-m-d' , $fechai );
            $dateEComplete = date ( 'y-m-d' , $fechaf );
        }
        
        
    }else if($hoy['weekday'] == 'Tuesday'){
        $fechai = strtotime ( '-1 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+5 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }else if($hoy['weekday'] == 'Wednesday'){
        $fechai = strtotime ( '-2 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+4 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
        //echo $dateI . $dateE ; 
    }else if($hoy['weekday'] == 'Thursday'){
        $fechai = strtotime ( '-3 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+3 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }else if($hoy['weekday'] == 'Friday'){
        $fechai = strtotime ( '-4 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+2 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }else if($hoy['weekday'] == 'Saturday'){
        $fechai = strtotime ( '-5 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+1 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }else if($hoy['weekday'] == 'Sunday'){
        $fechai = strtotime ( '-6 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '0 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }
    
	
    $resultSet = array();
    $consult = $db->prepare("select par1 from loto_sorteos where fecha between ? and ? and juego = 1
    order by id;");
        $consult->execute(array($dateIComplete, $dateEComplete)); 
            while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                $resulSet = $row; 
            } 
           // print_r( $resulSet);
           
            
?>

<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>

<style>
@font-face {
    font-family: "helvetica";
    src: url('font/HelveticaRounded-Bold.otf') format("truetype");
}
/*
body  {
    background-image: url("diaria.jpg");
    background-repeat:no-repeat;
-webkit-background-size:cover;
-moz-background-size:cover;
-o-background-size:cover;
background-size:cover;
/*background-position:center;*/
     /* Nos aseguramos que la imagen de fondo este centrada vertical y
    horizontalmente en todo momento */
  /*background-position: center center;*/
  /* La imagen de fondo no se repite */
  /*background-repeat: no-repeat;*/
  /* La imagen de fondo est� fija en el viewport, de modo que no se mueva cuando
     la altura del contenido supere la altura de la imagen. */
   /*background-attachment: fixed;*/
  /* La imagen de fondo se reescala cuando se cambia el ancho de ventana del navegador */
 /*background-size: cover;*/
  /* Fijamos un color de fondo para que se muestre mientras se est�
    cargando la imagen de fondo o si hay problemas para cargarla  */
  /*background-color: #464646;

  @media only screen and (max-width: 767px) {
  body {
    background-image: url(images/background-photo-mobile-devices.jpg);
  }
    }

} */

    .fullscreen{
	 position: absolute:
     
	}

    ._container{
        float: left;
        margin: 0 auto;
       
    }

    ._container_free{
        position: absolute;
        margin-top: 38%;
       
    }

    ._centrado{
        margin-left: 38%;
        margin-top: 0%;
    }

    ._espaciado{
        margin-left: 5%;
    }

    ._espaciado_numeros{
        margin-left: 20.7%;
    }

    .mifuente{
        font-weight: bold; font-size: 120px;
    }

    .mifuente2{
        font-weight: bold; font-size: 70px;
    }

    @media (max-width: 720px) {
        ._centrado{
        margin-left: 38%;
        margin-top: 3.5%;
    }
    }

    #position2{
   position: relative;
    /*margin-right: 250px;*/
   /* margin-right: 250px;*/
   /* margin-left: 60%;*/
  /* margin-top: -2%;*/
    height: 1080px;
    width: 1920px;
 }


    body{
        height: 1080px;
        width: 1920px;
    }
</style>
</head>
<body>
<div id="position2">
	<img src= 'img/diaria.jpg' style= 'position: absolute;' height="100%" width="100%"></img>
	<!-- <a id="download" style="visibility:hidden">Tomar screenshot y descargar</a> -->
    
                
                <div class="" style="position: absolute; margin-top: 5.5%; margin-left: 39.2%"><h1 class="mifuente" style=""><?php echo $dateI; ?> </h1></h1></div>
                <div class="" style="position: absolute; margin-top: 5.5%; margin-left: 51.2%"><h1 class="mifuente" style=""><?php echo $dateE; ?> </h1></div>
   


    <!-- Lunes -->
    <div class="" style="position: absolute; margin-top:31.3%; margin-left: 20.7%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[0]->par1)){echo $resulSet[0]->par1;} ?></h1></div>
    <div class="" style="position: absolute; margin-top: 37.8%; margin-left:20.7%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[1]->par1)){echo $resulSet[1]->par1;} ?></h1></div>

    <!-- Martes -->
    <div class="" style="position: absolute; margin-top: 31.3%; margin-left: 31.5%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[2]->par1)){echo $resulSet[2]->par1;} ?></h1></div>
    <div class="" style="position: absolute; margin-top: 37.8%; margin-left: 31.5%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[3]->par1)){echo $resulSet[3]->par1;} ?></h1></div>  

    <!-- Miercoles -->
    <div class="" style="position: absolute; margin-top: 31.3%; margin-left: 42.5%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[4]->par1)){echo $resulSet[4]->par1;} ?></h1></div>
    <div class="" style="position: absolute; margin-top: 37.8%; margin-left: 42.5%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[5]->par1)){echo $resulSet[5]->par1;} ?></h1></div>  

    <!-- Jueves -->
    <div class="" style="position: absolute; margin-top: 31.3%; margin-left: 53.1%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[6]->par1)){echo $resulSet[6]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 37.8%; margin-left: 53.1%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[7]->par1)){echo $resulSet[7]->par1;} ?> </h1></div>  

    <!-- Viernes -->
    <div class="" style="position: absolute; margin-top: 31.3%; margin-left: 63.9%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[8]->par1)){echo $resulSet[8]->par1;} ?></h1></div>
    <div class="" style="position: absolute; margin-top: 37.8%; margin-left: 63.9%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[9]->par1)){echo $resulSet[9]->par1;} ?></h1></div>  

    <!-- Sabado -->
    <div class="" style="position: absolute; margin-top: 31.3%; margin-left: 74.7%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[10]->par1)){echo $resulSet[10]->par1;} ?></h1></div>
    <div class="" style="position: absolute; margin-top: 37.8%; margin-left: 74.7%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[11]->par1)){echo $resulSet[11]->par1;} ?></h1></div>  

    <!-- Domingo -->
    <div class="" style="position: absolute; margin-top: 31.3%; margin-left: 85.5%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[12]->par1)){echo $resulSet[12]->par1;} ?></h1></div>
    <div class="" style="position: absolute; margin-top: 37.8%; margin-left: 85.5%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[13]->par1)){echo $resulSet[13]->par1;} ?></h1></div> 
</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
  <script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
     <script>
  
  $(document).ready(function(){
		/*html2canvas($('#position2'), {
		onrendered (canvas) {
		    var link = document.getElementById('download');;
		    var image = canvas.toDataURL();
		    link.href = image;
		    link.download = 'screenshot.png';
		    link.click();
		}
		});*/
        downloadCanvas('position2', 'imagen.jpeg');
	})

    function downloadCanvas(canvasId, filename) {
    // Obteniendo la etiqueta la cual se desea convertir en imagen
    var domElement = document.getElementById(canvasId);
 
    // Utilizando la función html2canvas para hacer la conversión
    html2canvas(domElement, {
        onrendered: function(domElementCanvas) {
            // Obteniendo el contexto del canvas ya generado
            var context = domElementCanvas.getContext('2d');
 
            // Creando enlace para descargar la imagen generada
            var link = document.createElement('a');
            link.href = domElementCanvas.toDataURL("image/jpeg");
            link.download = filename;
 
            // Chequeando para browsers más viejos
            if (document.createEvent) {
                var event = document.createEvent('MouseEvents');
                // Simulando clic para descargar
                event.initMouseEvent("click", true, true, window, 0,
                    0, 0, 0, 0,
                    false, false, false, false,
                    0, null);
                link.dispatchEvent(event);
            } else {
                // Simulando clic para descargar
                link.click();
            }
        }
    });
}
	
    </script>
</body> 
</html>

                <?php 
            }else if($_REQUEST['option'] == '2'){
                ?>
                <?php
    date_default_timezone_set('America/Managua');
    $hoy = getdate();
    $fechai = date('Y-m-d');
    $fechaActual = date('Y-m-d');
    $fechaf = date('Y-m-d');
    $dateI = "";
    $dateE = "";
    $dateIComplete = '';
    $dateEComplete = '';


    function conex(){
        try{      
        $con = new PDO('mysql:host=192.168.253.40;dbname=lotoni;charset=utf8mb4', 'remote-user', 'L0to2288!',
        array(PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES 'utf8' "));
        return $con;
        } catch (PDOException $e) {
            return null;
        }
    }
    
    $db = conex();
    $fechahoy = null;
    $sql = 'select fecha from loto_sorteos where fecha  = DATE_FORMAT(now(), "%Y-%m-%d")
    and juego = 2;';
    $result = $db->prepare($sql);
	$result->execute();
        if($row = $result->fetch(PDO::FETCH_OBJ)){
            $fechahoy = $row->fecha;
        }
        


        
    if($hoy['weekday'] == 'Monday'){
        if($fechahoy == $fechaActual){
        $fechai = strtotime ( '0 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+6 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
        }else{
                    
                $fechai = strtotime ( '-7 day' , strtotime ( $fechaActual ) ) ;
            $fechaf = strtotime ( '-1 day' , strtotime ( $fechaActual ) ) ;
            $dateI = date ( 'd' , $fechai );
            $dateE = date ( 'd' , $fechaf );
            $dateIComplete = date ( 'y-m-d' , $fechai );
            $dateEComplete = date ( 'y-m-d' , $fechaf );
        }
        
    }else if($hoy['weekday'] == 'Tuesday'){
        $fechai = strtotime ( '-1 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+5 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }else if($hoy['weekday'] == 'Wednesday'){
        $fechai = strtotime ( '-2 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+4 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
        //echo $dateI . $dateE ; 
    }else if($hoy['weekday'] == 'Thursday'){
        $fechai = strtotime ( '-3 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+3 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }else if($hoy['weekday'] == 'Friday'){
        $fechai = strtotime ( '-4 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+2 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }else if($hoy['weekday'] == 'Saturday'){
        $fechai = strtotime ( '-5 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+1 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }else if($hoy['weekday'] == 'Sunday'){
        $fechai = strtotime ( '-6 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '0 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }
    
	
    $resultSet = array();
    $consult = $db->prepare("select par1, par2 from loto_sorteos where fecha between ? and ? and juego = 2
    order by id;");
        $consult->execute(array($dateIComplete, $dateEComplete)); 
            while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                $resulSet = $row; 
            } 
           
            
?>

<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>

<style>
@font-face {
    font-family: "helvetica";
    src: url('font/HelveticaRounded-Bold.otf') format("truetype");
}

/*
body  {
    background-image: url("combo.jpg");
    background-repeat:no-repeat;
-webkit-background-size:cover;
-moz-background-size:cover;
-o-background-size:cover;
background-size:cover;
/*background-position:center;*/
     /* Nos aseguramos que la imagen de fondo este centrada vertical y
    horizontalmente en todo momento */
  /*background-position: center center;*/
  /* La imagen de fondo no se repite */
  /*background-repeat: no-repeat;*/
  /* La imagen de fondo est� fija en el viewport, de modo que no se mueva cuando
     la altura del contenido supere la altura de la imagen. */
   /*background-attachment: fixed;*/
  /* La imagen de fondo se reescala cuando se cambia el ancho de ventana del navegador */
 /*background-size: cover;*/
  /* Fijamos un color de fondo para que se muestre mientras se est�
    cargando la imagen de fondo o si hay problemas para cargarla  */
  /*background-color: #464646;

  @media only screen and (max-width: 767px) {
  body {
    background-image: url(images/background-photo-mobile-devices.jpg);
  }
    }

}*/

    

   

    .mifuente{
        font-weight: bold; font-size: 120px;
    }

    .mifuente2{
        font-weight: bold; font-size: 62px;
    }

    @media (max-width: 720px) {
        ._centrado{
        margin-left: 38%;
        margin-top: 4%;
        
    }
    }

    #position2{
   position: relative;
    /*margin-right: 250px;*/
   /* margin-right: 250px;*/
   /* margin-left: 60%;*/
  /* margin-top: -2%;*/
    height: 1080px;
    width: 1920px;
 }


    body{
        height: 1080px;
        width: 1920px;
    }
    .position{
       position: absolute;
       /* margin: 0 auto;
        margin-top: 0%;*/
        height: 1080px;
        width: 1920px;
    }

   #img { max-width: 100%; }
</style>
</head>
<body id="body">
<!--<button id="download" style="">Tomar screenshot y descargar</button>-->
<div id="position2">
    <img id="img" src= 'img/supercombo.jpg' class="position" alt="img"></img>
    <div class="" style="position: absolute; margin-top: 5.5%; margin-left: 39%;"><h1 class="mifuente" style=""><?php echo $dateI; ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 5.5%; margin-left: 50%;"><h1 class="mifuente" style=""><?php echo $dateE; ?> </h1></div>
    
    <!-- Lunes -->
    <div class="" style="position: absolute; margin-top: 30.5%; margin-left: 13%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[0]->par1)){echo $resulSet[0]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 30.5%; margin-left: 18.3%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[0]->par2)){echo $resulSet[0]->par2;} ?> </h1></div>
    
    <div class="" style="position: absolute; margin-top: 39.4%; margin-left: 13%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[1]->par1)){echo $resulSet[1]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 39.4%; margin-left: 18.3%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[1]->par2)){echo $resulSet[1]->par2;} ?> </h1></div>
    
    <!-- Martes -->
    <div class="" style="position: absolute; margin-top: 30.5%; margin-left: 24.3%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[2]->par1)){echo $resulSet[2]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 30.5%; margin-left: 29.8%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[2]->par2)){echo $resulSet[2]->par2;} ?> </h1></div>
    
    <div class="" style="position: absolute; margin-top: 39.4%; margin-left: 24.3%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[3]->par1)){echo $resulSet[3]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 39.4%; margin-left: 29.8%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[3]->par2)){echo $resulSet[3]->par2;} ?> </h1></div>
    
    <!-- Miercoles -->
    <div class="" style="position: absolute; margin-top: 30.5%; margin-left: 35.7%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[4]->par1)){echo $resulSet[4]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 30.5%; margin-left: 41.3%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[4]->par2)){echo $resulSet[4]->par2;} ?> </h1></div>
    
    <div class="" style="position: absolute; margin-top: 39.4%; margin-left: 35.7%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[5]->par1)){echo $resulSet[5]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 39.4%; margin-left: 41.3%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[5]->par2)){echo $resulSet[5]->par2;} ?> </h1></div>
    
    <!-- Jueves -->
    <div class="" style="position: absolute; margin-top: 30.5%; margin-left: 47.3%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[6]->par1)){echo $resulSet[6]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 30.5%; margin-left: 52.8%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[6]->par2)){echo $resulSet[6]->par2;} ?> </h1></div>
    
    <div class="" style="position: absolute; margin-top: 39.4%; margin-left: 47.3%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[7]->par1)){echo $resulSet[7]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 39.4%; margin-left: 52.8%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[7]->par2)){echo $resulSet[7]->par2;} ?> </h1></div>
    
    <!-- Viernes -->
    <div class="" style="position: absolute; margin-top: 30.5%; margin-left: 58.8%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[8]->par1)){echo $resulSet[8]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 30.5%; margin-left: 64.3%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[8]->par2)){echo $resulSet[8]->par2;} ?> </h1></div>
    
    <div class="" style="position: absolute; margin-top: 39.4%; margin-left: 58.8%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[9]->par1)){echo $resulSet[9]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 39.4%; margin-left: 64.3%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[9]->par2)){echo $resulSet[9]->par2;} ?> </h1></div>
    
    <!-- Sabado -->
    <div class="" style="position: absolute; margin-top: 30.5%; margin-left: 70.3%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[10]->par1)){echo $resulSet[10]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 30.5%; margin-left: 75.8%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[10]->par2)){echo $resulSet[10]->par2;} ?> </h1></div>
    
    <div class="" style="position: absolute; margin-top: 39.4%; margin-left: 70.3%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[11]->par1)){echo $resulSet[11]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 39.4%; margin-left: 75.8%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[11]->par2)){echo $resulSet[11]->par2;} ?> </h1></div>
    
    <!-- Domingo -->
    <div class="" style="position: absolute; margin-top: 30.5%; margin-left: 81.8%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[12]->par1)){echo $resulSet[12]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 30.5%; margin-left: 87.4%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[12]->par2)){echo $resulSet[12]->par2;} ?> </h1></div>
    
    <div class="" style="position: absolute; margin-top: 39.4%; margin-left: 81.8%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[13]->par1)){echo $resulSet[13]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 39.4%; margin-left: 87.3%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[13]->par2)){echo $resulSet[13]->par2;} ?> </h1></div>
</div>

   
</body> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
  
   <script>
  
  $(document).ready(function(){
		/*html2canvas($('#position2'), {
		onrendered (canvas) {
		    var link = document.getElementById('download');;
		    var image = canvas.toDataURL();
		    link.href = image;
		    link.download = 'screenshot.png';
		    link.click();
		}
		});*/
        downloadCanvas('position2', 'imagen.jpeg');
	})

    function downloadCanvas(canvasId, filename) {
    // Obteniendo la etiqueta la cual se desea convertir en imagen
    var domElement = document.getElementById(canvasId);
 
    // Utilizando la función html2canvas para hacer la conversión
    html2canvas(domElement, {
        onrendered: function(domElementCanvas) {
            // Obteniendo el contexto del canvas ya generado
            var context = domElementCanvas.getContext('2d');
 
            // Creando enlace para descargar la imagen generada
            var link = document.createElement('a');
            link.href = domElementCanvas.toDataURL("image/jpeg");
            link.download = filename;
 
            // Chequeando para browsers más viejos
            if (document.createEvent) {
                var event = document.createEvent('MouseEvents');
                // Simulando clic para descargar
                event.initMouseEvent("click", true, true, window, 0,
                    0, 0, 0, 0,
                    false, false, false, false,
                    0, null);
                link.dispatchEvent(event);
            } else {
                // Simulando clic para descargar
                link.click();
            }
        }
    });
}
 
// Haciendo la conversión y descarga de la imagen al presionar el botón
$('#download').click(function() {
    downloadCanvas('position2', 'imagen.jpeg');
});
		
    </script> 
</html>
                
                <?php
            }else if($_REQUEST['option'] == 3){
                ?>
                <?php
    date_default_timezone_set('America/Managua');
    $hoy = getdate();
    $fechai = date('Y-m-d');
    $fechaActual = date('Y-m-d');
    $fechaf = date('Y-m-d');
    $dateI = "";
    $dateE = "";
    $dateIComplete = '';
    $dateEComplete = '';
    
    function conex(){
        try{      
        $con = new PDO('mysql:host=192.168.253.40;dbname=lotoni;charset=utf8mb4', 'remote-user', 'L0to2288!',
        array(PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES 'utf8' "));
        return $con;
        } catch (PDOException $e) {
            return null;
        }
    }
    
    $db = conex();
    $fechahoy = null;
    $sql = 'select fecha from loto_sorteos where fecha  = DATE_FORMAT(now(), "%Y-%m-%d")
    and juego = 2;';
    $result = $db->prepare($sql);
	$result->execute();
        if($row = $result->fetch(PDO::FETCH_OBJ)){
            $fechahoy = $row->fecha;
        }

    if($hoy['weekday'] == 'Monday'){
        if($fechahoy == $fechaActual){
        $fechai = strtotime ( '0 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+6 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
        }else{
                
            $fechai = strtotime ( '-7 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '-1 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }

        
    }else if($hoy['weekday'] == 'Tuesday'){
        $fechai = strtotime ( '-1 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+5 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }else if($hoy['weekday'] == 'Wednesday'){
        $fechai = strtotime ( '-2 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+4 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
        //echo $dateI . $dateE ; 
    }else if($hoy['weekday'] == 'Thursday'){
        $fechai = strtotime ( '-3 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+3 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }else if($hoy['weekday'] == 'Friday'){
        $fechai = strtotime ( '-4 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+2 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }else if($hoy['weekday'] == 'Saturday'){
        $fechai = strtotime ( '-5 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+1 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }else if($hoy['weekday'] == 'Sunday'){
        $fechai = strtotime ( '-6 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '0 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }
    
	
    $resultSet = array();
    $consult = $db->prepare("select par1, par2, par3 from loto_sorteos where fecha between ? and ? and juego = 9
    order by id;");
        $consult->execute(array($dateIComplete, $dateEComplete)); 
            while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                $resulSet = $row; 
            } 
           
            
?>

<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>

<style>
@font-face {
    font-family: "helvetica";
    src: url('font/HelveticaRounded-Bold.otf') format("truetype");
}
/*
body  {
    background-image: url("juga3.jpg");
    background-repeat:no-repeat;
-webkit-background-size:cover;
-moz-background-size:cover;
-o-background-size:cover;
background-size:cover;
/*background-position:center;*/
     /* Nos aseguramos que la imagen de fondo este centrada vertical y
    horizontalmente en todo momento */
  /*background-position: center center;*/
  /* La imagen de fondo no se repite */
  /*background-repeat: no-repeat;*/
  /* La imagen de fondo est� fija en el viewport, de modo que no se mueva cuando
     la altura del contenido supere la altura de la imagen. */
   /*background-attachment: fixed;*/
  /* La imagen de fondo se reescala cuando se cambia el ancho de ventana del navegador */
 /*background-size: cover;*/
  /* Fijamos un color de fondo para que se muestre mientras se est�
    cargando la imagen de fondo o si hay problemas para cargarla  */
 /* background-color: #464646;

  @media only screen and (max-width: 767px) {
  body {
    background-image: url(images/background-photo-mobile-devices.jpg);
  }
    }

}*/

    ._container{
        float: left;
        margin: 0 auto;
       
    }

    ._container_free{
        position: absolute;
        margin-top: 32%;
       
    }

    ._centrado{
        margin-left: 31%;
        margin-top: 11%;
    }

    ._espaciado{
        margin-left: 2%;
    }

    ._espaciado_numeros{
        margin-left: 20.7%;
    }

    .mifuente{
        font-weight: bold; font-size: 120px;
    }

    .mifuente2{
        font-weight: bold; font-size: 80px;
    }

    @media (max-width: 720px) {
        ._centrado{
        margin-left: 31%;
        margin-top: 10%;
        
    }
    }
    #position2{
   position: relative;
    /*margin-right: 250px;*/
   /* margin-right: 250px;*/
   /* margin-left: 60%;*/
  /* margin-top: -2%;*/
    height: 1080px;
    width: 1920px;
 }


    body{
        height: 1080px;
        width: 1920px;
    }
</style>
</head>
<body>
    
	<!--<a id="download" style="visibility:hidden">Tomar screenshot y descargar</a>-->
    
                
<div id="position2">
    <img src= 'img/juga3.jpg' style= 'position: absolute;' height="100%" width="100%"></img>
    <div class="" style="position: absolute; margin-top: 11.5%; margin-left: 31.5%;"><h1 class="mifuente" style=""><?php echo $dateI; ?> </h1></div>
                <div class="" style="position: absolute; margin-top: 11.5%; margin-left: 42.5%;"><h1 class="mifuente" style=""><?php echo $dateE; ?> </h1></div>
    
    <!-- Lunes -->
    <div class="" style="position: absolute; margin-top: 29%; margin-left: 7.2%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[0]->par1)){ echo $resulSet[0]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 29%; margin-left: 11.4%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[0]->par2)){ echo $resulSet[0]->par2;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 29%; margin-left: 15.1%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[0]->par3)){ echo $resulSet[0]->par3;} ?> </h1></div>

    <div class="" style="position: absolute; margin-top: 39.5%; margin-left: 7.2%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[1]->par1)){ echo $resulSet[1]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 39.5%; margin-left: 11.4%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[1]->par2)){ echo $resulSet[1]->par2;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 39.5%; margin-left: 15.1%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[1]->par3)){ echo $resulSet[1]->par3;}; ?> </h1></div>

    <!-- Martes -->
    <div class="" style="position: absolute; margin-top: 29%; margin-left: 20.3%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[2]->par1)){ echo $resulSet[2]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 29%; margin-left: 24.4%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[2]->par2)){ echo $resulSet[2]->par2;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 29%; margin-left: 28.4%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[2]->par3)){ echo $resulSet[2]->par3;} ?> </h1></div>

    <div class="" style="position: absolute; margin-top: 39.5%; margin-left: 20.3%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[3]->par1)){ echo $resulSet[3]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 39.5%; margin-left: 24.4%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[3]->par2)){ echo $resulSet[3]->par2;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 39.5%; margin-left: 28.4%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[3]->par3)){ echo $resulSet[3]->par3;} ?> </h1></div>

    <!-- Miercoles -->
    <div class="" style="position: absolute; margin-top: 29%; margin-left: 33%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[4]->par1)){ echo $resulSet[4]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 29%; margin-left: 37.2%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[4]->par2)){ echo $resulSet[4]->par2;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 29%; margin-left: 41.1%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[4]->par3)){ echo $resulSet[4]->par3;} ?> </h1></div>

    <div class="" style="position: absolute; margin-top: 39.5%; margin-left: 33%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[5]->par1)){ echo $resulSet[5]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 39.5%; margin-left: 37.2%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[5]->par2)){ echo $resulSet[5]->par2;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 39.5%; margin-left: 41.1%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[5]->par3)){ echo $resulSet[5]->par3;} ?> </h1></div>

    <!-- Jueves -->
    <div class="" style="position: absolute; margin-top: 29%; margin-left: 46.2%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[6]->par1)){ echo $resulSet[6]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 29%; margin-left: 50.4%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[6]->par2)){ echo $resulSet[6]->par2;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 29%; margin-left: 54.1%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[6]->par3)){ echo $resulSet[6]->par3;} ?> </h1></div>

    <div class="" style="position: absolute; margin-top: 39.5%; margin-left: 46.2%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[7]->par1)){ echo $resulSet[7]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 39.5%; margin-left: 50.4%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[7]->par2)){ echo $resulSet[7]->par2;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 39.5%; margin-left: 54.1%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[7]->par3)){ echo $resulSet[7]->par3;} ?> </h1></div>

    <!-- Viernes -->
    <div class="" style="position: absolute; margin-top: 29%; margin-left: 59.2%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[8]->par1)){ echo $resulSet[8]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 29%; margin-left: 63.4%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[8]->par2)){ echo $resulSet[8]->par2;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 29%; margin-left: 67.1%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[8]->par3)){ echo $resulSet[8]->par3;} ?> </h1></div>

    <div class="" style="position: absolute; margin-top: 39.5%; margin-left: 59.2%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[9]->par1)){ echo $resulSet[9]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 39.5%; margin-left: 63.4%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[9]->par2)){ echo $resulSet[9]->par2;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 39.5%; margin-left: 67.1%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[9]->par3)){ echo $resulSet[9]->par3;} ?> </h1></div>

    <!-- Sabado -->
    <div class="" style="position: absolute; margin-top: 29%; margin-left: 72.2%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[10]->par1)){ echo $resulSet[10]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 29%; margin-left: 76.4%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[10]->par2)){ echo $resulSet[10]->par2;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 29%; margin-left: 80.1%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[10]->par3)){ echo $resulSet[10]->par3;} ?> </h1></div>

    <div class="" style="position: absolute; margin-top: 39.5%; margin-left: 72.2%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[11]->par1)){ echo $resulSet[11]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 39.5%; margin-left: 76.4%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[11]->par2)){ echo $resulSet[11]->par2;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 39.5%; margin-left: 80.1%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[11]->par3)){ echo $resulSet[11]->par3;} ?> </h1></div>

    <!-- Domingo -->
    <div class="" style="position: absolute; margin-top: 29%; margin-left: 85.2%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[12]->par1)){ echo $resulSet[12]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 29%; margin-left: 89.4%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[12]->par2)){ echo $resulSet[12]->par2;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 29%; margin-left: 93.1%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[12]->par3)){ echo $resulSet[12]->par3;} ?> </h1></div>

    <div class="" style="position: absolute; margin-top: 39.5%; margin-left: 85.2%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[12]->par1)){ echo $resulSet[13]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 39.5%; margin-left: 89.4%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[12]->par2)){ echo $resulSet[13]->par2;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 39.5%; margin-left: 93.1%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[13]->par3)){ echo $resulSet[13]->par3;} ?> </h1></div>
</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
  
    <script>
       $(document).ready(function(){
		/*html2canvas($('#position2'), {
		onrendered (canvas) {
		    var link = document.getElementById('download');;
		    var image = canvas.toDataURL();
		    link.href = image;
		    link.download = 'screenshot.png';
		    link.click();
		}
		});*/
        downloadCanvas('position2', 'imagen.jpeg');
	})

    function downloadCanvas(canvasId, filename) {
    // Obteniendo la etiqueta la cual se desea convertir en imagen
    var domElement = document.getElementById(canvasId);
 
    // Utilizando la función html2canvas para hacer la conversión
    html2canvas(domElement, {
        onrendered: function(domElementCanvas) {
            // Obteniendo el contexto del canvas ya generado
            var context = domElementCanvas.getContext('2d');
 
            // Creando enlace para descargar la imagen generada
            var link = document.createElement('a');
            link.href = domElementCanvas.toDataURL("image/jpeg");
            link.download = filename;
 
            // Chequeando para browsers más viejos
            if (document.createEvent) {
                var event = document.createEvent('MouseEvents');
                // Simulando clic para descargar
                event.initMouseEvent("click", true, true, window, 0,
                    0, 0, 0, 0,
                    false, false, false, false,
                    0, null);
                link.dispatchEvent(event);
            } else {
                // Simulando clic para descargar
                link.click();
            }
        }
    });
}
    </script> 
</body> 
</html>
                <?php
            }else if($_REQUEST['option'] == 4){
                ?>
                <?php
    date_default_timezone_set('America/Managua');
    $hoy = getdate();
    $fechai = date('Y-m-d');
    $fechaActual = date('Y-m-d');
    $fechaf = date('Y-m-d');
    $dateI = "";
    $dateE = "";
    $dateIComplete = '';
    $dateEComplete = '';
    function conex(){
        try{      
        $con = new PDO('mysql:host=192.168.253.40;dbname=lotoni;charset=utf8mb4', 'remote-user', 'L0to2288!',
        array(PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES 'utf8' "));
        return $con;
        } catch (PDOException $e) {
            return null;
        }
    }
    
    $db = conex();

    $sql = 'select fecha from loto_sorteos where fecha  = DATE_FORMAT(now(), "%Y-%m-%d")
    and juego = 3;';
    $result = $db->prepare($sql);
	$result->execute();
        if($row = $result->fetch(PDO::FETCH_OBJ)){
            $fechahoy = $row->fecha;
        }
        
    if($hoy['weekday'] == 'Monday'){
        
        $fechai = strtotime ( '-7 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '-1 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
        

        
    }else if($hoy['weekday'] == 'Tuesday'){
        $fechai = strtotime ( '-8 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '-2 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }else if($hoy['weekday'] == 'Wednesday'){
        $fechai = strtotime ( '-9 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '-3 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
        //echo $dateI . $dateE ; 
    }else if($hoy['weekday'] == 'Thursday'){
        if($fechahoy == $fechaActual){
        $fechai = strtotime ( '-3 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+3 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
        }else{
            $fechai = strtotime ( '-10 day' , strtotime ( $fechaActual ) ) ;
            $fechaf = strtotime ( '-4 day' , strtotime ( $fechaActual ) ) ;
            $dateI = date ( 'd' , $fechai );
            $dateE = date ( 'd' , $fechaf );
            $dateIComplete = date ( 'y-m-d' , $fechai );
            $dateEComplete = date ( 'y-m-d' , $fechaf );
        }
    }else if($hoy['weekday'] == 'Friday'){
        $fechai = strtotime ( '-4 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+2 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }else if($hoy['weekday'] == 'Saturday'){
        $fechai = strtotime ( '-5 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+1 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }else if($hoy['weekday'] == 'Sunday'){
        $fechai = strtotime ( '-6 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '0 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }
    
	
    $resultSet = array();
    $consult = $db->prepare("select par1, par2, par3, par4, par5, par6 from loto_sorteos where fecha between ? and ? and juego = 3
    order by id;");
        $consult->execute(array($dateIComplete, $dateEComplete)); 
            while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                $resulSet = $row; 
            } 
           
            
?>

<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>

<style>

@font-face {
    font-family: "helvetica";
    src: url('font/HelveticaRounded-Bold.otf') format("truetype");
}
/*
body  {
    background-image: url("big.jpg");
    background-repeat:no-repeat;
-webkit-background-size:cover;
-moz-background-size:cover;
-o-background-size:cover;
background-size:cover;
/*background-position:center;*/
     /* Nos aseguramos que la imagen de fondo este centrada vertical y
    horizontalmente en todo momento */
  /*background-position: center center;*/
  /* La imagen de fondo no se repite */
  /*background-repeat: no-repeat;*/
  /* La imagen de fondo est� fija en el viewport, de modo que no se mueva cuando
     la altura del contenido supere la altura de la imagen. */
   /*background-attachment: fixed;*/
  /* La imagen de fondo se reescala cuando se cambia el ancho de ventana del navegador */
 /*background-size: cover;*/
  /* Fijamos un color de fondo para que se muestre mientras se est�
    cargando la imagen de fondo o si hay problemas para cargarla  */
 /* background-color: #464646;

  @media only screen and (max-width: 767px) {
  body {
    background-image: url(images/background-photo-mobile-devices.jpg);
  }
    }

}*/

    ._container{
        float: left;
        margin: 0 auto;
       
    }

    ._container_free{
        position: absolute;
        margin-top: 32%;
       
    }

    ._centrado{
        margin-left: 39.4%;
        margin-top: 5%;
    }

    ._espaciado{
        margin-left: 6%;
    }

    ._espaciado_numeros{
        margin-left: 20.7%;
    }

    .mifuente{
        font-weight: bold; font-size: 140px;
    }

    .mifuente2{
        font-weight: bold; font-size: 90px;
    }

    @media (max-width: 720px) {
        ._centrado{
        margin-left: 39.4%;
        margin-top: 3.5%;
        
    }
    }

    #position2{
   position: relative;
    /*margin-right: 250px;*/
   /* margin-right: 250px;*/
   /* margin-left: 60%;*/
  /* margin-top: -2%;*/
    height: 1080px;
    width: 1920px;
 }


    body{
        height: 1080px;
        width: 1920px;
    }

</style>
</head>
<body>

<div id="position2">
    <img src= 'img/lagrande.jpg' style= 'position: absolute;' height="100%" width="100%"></img>
	<!-- <a id="download" style="visibility:hidden">Tomar screenshot y descargar</a> -->
    
                <div class="" style="position: absolute; margin-top: 4.7%; margin-left: 39%;"><h1 class="mifuente" style=""><?php echo $dateI; ?> </h1></div>
                <div class="" style="position: absolute; margin-top: 4.7%; margin-left: 50.5%;"><h1 class="mifuente" style=""><?php echo $dateE; ?> </h1></div>
    
    <!-- Jueves -->
    <?php 
    if(isset($resulSet[0])){
    ?> 
    <div class="" style="position: absolute; margin-top: 21.3%; margin-left: 39.4%;"><h1 class="mifuente2" style=""><?php echo $resulSet[0]->par1; ?></h1></div>
    <div class="" style="position: absolute; margin-top: 21.3%; margin-left: 46.7%;"><h1 class="mifuente2" style=""><?php echo $resulSet[0]->par2; ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 21.3%; margin-left: 54%;"><h1 class="mifuente2" style=""><?php echo $resulSet[0]->par3; ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 21.3%; margin-left: 61.5%;"><h1 class="mifuente2" style=""><?php echo $resulSet[0]->par4; ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 21.3%; margin-left: 68.6%;"><h1 class="mifuente2" style=""><?php echo $resulSet[0]->par5; ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 21.3%; margin-left: 77.2%;"><h1 class="mifuente2" style=""><?php echo $resulSet[0]->par6; ?> </h1></div>
    <?php 
    }
    if(isset($resulSet[1])){
    ?>
    <!-- Sabado -->
    <div class="" style="position: absolute; margin-top: 35.5%; margin-left: 39.2%;"><h1 class="mifuente2" style=""><?php echo $resulSet[1]->par1; ?></h1></div>
    <div class="" style="position: absolute; margin-top: 35.5%; margin-left: 46.5%;"><h1 class="mifuente2" style=""><?php echo $resulSet[1]->par2; ?></h1></div>
    <div class="" style="position: absolute; margin-top: 35.5%; margin-left: 54%;"><h1 class="mifuente2" style=""><?php echo $resulSet[1]->par3; ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 35.5%; margin-left: 61.5%;"><h1 class="mifuente2" style=""><?php echo $resulSet[1]->par4; ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 35.5%; margin-left: 68.6%;"><h1 class="mifuente2" style=""><?php echo $resulSet[1]->par5; ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 35.5%; margin-left: 77.2%;"><h1 class="mifuente2" style=""><?php echo $resulSet[1]->par6; ?> </h1></div>
    <?php }
    ?>
</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
  
    <script>
       $(document).ready(function(){
		/*html2canvas($('#position2'), {
		onrendered (canvas) {
		    var link = document.getElementById('download');;
		    var image = canvas.toDataURL();
		    link.href = image;
		    link.download = 'screenshot.png';
		    link.click();
		}
		});*/
        downloadCanvas('position2', 'imagen.jpeg');
	})

    function downloadCanvas(canvasId, filename) {
    // Obteniendo la etiqueta la cual se desea convertir en imagen
    var domElement = document.getElementById(canvasId);
 
    // Utilizando la función html2canvas para hacer la conversión
    html2canvas(domElement, {
        onrendered: function(domElementCanvas) {
            // Obteniendo el contexto del canvas ya generado
            var context = domElementCanvas.getContext('2d');
 
            // Creando enlace para descargar la imagen generada
            var link = document.createElement('a');
            link.href = domElementCanvas.toDataURL("image/jpeg");
            link.download = filename;
 
            // Chequeando para browsers más viejos
            if (document.createEvent) {
                var event = document.createEvent('MouseEvents');
                // Simulando clic para descargar
                event.initMouseEvent("click", true, true, window, 0,
                    0, 0, 0, 0,
                    false, false, false, false,
                    0, null);
                link.dispatchEvent(event);
            } else {
                // Simulando clic para descargar
                link.click();
            }
        }
    });
}
    </script>
</body> 
    
</html>
                <?php
            }else if($_REQUEST['option'] == 5){
                ?>
                <?php
    date_default_timezone_set('America/Managua');
    $hoy = getdate();
    $fechai = date('Y-m-d');
    $fechaActual = date('Y-m-d');
    $fechaf = date('Y-m-d');
    $dateI = "";
    $dateE = "";
    $dateIComplete = '';
    $dateEComplete = '';
    function conex(){
        try{      
        $con = new PDO('mysql:host=192.168.253.40;dbname=lotoni;charset=utf8mb4', 'remote-user', 'L0to2288!',
        array(PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES 'utf8' "));
        return $con;
        } catch (PDOException $e) {
            return null;
        }
    }
    
    $db = conex();

    $sql = 'select fecha from loto_sorteos where fecha  = DATE_FORMAT(now(), "%Y-%m-%d")
    and juego = 5;';
    $result = $db->prepare($sql);
    $fechahoy = null;
	$result->execute();
        if($row = $result->fetch(PDO::FETCH_OBJ)){
            $fechahoy = $row->fecha;
        }

    if($hoy['weekday'] == 'Monday'){
        $fechai = strtotime ( '-7 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '-1 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }else if($hoy['weekday'] == 'Tuesday'){
        if($fechahoy == $fechaActual){
        $fechai = strtotime ( '-1 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+5 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
        echo 'entra';
        }else{
            $fechai = strtotime ( '-8 day' , strtotime ( $fechaActual ) ) ;
            $fechaf = strtotime ( '-2 day' , strtotime ( $fechaActual ) ) ;
            $dateI = date ( 'd' , $fechai );
            $dateE = date ( 'd' , $fechaf );
            $dateIComplete = date ( 'y-m-d' , $fechai );
            $dateEComplete = date ( 'y-m-d' , $fechaf );
        }
    }else if($hoy['weekday'] == 'Wednesday'){
        $fechai = strtotime ( '-2 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+4 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
        //echo $dateI . $dateE ; 
    }else if($hoy['weekday'] == 'Thursday'){
        $fechai = strtotime ( '-3 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+3 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }else if($hoy['weekday'] == 'Friday'){
        $fechai = strtotime ( '-4 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+2 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }else if($hoy['weekday'] == 'Saturday'){
        $fechai = strtotime ( '-5 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+1 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }else if($hoy['weekday'] == 'Sunday'){
        $fechai = strtotime ( '-6 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '0 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }
    
	
    $resultSet = array();
    $consult = $db->prepare("select par1 from loto_sorteos where fecha between ? and ? and juego = 5
    order by id;");
        $consult->execute(array($dateIComplete, $dateEComplete)); 
            while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                $resulSet = $row; 
            } 
           
            
?>

<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>

<style>

@font-face {
    font-family: "helvetica";
    src: url('font/HelveticaRounded-Bold.otf') format("truetype");
}
/*
body  {
    background-image: url("end2.jpg");
    background-repeat:no-repeat;
-webkit-background-size:cover;
-moz-background-size:cover;
-o-background-size:cover;
background-size:cover;
/*background-position:center;*/
     /* Nos aseguramos que la imagen de fondo este centrada vertical y
    horizontalmente en todo momento */
  /*background-position: center center;*/
  /* La imagen de fondo no se repite */
  /*background-repeat: no-repeat;*/
  /* La imagen de fondo est� fija en el viewport, de modo que no se mueva cuando
     la altura del contenido supere la altura de la imagen. */
   /*background-attachment: fixed;*/
  /* La imagen de fondo se reescala cuando se cambia el ancho de ventana del navegador */
 /*background-size: cover;*/
  /* Fijamos un color de fondo para que se muestre mientras se est�
    cargando la imagen de fondo o si hay problemas para cargarla  */
  /*background-color: #464646;

  @media only screen and (max-width: 767px) {
  body {
    background-image: url(images/background-photo-mobile-devices.jpg);
  }
    }

}*/

    ._container{
        float: left;
        margin: 0 auto;
       
    }

    ._container_free{
        position: absolute;
        margin-top: 32%;
       
    }

    ._centrado{
        margin-left: 36.8%;
        margin-top: 6%;
    }

    ._espaciado{
        margin-left: 4.2%;
    }

    ._espaciado_numeros{
        margin-left: 20.7%;
    }

    .mifuente{
        font-weight: bold; font-size: 140px;
    }

    .mifuente2{
        font-weight: bold; font-size: 220px;
    }

    @media (max-width: 720px) {
        ._centrado{
        margin-left: 36.8%;
        margin-top: 4%;
    }
    }

    #position2{
   position: relative;
    /*margin-right: 250px;*/
   /* margin-right: 250px;*/
   /* margin-left: 60%;*/
  /* margin-top: -2%;*/
    height: 1080px;
    width: 1920px;
 }


    body{
        height: 1080px;
        width: 1920px;
    }
</style>
</head>
<body>
<div id="position2">
<img src= 'img/t2.jpg' style= 'position: absolute;' height="100%" width="100%"></img>
	<a id="download" style="visibility:hidden">Tomar screenshot y descargar</a>
    
                <div class="" style="position: absolute; margin-top: 4.2%; margin-left: 37%;"><h1 class="mifuente" style=""><?php echo $dateI; ?> </h1></div>
                <div class="" style="position: absolute; margin-top: 4.2%; margin-left: 49%;"><h1 class="mifuente" style=""><?php echo $dateE; ?> </h1></div>
    
    <!-- Martes -->
    <div class="" style="position: absolute; margin-top: 30%; margin-left: 35%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[0]->par1)){ echo $resulSet[0]->par1;} ?> </h1></div>
</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
  
   <script>
  
  $(document).ready(function(){
		/*html2canvas($('#position2'), {
		onrendered (canvas) {
		    var link = document.getElementById('download');;
		    var image = canvas.toDataURL();
		    link.href = image;
		    link.download = 'screenshot.png';
		    link.click();
		}
		});*/
        downloadCanvas('position2', 'imagen.jpeg');
	})

    function downloadCanvas(canvasId, filename) {
    // Obteniendo la etiqueta la cual se desea convertir en imagen
    var domElement = document.getElementById(canvasId);
 
    // Utilizando la función html2canvas para hacer la conversión
    html2canvas(domElement, {
        onrendered: function(domElementCanvas) {
            // Obteniendo el contexto del canvas ya generado
            var context = domElementCanvas.getContext('2d');
 
            // Creando enlace para descargar la imagen generada
            var link = document.createElement('a');
            link.href = domElementCanvas.toDataURL("image/jpeg");
            link.download = filename;
 
            // Chequeando para browsers más viejos
            if (document.createEvent) {
                var event = document.createEvent('MouseEvents');
                // Simulando clic para descargar
                event.initMouseEvent("click", true, true, window, 0,
                    0, 0, 0, 0,
                    false, false, false, false,
                    0, null);
                link.dispatchEvent(event);
            } else {
                // Simulando clic para descargar
                link.click();
            }
        }
    });
}
		
    </script>
</body> 
</html>
                <?php
            }
            else if($_REQUEST['option'] == 6){
                ?>
                <?php
    date_default_timezone_set('America/Managua');
    // Unix
    setlocale(LC_ALL,"es_ES@euro","es_ES","esp");

    $hoy = getdate();
    $fechai = date('Y-m-d');
    $fechaActual = date('Y-m-d');
    $fechaf = date('Y-m-d');
    $dateI = "";
    $dateE = "";
    $dateIComplete = '';
    $dateEComplete = '';
    function conex(){
        try{      
        $con = new PDO('mysql:host=192.168.253.40;dbname=lotoni;charset=utf8mb4', 'remote-user', 'L0to2288!',
        array(PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES 'utf8' "));
        return $con;
        } catch (PDOException $e) {
            return null;
        }
    }
    
    $db = conex();

    $sql = 'select fecha from loto_sorteos where fecha  = DATE_FORMAT(now(), "%Y-%m-%d")
    and juego = 3;';
    $result = $db->prepare($sql);
	$result->execute();
        if($row = $result->fetch(PDO::FETCH_OBJ)){
            $fechahoy = $row->fecha;
        }
        
    if($hoy['weekday'] == 'Monday'){
        
        $fechai = strtotime ( '-7 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '-1 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
        

        
    }else if($hoy['weekday'] == 'Tuesday'){
        $fechai = strtotime ( '-8 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '-2 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }else if($hoy['weekday'] == 'Wednesday'){
        $fechai = strtotime ( '-9 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '-3 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
        //echo $dateI . $dateE ; 
    }else if($hoy['weekday'] == 'Thursday'){
        if($fechahoy == $fechaActual){
        $fechai = strtotime ( '-3 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+3 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
        }else{
            $fechai = strtotime ( '-10 day' , strtotime ( $fechaActual ) ) ;
            $fechaf = strtotime ( '-4 day' , strtotime ( $fechaActual ) ) ;
            $dateI = date ( 'd' , $fechai );
            $dateE = date ( 'd' , $fechaf );
            $dateIComplete = date ( 'y-m-d' , $fechai );
            $dateEComplete = date ( 'y-m-d' , $fechaf );
        }
    }else if($hoy['weekday'] == 'Friday'){
        $fechai = strtotime ( '-4 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+2 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }else if($hoy['weekday'] == 'Saturday'){
        $fechai = strtotime ( '-5 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+1 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }else if($hoy['weekday'] == 'Sunday'){
        $fechai = strtotime ( '-6 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '0 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }
    
	
    
    $result = $db->prepare("select monto, texto from banners where id = 1;");
	$result->execute();
        if($row = $result->fetch(PDO::FETCH_OBJ)){
            $monto = $row->monto;
            $texto = $row->texto;
        }
       
        $monto= number_format($monto);

        $proxSorteo = strftime("%A, %d de %B del %Y", strtotime($texto));
        
       
       
        
           
            
?>

<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>

<style>
@font-face {
    font-family: "helvetica";
    src: url('font/HelveticaRounded-Bold.otf') format("truetype");
}
/*
body  {
    background-image: url("premio.jpg");
    background-repeat:no-repeat;
-webkit-background-size:cover;
-moz-background-size:cover;
-o-background-size:cover;
background-size:cover;
/*background-position:center;*/
     /* Nos aseguramos que la imagen de fondo este centrada vertical y
    horizontalmente en todo momento */
  /*background-position: center center;*/
  /* La imagen de fondo no se repite */
  /*background-repeat: no-repeat;*/
  /* La imagen de fondo est� fija en el viewport, de modo que no se mueva cuando
     la altura del contenido supere la altura de la imagen. */
   /*background-attachment: fixed;*/
  /* La imagen de fondo se reescala cuando se cambia el ancho de ventana del navegador */
 /*background-size: cover;*/
  /* Fijamos un color de fondo para que se muestre mientras se est�
    cargando la imagen de fondo o si hay problemas para cargarla  */
  /*background-color: #464646;

  @media only screen and (max-width: 767px) {
  body {
    background-image: url(images/background-photo-mobile-devices.jpg);
  }
    }

}*/

    ._container{
        float: left;
        margin: 0 auto;
       
    }

    ._container_free{
        position: absolute;
        margin-top: 32%;
       
    }

    ._centrado{
        margin-left: 39.4%;
        margin-top: 5%;
    }

    ._espaciado{
        margin-left: 6%;
    }

    ._espaciado_numeros{
        margin-left: 20.7%;
    }

    .mifuente{
        font-weight: bold; font-size: 80px;
    }

    .mifuente2{
        font-weight: bold; font-size: 220px;
    }
    h1 {
  color:#FFF;
  
  text-transform: uppercase;
  text-shadow: 0 12px 0 #41330a,
  0  4px  0   #7c6213,
               0  6px  0   #6e5611, 
               0  8px  0   #5f4b0e, 
               0 10px  0   #503f0c,
               0 12px  0   #41330a,
              3px 8px 15px rgba(0,0,0,0.1),
              3px 8px  5px rgba(0,0,0,0.3);
}

    @media (max-width: 720px) {
        ._centrado{
        margin-left: 39.4%;
        margin-top: 3.5%;
        
    }
    }

    #position2{
   position: relative;
    /*margin-right: 250px;*/
   /* margin-right: 250px;*/
   /* margin-left: 60%;*/
  /* margin-top: -2%;*/
    height: 1080px;
    width: 1920px;
 }


    body{
        height: 1080px;
        width: 1920px;
    }
</style>
</head>
<body>
<div id="position2"> 
    <img src= 'img/monto.jpg' style= 'position: absolute;' height="100%" width="100%"></img>
	<a id="download" style="visibility:hidden">Tomar screenshot y descargar</a>
    

    <!-- Monto -->
    <div class="" style="position: absolute; margin-top: 18.5%; margin-left: 10%;"><h1 class="mifuente2" style="">C$ <?php echo$monto; ?> </h1></div>
    
    <div class="" style="position: absolute; margin-top: 32%; margin-left: 18%;"><h2 class="mifuente" style=""><?php echo  ucwords ($proxSorteo); ?> </h2></div>
<div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
  <script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script>
  $(document).ready(function(){
		/*html2canvas($('#position2'), {
		onrendered (canvas) {
		    var link = document.getElementById('download');;
		    var image = canvas.toDataURL();
		    link.href = image;
		    link.download = 'screenshot.png';
		    link.click();
		}
		});*/
        downloadCanvas('position2', 'imagen.jpeg');
	})

    function downloadCanvas(canvasId, filename) {
    // Obteniendo la etiqueta la cual se desea convertir en imagen
    var domElement = document.getElementById(canvasId);
 
    // Utilizando la función html2canvas para hacer la conversión
    html2canvas(domElement, {
        onrendered: function(domElementCanvas) {
            // Obteniendo el contexto del canvas ya generado
            var context = domElementCanvas.getContext('2d');
 
            // Creando enlace para descargar la imagen generada
            var link = document.createElement('a');
            link.href = domElementCanvas.toDataURL("image/jpeg");
            link.download = filename;
 
            // Chequeando para browsers más viejos
            if (document.createEvent) {
                var event = document.createEvent('MouseEvents');
                // Simulando clic para descargar
                event.initMouseEvent("click", true, true, window, 0,
                    0, 0, 0, 0,
                    false, false, false, false,
                    0, null);
                link.dispatchEvent(event);
            } else {
                // Simulando clic para descargar
                link.click();
            }
        }
    });
}
    </script>
</body>
</html>
                <?php
            }
            else if($_REQUEST['option'] == 7){
                ?>
                <?php
    date_default_timezone_set('America/Managua');
    $hoy = getdate();
    $fechai = date('Y-m-d');
    $fechaActual = date('Y-m-d');
    
    $fechaf = date('Y-m-d');
    $dateI = "";
    $dateE = "";
    $dateIComplete = '';
    $dateEComplete = '';
    
    function conex(){
        try{      
        $con = new PDO('mysql:host=192.168.253.40;dbname=lotoni;charset=utf8mb4', 'remote-user', 'L0to2288!',
        array(PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES 'utf8' "));
        return $con;
        } catch (PDOException $e) {
            return null;
        }
    }
    
    $db = conex();

    $sql = 'select fecha from loto_sorteos where fecha  = DATE_FORMAT(now(), "%Y-%m-%d")
    and juego = 1;';
    $result = $db->prepare($sql);
    $fechahoy = null;
	$result->execute();
        if($row = $result->fetch(PDO::FETCH_OBJ)){
            $fechahoy = $row->fecha;
        }
        
            

    if($hoy['weekday'] == 'Monday'){
        if($fechahoy == $fechaActual){
            $fechai = strtotime ( '0 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+6 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
        }else{
                $fechai = strtotime ( '-7 day' , strtotime ( $fechaActual ) ) ;
            $fechaf = strtotime ( '-1 day' , strtotime ( $fechaActual ) ) ;
            $dateI = date ( 'd' , $fechai );
            $dateE = date ( 'd' , $fechaf );
            $dateIComplete = date ( 'y-m-d' , $fechai );
            $dateEComplete = date ( 'y-m-d' , $fechaf );
        }
        
        
    }else if($hoy['weekday'] == 'Tuesday'){
        $fechai = strtotime ( '-1 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+5 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }else if($hoy['weekday'] == 'Wednesday'){
        $fechai = strtotime ( '-2 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+4 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
        //echo $dateI . $dateE ; 
    }else if($hoy['weekday'] == 'Thursday'){
        $fechai = strtotime ( '-3 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+3 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }else if($hoy['weekday'] == 'Friday'){
        $fechai = strtotime ( '-4 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+2 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }else if($hoy['weekday'] == 'Saturday'){
        $fechai = strtotime ( '-5 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+1 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }else if($hoy['weekday'] == 'Sunday'){
        $fechai = strtotime ( '-6 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '0 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }
    
	
    $resultSet = array();
    $consult = $db->prepare("select par1 from loto_sorteos where fecha between ? and ? and juego = 1
    order by id;");
        $consult->execute(array($dateIComplete, $dateEComplete)); 
            while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                $resulSet = $row; 
            } 
           // print_r( $resulSet);
           
            
?>

<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>

<style>
@font-face {
    font-family: "helvetica";
    src: url('font/HelveticaRounded-Bold.otf') format("truetype");
}
/*
body  {
    background-image: url("diaria.jpg");
    background-repeat:no-repeat;
-webkit-background-size:cover;
-moz-background-size:cover;
-o-background-size:cover;
background-size:cover;
/*background-position:center;*/
     /* Nos aseguramos que la imagen de fondo este centrada vertical y
    horizontalmente en todo momento */
  /*background-position: center center;*/
  /* La imagen de fondo no se repite */
  /*background-repeat: no-repeat;*/
  /* La imagen de fondo est� fija en el viewport, de modo que no se mueva cuando
     la altura del contenido supere la altura de la imagen. */
   /*background-attachment: fixed;*/
  /* La imagen de fondo se reescala cuando se cambia el ancho de ventana del navegador */
 /*background-size: cover;*/
  /* Fijamos un color de fondo para que se muestre mientras se est�
    cargando la imagen de fondo o si hay problemas para cargarla  */
  /*background-color: #464646;

  @media only screen and (max-width: 767px) {
  body {
    background-image: url(images/background-photo-mobile-devices.jpg);
  }
    }

} */

    .fullscreen{
	 position: absolute:
     
	}

    ._container{
        float: left;
        margin: 0 auto;
       
    }

    ._container_free{
        position: absolute;
        margin-top: 38%;
       
    }

    ._centrado{
        margin-left: 38%;
        margin-top: 0%;
    }

    ._espaciado{
        margin-left: 5%;
    }

    ._espaciado_numeros{
        margin-left: 20.7%;
    }

    .__mifuente{
        font-weight: bold; font-size: 120px;
    }

    .__mifuente2{
        font-weight: bold; font-size: 70px;
    }

    @media (max-width: 720px) {
        ._centrado{
        margin-left: 38%;
        margin-top: 3.5%;
    }
    }

    #position2{
   position: relative;
    /*margin-right: 250px;*/
   /* margin-right: 250px;*/
   /* margin-left: 60%;*/
  /* margin-top: -2%;*/
    height: 1080px;
    width: 1920px;
 }


    body{
        height: 1080px;
        width: 1920px;
    }
</style>
</head>
<body>
<div id="position2">
	<img src= 'img/diaria.jpg' style= 'position: absolute;' height="100%" width="100%"></img>
	<!-- <a id="download" style="visibility:hidden">Tomar screenshot y descargar</a> -->
    
                
                <div class="" style="position: absolute; margin-top: 5.5%; margin-left: 39.2%"><h1 class="__mifuente" style=""><?php echo $dateI; ?> </h1></h1></div>
                <div class="" style="position: absolute; margin-top: 5.5%; margin-left: 51.2%"><h1 class="__mifuente" style=""><?php echo $dateE; ?> </h1></div>
   


    <!-- Lunes -->
    <div class="" style="position: absolute; margin-top:31.3%; margin-left: 20.7%;"><h1 class="__mifuente2" style=""><?php if(isset($resulSet[0]->par1)){echo $resulSet[0]->par1;} ?></h1></div>
    <div class="" style="position: absolute; margin-top: 37.8%; margin-left:20.7%;"><h1 class="__mifuente2" style=""><?php if(isset($resulSet[1]->par1)){echo $resulSet[1]->par1;} ?></h1></div>

    <!-- Martes -->
    <div class="" style="position: absolute; margin-top: 31.3%; margin-left: 31.5%;"><h1 class="__mifuente2" style=""><?php if(isset($resulSet[2]->par1)){echo $resulSet[2]->par1;} ?></h1></div>
    <div class="" style="position: absolute; margin-top: 37.8%; margin-left: 31.5%;"><h1 class="__mifuente2" style=""><?php if(isset($resulSet[3]->par1)){echo $resulSet[3]->par1;} ?></h1></div>  

    <!-- Miercoles -->
    <div class="" style="position: absolute; margin-top: 31.3%; margin-left: 42.5%;"><h1 class="__mifuente2" style=""><?php if(isset($resulSet[4]->par1)){echo $resulSet[4]->par1;} ?></h1></div>
    <div class="" style="position: absolute; margin-top: 37.8%; margin-left: 42.5%;"><h1 class="__mifuente2" style=""><?php if(isset($resulSet[5]->par1)){echo $resulSet[5]->par1;} ?></h1></div>  

    <!-- Jueves -->
    <div class="" style="position: absolute; margin-top: 31.3%; margin-left: 53.1%;"><h1 class="__mifuente2" style=""><?php if(isset($resulSet[6]->par1)){echo $resulSet[6]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 37.8%; margin-left: 53.1%;"><h1 class="__mifuente2" style=""><?php if(isset($resulSet[7]->par1)){echo $resulSet[7]->par1;} ?> </h1></div>  

    <!-- Viernes -->
    <div class="" style="position: absolute; margin-top: 31.3%; margin-left: 63.9%;"><h1 class="__mifuente2" style=""><?php if(isset($resulSet[8]->par1)){echo $resulSet[8]->par1;} ?></h1></div>
    <div class="" style="position: absolute; margin-top: 37.8%; margin-left: 63.9%;"><h1 class="__mifuente2" style=""><?php if(isset($resulSet[9]->par1)){echo $resulSet[9]->par1;} ?></h1></div>  

    <!-- Sabado -->
    <div class="" style="position: absolute; margin-top: 31.3%; margin-left: 74.7%;"><h1 class="__mifuente2" style=""><?php if(isset($resulSet[10]->par1)){echo $resulSet[10]->par1;} ?></h1></div>
    <div class="" style="position: absolute; margin-top: 37.8%; margin-left: 74.7%;"><h1 class="__mifuente2" style=""><?php if(isset($resulSet[11]->par1)){echo $resulSet[11]->par1;} ?></h1></div>  

    <!-- Domingo -->
    <div class="" style="position: absolute; margin-top: 31.3%; margin-left: 85.5%;"><h1 class="__mifuente2" style=""><?php if(isset($resulSet[12]->par1)){echo $resulSet[12]->par1;} ?></h1></div>
    <div class="" style="position: absolute; margin-top: 37.8%; margin-left: 85.5%;"><h1 class="__mifuente2" style=""><?php if(isset($resulSet[13]->par1)){echo $resulSet[13]->par1;} ?></h1></div> 
</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
  <script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
     <script>
  
  $(document).ready(function(){
		/*html2canvas($('#position2'), {
		onrendered (canvas) {
		    var link = document.getElementById('download');;
		    var image = canvas.toDataURL();
		    link.href = image;
		    link.download = 'screenshot.png';
		    link.click();
		}
		});*/
        downloadCanvas('position2', 'imagen.jpeg');
	})

    function downloadCanvas(canvasId, filename) {
    // Obteniendo la etiqueta la cual se desea convertir en imagen
    var domElement = document.getElementById(canvasId);
 
    // Utilizando la función html2canvas para hacer la conversión
    html2canvas(domElement, {
        onrendered: function(domElementCanvas) {
            // Obteniendo el contexto del canvas ya generado
            var context = domElementCanvas.getContext('2d');
 
            // Creando enlace para descargar la imagen generada
            var link = document.createElement('a');
            link.href = domElementCanvas.toDataURL("image/jpeg");
            link.download = filename;
 
            // Chequeando para browsers más viejos
            if (document.createEvent) {
                var event = document.createEvent('MouseEvents');
                // Simulando clic para descargar
                event.initMouseEvent("click", true, true, window, 0,
                    0, 0, 0, 0,
                    false, false, false, false,
                    0, null);
                link.dispatchEvent(event);
            } else {
                // Simulando clic para descargar
                link.click();
            }
        }
    });
}
	
    </script>
</body> 
</html>


<?php
    date_default_timezone_set('America/Managua');
    $hoy = getdate();
    $fechai = date('Y-m-d');
    $fechaActual = date('Y-m-d');
    $fechaf = date('Y-m-d');
    $dateI = "";
    $dateE = "";
    $dateIComplete = '';
    $dateEComplete = '';


    
    
    $db = conex();
    $fechahoy = null;
    $sql = 'select fecha from loto_sorteos where fecha  = DATE_FORMAT(now(), "%Y-%m-%d")
    and juego = 2;';
    $result = $db->prepare($sql);
	$result->execute();
        if($row = $result->fetch(PDO::FETCH_OBJ)){
            $fechahoy = $row->fecha;
        }
        


        
    if($hoy['weekday'] == 'Monday'){
        if($fechahoy == $fechaActual){
        $fechai = strtotime ( '0 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+6 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
        }else{
                    
                $fechai = strtotime ( '-7 day' , strtotime ( $fechaActual ) ) ;
            $fechaf = strtotime ( '-1 day' , strtotime ( $fechaActual ) ) ;
            $dateI = date ( 'd' , $fechai );
            $dateE = date ( 'd' , $fechaf );
            $dateIComplete = date ( 'y-m-d' , $fechai );
            $dateEComplete = date ( 'y-m-d' , $fechaf );
        }
        
    }else if($hoy['weekday'] == 'Tuesday'){
        $fechai = strtotime ( '-1 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+5 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }else if($hoy['weekday'] == 'Wednesday'){
        $fechai = strtotime ( '-2 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+4 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
        //echo $dateI . $dateE ; 
    }else if($hoy['weekday'] == 'Thursday'){
        $fechai = strtotime ( '-3 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+3 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }else if($hoy['weekday'] == 'Friday'){
        $fechai = strtotime ( '-4 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+2 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }else if($hoy['weekday'] == 'Saturday'){
        $fechai = strtotime ( '-5 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+1 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }else if($hoy['weekday'] == 'Sunday'){
        $fechai = strtotime ( '-6 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '0 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }
    
	
    $resultSet = array();
    $consult = $db->prepare("select par1, par2 from loto_sorteos where fecha between ? and ? and juego = 2
    order by id;");
        $consult->execute(array($dateIComplete, $dateEComplete)); 
            while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                $resulSet = $row; 
            } 
           
            
?>

<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>

<style>
@font-face {
    font-family: "helvetica";
    src: url('font/HelveticaRounded-Bold.otf') format("truetype");
}

/*
body  {
    background-image: url("combo.jpg");
    background-repeat:no-repeat;
-webkit-background-size:cover;
-moz-background-size:cover;
-o-background-size:cover;
background-size:cover;
/*background-position:center;*/
     /* Nos aseguramos que la imagen de fondo este centrada vertical y
    horizontalmente en todo momento */
  /*background-position: center center;*/
  /* La imagen de fondo no se repite */
  /*background-repeat: no-repeat;*/
  /* La imagen de fondo est� fija en el viewport, de modo que no se mueva cuando
     la altura del contenido supere la altura de la imagen. */
   /*background-attachment: fixed;*/
  /* La imagen de fondo se reescala cuando se cambia el ancho de ventana del navegador */
 /*background-size: cover;*/
  /* Fijamos un color de fondo para que se muestre mientras se est�
    cargando la imagen de fondo o si hay problemas para cargarla  */
  /*background-color: #464646;

  @media only screen and (max-width: 767px) {
  body {
    background-image: url(images/background-photo-mobile-devices.jpg);
  }
    }

}*/

    

   

    ._mifuente{
        font-weight: bold; font-size: 120px;
    }

    ._mifuente2{
        font-weight: bold; font-size: 62px;
    }

    @media (max-width: 720px) {
        ._centrado{
        margin-left: 38%;
        margin-top: 4%;
        
    }
    }

    #position2{
   position: relative;
    /*margin-right: 250px;*/
   /* margin-right: 250px;*/
   /* margin-left: 60%;*/
  /* margin-top: -2%;*/
    height: 1080px;
    width: 1920px;
 }


    body{
        height: 1080px;
        width: 1920px;
    }
    .position{
       position: absolute;
       /* margin: 0 auto;
        margin-top: 0%;*/
        height: 1080px;
        width: 1920px;
    }

   #img { max-width: 100%; }
</style>
</head>
<body id="body">
<!--<button id="download" style="">Tomar screenshot y descargar</button>-->
<div id="position2">
    <img id="img" src= 'img/supercombo.jpg' class="position" alt="img"></img>
    <div class="" style="position: absolute; margin-top: 5.5%; margin-left: 39%;"><h1 class="_mifuente" style=""><?php echo $dateI; ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 5.5%; margin-left: 50%;"><h1 class="_mifuente" style=""><?php echo $dateE; ?> </h1></div>
    
    <!-- Lunes -->
    <div class="" style="position: absolute; margin-top: 30.5%; margin-left: 13%;"><h1 class="_mifuente2" style=""><?php if(isset($resulSet[0]->par1)){echo $resulSet[0]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 30.5%; margin-left: 18.3%;"><h1 class="_mifuente2" style=""><?php if(isset($resulSet[0]->par2)){echo $resulSet[0]->par2;} ?> </h1></div>
    
    <div class="" style="position: absolute; margin-top: 39.4%; margin-left: 13%;"><h1 class="_mifuente2" style=""><?php if(isset($resulSet[1]->par1)){echo $resulSet[1]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 39.4%; margin-left: 18.3%;"><h1 class="_mifuente2" style=""><?php if(isset($resulSet[1]->par2)){echo $resulSet[1]->par2;} ?> </h1></div>
    
    <!-- Martes -->
    <div class="" style="position: absolute; margin-top: 30.5%; margin-left: 24.3%;"><h1 class="_mifuente2" style=""><?php if(isset($resulSet[2]->par1)){echo $resulSet[2]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 30.5%; margin-left: 29.8%;"><h1 class="_mifuente2" style=""><?php if(isset($resulSet[2]->par2)){echo $resulSet[2]->par2;} ?> </h1></div>
    
    <div class="" style="position: absolute; margin-top: 39.4%; margin-left: 24.3%;"><h1 class="_mifuente2" style=""><?php if(isset($resulSet[3]->par1)){echo $resulSet[3]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 39.4%; margin-left: 29.8%;"><h1 class="_mifuente2" style=""><?php if(isset($resulSet[3]->par2)){echo $resulSet[3]->par2;} ?> </h1></div>
    
    <!-- Miercoles -->
    <div class="" style="position: absolute; margin-top: 30.5%; margin-left: 35.7%;"><h1 class="_mifuente2" style=""><?php if(isset($resulSet[4]->par1)){echo $resulSet[4]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 30.5%; margin-left: 41.3%;"><h1 class="_mifuente2" style=""><?php if(isset($resulSet[4]->par2)){echo $resulSet[4]->par2;} ?> </h1></div>
    
    <div class="" style="position: absolute; margin-top: 39.4%; margin-left: 35.7%;"><h1 class="_mifuente2" style=""><?php if(isset($resulSet[5]->par1)){echo $resulSet[5]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 39.4%; margin-left: 41.3%;"><h1 class="_mifuente2" style=""><?php if(isset($resulSet[5]->par2)){echo $resulSet[5]->par2;} ?> </h1></div>
    
    <!-- Jueves -->
    <div class="" style="position: absolute; margin-top: 30.5%; margin-left: 47.3%;"><h1 class="_mifuente2" style=""><?php if(isset($resulSet[6]->par1)){echo $resulSet[6]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 30.5%; margin-left: 52.8%;"><h1 class="_mifuente2" style=""><?php if(isset($resulSet[6]->par2)){echo $resulSet[6]->par2;} ?> </h1></div>
    
    <div class="" style="position: absolute; margin-top: 39.4%; margin-left: 47.3%;"><h1 class="_mifuente2" style=""><?php if(isset($resulSet[7]->par1)){echo $resulSet[7]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 39.4%; margin-left: 52.8%;"><h1 class="_mifuente2" style=""><?php if(isset($resulSet[7]->par2)){echo $resulSet[7]->par2;} ?> </h1></div>
    
    <!-- Viernes -->
    <div class="" style="position: absolute; margin-top: 30.5%; margin-left: 58.8%;"><h1 class="_mifuente2" style=""><?php if(isset($resulSet[8]->par1)){echo $resulSet[8]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 30.5%; margin-left: 64.3%;"><h1 class="_mifuente2" style=""><?php if(isset($resulSet[8]->par2)){echo $resulSet[8]->par2;} ?> </h1></div>
    
    <div class="" style="position: absolute; margin-top: 39.4%; margin-left: 58.8%;"><h1 class="_mifuente2" style=""><?php if(isset($resulSet[9]->par1)){echo $resulSet[9]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 39.4%; margin-left: 64.3%;"><h1 class="_mifuente2" style=""><?php if(isset($resulSet[9]->par2)){echo $resulSet[9]->par2;} ?> </h1></div>
    
    <!-- Sabado -->
    <div class="" style="position: absolute; margin-top: 30.5%; margin-left: 70.3%;"><h1 class="_mifuente2" style=""><?php if(isset($resulSet[10]->par1)){echo $resulSet[10]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 30.5%; margin-left: 75.8%;"><h1 class="_mifuente2" style=""><?php if(isset($resulSet[10]->par2)){echo $resulSet[10]->par2;} ?> </h1></div>
    
    <div class="" style="position: absolute; margin-top: 39.4%; margin-left: 70.3%;"><h1 class="_mifuente2" style=""><?php if(isset($resulSet[11]->par1)){echo $resulSet[11]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 39.4%; margin-left: 75.8%;"><h1 class="_mifuente2" style=""><?php if(isset($resulSet[11]->par2)){echo $resulSet[11]->par2;} ?> </h1></div>
    
    <!-- Domingo -->
    <div class="" style="position: absolute; margin-top: 30.5%; margin-left: 81.8%;"><h1 class="_mifuente2" style=""><?php if(isset($resulSet[12]->par1)){echo $resulSet[12]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 30.5%; margin-left: 87.4%;"><h1 class="_mifuente2" style=""><?php if(isset($resulSet[12]->par2)){echo $resulSet[12]->par2;} ?> </h1></div>
    
    <div class="" style="position: absolute; margin-top: 39.4%; margin-left: 81.8%;"><h1 class="_mifuente2" style=""><?php if(isset($resulSet[13]->par1)){echo $resulSet[13]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 39.4%; margin-left: 87.3%;"><h1 class="_mifuente2" style=""><?php if(isset($resulSet[13]->par2)){echo $resulSet[13]->par2;} ?> </h1></div>
</div>

   
</body> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
  
   <script>
  
  $(document).ready(function(){
		/*html2canvas($('#position2'), {
		onrendered (canvas) {
		    var link = document.getElementById('download');;
		    var image = canvas.toDataURL();
		    link.href = image;
		    link.download = 'screenshot.png';
		    link.click();
		}
		});*/
        downloadCanvas('position2', 'imagen.jpeg');
	})

    function downloadCanvas(canvasId, filename) {
    // Obteniendo la etiqueta la cual se desea convertir en imagen
    var domElement = document.getElementById(canvasId);
 
    // Utilizando la función html2canvas para hacer la conversión
    html2canvas(domElement, {
        onrendered: function(domElementCanvas) {
            // Obteniendo el contexto del canvas ya generado
            var context = domElementCanvas.getContext('2d');
 
            // Creando enlace para descargar la imagen generada
            var link = document.createElement('a');
            link.href = domElementCanvas.toDataURL("image/jpeg");
            link.download = filename;
 
            // Chequeando para browsers más viejos
            if (document.createEvent) {
                var event = document.createEvent('MouseEvents');
                // Simulando clic para descargar
                event.initMouseEvent("click", true, true, window, 0,
                    0, 0, 0, 0,
                    false, false, false, false,
                    0, null);
                link.dispatchEvent(event);
            } else {
                // Simulando clic para descargar
                link.click();
            }
        }
    });
}
 
// Haciendo la conversión y descarga de la imagen al presionar el botón
$('#download').click(function() {
    downloadCanvas('position2', 'imagen.jpeg');
});
		
    </script> 
</html>
<?php
    date_default_timezone_set('America/Managua');
    $hoy = getdate();
    $fechai = date('Y-m-d');
    $fechaActual = date('Y-m-d');
    $fechaf = date('Y-m-d');
    $dateI = "";
    $dateE = "";
    $dateIComplete = '';
    $dateEComplete = '';
    
   
    
    $db = conex();
    $fechahoy = null;
    $sql = 'select fecha from loto_sorteos where fecha  = DATE_FORMAT(now(), "%Y-%m-%d")
    and juego = 2;';
    $result = $db->prepare($sql);
	$result->execute();
        if($row = $result->fetch(PDO::FETCH_OBJ)){
            $fechahoy = $row->fecha;
        }

    if($hoy['weekday'] == 'Monday'){
        if($fechahoy == $fechaActual){
        $fechai = strtotime ( '0 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+6 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
        }else{
                
            $fechai = strtotime ( '-7 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '-1 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }

        
    }else if($hoy['weekday'] == 'Tuesday'){
        $fechai = strtotime ( '-1 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+5 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }else if($hoy['weekday'] == 'Wednesday'){
        $fechai = strtotime ( '-2 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+4 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
        //echo $dateI . $dateE ; 
    }else if($hoy['weekday'] == 'Thursday'){
        $fechai = strtotime ( '-3 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+3 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }else if($hoy['weekday'] == 'Friday'){
        $fechai = strtotime ( '-4 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+2 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }else if($hoy['weekday'] == 'Saturday'){
        $fechai = strtotime ( '-5 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '+1 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }else if($hoy['weekday'] == 'Sunday'){
        $fechai = strtotime ( '-6 day' , strtotime ( $fechaActual ) ) ;
        $fechaf = strtotime ( '0 day' , strtotime ( $fechaActual ) ) ;
        $dateI = date ( 'd' , $fechai );
        $dateE = date ( 'd' , $fechaf );
        $dateIComplete = date ( 'y-m-d' , $fechai );
        $dateEComplete = date ( 'y-m-d' , $fechaf );
    }
    
	
    $resultSet = array();
    $consult = $db->prepare("select par1, par2, par3 from loto_sorteos where fecha between ? and ? and juego = 9
    order by id;");
        $consult->execute(array($dateIComplete, $dateEComplete)); 
            while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                $resulSet = $row; 
            } 
           
            
?>

<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>

<style>
@font-face {
    font-family: "helvetica";
    src: url('font/HelveticaRounded-Bold.otf') format("truetype");
}
/*
body  {
    background-image: url("juga3.jpg");
    background-repeat:no-repeat;
-webkit-background-size:cover;
-moz-background-size:cover;
-o-background-size:cover;
background-size:cover;
/*background-position:center;*/
     /* Nos aseguramos que la imagen de fondo este centrada vertical y
    horizontalmente en todo momento */
  /*background-position: center center;*/
  /* La imagen de fondo no se repite */
  /*background-repeat: no-repeat;*/
  /* La imagen de fondo est� fija en el viewport, de modo que no se mueva cuando
     la altura del contenido supere la altura de la imagen. */
   /*background-attachment: fixed;*/
  /* La imagen de fondo se reescala cuando se cambia el ancho de ventana del navegador */
 /*background-size: cover;*/
  /* Fijamos un color de fondo para que se muestre mientras se est�
    cargando la imagen de fondo o si hay problemas para cargarla  */
 /* background-color: #464646;

  @media only screen and (max-width: 767px) {
  body {
    background-image: url(images/background-photo-mobile-devices.jpg);
  }
    }

}*/

    ._container{
        float: left;
        margin: 0 auto;
       
    }

    ._container_free{
        position: absolute;
        margin-top: 32%;
       
    }

    ._centrado{
        margin-left: 31%;
        margin-top: 11%;
    }

    ._espaciado{
        margin-left: 2%;
    }

    ._espaciado_numeros{
        margin-left: 20.7%;
    }

    .mifuente{
        font-weight: bold; font-size: 120px;
    }

    .mifuente2{
        font-weight: bold; font-size: 80px;
    }

    @media (max-width: 720px) {
        ._centrado{
        margin-left: 31%;
        margin-top: 10%;
        
    }
    }
    #position2{
   position: relative;
    /*margin-right: 250px;*/
   /* margin-right: 250px;*/
   /* margin-left: 60%;*/
  /* margin-top: -2%;*/
    height: 1080px;
    width: 1920px;
 }


    body{
        height: 1080px;
        width: 1920px;
    }
</style>
</head>
<body>
    
	<!--<a id="download" style="visibility:hidden">Tomar screenshot y descargar</a>-->
    
                
<div id="position2">
    <img src= 'img/juga3.jpg' style= 'position: absolute;' height="100%" width="100%"></img>
    <div class="" style="position: absolute; margin-top: 11.5%; margin-left: 31.5%;"><h1 class="mifuente" style=""><?php echo $dateI; ?> </h1></div>
                <div class="" style="position: absolute; margin-top: 11.5%; margin-left: 42.5%;"><h1 class="mifuente" style=""><?php echo $dateE; ?> </h1></div>
    
    <!-- Lunes -->
    <div class="" style="position: absolute; margin-top: 29%; margin-left: 7.2%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[0]->par1)){ echo $resulSet[0]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 29%; margin-left: 11.4%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[0]->par2)){ echo $resulSet[0]->par2;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 29%; margin-left: 15.1%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[0]->par3)){ echo $resulSet[0]->par3;} ?> </h1></div>

    <div class="" style="position: absolute; margin-top: 39.5%; margin-left: 7.2%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[1]->par1)){ echo $resulSet[1]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 39.5%; margin-left: 11.4%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[1]->par2)){ echo $resulSet[1]->par2;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 39.5%; margin-left: 15.1%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[1]->par3)){ echo $resulSet[1]->par3;}; ?> </h1></div>

    <!-- Martes -->
    <div class="" style="position: absolute; margin-top: 29%; margin-left: 20.3%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[2]->par1)){ echo $resulSet[2]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 29%; margin-left: 24.4%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[2]->par2)){ echo $resulSet[2]->par2;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 29%; margin-left: 28.4%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[2]->par3)){ echo $resulSet[2]->par3;} ?> </h1></div>

    <div class="" style="position: absolute; margin-top: 39.5%; margin-left: 20.3%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[3]->par1)){ echo $resulSet[3]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 39.5%; margin-left: 24.4%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[3]->par2)){ echo $resulSet[3]->par2;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 39.5%; margin-left: 28.4%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[3]->par3)){ echo $resulSet[3]->par3;} ?> </h1></div>

    <!-- Miercoles -->
    <div class="" style="position: absolute; margin-top: 29%; margin-left: 33%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[4]->par1)){ echo $resulSet[4]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 29%; margin-left: 37.2%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[4]->par2)){ echo $resulSet[4]->par2;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 29%; margin-left: 41.1%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[4]->par3)){ echo $resulSet[4]->par3;} ?> </h1></div>

    <div class="" style="position: absolute; margin-top: 39.5%; margin-left: 33%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[5]->par1)){ echo $resulSet[5]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 39.5%; margin-left: 37.2%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[5]->par2)){ echo $resulSet[5]->par2;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 39.5%; margin-left: 41.1%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[5]->par3)){ echo $resulSet[5]->par3;} ?> </h1></div>

    <!-- Jueves -->
    <div class="" style="position: absolute; margin-top: 29%; margin-left: 46.2%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[6]->par1)){ echo $resulSet[6]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 29%; margin-left: 50.4%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[6]->par2)){ echo $resulSet[6]->par2;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 29%; margin-left: 54.1%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[6]->par3)){ echo $resulSet[6]->par3;} ?> </h1></div>

    <div class="" style="position: absolute; margin-top: 39.5%; margin-left: 46.2%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[7]->par1)){ echo $resulSet[7]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 39.5%; margin-left: 50.4%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[7]->par2)){ echo $resulSet[7]->par2;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 39.5%; margin-left: 54.1%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[7]->par3)){ echo $resulSet[7]->par3;} ?> </h1></div>

    <!-- Viernes -->
    <div class="" style="position: absolute; margin-top: 29%; margin-left: 59.2%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[8]->par1)){ echo $resulSet[8]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 29%; margin-left: 63.4%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[8]->par2)){ echo $resulSet[8]->par2;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 29%; margin-left: 67.1%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[8]->par3)){ echo $resulSet[8]->par3;} ?> </h1></div>

    <div class="" style="position: absolute; margin-top: 39.5%; margin-left: 59.2%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[9]->par1)){ echo $resulSet[9]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 39.5%; margin-left: 63.4%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[9]->par2)){ echo $resulSet[9]->par2;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 39.5%; margin-left: 67.1%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[9]->par3)){ echo $resulSet[9]->par3;} ?> </h1></div>

    <!-- Sabado -->
    <div class="" style="position: absolute; margin-top: 29%; margin-left: 72.2%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[10]->par1)){ echo $resulSet[10]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 29%; margin-left: 76.4%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[10]->par2)){ echo $resulSet[10]->par2;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 29%; margin-left: 80.1%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[10]->par3)){ echo $resulSet[10]->par3;} ?> </h1></div>

    <div class="" style="position: absolute; margin-top: 39.5%; margin-left: 72.2%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[11]->par1)){ echo $resulSet[11]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 39.5%; margin-left: 76.4%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[11]->par2)){ echo $resulSet[11]->par2;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 39.5%; margin-left: 80.1%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[11]->par3)){ echo $resulSet[11]->par3;} ?> </h1></div>

    <!-- Domingo -->
    <div class="" style="position: absolute; margin-top: 29%; margin-left: 85.2%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[12]->par1)){ echo $resulSet[12]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 29%; margin-left: 89.4%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[12]->par2)){ echo $resulSet[12]->par2;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 29%; margin-left: 93.1%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[12]->par3)){ echo $resulSet[12]->par3;} ?> </h1></div>

    <div class="" style="position: absolute; margin-top: 39.5%; margin-left: 85.2%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[12]->par1)){ echo $resulSet[13]->par1;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 39.5%; margin-left: 89.4%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[12]->par2)){ echo $resulSet[13]->par2;} ?> </h1></div>
    <div class="" style="position: absolute; margin-top: 39.5%; margin-left: 93.1%;"><h1 class="mifuente2" style=""><?php if(isset($resulSet[13]->par3)){ echo $resulSet[13]->par3;} ?> </h1></div>
</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
  
    <script>
       $(document).ready(function(){
		/*html2canvas($('#position2'), {
		onrendered (canvas) {
		    var link = document.getElementById('download');;
		    var image = canvas.toDataURL();
		    link.href = image;
		    link.download = 'screenshot.png';
		    link.click();
		}
		});*/
        downloadCanvas('position2', 'imagen.jpeg');
	})

    function downloadCanvas(canvasId, filename) {
    // Obteniendo la etiqueta la cual se desea convertir en imagen
    var domElement = document.getElementById(canvasId);
 
    // Utilizando la función html2canvas para hacer la conversión
    html2canvas(domElement, {
        onrendered: function(domElementCanvas) {
            // Obteniendo el contexto del canvas ya generado
            var context = domElementCanvas.getContext('2d');
 
            // Creando enlace para descargar la imagen generada
            var link = document.createElement('a');
            link.href = domElementCanvas.toDataURL("image/jpeg");
            link.download = filename;
 
            // Chequeando para browsers más viejos
            if (document.createEvent) {
                var event = document.createEvent('MouseEvents');
                // Simulando clic para descargar
                event.initMouseEvent("click", true, true, window, 0,
                    0, 0, 0, 0,
                    false, false, false, false,
                    0, null);
                link.dispatchEvent(event);
            } else {
                // Simulando clic para descargar
                link.click();
            }
        }
    });
}
    </script> 
</body> 
</html>
                <?php
            }
            else{
                echo 'Nada que mostrar';
            }
        }
    ?>