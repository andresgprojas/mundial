<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
        <style type="text/css" title="currentStyle">
            @import "css/demo_page.css";
            @import "css/demo_table.css";
        </style>
        <link rel="stylesheet" href="css/general.css" />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
        <script src="http://malsup.github.com/jquery.form.js"></script> 
        <script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
        <script src="js/functions.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    </head>
    <body>
        <div class="body">
            Bienvenido, <span id="nick"></span> <a class="endSesion" href="#">Salir</a><br>
            <div class="left">
                <div id="divPartidos"></div>

            </div>
            <div class="right">
                <table id="divTabla">
                    <thead>
                        <tr>
                            <th>Nick</th>
                            <th>Acumulado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="5" class="dataTables_empty">Loading data from server</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
        <div id="divPronosticos"></div>
    </body>
</html>
	