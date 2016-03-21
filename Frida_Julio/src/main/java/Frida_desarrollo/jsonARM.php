<?php
// include('httpful.phar');
//include('HttpClient.class.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2" />
<title>Untitled Document</title>
<script type="text/javascript" src="js/jquery-ui-1.10.4.custom/js/jquery-1.10.2.js"></script>
</head>

<script type="text/javascript">

    var JsonObject={"otId":"CE_GUSLMO_001CNOO",
                     "tipoElemnto":"NODO"
                    };
    var JsonData=JSON.stringify(JsonObject);
     
     $.ajax({
          url:'http://10.105.59.73:8082/fridaSendARM/equipo',
          type: "POST",
         dataType:"json",
		 data:JsonData,
         contentType:"application/json",
           success: function(data){
             console.log(data);
     
              
           }
         
    });
    
     

</script>
    
    

  
    <body>
</body>
</html>




