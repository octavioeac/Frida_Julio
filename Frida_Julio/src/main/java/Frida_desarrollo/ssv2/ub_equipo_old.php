<?php
    header("Content-Type: text/html;charset=utf-8");
    include("functions/conexion.php");
?>
<html>
    <head>
        <style>
            .Estilo28,.Estilo49,.Estilo53,.Estilo57,.Estilo42,.Estilo70{font-family:Verdana,Arial,Helvetica,sans-serif}
            .Estilo49,.Estilo53,.Estilo57,.Estilo70{font-weight:bold}
            .Estilo28,.Estilo42,.Estilo70{font-size:12px}
            .Estilo49,.Estilo42,.Estilo70{color:#006}
            .Estilo49,.Estilo53{font-size:10px}
            .Estilo1,.Estilo53{color:#000}
            .Estilo57{font-size:9px;color:#900}
            .Estilo70{background:#ffc}
            h1{color: #f90}
            h2{color:#930;font-size:2px;font-style:normal;line-height:normal}
            tr{text-align:left}
            strong{color:#c30}
            #tb{font-size:11px}
            #sala{width:350px}
    </style>
    </head>
    <body>
        <?php
            $campo=$_GET['text'];
            /*----------------------------------
            QUERY'S PARA FORMAR LA UBICACION 
            ---------------------------------*/
            // SALA
            $catsala=mysql_query("SELECT codigo,tipo_sala FROM cat_salas");
            $numsala=mysql_num_rows($catsala);
            
            // PISO
            $catpiso=mysql_query("SELECT piso,codigo FROM `cat_pisos` ");
            $numpiso=mysql_num_rows($catpiso);
        ?>
        <table width='825' border='3' cellspacing='1' bordercolor='#999999' bgcolor='#CAE4FF' id='tb'>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
        <td width="268" colspan="4" class="Estilo42">
            <strong>Informacion del Equipo</strong>
        </td>
    </tr>
    <tr bordercolor='#CAE4FF' bgcolor='#CAE4FF'>
    <!--PISO-->
        <td>
            <select name='piso' id='piso' class='Estilo48' onchange='concatena()'>
                <option selected value=''>---Piso---</option>
                <?php
                    $selpiso='';

                    for($e = 0;$e < $numpiso; $e++){
                       $edif = mysql_result($catpiso,$e,0)." - ".mysql_result($catpiso,$e,1);  
                       echo "<option $selpiso value='".mysql_result($catpiso,$e,1)."'>$edif</option>";
                    }
                ?>
            </select>&nbsp;&nbsp;
        <!--SALA--> 
	<td><select name='sala' class='Estilo48' id='sala'  onchange='concatena()'>
	<option selected value=''>---Sala---</option>
        <?php
            $selsala='';
            for($e = 0; $e < $numsala; $e++){
               $edif=mysql_result($catsala,$e,0)." , ".mysql_result($catsala,$e,1);  
               echo "<option $selsala value='".mysql_result($catsala,$e,0)."'>$edif</option>";
            }
        ?>
	</select></td>
        <!--GRUPO-->
	<td>
            <select name='grupo' id='grupo' class='Estilo48' class='Estilo48' onchange='concatena()'>
        <?php
            if($grupo == '')
                $selec='selected'; 
            else 
                $selec='';
        ?>
            <option value='' <?php echo $selec ?>>-Grupo-</option>
        <?php
            if ($grupo=='grupo')
                $selec='selected';
            else 
                $selec='';
            for($contador = 0; $contador < 10; $contador++){
                echo "<option value='$contador' $selec>$contador</option>";
            } 
        ?>
	</select> 
        <!--FILA-->
	<select name='fila' id='fila' class='Estilo48' class='Estilo48' onchange='concatena()' >
	<?php
            if($fila=='')
                $selec='selected';
            else $selec='';
        ?>
	<option value='' <?php echo $selec ?>>-Fila-</option>
        <?php
            if($fila=='fila')
                $selec='selected';
            else 
                $selec='';
            for($contador=0; $contador < 1000; $contador++){
		echo "<option value='$contador' $selec>$contador</option>";
            }
        ?>
	</select>
        </td> 
	<!--LADO-->
	<td><select name='lado' id='lado' class='Estilo48'  onchange='concatena()' >
        <?php
            if ($lado=='') $selec='selected'; else $selec='';
            echo "<option value='' $selec>- Lado- </option>";
            if ($lado=='ladoa') $selec='selected'; else $selec='';
            echo "<option value='A' $selec>Lado A</option>";
            if ($lado=='ladob') $selec='selected'; else $selec='';
            echo "<option value='B' $selec>Lado B</option>";
            if ($lado=='ladox') $selec='selected'; else $selec='';
            echo "<option value='X' $selec>Lado X</option>";
            if ($lado=='ladoh') $selec='selected'; else $selec='';
            echo "<option value='H' $selec>Lado H</option>";
        ?>
	</select></td>
	<!--BASTIDOR-->
	<td><select name='bastidor' id='bastidor' class='Estilo48' class='Estilo48' onchange='concatena()' >
        <?php
	if ($bastidor=='') $selec='selected'; else $selec='';
	echo "<option value='' $selec>-Bastidor-</option>";
	if ($bastidor=='bastidor') $selec='selected'; else $selec='';
	for	($contador=0; $contador < 100; $contador++ )
	    {
		echo "<option value='$contador' $selec>$contador</option>";
		} 
	echo "</select>&nbsp;";
	//REPISA
//	echo "<select name='repisa1' id='repisa1' class='Estilo48' class='Estilo48'  onchange='concatena()' >";
//	if ($repisa1=='') $selec='selected'; else $selec='';
//	echo "<option value='' $selec>-Repisa-</option>";
//	if ($repisa1=='repisa1') $selec='selected'; else $selec='';
//	for	($contador=101; $contador < 10000; $contador++ )
//	{	
//	  // echo "<option value='0$contador' $selec>0$contador</option>";
//	   $contador=str_pad($contador,4,"0",STR_PAD_LEFT);
//	   $con= substr($contador,-2);	
//	   echo "<option value='$contador' $selec>$contador</option>";
//	   if($con==99)
//	   {$contador=$contador+1;}  
//
//	}
//	echo "</select></td>";  
echo "</tr>";


echo "<tr bordercolor='#CAE4FF' bgcolor='#CAE4FF'>";
		echo "<td class='Estilo42'>Ubicacion del Equipo (Piso.Sala.Grupo.Fila.Lado.Bastidor)&nbsp;</td>";
		echo "<td><input type='text' readonly name='ubicacion_demarcador1' id='ubicacion_demarcador1' size='19' maxlength='19'  ></td>";
		
echo "<td><input name='regresar' value='Enviar' type='button' onClick='opener.document.getElementById(\"$campo\").value=document.getElementById(\"ubicacion_demarcador1\").value;cerrar()'></td>";
echo "</tr>";


?>
    <script type="text/javascript">
        function concatena(){
            var piso = document.getElementById('piso').value;
            var sala = document.getElementById('sala').value;
            var grupo = document.getElementById('grupo').value;
            var fila = document.getElementById('fila').value;
            var lado = document.getElementById('lado').value;
            var bastidor = document.getElementById('bastidor').value;
            //var repisa1 = document.getElementById('repisa1').value;
            if(fila < 9){
                fila =0+document.getElementById('fila').value;
            }
            if(bastidor < 9){
                bastidor =0+document.getElementById('bastidor').value;
            }
            var ubicacion=piso+"."+sala+grupo+fila+lado+bastidor;
            document.getElementById('ubicacion_demarcador1').value=ubicacion;
        }
        function cerrar(){
            var ventana= window.self;
            ventana.opener=window.self;
            ventana.close();
        }
    </script>
</html>