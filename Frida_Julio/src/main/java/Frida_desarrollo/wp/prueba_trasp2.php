<?php
//header ("Content-type:image/png");
//include('../conexion.php');
putenv('GDFONTPATH=' . realpath('.'));

$ref_sisa_a=$_REQUEST['ref_sisa_a'];

function procesaPalabra($cadena){
    $inicioConteo=$contador=0;
    $resultado = array();
    for($i = 0; $i <= ceil(strlen($cadena) / 17) + 1; $i++){
        $primerSubcadena = substr($cadena, $inicioConteo, 17);
        $posicionEspacio = strripos($primerSubcadena,' ');
        $posicionEspacio != 0 ? $segundaSubcadena = substr($cadena,$inicioConteo,$posicionEspacio) : $segundaSubcadena = substr($cadena,$inicioConteo,17);
        if($segundaSubcadena != '') $resultado[$contador] = trim($segundaSubcadena);
        $contador++;
        $i == 0 ? $inicioConteo = strlen($segundaSubcadena) : $inicioConteo += strlen($segundaSubcadena);
    }
    return $resultado;
}

function texto($handle,$texto,$fuente,$color,$x,$y){
    $y-=15;
    $c = 0;
    $mx = count($texto);
    for($i = 0; $i < $mx; $i++){
        if($texto[$i] != ''){
            if(strlen($texto[$i]) > 17){
                $subtxt = procesaPalabra($texto[$i]);
                for($j = 0; $j < count($subtxt); $j++){
                    imagettftext($handle,8,0,$x,$y,$color[$c],$fuente,$subtxt[$j]);
                    $y+=15;
                }
            }
            else{
                imagettftext($handle,8,0,$x,$y,$color[$c],$fuente,$texto[$i]);
                $y+=15;
            }
            if($c < 7)  $c++;
            else        $c = 2;
        }
    }
}


$sql_img=mysql_query("SELECT consecutivo, tipo_trayec, central_a, ubicaciona, fibra_a, fibra_b, tipo_trab1, tipo_conector_a, central_b, ubicacionb, fibra_a2, fibra_b2, tipo_trab2, tipo_conector_b, proveedor, longitud, pedido45 FROM inventario_bdfo WHERE ref_sisa='".$ref_sisa_a."' ORDER BY consecutivo ASC");
//topologico crea el contenedor de la imagen
$topologico  = imagecreatetruecolor (1500,1100) or die ("No fue posible crear la imagen.");

//relleno tiene el color de fondo(amarillo)
$relleno = imagecolorallocate($topologico, 255, 255, 204);

//imagefill es la función que te coloca $relleno como color de fondo en $topologico
imagefill($topologico, 0, 0, $relleno);



$linea = imagecreate(200,2);

$color = array(
        imagecolorallocate($topologico,0,0,0),//NEG
        imagecolorallocate($topologico,255,255,200),//AMARILLO
        imagecolorallocate($topologico,4,151,3),//VERDE
        imagecolorallocate($topologico,204,0,0),//ROJO    
        imagecolorallocate($topologico,102,4,254),//AZUL FUERTE
        imagecolorallocate($topologico,53,151,254),//AZUL CLARO
        imagecolorallocate($topologico,255,32,151),//ROSA
        imagecolorallocate($topologico,0,0,255)//AZUL MÀS FUERTE
    );



#COLOCAR CAJA
//declaras imagen
$traspaso = imagecreatefrompng('wp/img/traspaso.PNG');

$fuente = 'wp/font/arial.ttf';

$y1=150;
$x1=0;

$y2=190;
$x2=160;

$cont=0;

$total=mysql_num_rows($sql_img);
//Guarda resultados de consulta
$i=0;

while($row = mysql_fetch_array($sql_img))
{
		$info_img[$i][0]=$row['consecutivo'];
		$info_img[$i][1]=$row['tipo_trayec'];
		$info_img[$i][2]=$row['central_a'];
		$info_img[$i][3]=$row['ubicaciona'];
		$info_img[$i][4]=$row['fibra_a'];
		$info_img[$i][5]=$row['fibra_a2'];
		$info_img[$i][6]=$row['tipo_trab1'];
		$info_img[$i][7]=$row['tipo_conector_a'];
		$info_img[$i][8]=$row['central_b'];
		$info_img[$i][9]=$row['ubicacionb'];
		$info_img[$i][10]=$row['fibra_b'];
		$info_img[$i][11]=$row['fibra_b2'];
		$info_img[$i][12]=$row['tipo_trab2'];
		$info_img[$i][13]=$row['tipo_conector_b'];
		$info_img[$i][14]=$row['proveedor'];
		$info_img[$i][15]=$row['longitud'];
		$info_img[$i][16]=$row['pedido45'];
		$i=$i+1;
}

for($i=0;$i<$total;$i++)
{
	$ubi_val=substr($info_img[$i][9], 0, -5);
	do
	{
			
				$cont_val=0;
				
				for($j=0;$j<$total;$j++)
				{
						$ubi_val2 = substr($info_img[$j][3], 0, -5); 
						if($ubi_val==$ubi_val2 && $info_img[$j][1]==$info_img[$i][1]) 
						{
							
							$guarda_sig[$i].=",".$info_img[$j][0];
							$info_img[$j][17]=$info_img[$i][0];//Bandera que indica que continua despues  de otra
							$ubi_val=substr($info_img[$j][9], 0, -5);
						}
						else
						{
							$val_img='OK';
						}
						
				}
				
	}while($val_img!='OK');
}


$x=0;
$y=0;
$cont=0;
do
{

		$c1=$c2=0;
		
		for($i=0;$i<$total;$i++)
		{
			$c1=$c1+1;
			if($guarda_posicion[$i]!='') $c2=$c2+1;
		}

		if($c1==$c2) $completo='OK';
		for($i=0;$i<$total;$i++)
		{
			
			if($info_img[$i][17]=='' && $guarda_posicion[$i]=='')
			{
				$x=30;
				$y=$y+130;
				$guarda_posicion[$i]=$x.",".$y;
				$cont=$cont+1;//Contador de traspasos anteriores (sin ramas)
			}
			
			else
			{
				$v=$info_img[$i][17];
				if($guarda_posicion[$v]!='')
				{
					$xy=explode(",",$guarda_posicion[$v]);
					$x=$xy[0]+324;
					$y=$xy[1];
					$guarda_posicion[$i]=$x.",".$y;
				}
				
			}
			/*else
			{
				$sig=explode(",".$guarda_sig[$i]);
				for()
			}*/
		}
}while($completo!='OK');


for($i=0;$i<$total;$i++)
{
		$xy=explode(",",$guarda_posicion[$i]);
		
		imagecopyresized($topologico,$traspaso,$xy[0],$xy[1],0,0,62,100,139,238);//CuadroA
		imagettftext($topologico,8,0,$xy[0],($xy[1]+110),$color[0],$fuente,$info_img[$i][3]);//ubicacionA
					
		//F1a-F2a
		imagettftext($topologico,8,0,($xy[0]+62),($xy[1]+30),$color[0],$fuente,$info_img[$i][4]);
		imagettftext($topologico,8,0,($xy[0]+250),($xy[1]+30),$color[0],$fuente,$info_img[$i][10]);
		imagecopyresized($topologico,$linea,($xy[0]+62),($xy[1]+30),0,0,200,2,200,2);
		
		//F1b-F2b
		imagettftext($topologico,8,0,($xy[0]+62),($xy[1]+50),$color[0],$fuente,$info_img[$i][5]);
		imagettftext($topologico,8,0,($xy[0]+250),($xy[1]+50),$color[0],$fuente,$info_img[$i][11]);
		imagecopyresized($topologico,$linea,($xy[0]+62),($xy[1]+50),0,0,200,2,200,2);
					
		imagecopyresized($topologico,$traspaso,($xy[0]+262),$xy[1],0,0,62,100,139,238);//CuadroB
		imagettftext($topologico,8,0,($xy[0]+262),($xy[1]+110),$color[0],$fuente,$info_img[$i][9]);//ubicacionB
					
}



//Tablilla
$y1=$y+180;

//imagettftext($topologico,8,0,0,$y1,$color[0],$fuente,'Consecutivo');
imagettftext($topologico,8,0,50,$y1,$color[0],$fuente,'Tipo trayecto');
imagettftext($topologico,8,0,185,$y1,$color[0],$fuente,'Central A');
imagettftext($topologico,8,0,320,$y1,$color[0],$fuente,'Ubicacion A');
imagettftext($topologico,8,0,455,$y1,$color[0],$fuente,'F1,F2/Puertos');
imagettftext($topologico,8,0,555,$y1,$color[0],$fuente,'Tipo de trabajo');
imagettftext($topologico,8,0,655,$y1,$color[0],$fuente,'Tipo conec.');
imagettftext($topologico,8,0,705,$y1,$color[0],$fuente,'Central B');
imagettftext($topologico,8,0,840,$y1,$color[0],$fuente,'Ubicacion B');
imagettftext($topologico,8,0,975,$y1,$color[0],$fuente,'F1,F2/Puertos');
imagettftext($topologico,8,0,1075,$y1,$color[0],$fuente,'Tipo trabajo');
imagettftext($topologico,8,0,1175,$y1,$color[0],$fuente,'Tipo conec.');
imagettftext($topologico,8,0,1225,$y1,$color[0],$fuente,'Proveedor');
imagettftext($topologico,8,0,1325,$y1,$color[0],$fuente,'Longitud');
imagettftext($topologico,8,0,1375,$y1,$color[0],$fuente,'Pedido');

for($i=0;$i<$total;$i++)
{

		$y1=$y1+30;
		for($j=0;$j<17;$j++)
		{
			if($j==0) $x1=0; elseif($j==1 || $j==5 || $j==8 || $j==12 || $j==6 || $j==14 || $j==11 || $j==16 )$x1=$x1+50; elseif($j==7 || $j==13 || $j==15) $x1=$x1+100; else $x1=$x1+135;
			imagettftext($topologico,8,0,$x1,$y1,$color[0],$fuente,mysql_result($sql_img,$i,$j));
		}
}





//Dar salida a la imagen
$ruta = 'traspaso.png';

//Solo mostrar
//imagepng($topologico);

//Guardar
imagepng($topologico,$ruta);
imagedestroy($topologico);
echo '<html><body>';
echo '<img src="'.$ruta.'" alt="traspaso"/>';
echo '</body></html>';
?>
