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
        
        $array = array();
        while($row = mysql_fetch_assoc($qry)){
            $myClass = new Resultados();
            $myClass->setPartidos_CodPartido($row['Partidos_CodPartido']);
            $myClass->setPuntos_CodPron($row['Puntos_CodPron']);
            $myClass->setResultado($row['Resultado']);
            array_push($array, $myClass);
        }
        
        $conn->cerrar();

        return $array;
    }

    public function setRegistro(){

        $conn = new Conn();
        $conn->conectar();
        
        $str = "INSERT INTO ".$this::Tabla." (Partidos_CodPartido, Puntos_CodPron, Resultado) VALUES ('{$this->getPartidos_CodPartido()}', '{$this->getPuntos_CodPron()}', '{$this->getResultado()}')";
        $qry = mysql_query($str);

        if ($qry === TRUE){
            $id = mysql_insert_id();
            $conn->cerrar();

            return TRUE;
        }
        
        return FALSE;
    }
    
    public function updateRegistro(){
        $conn = new Conn();
        $conn->conectar();
        $str = "UPDATE ".$this::Tabla." SET Resultado = '{$this->getResultado()}' WHERE Partidos_CodPartido = '{$this->getPartidos_CodPartido()}' AND Puntos_CodPron = '{$this->getPuntos_CodPron()}'";
        $qry = mysql_query($str);
        
        if ($qry === TRUE)
            return TRUE;
        
        return FALSE;
        
        $conn->cerrar();
    }

}

?>
