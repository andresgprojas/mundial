<?php
    include_once '../cab.inc.php';
    $Conn = new Conn();
    $Conn->conectar();
    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Easy set variables
	 */
	
	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */
	$aColumns = array( 'Nick', 'Acumulado');
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "Nick";
	
	/* 
	 * Paging
	 */
	$sLimit = "";
	if ( isset( $_POST['iDisplayStart'] ) && $_POST['iDisplayLength'] != '-1' )
	{
		$sLimit = "LIMIT ".intval( $_POST['iDisplayStart'] ).", ".
			intval( $_POST['iDisplayLength'] );
	}
	
	
	/*
	 * Ordering
	 */
	$sOrder = "";
	if ( isset( $_POST['iSortCol_0'] ) )
	{
		$sOrder = "ORDER BY  ";
		for ( $i=0 ; $i<intval( $_POST['iSortingCols'] ) ; $i++ )
		{
			if ( $_POST[ 'bSortable_'.intval($_POST['iSortCol_'.$i]) ] == "true" )
			{
				$sOrder .= "`".$aColumns[ intval( $_POST['iSortCol_'.$i] ) ]."` ".
					($_POST['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
			}
		}
		
		$sOrder = substr_replace( $sOrder, "", -2 );
		if ( $sOrder == "ORDER BY" )
		{
			$sOrder = "";
		}
	}
        else{
            $sOrder = "ORDER BY Acumulado DESC, Nick ASC";
        }
	
	
	/* 
	 * Filtering
	 * NOTE this does not match the built-in DataTables filtering which does it
	 * word by word on any field. It's possible to do here, but concerned about efficiency
	 * on very large tables, and MySQL's regex functionality is very limited
	 */
	$sWhere = "";
	if ( isset($_POST['sSearch']) && $_POST['sSearch'] != "" )
	{
		$sWhere = "WHERE (";
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
                    if ($aColumns[$i]!='Acumulado'){
			$sWhere .= "`".$aColumns[$i]."` LIKE '%".mysql_real_escape_string( $_POST['sSearch'] )."%' OR ";
                    }
		}
		$sWhere = substr_replace( $sWhere, "", -3 );
		$sWhere .= ')';
	}
	
	/* Individual column filtering */
	for ( $i=0 ; $i<count($aColumns) ; $i++ )
	{
            if ($aColumns[$i]!='Acumulado'){
		if ( isset($_POST['bSearchable_'.$i]) && $_POST['bSearchable_'.$i] == "true" && $_POST['sSearch_'.$i] != '' )
		{
			if ( $sWhere == "" )
			{
				$sWhere = "WHERE ";
			}
			else
			{
				$sWhere .= " AND ";
			}
			$sWhere .= "`".$aColumns[$i]."` LIKE '%".mysql_real_escape_string($_POST['sSearch_'.$i])."%' ";
		}
            }
	}
	
	
	/*
	 * SQL queries
	 * Get data to display
	 */
        if(!$sWhere){
            $sWhere = "WHERE N.Pago = '1'";
        }
        else{
            $sWhere .= " AND N.Pago = '1' ";
        }
        $Nick       = new NickName();
        $Pronostico = new Pronosticos();
        $Resultado  = new Resultados();
        $Punto      = new Puntos();
        $sQuery = "
		SELECT ".
                "N.Nick, " .
                "SUM(IF(R.Resultado = P.Pronostico, PTS.Puntos ,'0')) AS Acumulado " .
                "FROM ".$Nick::Tabla." N " .
                "LEFT JOIN ".$Pronostico::Tabla." P ".
                "ON ".
                    "P.NickName_Nick = N.Nick " .
                "LEFT JOIN ".$Resultado::Tabla." R " .
                "ON " .
                    "R.Partidos_CodPartido=P.Partidos_CodPartido AND " .
                    "R.Puntos_CodPron = P.Puntos_CodPron " .
                "LEFT JOIN ".$Punto::Tabla." PTS ".
                "ON ".
                    "PTS.CodPron = R.Puntos_CodPron " .
                $sWhere.
                " GROUP BY N.Nick   
		
		$sOrder
		$sLimit
		";//die($sQuery);
	$rResult = mysql_query( $sQuery) or fatal_error( 'MySQL Error: ' . mysql_errno() );
	
	/* Data set length after filtering */
//	$sQuery = mysql_num_rows($rResult);
//	$rResultFilterTotal = mysql_query( $sQuery) or fatal_error( 'MySQL Error: ' . mysql_errno() );
//	$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
//	$iFilteredTotal = $aResultFilterTotal[0];
	$iFilteredTotal = mysql_num_rows($rResult);
	
	/* Total data set length */
	$sQuery = "
		SELECT ".
                "Count($sIndexColumn)".
                "FROM NickName N WHERE N.Pago = '1'";
	$rResultTotal = mysql_query( $sQuery ) or fatal_error( 'MySQL Error: ' . mysql_errno() );
	$aResultTotal = mysql_fetch_array($rResultTotal);
	$iTotal = $aResultTotal[0];
	
	
	/*
	 * Output
	 */
	$output = array(
		"sEcho" => intval($_POST['sEcho']),
		"iTotalRecords" => $iFilteredTotal,
		"iTotalDisplayRecords" => $iTotal,
//		"iTotalDisplayRecords" => '7',
		"aaData" => array()
	);
	$c = $_POST['iDisplayStart'];
	while ( $aRow = mysql_fetch_array( $rResult ) )
	{
		$row = array();
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			if ( $aColumns[$i] == "version" )
			{
				/* Special output formatting for 'version' column */
				$row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];
			}
			else if ( $aColumns[$i] != ' ' )
			{
				/* General output */
				$row[] = $aRow[ $aColumns[$i] ];
			}
		}
                $row[2] = ++$c;
		$output['aaData'][] = $row;
	}
	
	echo json_encode( $output );
?>