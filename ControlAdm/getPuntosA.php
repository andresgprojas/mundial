<?php

require_once '../cab.inc.php';
extract($_POST);

$Sesion = new Conn();

$usuario = $Sesion->getSesion();
$Nickname = new NickName();
$id = $Nickname->getByFilter(array('Nick'=>$usuario));

if ($usuario === FALSE || ($id === FALSE || ($id->getId() != '1026262467' && $id->getId() != '74085361' && $id->getId() != '80238729'))) {//agregar el id de Alan y Anderson
    die("0");
}


switch ($action) {
    case 'loadView':
        $Puntos = new Puntos();
        $criterios = $Puntos->getAll();

        $Partido = new Partidos();
        $Dato = $Partido->getByFilter(array('CodPartido' => $partido));
//        $Dato->getAbierto()."ANDres";
        $cerrado = ($Dato->getAbierto() == '1')?"":" checked";

        //obtener los pronosticos de un usuario de determinado partido
        $Resultados = new Resultados();
        $rtaRes = $Resultados->getByFilter(array('Partidos_CodPartido' => $partido));
        
//        echo "<pre>";
//        print_r($rtaRes);
//        echo "</pre>";
        
//        var_dump($rtaRes);
//        die();

        if ($rtaRes === FALSE) {//die('CUANDO NO SE HAN CARGADO PRONOSTICOS PARA UN PARTIDO');
            /* ++++++++++++++++++CUANDO NO SE HAN CARGADO PRONOSTICOS PARA UN PARTIDO++++++++++++++++++++++++ */
            $htmlSel = "<form action='../ControlAdm/setPronosticosA' method='POST'>";
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
            
            $htmlSel .= "Cerrado: <input type='checkbox' name='cerrado' value='TRUE' $cerrado>"; 
            $htmlSel .= '<input type="submit" value="Terminar" class="btn btn-lg btn-success btn-block">';
            /* ++++++++++++++++++FIN (CUANDO NO SE HAN CARGADO PRONOSTICOS PARA UN PARTIDO)++++++++++++++++++++++++ */
        } else {
//            die('CUANDO SE HAN CARGADO PRONOSTICOS PARA UN PARTIDO');
            $htmlSel = "";
            /* ++++++++++++++++++CUANDO SE HAN CARGADO PRONOSTICOS PARA UN PARTIDO++++++++++++++++++++++++ */
            $flag = FALSE;
            foreach ($criterios as $objeto) {//RECORRER LOS CRITERIOS
                $PronosticosP = new Resultados();
                $rtaPronP = $PronosticosP->getByFilter(array('Puntos_CodPron' => $objeto->getCodPron(), 'Partidos_CodPartido' => $partido));

                
                    /* ++++++++++++++++++CUANDO ESTA ABIERTO EL PARTIDO++++++++++++++++++++++++ */
                    //abierto con datos
                    $htmlSel .= "<form action='../ControlAdm/setPronosticosA' method='POST'>";
                    
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
                            $SEL = ($rtaPronP[0]->getResultado() == $valor) ? "selected='selected'" : "";
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
            
            /* ++++++++++++++++++FIN (CUANDO SE HAN CARGADO PRONOSTICOS PARA UN PARTIDO)++++++++++++++++++++++++ */
            $htmlSel .= "Cerrado: <input type='checkbox' name='cerrado' value='TRUE' $cerrado>"; 
            if ($flag === TRUE)
                $htmlSel .= '<input type="submit" value="Editar" class="btn btn-lg btn-success btn-block">';
        }
        $htmlSel .= "</form>";
//        
//        $htmlSel .= '<div class="btn-group" data-toggle="buttons">
//  <label class="btn btn-primary btn-xs">
//    <input type="radio" name="options" id="Si"> Si
//  </label>
//  
//  <label class="btn btn-primary btn-xs">
//    <input type="radio" name="options" id="No"> No
//  </label>
//</div>';
//        $htmlSel .= "Si<input name='Cerrado' type='radio' value='Si'>"
//                    . "No<input name='Cerrado' type='radio' value='No'>";
        $htmlSel .= "<script>$('input[type=submit]').button()</script>";
        die($htmlSel);

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