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
class Partidos {

    private $CodPartido;
    private $Partidoscol;
    private $Equipos_CodEq1;
    private $Equipos_CodEq2;
    private $Fecha;
    private $hora;
    private $Abierto;

    const Tabla = "partidos";

    public function getCodPartido() {
        return $this->CodPartido;
    }

    public function setCodPartido($CodPartido) {
        $this->CodPartido = $CodPartido;
    }

    public function getPartidoscol() {
        return $this->Partidoscol;
    }

    public function setPartidoscol($Partidoscol) {
        $this->Partidoscol = $Partidoscol;
    }

    public function getEquipos_CodEq1() {
        return $this->Equipos_CodEq1;
    }

    public function setEquipos_CodEq1($Equipos_CodEq1) {
        $this->Equipos_CodEq1 = $Equipos_CodEq1;
    }

    public function getEquipos_CodEq2() {
        return $this->Equipos_CodEq2;
    }

    public function setEquipos_CodEq2($Equipos_CodEq2) {
        $this->Equipos_CodEq2 = $Equipos_CodEq2;
    }

    public function getFecha() {
        return $this->Fecha;
    }

    public function setFecha($Fecha) {
        $this->Fecha = $Fecha;
    }

    public function getHora() {
        return $this->hora;
    }

    public function setHora($hora) {
        $this->hora = $hora;
    }

    public function getAbierto() {
        return $this->Abierto;
    }

    public function setAbierto($Abierto) {
        $this->Abierto = $Abierto;
    }

    public function getByFilter($filtro = array()) {
        $conn = new Conn();
        $conn->conectar();
        $filter = "WHERE ";
        foreach ($filtro as $key => $value) {
            $filter .= "{$key} = '{$value}' AND ";
        }
        $filter = substr($filter, 0, -4);

        $str = "SELECT * FROM " . $this::Tabla . " {$filter}";
        $qry = mysql_query($str) or die(mysql_error());

        if (mysql_num_rows($qry) == 0)
            return FALSE;

        $row = mysql_fetch_assoc($qry);
        $myClass = new Partidos();
        $myClass->setAbierto($row['Abierto']);
        $myClass->setCodPartido($row['CodPartido']);
        $myClass->setEquipos_CodEq1($row['Equipos_CodEq1']);
        $myClass->setEquipos_CodEq2($row['Equipos_CodEq2']);
        $myClass->setFecha($row['Fecha']);
        $myClass->setHora($row['hora']);
        $myClass->setPartidoscol($row['Partidoscol']);

        $conn->cerrar();
        return $myClass;
    }

    public function getAll() {
        $Equipos = new Equipos();
        $conn = new Conn();
        $conn->conectar();

        $str = "SELECT " .
                "a.*, " .
                "e.NomEq AS eq, " .
                "e2.NomEq AS eq2 " .
                "FROM " . $this::Tabla . " a " .
                "INNER JOIN " .
                $Equipos::Tabla . " e ON a.Equipos_CodEq1 = e.CodEq " .
                "INNER JOIN " .
                $Equipos::Tabla . " e2 ON a.Equipos_CodEq2 = e2.CodEq " .
                "ORDER BY Fecha,hora ASC";
        $qry = mysql_query($str) or die(mysql_error());

        $globalArray = array();
        while ($row = mysql_fetch_assoc($qry)) {
            $myClass = new Partidos();
            $myClass->setAbierto($row['Abierto']);
            $myClass->setCodPartido($row['CodPartido']);
            $myClass->setEquipos_CodEq1($row['eq']);
            $myClass->setEquipos_CodEq2($row['eq2']);
            $myClass->setFecha($row['Fecha']);
            $myClass->setHora($row['hora']);

            $myClass->setPartidoscol($row['Partidoscol']);

            array_push($globalArray, $myClass);
        }

        return $globalArray;
    }

    public function getDinamic() {
        $conn = new Conn();
        $conn->conectar();

        $str = "SELECT count(Fecha) AS contador, Fecha FROM " . $this::Tabla . " GROUP BY Fecha";
        $qry = mysql_query($str);

        $array = array();
        while ($row = mysql_fetch_array($qry)) {
            $array[$row['Fecha']] = $row['contador'];
        }
        return $array;
    }

    public function getRest() {
        $hoy = date('Y-m-d H:i:s');

        $conn = new Conn();
        $conn->conectar();
        //$str = "SELECT DATEDIFF( (SELECT Fecha FROM ".$this::Tabla." WHERE fecha >= CURDATE() ORDER BY fecha LIMIT 1) , CURDATE() ) as rest";
        $str = "SELECT CONCAT (Fecha,' ', hora) as rest FROM " . $this::Tabla . " WHERE fecha >= CURDATE() AND Abierto = 1 ORDER BY fecha,hora  LIMIT 1";
        $qry = mysql_query($str);
        $row = mysql_fetch_array($qry);
//        echo $hoy. '<br>';
//        echo $row['rest']. '<br>';

        $datetime1 = new DateTime($hoy);
        $datetime2 = new DateTime($row['rest']);
        $interval = $datetime2->diff($datetime1);
        $dia = $interval->format('%d')> 9?$interval->format('%d'):'0'.$interval->format('%d');
        $hora = $interval->format('%h')> 9?$interval->format('%h'):'0'.$interval->format('%h');
        $min = $interval->format('%i')> 9?$interval->format('%i'):'0'.$interval->format('%i');
        $seg = $interval->format('%s')> 9?$interval->format('%s'):'0'.$interval->format('%s');
        $rest = $dia . utf8_encode(' Días<br>') . $hora . ':' . $min . ':' . $seg;
        return $rest;
    }

}

?>
