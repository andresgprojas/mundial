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
        <!--<link href="View/css/bootstrap.css" rel="stylesheet" media="screen">-->
        <link href="../View/css/bootstrap.css" rel="stylesheet" media="screen">
        <script src="../View/js/bootstrap.min.js"></script>
        <style>
            body{
                height: 1000px;
            }
        </style>
    </head>
    <body>
        <div id="divPronosticos" class="modal fade in" style="display: none;">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                <h3>Cargar Pronósticos</h3>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-danger" data-dismiss="modal">Cerrar</a>
            </div>
        </div>
        <div class="body">
            <nav class="navbar navbar-default navbar-inverse" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Mi Polla</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a class="endSesion" href="#">Salir</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div class="page-header">
            <h1>Bienvenido <span id="nick"></span></h1>
        </div>
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
<!--        <div id="divPronosticos"></div>-->
    </body>
</html>
	