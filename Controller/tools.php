<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_once '../cab.inc.php';
extract($_POST);
switch ($action) {
    case 'acum':
        $n = new NickName();
        echo '$ ' . number_format($n->getActivos() * 500000);
        break;
        
    case 'rest':
        $n = new Partidos();
        echo $n->getRest() . ' Dias';
        break;
}
?>
