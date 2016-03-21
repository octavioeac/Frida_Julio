<?php
$centrox=450;
$centroy = 450;
    $segemento=8;
$radio=400;
$div=360/$segemento;
for($i=0 ; $i<$segemento; $i++){
    $ang=deg2rad($div*$i);
    $coord_x=round($radio*cos($ang),5);
    $coord_y=round($radio*sin($ang),5);
    $pos_X=$coord_x+$centrox;
    $pos_Y=$coord_y+$centroy;
    	echo "<br>".$pos_X." , ".$pos_Y."<br>";
  $pos[$i]=array("x".$i.""=>$radio*cos($ang),"y".$i.""=>$radio*sin($ang));
	}
print_r($pos);