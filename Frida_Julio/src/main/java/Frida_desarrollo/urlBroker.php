<?php
	$deviceName = 			urlencode($_GET['deviceName']);
	$distributorDevice =            urlencode($_GET['distributorDevice']);
	$centralName = 			urlencode($_GET['centralName']);
	$portType = 			urlencode($_GET['portType']);
	$serviceName = 			urlencode($_GET['serviceName']);
	$serviceType = 			urlencode($_GET['serviceType']);
	$serviceClass = 		urlencode($_GET['serviceClass']);
	$noOfPort = 			str_replace(' ','',$_GET['noOfPort']);
	
include("http://10.105.59.73:8082/SenderARM/Servlet?deviceName=".$deviceName."&"."distributorDevice=".$distributorDevice."&centralName=".$centralName."&portType=".$portType."&serviceName=".$serviceName."&serviceType=".$serviceType."&serviceClass=".$serviceClass."&noOfPort=".$noOfPort);