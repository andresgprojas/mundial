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
class NickName {

    private $Nick;
    private $ID;
    private $PWD;
    private $Pago;
    const Tabla = "nickname";
    


    public function getNick() {
        return $this->Nick;
    }

    public function setNick($Nick) {
        $this->Nick = $Nick;
    }

    public function getID() {
        return $this->ID;
    }

    public function setID($ID) {
        $this->ID = $ID;
    }

    public function getPWD() {
        return $this->PWD;
    }

    public function setPWD($PWD) {
        $this->PWD = $PWD;
    }

    public function getPago() {
        return $this->Pago;
    }

    public function setPago($Pago) {
        $this->Pago = $Pago;
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
        $qry = mysql_query($str);
        
        if (mysql_num_rows($qry)==0)
            return FALSE;
        
        $row = mysql_fetch_assoc($qry);
        $myClass = new NickName();
        $myClass->setID($row['ID']);
        $myClass->setNick($row['Nick']);
        $myClass->setPWD($row['PWD']);
        $myClass->setPago($row['Pago']);
        
        $conn->cerrar();
        return $myClass;
    }
    
    /**
     * Guardar un usuario en la base de datos
     */
    public function setNickName(){

        $conn = new Conn();
        $conn->conectar();
        
        $str = "INSERT INTO ".$this::Tabla." (Nick, PWD, ID) VALUES ('{$this->Nick}', '{$this->PWD}', '{$this->ID}')";
        $qry = mysql_query($str);

        if ($qry === TRUE){
            $id = mysql_insert_id();
            $conn->cerrar();

            return $id;
        }
        
        return FALSE;
    }
    
    /**
     * Obtiene la cantidad de usuarios que ya realizarón el pago!!
     */
    public function getActivos(){
        $conn = new Conn();
        $conn->conectar();
        
        $str = "SELECT count(*) as total FROM ".$this::Tabla." WHERE Pago =1";
        $qry = mysql_query($str);
        
        if (mysql_num_rows($qry)==0)
            return FALSE;
        
        $row = mysql_fetch_assoc($qry);
        return $row['total'];
    }


}

?>
