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
class Equipos {

    private $CodEq;
    private $NomEq;
    private $Grupo;
    const Tabla = "equipos";

    public function getCodEq() {
        return $this->CodEq;
    }

    public function setCodEq($CodEq) {
        $this->CodEq = $CodEq;
    }

    public function getNomEq() {
        return $this->NomEq;
    }

    public function setNomEq($NomEq) {
        $this->NomEq = $NomEq;
    }

    public function getGrupo() {
        return $this->Grupo;
    }

    public function setGrupo($Grupo) {
        $this->Grupo = $Grupo;
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
        $myClass = new Equipos();
        $myClass->setCodEq($row['CodEq']);
        $myClass->setGrupo($row['Grupo']);
        $myClass->setNomEq($row['NomEq']);
        
        $conn->cerrar();
        return $myClass;
    }



}

?>
