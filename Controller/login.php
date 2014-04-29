<?php
    include_once '../cab.inc.php';
    extract($_POST);
    
    switch ($action) {
        case 'save':
            $Sesion = new Conn();
//            $username = $Sesion->getSesion();
//            if ($username === FALSE){
//                die("0");
//            }
            $n = new NickName();
            $n->setNick($nick);
            $n->setPWD(md5($pass));
            $n->setID($iden);
            $var = $n->setNickName();
            if($var === FALSE)
                die('No se pudo insertar el registro');
            
            die(utf8_encode('Creación exitosa'));
            break;

        case 'sesion':
            $Sesion = new Conn();
            $username = $Sesion->getSesion();
            
            if ($username === FALSE){
                die("0");
            }
            
            $Pronosticos = new Pronosticos();
            $myArray = $Pronosticos->getAcumulado($username);
            
//            print_r($myArray);DIE();
//            $Pronosticos->getPronostico()
            
            echo $username.", tu puntaje es <b>".$myArray[0]->getPronostico()."</b>-------------------";
            break;
            
        case 'endSesion':
            session_start();
            session_destroy();

            die("1");
            break;

        default:
            
            $n = new NickName();
            $class = $n->getByFilter(array('Nick'=>$nick, 'PWD'=>  md5($pass), 'Pago'=>'1'));
            if ($class===FALSE){
                die("Ud no esta activo en el sistema");
            }

            session_start();
            $_SESSION['usuario'] = $class->getNick();
            die(TRUE);
            break;
}
    

    
?>