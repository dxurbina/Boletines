$(document).ready(function(){
    
    $('.space').change(function(){
        $("#img").remove();

        if ($("#r1").prop("checked")) {
            jQuery('#position2').append('<img id="img" src="img/img1.jpg" alt="img">');
        }else if ($("#r2").prop("checked")) {
            jQuery('#position2').append('<img id="img" src="img/img2.jpg" alt="img">');
        }else if ($("#r3").prop("checked")) {
            jQuery('#position2').append('<img id="img" src="img/img3.jpg" alt="img">');
        }else if ($("#r4").prop("checked")) {
            jQuery('#position2').append('<img id="img" src="img/img4.jpg" alt="img">');
        }else if ($("#r5").prop("checked")) {
            jQuery('#position2').append('<img id="img" src="img/img5.jpg" alt="img">');
        }
        
        
    });

    
});