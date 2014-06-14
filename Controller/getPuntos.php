<?php

require_once '../cab.inc.php';
extract($_POST);

$Sesion = new Conn();
if ($Sesion->getSesion() === FALSE) {
    die("0");
}
$usuario = $Sesion->getSesion();


switch ($action) {
    case 'loadView':
        $Puntos = new Puntos();
        $criterios = $Puntos->getAll();

        $Partido = new Partidos();
        $Dato = $Partido->getByFilter(array('CodPartido' => $partido));

        //obtener los pronosticos de un usuario de determinado partido
        $Pronosticos = new Pronosticos();
        $rtaPron = $Pronosticos->getByFilter(array('NickName_Nick' => $usuario, 'Partidos_CodPartido' => $partido));

        $strTimePartido = strtotime($Dato->getFecha()." ".$Dato->getHora());
        $strTimeAhora   = strtotime('+10 minute', strtotime(date("Y-m-d H:i:s")));//cerrar 10 minutos antes

        if (($rtaPron === FALSE && $Dato->getAbierto() == '0') || ($strTimeAhora >= $strTimePartido && $Dato->getAbierto() == '1'))
            die('Lo sentimos, pero este partido ya fue cerrado');
        //if ($rtaPron !== FALSE && $Dato->getAbierto() == '0')die('Este partido ya fue cerrado');

        if ($rtaPron === FALSE && $Dato->getAbierto() == '1') {
            /* ++++++++++++++++++CUANDO NO SE HAN CARGADO PRONOSTICOS PARA UN PARTIDO++++++++++++++++++++++++ */
            $htmlSel = "<form action='../Controller/setPronosticos' method='POST'>";
            foreach ($criterios as $objeto) {
                $Nom_y_Reg = getVars($Dato, array('nombrePron' => $objeto->getNomPron(), 'reglaPron' => $objeto->getReglaPron()));
                extract($Nom_y_Reg);
                $htmlSel .= '<div class="panel panel-primary">' .
                        "<input type='hidden' value='{$partido}' name='idPartido'>" .
                        //                            "<input type='hidden' value='{$objeto->getCodPron()}' name='idPuntos'>".
                        '<div class="panel-heading">' . $nombreCri . '</div>' .
                        '<div class="panel-body"><p>' .
                        "<div class='text-criterio'>".
                        "Descripcion: " . $regla . "<br>" .
                        "Puntos a otorgar: " . $objeto->getPuntos() .
                        "</div>";
                if ($objeto->getValores() != '-') {
                    $select = explode(',', $objeto->getValores());
                    $htmlSel .= "<select name='Form[{$objeto->getCodPron()}]' class='form-control select-criterio'>";
                    $htmlSel .= "<option value='-'>--</option>";
                    foreach ($select as $valor) {
                        $htmlSel .= "<option value='{$valor}'>{$valor}</option>";
                    }
                    $htmlSel .= "<select>";
                } elseif ($objeto->getValores() == '-') {
                    $htmlSel .= "<input type='text'>";
                }
                $htmlSel .= '</p></div>';
                $htmlSel .= '</div>';
            }
            $htmlSel .= '<input type="submit" value="Terminar" class="btn btn-lg btn-success btn-block">';
            /* ++++++++++++++++++FIN (CUANDO NO SE HAN CARGADO PRONOSTICOS PARA UN PARTIDO)++++++++++++++++++++++++ */
        } else {
            $htmlSel = "";
            /* ++++++++++++++++++CUANDO SE HAN CARGADO PRONOSTICOS PARA UN PARTIDO++++++++++++++++++++++++ */
            $flag = FALSE;
            foreach ($criterios as $objeto) {//RECORRER LOS CRITERIOS
                $PronosticosP = new Pronosticos();
                $rtaPronP = $PronosticosP->getByFilter(array('CodPron' => $objeto->getCodPron(), 'NickName_Nick' => $usuario, 'Partidos_CodPartido' => $partido));

                if ($Dato->getAbierto() == "0") {
                    /* ++++++++++++++++++CUANDO NO ESTA ABIERTO EL PARTIDO++++++++++++++++++++++++ */
                    //cerrado con datos
                    $Resultados = new Resultados();
                    $rtaResult = $Resultados->getByFilter(array('Puntos_CodPron' => $objeto->getCodPron(), 'Partidos_CodPartido' => $partido));
                    if ($rtaResult[0] !== FALSE) {

                        if ($rtaPronP[0]->getPronostico() == $rtaResult[0]->getResultado()) {
                            $pron = "{$rtaPronP[0]->getPronostico()}<span class='glyphicon glyphicon-ok'></span>";
                        }
                        else
                            $pron = "{$rtaPronP[0]->getPronostico()}<span class='glyphicon glyphicon-remove'></span>";

                        $Nom_y_Reg = getVars($Dato, array('nombrePron' => $objeto->getNomPron(), 'reglaPron' => $objeto->getReglaPron()));
                        extract($Nom_y_Reg);

                        $htmlSel .= '<div class="panel panel-primary">' .
                                '<div class="panel-heading">' . $nombreCri . '</div>' .
                                '<div class="panel-body">' .
                                "<div class='text-criterio' style='width:100% !important'>".
                                'Descripcion: ' . $regla . '<br>' .
                                'Puntos a otorgar: ' . $objeto->getPuntos() . '<br>' .
                                'Pronostico hecho: ' . $pron .
                                "</div>".
                                '</div>' .
                                '</div>';
                        ;
                    }
                    else {
                        die('Este Partido ya Fue Cerrado');
                    }

                    /* ++++++++++++++++++FIN (CUANDO NO ESTA ABIERTO EL PARTIDO)++++++++++++++++++++++++ */
                } else {
                    /* ++++++++++++++++++CUANDO ESTA ABIERTO EL PARTIDO++++++++++++++++++++++++ */
                    //abierto con datos
                    $htmlSel .= "<form action='../Controller/setPronosticos' method='POST'>";

                    $Nom_y_Reg = getVars($Dato, array('nombrePron' => $objeto->getNomPron(), 'reglaPron' => $objeto->getReglaPron()));
                    extract($Nom_y_Reg);

                    $htmlSel .= "<div class='panel panel-primary'>" .
                            "<input type='hidden' value='{$partido}' name='idPartido'>" .
                            //                            "<input type='hidden' value='{$objeto->getCodPron()}' name='idPuntos'>".
                            '<div class="panel-heading">' . $nombreCri . '</div>' .
                            '<div class="panel-body"><p>' .
                            "<div class='text-criterio'>".
                            "Descripcion: " . $regla . "<br>" .
                            "Puntos a otorgar: " . $objeto->getPuntos() .
                            "</div>";

                    if ($objeto->getValores() != '-') {
                        $select = explode(',', $objeto->getValores());
                        $htmlSel .= "<select name='Form[{$objeto->getCodPron()}]' class='form-control select-criterio'>";
                        $htmlSel .= "<option value='-'>--</option>";
                        foreach ($select as $valor) {
                            $SEL = ($rtaPronP[0]->getPronostico() == $valor) ? "selected='selected'" : "";
                            $htmlSel .= "<option value='{$valor}' {$SEL} >{$valor}</option>";
                        }
                        $htmlSel .= "<select>";
                    } elseif ($objeto->getValores() == '-') {
                        $htmlSel .= "<input type='text'>";
                    }
                    $htmlSel .= "</p></div>";
                    $htmlSel .= "</div>";
                    $flag = TRUE;


                    /* ++++++++++++++++++FIN (CUANDO ESTA ABIERTO EL PARTIDO)++++++++++++++++++++++++ */
                }
            }
            /* ++++++++++++++++++FIN (CUANDO SE HAN CARGADO PRONOSTICOS PARA UN PARTIDO)++++++++++++++++++++++++ */
            if ($flag === TRUE)
                $htmlSel .= '<input type="submit" value="Editar" class="btn btn-lg btn-success btn-block">';
        }
        $htmlSel .= "<script>$('input[type=submit]').button()</script>";
        die($htmlSel);

        break;

    case 'loadPosiciones':
        /* -------------------------- */

        if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
            $sLimit = "LIMIT " . intval($_GET['iDisplayStart']) . ", " .
                    intval($_GET['iDisplayLength']);
        }


        /*
         * Ordering
         */
        $sOrder = "";
        if (isset($_GET['iSortCol_0'])) {
            $sOrder = "ORDER BY  ";
            for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
                if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
                    $sOrder .= "`" . $aColumns[intval($_GET['iSortCol_' . $i])] . "` " .
                            ($_GET['sSortDir_' . $i] === 'asc' ? 'asc' : 'desc') . ", ";
                }
            }

            $sOrder = substr_replace($sOrder, "", -2);
            if ($sOrder == "ORDER BY") {
                $sOrder = "";
            }
        }


        /*
         * Filtering
         * NOTE this does not match the built-in DataTables filtering which does it
         * word by word on any field. It's possible to do here, but concerned about efficiency
         * on very large tables, and MySQL's regex functionality is very limited
         */
        $sWhere = "";
        if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
            $sWhere = "WHERE (";
            for ($i = 0; $i < count($aColumns); $i++) {
                $sWhere .= "`" . $aColumns[$i] . "` LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
            }
            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere .= ')';
        }

        /* Individual column filtering */
        for ($i = 0; $i < count($aColumns); $i++) {
            if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true" && $_GET['sSearch_' . $i] != '') {
                if ($sWhere == "") {
                    $sWhere = "WHERE ";
                } else {
                    $sWhere .= " AND ";
                }
                $sWhere .= "`" . $aColumns[$i] . "` LIKE '%" . mysql_real_escape_string($_GET['sSearch_' . $i]) . "%' ";
            }
        }


        /*
         * SQL queries
         * Get data to display
         */
        $sQuery = "
		SELECT SQL_CALC_FOUND_ROWS `" . str_replace(" , ", " ", implode("`, `", $aColumns)) . "`
		FROM   $sTable
		$sWhere
		$sOrder
		$sLimit
		";
        $rResult = mysql_query($sQuery, $gaSql['link']) or die(mysql_error());

        /* Data set length after filtering */
        $sQuery = "
		SELECT FOUND_ROWS()
	";
        $rResultFilterTotal = mysql_query($sQuery, $gaSql['link']) or die(mysql_error());
        $aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
        $iFilteredTotal = $aResultFilterTotal[0];

        /* Total data set length */
        $sQuery = "
		SELECT COUNT(`" . $sIndexColumn . "`)
		FROM   $sTable
	";
        $rResultTotal = mysql_query($sQuery, $gaSql['link']) or die(mysql_error());
        $aResultTotal = mysql_fetch_array($rResultTotal);
        $iTotal = $aResultTotal[0];


        /*
         * Output
         */
        $output = array(
            "sEcho" => intval($_GET['sEcho']),
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $iFilteredTotal,
            "aaData" => array()
        );

        while ($aRow = mysql_fetch_array($rResult)) {
            $row = array();
            for ($i = 0; $i < count($aColumns); $i++) {
                if ($aColumns[$i] == "version") {
                    /* Special output formatting for 'version' column */
                    $row[] = ($aRow[$aColumns[$i]] == "0") ? '-' : $aRow[$aColumns[$i]];
                } else if ($aColumns[$i] != ' ') {
                    /* General output */
                    $row[] = $aRow[$aColumns[$i]];
                }
            }
            $output['aaData'][] = $row;
        }

        echo json_encode($output);


        /* -------------------------- */

        $Pronosticos = new Pronosticos();
        $matriz = $Pronosticos->getAcumulado();
        $html = "<table border='1'>";
        $html .= "<tr><th>Nick</th><th>Puntaje</th></tr>";
        foreach ($matriz as $obj) {
            $html .= "<tr><td>" . $obj->getNickName_Nick() . "</td><td>" .
                    $obj->getPronostico() . "</td>";
        }
        $html .= "</table>";
        die($html);
        break;
}

function getVars(Partidos $Dato, $array) {

    $eq1 = $Dato->getEquipos_CodEq1();
    $eq2 = $Dato->getEquipos_CodEq2();

    if (strrpos($array['nombrePron'], "$")) {
        eval('$nombreCri = "' . $array['nombrePron'] . '";');
        eval('$regla = "' . $array['reglaPron'] . '";');
    } else {
        $nombreCri = $array['nombrePron'];
        $regla = $array['reglaPron'];
    }
    return array('nombreCri' => $nombreCri, 'regla' => $regla);
}

?>	