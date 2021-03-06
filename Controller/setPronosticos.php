<?php
    include_once '../cab.inc.php';
    
    $Sesion = new Conn();
    $usuario = $Sesion->getSesion();
    if ($usuario === FALSE){
        die("0");
    }
    $Pronosticos= new Pronosticos();
    $Partidos   = new Partidos();
    $rtaPartido = $Partidos->getByFilter(array('CodPartido'=>$_POST['idPartido']));
    
    $strTimePartido = strtotime($rtaPartido->getFecha()." ".$rtaPartido->getHora());
    $strTimeAhora   = strtotime('+10 minute', strtotime(date("Y-m-d H:i:s")));//cerrar 10 minutos antes
    
    if ($rtaPartido->getAbierto()!='1' || $strTimeAhora >= $strTimePartido){
        die(utf8_encode('Lo sentimos, pero no podemos cargar los pronůsticos para este partido porque ya esta cerrado'));
    }
    
    $rta = $Pronosticos->getByFilter(array('NickName_Nick'=>$usuario, 'Partidos_CodPartido'=>$_POST['idPartido']));
    
    if ($rta === FALSE){
        foreach ($_POST['Form'] as $idCriterio => $valor) {
            $Pronosticos->setNickName_Nick(($usuario));
            $Pronosticos->setPartidos_CodPartido(($_POST['idPartido']));
            $Pronosticos->setPuntos_CodPron(($idCriterio));
            $Pronosticos->setPronostico(($valor));
            $Pronosticos->setRegistro();
        }
    }
    else{
        foreach ($_POST['Form'] as $idCriterio => $valor) {
            $Pronosticos->setNickName_Nick(($usuario));
            $Pronosticos->setPartidos_CodPartido(($_POST['idPartido']));
            $Pronosticos->setPuntos_CodPron(($idCriterio));
            $Pronosticos->setPronostico(($valor));
            $Pronosticos->updateRegistro();
        }
    }    
    die('Pronosticos Cargados, que tengas mucha suerte');
?>