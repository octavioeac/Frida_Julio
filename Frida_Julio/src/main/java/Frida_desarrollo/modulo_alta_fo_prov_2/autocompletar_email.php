<html>
<head>
<!--<link rel="stylesheet" type="text/css" href="../js/jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui-1.10.4.custom.css">
<script type="text/javascript" src="../js/jquery-ui-1.10.4.custom/js/jquery-1.10.2"></script>

<script type="text/javascript" src="../js/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.js"></script> 
<script>
var jq2=jQuery.noConflict();

</script>-->

</head>
<body>
<?php 
//include("../conexion.php");
 $query = "select email from seg_usuarios";
   	$result = mysql_query($query);
	$contador=0;
	 $contad=mysql_num_rows($result);
	 
?>
<script type="text/javascript">
 jq2("#mails").attr("value","");
var lista_de_correos=[
<?php
        $usuarios="";
       while ($row=mysql_fetch_row($result)) 
      { 
		  $usuarios .="'".$row[0];
		  if($contador<($contad-1)){
			  		  $usuarios .="',";
			  }
			  else{
				    $usuarios .="'";
				  }
		  $contador++;
		  
       }
	     echo $usuarios; 
?>
];
</script>
<?php

echo "<div >
    <label class='Estilo2'>Para:</label>
	<input style:'resize:'vertical;' value='' id='mails' size='100%'>
	</div>";
?>
 <script>
  jq2(function() {
    function split( val ) {
      return val.split( /,\s*/ );
    }
    function extractLast( term ) {
      return split( term ).pop();
    }
 
    jq2( "#mails" )
      .autocomplete({
        minLength: 0,
        source: function( request, response ) {
          response( jq2.ui.autocomplete.filter(
            lista_de_correos, extractLast( request.term ) ) );
        },
        focus: function() {
          return false;
        },
        select: function( event, ui ) {
          var terms = split( this.value );
          // remove the current input
          terms.pop();
          // add the selected item
          terms.push( ui.item.value );
          // add placeholder to get the comma-and-space at the end
          terms.push( "" );
          this.value = terms.join( ", " );
          return false;
        }
      });
  });

</script>

</body>
</html>
