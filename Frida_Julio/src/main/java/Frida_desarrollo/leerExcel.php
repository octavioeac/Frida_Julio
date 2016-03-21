<?php
    set_time_limit(3600);
    include 'excel_reader/reader.php';
    include "conexio2.php"; 
    $data;
    $excel = new Spreadsheet_Excel_Reader();
    $excel->read('prueba.xlsx');
    $x = 1;
    while($x <= $excel->sheets[0]['numRows']){
        $y = 2;
        while($y <= $excel->sheets[0]['numCols']){
            $data[$x-1][$y-1] = isset($excel->sheets[0]['cells'][$x][$y]) ? $excel->sheets[0]['cells'][$x][$y] : NULL;
            $y++;
        }
        $x++;
    }
    
	foreach($valores as $valor){
	echo '<pre>';
    //print_r($data);
	 echo '</pre>';
	echo "hola".$valor[0];
		
		}