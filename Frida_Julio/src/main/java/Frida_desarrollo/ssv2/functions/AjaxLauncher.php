<?php
header('Content-Type: text/html;charset=utf-8');
include 'conexion.php';
include '../../perfiles.php';
function subquery($plan){
    $sq = array('',' AND plan=\'VDSL\'',' AND plan=\'FTTH\'');
    $c = preg_match('/VDSL/',$plan);
    if($c == 1){
        return $sq[$c];
        
    }
    $c = preg_match('/FTTH/',$plan);
    $c = $c == 1 ? 2 : 0;
    return $sq[$c];
}

function division($division,$plan){
    $div = array();
    $inx = $plan == 'Plan VDSL 2014 F1' ? 0 : 1;
    //"(SELECT division FROM cat_programa_vdsl WHERE division LIKE '%".$division."%' GROUP BY division ORDER BY division ASC)",
	$query = array(
        "(SELECT dir_div FROM centrales WHERE dir_div LIKE '%".$division."%' GROUP BY dir_div ORDER BY dir_div ASC)",
        "(SELECT dir_div FROM centrales WHERE dir_div LIKE '%".$division."%' GROUP BY dir_div ORDER BY dir_div ASC)"
    );
    $centrales = mysql_query($query[$inx]." UNION (SELECT sold FROM centrales WHERE sold != 'TELNOR' AND sold != '' GROUP BY sold)");
    for($i = 0; $i < mysql_num_rows($centrales); $i++){
        $cn = mysql_fetch_row($centrales);
        $div[] = $cn[0];
    }
    return json_encode($div);
}

function central($div,$plan){
    $regex = '/^SOLD (NORTE|SUR)$/';
    $x = preg_match($regex,$div);
    $centrales = array();
    $y = $plan == 'Plan 2015' ? 1 : 0;
    $query = array(
        //0 => 0 => "SELECT centrales.id_ctl,CONCAT(centrales.edificio,' - ',centrales.sigcent) ec FROM centrales,cat_programa_vdsl WHERE centrales.dir_div='".$div."' AND centrales.dir_div=cat_programa_vdsl.division AND centrales.sigcent=cat_programa_vdsl.siglas ORDER BY centrales.edificio ASC"
		array(
            "SELECT id_ctl,CONCAT(edificio,' - ',sigcent) ec FROM centrales WHERE dir_div='".$div."' ORDER BY edificio ASC",
            "SELECT id_ctl,CONCAT(edificio,' - ',sigcent) ec FROM centrales WHERE dir_div='".$div."' ORDER BY edificio ASC"
        ),
        array(
            "SELECT id_ctl,CONCAT(edificio,' - ',sigcent) ec FROM centrales WHERE sold = '".$div."' ORDER BY edificio ASC",
            "SELECT id_ctl,CONCAT(edificio,' - ',sigcent) ec FROM centrales WHERE sold = '".$div."' ORDER BY edificio ASC"
        )
    );
    $result = mysql_query($query[$x][$y]);
    for($i = 0; $i < mysql_num_rows($result); $i++){
        $d = mysql_fetch_array($result);
        $centrales[utf8_encode($d['ec'])] = $d['id_ctl'];
    }
    return json_encode($centrales);
}

function nombreEquipo($siglas){
    $datos = array();
    $query = "select nombre_oficial_pisa,siglas_central,tipo_equipo,ubicacion,clli_isam,fecha_operacion from isam_unica where siglas_central='".$siglas."' order by nombre_oficial_pisa";
    //$query = "select nombre_oficial_pisa,siglas_central,tipo_equipo,ubicacion,clli_isam,fecha_operacion from isam_unica where siglas_central='RO_' order by nombre_oficial_pisa";
    $result = mysql_query($query);
    $sz = mysql_num_rows($result);
    if($sz > 0){
        for($i = 0; $i < $sz; $i++){
            $d = mysql_fetch_array($result);
            $datos[$i] = $d['nombre_oficial_pisa'];
        }
    }  
    return json_encode($datos);
}

function tipoTarjeta($nomof,$sgl){
    $sgl = 'RO_';
    $data = array();
    $query = "SELECT cat_tarjetas_acceso.tipo_tarjeta FROM cat_tarjetas_acceso,isam_unica WHERE cat_tarjetas_acceso.tipo_equipo=isam_unica.tipo_equipo AND isam_unica.siglas_central='".$sgl."' AND isam_unica.nombre_oficial_pisa='".$nomof."' GROUP BY cat_tarjetas_acceso.tipo_tarjeta";
    $result = mysql_query($query);
    $sz = mysql_num_rows($result);
    if($sz > 0){
        for($i = 0; $i < $sz; $i++){
            $d = mysql_fetch_array($result);
            $data[$i] = $d['tipo_tarjeta'];
        }
    }
    return json_encode($data);
}

function datosSitio($central){
    $centrall = array();
    $query = "SELECT edificio,clli_edif,calle,num_ext,localidad,municipio,edo,c_p,latitud,longitud,siglas4,area FROM centrales WHERE id_ctl=".$central;
    $result = mysql_query($query);
    $sz = mysql_num_rows($result);
    if($sz > 0){
        $d = mysql_fetch_array($result);
        $centrall['nsitio'] = $d['edificio'];
        $centrall['siglas'] = $d['siglas4'];
        $centrall['area'] = $d['area'];
        $centrall['clli'] = $d['clli_edif'];
        $centrall['calle'] = $d['calle'];
        $centrall['numero'] = $d['num_ext'];
        $centrall['localidad'] = $d['localidad'];
        $centrall['ciudad'] = $d['municipio'];
        $centrall['estado'] = $d['edo'];
        $centrall['cp'] = $d['c_p'];
        $centrall['latitud'] = str_replace('&deg;','°',$d['latitud']);
        $centrall['longitud'] = '-'.str_replace('&deg;','°',$d['longitud']);
    }
    return json_encode($centrall);
}

function proveedor($rubro,$plan,$usuario){
 
    #Buscar empresa del login
    #$usrLog = "SELECT * FROM usuarios.seg_usuarios WHERE login = '".$usuario."'  AND empresa IN ('HUAWEI','ALCATEL-LUCENT');";
    $usrLog = "SELECT * FROM seg_usuarios WHERE login = '".$usuario."'  AND empresa IN ('HUAWEI','ALCATEL-LUCENT');";
    $sqlLog = mysql_query($usrLog);
    @$numLog = mysql_num_rows($sqlLog);
    if($numLog > 0){
        while($rLog = mysql_fetch_array($sqlLog)){
            $emp = $rLog['empresa'];
        }
        $whrProv = " AND proveedor = '$emp'";
    }else{
        $whrProv  = "";
    }

    $proveedor = array();
    $seq = subquery($plan);
    $query = "SELECT proveedor from ztecnologias WHERE rubro='".$rubro."'".$seq.$whrProv."  GROUP BY proveedor";
    $result = mysql_query($query);
    $sz = mysql_num_rows($result);
    if($sz > 0){
        for($i = 0; $i < $sz; $i++){
            $d = mysql_fetch_array($result);
            $proveedor[$i] = $d['proveedor'];
        }
    }
    return json_encode($proveedor);
}
function proveedorinfra($provinfra){
        $proveinfra = array();
        $query     = "SELECT DISTINCT NOMBRE FROM inversion.proveedores WHERE PROVE_INFRA = 'SI'";
        $result    = mysql_query($query);
        $pi        = mysql_num_rows($result);
        if($pi > 0){
            for($i = 0 ; $i<$pi ; $i++){
                $gpi = mysql_fetch_array($result);
                $proveinfra[$i] = trim($gpi['NOMBRE']);
            }
        }

    return json_encode($proveinfra);       
}

function tecnologia($proveedor,$rubro,$plan){
    $tecnologia = array();
    $seq = subquery($plan);
    $query = "SELECT tecnologia from ztecnologias WHERE rubro='".$rubro."' AND proveedor='".$proveedor."'".$seq." GROUP BY tecnologia";
    $result = mysql_query($query);
    $sz = mysql_num_rows($result);
    if($sz > 0){
        for($i = 0; $i < $sz; $i++){
            $d = mysql_fetch_array($result);
            $tecnologia[$i] = $d['tecnologia'];
        }
    }
    return json_encode($tecnologia);
}

function modelo($rubro,$proveedor,$tecnologia,$plan){
    $modelos = array();
    $seq = subquery($plan);
    $query = "SELECT id,tipo_equipo FROM ztecnologias WHERE rubro='".$rubro."' AND proveedor='".$proveedor."' AND tecnologia='".$tecnologia."'".$seq." GROUP BY tipo_equipo";
    $result = mysql_query($query);
    $sz = mysql_num_rows($result);
    if($sz > 0){
        for($i = 0; $i < $sz; $i++){
            $d = mysql_fetch_array($result);
            $modelos[$d['id']] = $d['tipo_equipo'];
        }
    }
    return json_encode($modelos);
}

function claseRepisa($rubro,$proveedor,$tecnologia,$modelo,$plan){
    $clase_repisa = array();
    $seq = subquery($plan);
    $query = "SELECT clase_repisa FROM ztecnologias WHERE rubro='".$rubro."' AND proveedor='".$proveedor."' AND tecnologia='".$tecnologia."' AND tipo_equipo='".$modelo."'".$seq." GROUP BY clase_repisa";
    $result = mysql_query($query);
    $sz = mysql_num_rows($result);
    if($sz > 0){
        for($i = 0; $i < $sz; $i++){
            $d = mysql_fetch_array($result);
            $clase_repisa[$i] = $d['clase_repisa'];
        }
    }
    return json_encode($clase_repisa);
}

function codigoRepisa($rubro,$proveedor,$tecnologia,$modelo,$claseRepisa,$plan){
    $codigo_repisa = array();
    $seq = subquery($plan);
    $query = "SELECT tipo_tarjeta,cod_tarjeta FROM ztecnologias WHERE rubro='".$rubro."' AND proveedor='".$proveedor."' AND tecnologia='".$tecnologia."' AND tipo_equipo='".$modelo."' AND clase_repisa='".$claseRepisa."'".$seq." GROUP BY cod_tarjeta";
    $result = mysql_query($query);
    $sz = mysql_num_rows($result);
    if($sz > 0){
        for($i = 0; $i < $sz; $i++){
            $d = mysql_fetch_array($result);
            $codigo_repisa[$d['cod_tarjeta']] = $d['tipo_tarjeta'];
        }
    }
    return json_encode($codigo_repisa);
}

function getNomof($siglas,$cr){
    $nomof = array();
    $query = "SELECT isam_unica.nombre_oficial_pisa,isam_unica.clase_repisa,isam_unica.tipo_equipo_oficial,ztecnologias.puertos_tarjeta,ztecnologias.tarjetas_max FROM isam_unica,ztecnologias WHERE isam_unica.siglas_central='".$siglas."' AND ztecnologias.clase_repisa='".$cr."' AND isam_unica.clase_repisa=ztecnologias.clase_repisa AND ztecnologias.tipo_equipo=isam_unica.tipo_equipo_oficial GROUP BY isam_unica.nombre_oficial_pisa ORDER BY isam_unica.nombre_oficial_pisa";
    $result = mysql_query($query);
    $sz = mysql_num_rows($result);
    if($sz > 0){
        for($i = 0; $i < $sz; $i++){
            $nomof[$i] = mysql_fetch_row($result);
        }
    }
    return json_encode($nomof);
}

function codTarjeta($modelo,$repisa){
    $cod_tarjeta = array();
    $query = "SELECT cod_tarjeta FROM ztecnologias where clase_repisa='".$repisa."' AND tipo_equipo='".$modelo."' GROUP BY cod_tarjeta";
    $result = mysql_query($query);
    $sz = mysql_num_rows($result);
    if($sz > 0){
        for($i = 0; $i < $sz; $i++){
            $d = mysql_fetch_array($result);
            $cod_tarjeta[$i] = $d['cod_tarjeta'];
        }
    }
    return json_encode($cod_tarjeta);
}

function infPuertos($rubro_,$proveedor_,$tecnologia_,$tipoEquipo_,$claseRepisa_,$codTarjeta_){
    $infPtos;
    $query = "SELECT puertos_tarjeta,tarjetas_max,(puertos_tarjeta * tarjetas_max) total FROM ztecnologias WHERE rubro='".$rubro_."' AND proveedor='".$proveedor_."' AND tecnologia='".$tecnologia_."' AND tipo_equipo='".$tipoEquipo_."' AND clase_repisa='".$claseRepisa_."' AND cod_tarjeta = '".$codTarjeta_."' GROUP BY cod_tarjeta";
    $result = mysql_query($query);
    $sz = mysql_num_rows($result);
    if($sz > 0){
        for($i = 0; $i < $sz; $i++){
            $infPtos = $d = mysql_fetch_row($result);
        }
    }
    return json_encode($infPtos);
}

if($division){
    $division = $_POST['division'];
    $plan = $_POST['plan'];
    echo division($division,$plan);
}
else if($div){
    $div = $_POST['div'];
    $plan = $_POST['plan'];
    echo central($div,$plan);
}
else if($siglas){
    $siglas = $_POST['siglas'];
    echo nombreEquipo($siglas);
}
else if($nomof){
    $nomof = $_POST['nomof'];
    $sgl = $_POST['sgl'];
    echo tipoTarjeta($nomof,$sgl);
}
else if($central){
    $central = $_POST['central'];
    echo datosSitio($central);
}
else if($rubro){
    $rubro = $_POST['rubro'];
    $plan = $_POST['plan'];
    $usrL = $sess_usr;
    echo proveedor($rubro,$plan,$usrL);
}
else if($proveedor){
    $rbr = $_POST['rbr'];
    $proveedor = $_POST['proveedor'];
    $plan = $_POST['plan'];
    echo tecnologia($proveedor,$rbr,$plan);
}
else if($tecnologia){
    $r = $_POST['r'];
    $prov = $_POST['prov'];
    $tecnologia = $_POST['tecnologia'];
    $plan = $_POST['plan'];
    echo modelo($r,$prov,$tecnologia,$plan);
}
else if($modelo){
    $rb = $_POST['rb'];
    $prove = $_POST['prove'];
    $tec = $_POST['tec'];
    $modelo = $_POST['modelo'];
    $plan = $_POST['plan'];
    echo claseRepisa($rb,$prove,$tec,$modelo,$plan);
}
else if ($claseRepisa){
    $gaan = $_POST['gaan'];
    $verskaffer = $_POST['verskaffer'];
    $tegnologie = $_POST['tegnologie'];
    $model = $_POST['model'];
    $claseRepisa = $_POST['claseRepisa'];
    $plan = $_POST['plan'];
    echo codigoRepisa($gaan,$verskaffer,$tegnologie,$model,$claseRepisa,$plan);
}
else if($SiglasCentral){
    $SiglasCentral = $_POST['SiglasCentral'];
    $cr = $_POST['cr'];
    echo getNomof($SiglasCentral,$cr);
}
else if($clRps){
    $clRps = $_POST['clRps'];
    $mdl = $_POST['mdl'];
    echo codTarjeta($mdl, $clRps);
}
else if($codTarjeta_){
    $rubro_ = $_POST['rubro_'];
    $proveedor_ = $_POST['proveedor_'];
    $tecnologia_ = $_POST['tecnologia_'];
    $tipoEquipo_ = $_POST['tipoEquipo_'];
    $claseRepisa_ = $_POST['claseRepisa_'];
    $codTarjeta_ = $_POST['codTarjeta_'];
    echo infPuertos($rubro_,$proveedor_,$tecnologia_,$tipoEquipo_,$claseRepisa_,$codTarjeta_);
}
else if($provinfra){
    $provinfra = $_POST['provinfra'];
    echo proveedorinfra($provinfra);
}