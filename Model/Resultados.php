<?php
require_once '../cab.inc.php';


/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NickName
 *
 * @author andresprojas
 */
class Resultados {

    private $Partidos_CodPartido;
    private $Puntos_CodPron;
    private $Resultado;
    const Tabla = "resultados";


    public function getPartidos_CodPartido() {
        return $this->Partidos_CodPartido;
    }

    public function setPartidos_CodPartido($Partidos_CodPartido) {
        $this->Partidos_CodPartido = $Partidos_CodPartido;
    }

    public function getPuntos_CodPron() {
        return $this->Puntos_CodPron;
    }

    public function setPuntos_CodPron($Puntos_CodPron) {
        $this->Puntos_CodPron = $Puntos_CodPron;
    }

    public function getResultado() {
        return $this->Resultado;
    }

    public function setResultado($Resultado) {
        $this->Resultado = $Resultado;
    }

        
    public function getByFilter($filtro = array()){
        $conn = new Conn();
        $conn->conectar();
        $filter = "WHERE ";
        foreach ($filtro as $key => $value) {
            $filter .= "{$key} = '{$value}' AND ";
        }
        $filter = substr($filter, 0, -4);
        
        $str = "SELECT * FROM ".$this::Tabla." {$filter}";
        $qry = mysql_query($str) or die(mysql_error());
        
        if (mysql_num_rows($qry)==0)
            return FALSE;
        
        $row = mysql_fetch_assoc($qry);
        $myClass = new Resultados();
        $myClass->setPartidos_CodPartido($row['Partidos_CodPartido']);
        $myClass->setPuntos_CodPron($row['Puntos_CodPron']);
        $myClass->setResultado($row['Resultado']);
        
        $conn->cerrar();

        return $myClass;
    }



}

?>
