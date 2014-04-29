<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Conn
 *
 * @author andresprojas
 */
class Conn {

    const _HOST = "localhost";
    const _USUARIO = "root";
    const _PASSWORD = "root";
    const _DATABASE = "mydb";
    private $link;
    
    
    
    public function conectar(){
        @mysql_connect($this::_HOST, $this::_USUARIO, $this::_PASSWORD) or die("Error al conectarse con el servidor");
        $this->setLink(@mysql_select_db($this::_DATABASE) or die('Error al conectarse con la base de datos'));
    }
    
    public function cerrar(){
        mysql_close();
    }
    
    
    public function getLink() {
        return $this->link;
    }

    public function setLink($link) {
        $this->link = $link;
    }
    
    public function getSesion() {
        @session_start();
        if (count($_SESSION)>0)
            return $_SESSION['usuario'];
        else
            return FALSE;
    }
}

?>
