<?php
    include_once '../cab.inc.php';
    extract($_POST);
    
    $Sesion = new Conn();
    $usuario = $Sesion->getSesion();
    if ($usuario === FALSE){
        die("0");
    }
    
    switch ($action) {
        case 'loadAll':
            $Partidos = new Partidos();
            $result = $Partidos->getAll();
            $array = $Partidos->getDinamic();
            $tmp = 0;
            $html = "";
            foreach ($result as $value) {
                if ($tmp == 0){
                    setlocale(LC_ALL,"es_ES");
//                    echo strftime("%A %d de %B", strtotime($value->getFecha()));
                    $html .= "<h3>". ucfirst(strftime("%A %d de %B", strtotime($value->getFecha())))."</h3>";
                    $html .= "<div><p>";

                }

                $html .= "<div id='partido_{$value->getCodPartido()}'>";
                $html .= "<a href='#' onclick='verCriterios({$value->getCodPartido()}); return false' title='Hora: {$value->getHora()}'>";
                $html .= utf8_encode($value->getEquipos_CodEq1())." vs ";
                $html .= utf8_encode($value->getEquipos_CodEq2());
                $html .= "</a>";
                $html .= "</div>";

                $array[$value->getFecha()]--;
                
                if ($array[$value->getFecha()] == 0){
                    $html .= "</p></div>";
                }
                
                $tmp = $array[$value->getFecha()];
            }

            
            die($html);
            
            if($var === FALSE)
                die('No se pudo insertar el registro');
            
            die(utf8_encode('Creación exitosa'));
            break;

        case 'sesion':
            session_start();
            echo $_SESSION['usuario'];
            break;

        default:
            $n = new NickName();
            $class = $n->getByFilter(array('Nick'=>$nick, 'PWD'=>  md5($pass), 'Pago'=>'1'));
            if ($class===FALSE){
                die("Ud no existe");
            }

            session_start();
            $_SESSION['usuario'] = $class->getNick();
            die(TRUE);
            break;
}
    

    
?>