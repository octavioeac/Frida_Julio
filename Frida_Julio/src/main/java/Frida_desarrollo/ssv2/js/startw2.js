$(document).ready(function(){
    var z = 0;
    $('#folio').focus(function(){
        $(".aviso").html('');
    });
    $('#folio').blur(function(){
        var f = $(this).val();
        if(f === ''){
            $(".aviso").html('<div id="error">Folio no v&aacute;lido.</div>');
            return false;
        }
        else{
            $.ajax({
                url:"functions/sfolio.php",
                type: "POST",
                data:"folio="+f,
                success:function(flag){
                    var b = (flag);
                    b = parseInt(b);
                    if(b === 0){
                        //alert(b);
                        //$(".aviso").css('display','block');
                        z = 0;
                        $(".aviso").html('<div id="error">Folio no v&aacute;lido.</div>');
                        return false;
                    }
                    else if(b === 1){
                        z = 1;
                        $(".aviso").html('<div id="alert">Folio el proceso de validaci&oacute;n.</div>');
                        return false;
                    }
                    else{
                        z = 2;
                    }
                }
            });
        }
    });
    $('#entr').click(function(){
        if(z === 0){
            $(".aviso").html('<div id="error">Folio no v&aacute;lido.</div>');
            return false;
        }
        else if(z === 1){
            $(".aviso").html('<div id="alert">Folio el proceso de validaci&oacute;n.</div>');
            return false;
        }
        else if(z === 3){
            $(".aviso").html('<div id="alert">Site Survey capturado, esta en espera de ser validado.</div>');
            return false;
        }
    });
});