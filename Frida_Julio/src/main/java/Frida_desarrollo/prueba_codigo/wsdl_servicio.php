<?php
$wsdl="http://10.192.2.74:8082/infofrida/webservices/sistemaFridaRedTroncal?wsdl";
$objetos=array(
"objeto_0"=>"D32-0708-0515",
"objeto_1"=>"D32-0708-0515",
"objeto_2"=>"C03-1401-0012",
"objeto_3"=>"A32-1310-0025",
"objeto_4"=>"C00-1306-0007",
"objeto_5"=>"C00-1306-0009",
"objeto_6"=>"C00-1306-0009",
"objeto_7"=>"C00-1403-0001",
"objeto_8"=>"C00-1403-0004",
"objeto_9"=>"C01-1301-0030",
"objeto_10"=>"C01-1302-0018",
"objeto_11"=>"C01-1303-0015",
"objeto_12"=>"C01-1303-0015",
"objeto_13"=>"C01-1305-0079",
"objeto_14"=>"C01-1306-0006",
"objeto_15"=>"C01-1402-0082",
"objeto_16"=>"C01-1403-0058",
"objeto_17"=>"C02-1304-0019",
"objeto_18"=>"C03-1401-0012",
"objeto_19"=>"C03-1401-0013",
"objeto_20"=>"C03-1401-0014",
"objeto_21"=>"C03-1401-0016",
"objeto_22"=>"C03-1401-0017",
"objeto_23"=>"C03-1401-0018",
"objeto_24"=>"C05-1407-0001",
"objeto_25"=>"CB4-1308-0020",
"objeto_26"=>"CB4-1308-0020",
"objeto_27"=>"D32-0708-0515",
"objeto_28"=>"F10-0704-0012",
"objeto_29"=>"F10-1202-0055",
"objeto_30"=>"F10-1204-0054",
"objeto_31"=>"F10-1205-0024",
"objeto_32"=>"F10-1205-0115",
"objeto_33"=>"F10-1206-0078",
"objeto_34"=>"F10-1206-0135",
"objeto_35"=>"F10-1206-0135",
"objeto_36"=>"F10-1206-0154",
"objeto_37"=>"F20-1205-0038",
"objeto_38"=>"FB4-1205-0106"
);

class prueba_wsdl {
	public static function wsdl($ref_sisa,$wsdl){
	                 	 try {
							       $ref_sisa_1="FB4-1205-0106";
								   echo $wsdl;
								   $cliente= new SoapClient( $wsdl);
                  				   //$cliente= new SoapClient( $wsdl,array('cache_wsdl' => WSDL_CACHE_NONE,'trace' => TRUE) );                               
								  /*   $para=array(
								    "bastRemate"=>"hola");
									
								    print "<pre>";var_dump($client->__getFunctions()); print "<pre>";
								   print "<pre>"; var_dump($client->__getTypes());print "<pre>";
                                      
								   echo $ref_sisa;*/
								   $parameters=array(
								      "referenciaSisa"=>"FB4-1205-0106");
                                     
									 var_dump($parameters);
								   $result=$cliente->ConsultaReferenciaSisa($parameters['referenciaSisa']);
								   var_dump($result);
	   								} 
									catch ( SoapFault $fault ) {

					        		}
	                     }

     public static function wsd_2($wsdl){
		 try {
    $client = new SoapClient($wsdl,array('cache_wsdl' => WSDL_CACHE_NONE,'trace' => TRUE));
   $ref_sisa="FB4-1205-0106";
     print "<pre>"; print_r($client); print "<pre>";


    var_dump($ready); //Verificar si hay resultado
} catch (Exception $e) {
    //trigger_error($e->getMessage(), E_USER_WARNING);
	echo $e->getMessage();
} 
}
	 
	                  


 }
 
// prueba_wsdl::wsd_2($wsdl);
prueba_wsdl::wsdl($objetos["objeto_1"],$wsdl);							
                                    $num=1; 
                                   //$num=count($objetos);
/*                                   for($i=0;$i<=$num;$i++)
								   {
                                   $hola=prueba_wsdl::wsdl($objetos["objeto_".$i],$wsdl);							
								   echo $hola;
								   }
*/ ?>