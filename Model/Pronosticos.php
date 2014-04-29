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
class Pronosticos {

    private $NickName_Nick;
    private $Partidos_CodPartido;
    private $Puntos_CodPron;
    private $Pronostico;
    const Tabla = "Pronosticos";
    public function getNickName_Nick() {
        return $this->NickName_Nick;
    }

    public function setNickName_Nick($NickName_Nick) {
        $this->NickName_Nick = $NickName_Nick;
    }

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

    public function getPronostico() {
        return $this->Pronostico;
    }

    public function setPronostico($Pronostico) {
        $this->Pronostico = $Pronostico;
    }

        
    public function getByFilter($filtro = array()){
        $conn = new Conn();
        $conn->conectar();
        $filter = "WHERE ";
        foreach ($filtro as $key => $value) {
            $filter .= "{$key} = '{$value}' AND ";
        }
        $filter = substr($filter, 0, -4);
        
        $str = "SELECT a.* FROM ".$this::Tabla." a ".
                "INNER JOIN Puntos pn ON a.Puntos_CodPron = pn.CodPron ".
                "INNER JOIN Partidos pa ON pa.CodPartido = a.Partidos_CodPartido ".
                "{$filter}";
        $qry = mysql_query($str) or die(mysql_error());
        
        if (mysql_num_rows($qry)==0)
            return FALSE;
        
        $array = array();
        while($row = mysql_fetch_assoc($qry)){
            $myClass = new Pronosticos();
            $myClass->setNickName_Nick($row['NickName_Nick']);
            $myClass->setPartidos_CodPartido($row['Partidos_CodPartido']);
            $myClass->setPronostico($row['Pronostico']);
            $myClass->setPuntos_CodPron($row['Puntos_CodPron']);
            
            array_push($array, $myClass);
        }
        $return = (count($array)==0)?FALSE:$array;
        $conn->cerrar();
        return $return;
    }
    
    public function setRegistro(){
        $conn = new Conn();
        $conn->conectar();
        
        $str = "INSERT INTO ".$this::Tabla." (NickName_Nick, Partidos_CodPartido, Pronostico, Puntos_CodPron) VALUES ('$this->NickName_Nick', '{$this->Partidos_CodPartido}', '{$this->Pronostico}', '{$this->Puntos_CodPron}')";
        $qry = mysql_query($str);
        
        $conn->cerrar();
        
        if ($qry === TRUE)
            return mysql_insert_id();
        
        return FALSE;
    }
    
    public function updateRegistro(){
        $conn = new Conn();
        $conn->conectar();
        $str = "UPDATE ".$this::Tabla." SET Pronostico = '{$this->getPronostico()}' WHERE Partidos_CodPartido = '{$this->getPartidos_CodPartido()}' AND Puntos_CodPron = '{$this->getPuntos_CodPron()}' AND NickName_Nick = '{$this->getNickName_Nick()}'";
        $qry = mysql_query($str);
        
        if ($qry === TRUE)
            return TRUE;
        
        return FALSE;
        
        $conn->cerrar();
    }
    
    public function getAcumulado($Nick=null){
        $conn = new Conn();
        $conn->conectar();
        $Resultados = new Resultados();
        $Puntos     = new Puntos();
        $NickName   = new NickName();
        
        $filtro = ($Nick == null)?"":"AND N.Nick = '{$Nick}' ";
        
        $str = "SELECT ".
                "N.Nick, " .
                "SUM(IF(R.Resultado = P.Pronostico, PTS.Puntos ,'0')) AS Acumulado " .
                "FROM " .
                    $NickName::Tabla . " N " .
                "LEFT JOIN ".$this::Tabla." P ".
                "ON ".
                    "P.NickName_Nick = N.Nick " .
                "LEFT JOIN ".$Resultados::Tabla." R " .
                "ON " .
                    "R.Partidos_CodPartido=P.Partidos_CodPartido AND " .
                    "R.Puntos_CodPron = P.Puntos_CodPron " .
                "LEFT JOIN ".$Puntos::Tabla." PTS ".
                "ON ".
                    "PTS.CodPron = R.Puntos_CodPron " .
                "WHERE ".
                    "N.Pago = '1' ".
                    $filtro.
                "GROUP BY N.Nick ".
                "ORDER BY Acumulado DESC;";
        $qry = mysql_query($str);
        $array = array();
        while($row = mysql_fetch_assoc($qry)){
            $myClass = new Pronosticos();
            $myClass->setNickName_Nick($row['Nick']);
            $myClass->setPronostico($row['Acumulado']);
            array_push($array, $myClass);
        }
        $conn->cerrar();
        return $array;
        

    }
    



}

?>
