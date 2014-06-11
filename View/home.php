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
        <link href="../View/css/bootstrap.css" rel="stylesheet" media="screen">
        <script src="../View/js/bootstrap.min.js"></script>
        <script src="../View/js/dataTables.bootstrap.js"></script>
        <style>
            body{
                height: 1000px;
            }
        </style>
    </head>
    <body>
        <div class="gray" style="display: none">
            <div class="spinner">
                <div class="rect1"></div>
                <div class="rect2"></div>
                <div class="rect3"></div>
                <div class="rect4"></div>
                <div class="rect5"></div>
            </div>
        </div>
        <div id="divPronosticos" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Cargar Pronósticos</h4>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
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
                    <a class="navbar-brand" href="#">Chickel-Gol</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a class="endSesion" href="#">Salir</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div class="body">
            <div class="page-header">
                <h1>Bienvenido <span id="nick"></span></h1>
            </div>
            <div class="left">
                <div class="panel panel-primary">
                    <!-- Default panel contents -->
                    <div class="panel-heading">PARTIDOS</div>
                    <div class="panel-body">
                        <p>A continuación encontrará los partidos de la primera ronda. La hora mostrada de cada encuentro es la de Colombia;
                            recuerde que el partido se cierra automáticamente 10 minutos antes de comenzar.</p>
                    </div>
                    <div class="panel-group" id="accordion"></div>
                </div>
            </div>
            <div class="right">
                <div class="panel panel-primary">
                    <!-- Default panel contents -->
                    <div class="panel-heading">TABLA DE POSICIONES</div>
                    <div class="panel-body">
                        <p>Las siguientes son las posiciones según el acumulado de aciertos en cada uno de los criteros de los partidos ya cerrados</p>
                    </div>

                    <!-- Table -->
                    <table id="divTabla" class="table">
                        <thead>
                            <tr>
                                <th>Nick</th>
                                <th>Acumulado</th>
                                <th>Posición</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="5" class="dataTables_empty">Loading data from server</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12 text-center">
                    <div class="panel-2"><img src="../View/images/history.png"><span>Próximo Encuentro en ...</span><div class="sep"></div> <h2 id="inputRest"></h2></div>
                </div>
            </div>
    </body>
</html>
