<?php 
    if(isset($_REQUEST['option'])){
        if($_REQUEST['option'] == '1'){
            echo 'uno';
        }else if($_REQUEST['option'] == '2'){
            echo 'dos';
        }else if($_REQUEST['option'] == 3){
            echo 'tres';
        }else if($_REQUEST['option'] == 4){

        }else if($_REQUEST['option'] == 5){

        }
        else{
            echo 'Nada que mostrar';
        }
    }
?>

