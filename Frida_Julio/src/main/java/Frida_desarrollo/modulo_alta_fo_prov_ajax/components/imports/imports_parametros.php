<?php
class get_files_names{

        	public static function get_dir_files(){
			  //dirname(__FILE__);
			  $files = glob("modulo_alta_fo_prov/components/imports/clases/*.{php}", GLOB_BRACE);
               // $files = glob("imports/clases/*.{php}", GLOB_BRACE);
			   return $files;
     			}	
	
}

$array_files=get_files_names::get_dir_files();
$number=count($array_files);
for($i=0;$i<=($number-1);$i++){
    include($array_files[$i]);
	}

//$archivos_incluidos = get_included_files();
//print_r(get_declared_classes());
?>