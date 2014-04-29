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
class Puntos {

    private $CodPron;
    private $NomPron;
    private $ReglaPron;
    private $Puntos;
    private $Valores;
    const Tabla = "Puntos";


    public function getCodPron() {
        return $this->CodPron;
    }

    public function setCodPron($CodPron) {
        $this->CodPron = $CodPron;
    }

    public function getNomPron() {
        return $this->NomPron;
    }

    public function setNomPron($NomPron) {
        $this->NomPron = $NomPron;
    }

    public function getReglaPron() {
        return $this->ReglaPron;
    }

    public function setReglaPron($ReglaPron) {
        $this->ReglaPron = $ReglaPron;
    }

    public function getPuntos() {
        return $this->Puntos;
    }

    public function setPuntos($Puntos) {
        $this->Puntos = $Puntos;
    }

    public function getValores() {
        return $this->Valores;
    }

    public function setValores($Valores) {
        $this->Valores = $Valores;
    }

    
        
    public function getAll(){
        $conn = new Conn();
        $conn->conectar();
//        $filter = "WHERE ";
//        foreach ($filtro as $key => $value) {
//            $filter .= "{$key} = '{$value}' AND ";
//        }
//        $filter = substr($filter, 0, -4);
        
        $str = "SELECT * FROM ".$this::Tabla;
        $qry = mysql_query($str) or die(mysql_error());
        
        if (mysql_num_rows($qry)==0)
            return FALSE;
        
        $array = array();
        while($row = mysql_fetch_assoc($qry)){
            $myClass = new Puntos();
            $myClass->setCodPron($row['CodPron']);
            $myClass->setNomPron($row['NomPron']);
            $myClass->setPuntos($row['Puntos']);
            $myClass->setReglaPron($row['ReglaPron']);
            $myClass->setValores($row['Valores']);
            
            array_push($array, $myClass);
        }
        
        $conn->cerrar();
        return $array;
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
            $myClass = new Puntos();
            $myClass->setCodPron($row['CodPron']);
            $myClass->setNomPron($row['NomPron']);
            $myClass->setPuntos($row['Puntos']);
            $myClass->setReglaPron($row['ReglaPron']);
            $myClass->setValores($row['Valores']);
            
            array_push($array, $myClass);
        }
        
        $conn->cerrar();
        return $array;
    }



}

?>
