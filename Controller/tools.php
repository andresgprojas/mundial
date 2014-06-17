<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if (isset($_GET)) {//generar reportes
    if (count($_GET) > 0 && $_GET['obtener'] == '1') {

        require_once '../cab.inc.php';

        $n = new Partidos();
        $idPartido = $n->getRest(TRUE);
        $Pronostico = new Pronosticos();
        $rta = $Pronostico->getReporte($idPartido);

        $csv_end = "\n";
        $csv_sep = ";";
        $csv_file = "../View/Archivos/" . $idPartido."_".$rta[0]->getPartidos_CodPartido() . ".csv";
        $csv = "";


        foreach ($rta as $pron) {
            $csv.=$pron->getNickName_Nick() . $csv_sep . $pron->getPartidos_CodPartido() . $csv_sep . $pron->getPuntos_CodPron().": ". $pron->getPronostico() . $csv_sep . $csv_end;
        }
        if (!$handle = fopen($csv_file, "w")) {
            echo "No se puede abrir el archivo";
            exit;
        }
        if (fwrite($handle, utf8_decode($csv)) === FALSE) {
            echo "No se puede escribir en el archivo";
            exit;
        }

        fclose($handle);
        die('archivo creado');
    }
}

include_once '../cab.inc.php';
extract($_POST);
switch ($action) {
    case 'acum':
        $n = new NickName();
        echo '$ ' . number_format($n->getActivos() * 50000);
        break;

    case 'rest':
        $n = new Partidos();
        echo $n->getRest();
        break;

    case 'archivos':
        $directorio = opendir("../View/Archivos/"); //ruta actual
        $html = "";
        $array = array();
        while ($archivo = readdir($directorio)) { //obtenemos un archivo y luego otro sucesivamente
            if (!is_dir($archivo)) {//verificamos si es o no un directorio
                $array[(substr($archivo, 0, -4))] = $archivo;
            }
        }
        ksort($array);
        foreach ($array as $key => $value) {
            $html .= "<li><a href='../View/Archivos/$value'>" . $key . "</a><li>";
        }
        echo $html;
        break;
}
?>
