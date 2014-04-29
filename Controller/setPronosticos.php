<?php
    include_once '../cab.inc.php';
    
    $Sesion = new Conn();
    $usuario = $Sesion->getSesion();
    if ($usuario === FALSE){
        die("0");
    }
    $Pronosticos = new Pronosticos();
    
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