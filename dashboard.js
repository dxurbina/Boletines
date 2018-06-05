$(document).ready(function(){
    
    $('.space').change(function(){
        $("#img").remove();

        if ($("#b1").prop("checked")) {
            jQuery('#position2').append('<img id="img" class="position-boletin" src="img/img1.jpg" alt="img">');
        }else if ($("#b2").prop("checked")) {
            jQuery('#position2').append('<img id="img" class="position-boletin" src="img/img2.jpg" alt="img">');
        }else if ($("#b3").prop("checked")) {
            jQuery('#position2').append('<img id="img" class="position-boletin" src="img/img3.jpg" alt="img">');
        }else if ($("#b4").prop("checked")) {
            jQuery('#position2').append('<img id="img" class="position-boletin" src="img/img4.jpg" alt="img">');
        }else if ($("#b5").prop("checked")) {
            jQuery('#position2').append('<img id="img" class="position-boletin" src="img/img5.jpg" alt="img">');
        }
        
        
    });


    $('.space2').change(function(){
        if ($("#r1").prop("checked")) {
            jQuery('#position2').append('<img id="img" class="position-boletin" src="img/diaria.jpg" alt="img">');
        }else if ($("#r2").prop("checked")) {
            jQuery('#position2').append('<img id="img" class="position-boletin" src="img/supercombo.jpg" alt="img">');
        }else if ($("#r3").prop("checked")) {
            jQuery('#position2').append('<img id="img" class="position-boletin" src="img/juga3.jpg" alt="img">');
        }else if ($("#r4").prop("checked")) {
            jQuery('#position2').append('<img id="img" class="position-boletin" src="img/lagrande.jpg" alt="img">');
        }else if ($("#r5").prop("checked")) {
            jQuery('#position2').append('<img id="img" class="position-boletin" src="img/t2.jpg" alt="img">');
        }else if ($("#r6").prop("checked")) {
            jQuery('#position2').append('<img id="img" class="position-boletin" src="img/monto.jpg" alt="img">');
        }
    });

    
});