<?php
    include_once '../cab.inc.php';
    
    $Sesion = new Conn();
    $usuario = $Sesion->getSesion();
    $Nickname = new NickName();
    $id = $Nickname->getByFilter(array('Nick'=>$usuario));
    
    if ($usuario === FALSE || ($id === FALSE || ($id->getId() != '1026262467' && $id->getId() != '74085361' && $id->getId() != '80238729'))) {//agregar el id de Alan y Anderson
        die("0");
    }

    $Resultados = new Resultados();
    $Partidos   = new Partidos();
    if (isset($_POST['cerrado'])){
        if($_POST['cerrado'] == 'TRUE'){
            $Nickname = new Partidos();
            $Nickname->cerrar($_POST['idPartido'], TRUE);
        }
        
    }else{
        $Nickname = new Partidos();
        $Nickname->cerrar($_POST['idPartido']);
    }
    
    $rtaPartido = $Partidos->getByFilter(array('CodPartido'=>$_POST['idPartido']));
    
    $rta = $Resultados->getByFilter(array('Partidos_CodPartido'=>$_POST['idPartido']));
    
    if ($rta === FALSE){
        foreach ($_POST['Form'] as $idCriterio => $valor) {
            $Resultados->setPuntos_CodPron($idCriterio);
            $Resultados->setPartidos_CodPartido($_POST['idPartido']);
            $Resultados->setResultado($valor);
            $Resultados->setRegistro();
        }
    }
    else{
        foreach ($_POST['Form'] as $idCriterio => $valor) {
            $Resultados->setPuntos_CodPron($idCriterio);
            $Resultados->setPartidos_CodPartido($_POST['idPartido']);
            $Resultados->setResultado($valor);
            $Resultados->updateRegistro();
        }
    }    
    die('Se han cargado los resultados');
?>