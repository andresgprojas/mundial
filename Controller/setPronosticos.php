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
    if ($rtaPartido->getAbierto()!='1'){
        die(utf8_encode('No se pueden cargar los pronósticos porque este partido ya fue cerrado'));
    }
    
    $rta = $Pronosticos->getByFilter(array('NickName_Nick'=>$usuario, 'Partidos_CodPartido'=>$_POST['idPartido']));
    
    if ($rta === FALSE){
        foreach ($_POST['Form'] as $idCriterio => $valor) {
            $Pronosticos->setNickName_Nick($usuario);
            $Pronosticos->setPartidos_CodPartido($_POST['idPartido']);
            $Pronosticos->setPuntos_CodPron($idCriterio);
            $Pronosticos->setPronostico($valor);
            $Pronosticos->setRegistro();
        }
    }
    else{
        foreach ($_POST['Form'] as $idCriterio => $valor) {
            $Pronosticos->setNickName_Nick($usuario);
            $Pronosticos->setPartidos_CodPartido($_POST['idPartido']);
            $Pronosticos->setPuntos_CodPron($idCriterio);
            $Pronosticos->setPronostico($valor);
            $Pronosticos->updateRegistro();
        }
    }    
    die('Pronosticos Cargados, que tengas muchas suerte');
?>