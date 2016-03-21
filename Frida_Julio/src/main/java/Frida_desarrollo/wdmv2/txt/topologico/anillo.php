<?php

$segemento = $_GET['seg'];

$img = imagecreatetruecolor('900', '900');
$background = imagecolorallocate($img, 255, 255, 204);
imagefill($img, 0, 0, $background);

$blanco = imagecolorallocate($img, 255, 255, 255);
$rojo   = imagecolorallocate($img, 255,   0,   0);
$verde = imagecolorallocate($img,   0, 255,   0);
$azul  = imagecolorallocate($img,   0,   0, 255);

imagearc($img,450, 450, 800, 800, 0, 360, $rojo);
$wdm01 = imagecreatefrompng('source/wdmO.png');

$centrox=402;
$centroy = 410;
$radio=400;
$div=360/$segemento;

for($i=0 ; $i<$segemento; $i++){
    $ang=deg2rad($div*$i);
    $coord_x=round($radio*cos($ang),5);
    $coord_y=round($radio*sin($ang),5);
    $pos_X=$coord_x+$centrox;
    $pos_Y=$coord_y+$centroy;
    imagecopyresized($img,$wdm01,$pos_X,$pos_Y,0,0,96,80,96,80);
}

header("Content-type: image/png");
imagepng($img);

imagedestroy($img);