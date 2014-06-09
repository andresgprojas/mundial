<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <title>Chicken-gol</title>
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
        <link rel="stylesheet" href="View/css/general.css" />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!--<link href="View/css/bootstrap.css" rel="stylesheet" media="screen">-->
        <link href="View/css/bootstrap.css" rel="stylesheet" media="screen">
        <script src="View/js/bootstrap.min.js"></script>
        <script>
            $(function() {
                $("#linkRegistro").click(function() {
                    $('#divRegistrar').modal('show')
                    return false;
                });

                $("#linkLogIn").click(function() {
                    $('#divLogin').modal('show')
                    return false;
                });
                $("#windowHowTo").click(function() {
                    $('#divHowTo').modal('show')
                    return false;
                });

                $("#login").click(function() {
                    var nick = $("#nickname").val();
                    var pass = $("#password").val();
                    $.ajax({
                        type: 'POST',
                        url: 'Controller/login',
                        data: {
                            'nick': nick,
                            'pass': pass,
                            'action': 'login'
                        },
                        success: function(a) {
                            if (a == '1') {
                                window.location.replace("View/home");
                            }
                            else {
                                $("#salida .modal-body").html(a)
                                $('#salida').modal('show')
                            }
                        }
                    })
                })

                $("#btnRegistrar").click(function() {
                    var nick = $("#username").val();
                    var pass = $("#contra").val();
                    var id = $("#identificacion").val();
                    $.ajax({
                        type: 'POST',
                        url: 'Controller/login',
                        data: {
                            'action': 'save',
                            'nick': nick,
                            'pass': pass,
                            'iden': id
                        },
                        success: function(a) {
                            $("#divRegistrar .modal-body").html(a)
                        }
                    })
                });
                $("#inputAcum").load('Controller/tools', {'action': 'acum'});
                $("#inputRest").load('Controller/tools', {'action': 'rest'});

            })
        </script>
        <style>
            .boxlogin{
                margin: 50px auto;
                width: 320px;
                box-shadow: 0px 2px 10px #d6d6d6;
                border-radius: 4px;
                -webkit-border-radius: 4px;
                -moz-border-radius: 10px;
            }
            .myMiddle{
                border-radius: 0px !important;
                margin-top: -1px;
            }
            .myBottom{
                border-top-left-radius: 0px !important;
                border-top-right-radius: 0px !important;
            }
            .myTop{
                border-bottom-left-radius: 0px !important;
                border-bottom-right-radius: 0px !important;
            }
            input[type="password"]{
                margin-top: -1px;
            }
            input[type="button"]{
                margin-top: 15px;
            }
            input::-webkit-input-placeholder:before{
                font-weight: bold;
            }
            input::-webkit-input-placeholder{
                font-style: italic;
            }
            input:-moz-placeholder:before {
                font-weight: bold;
            }
            input:-moz-placeholder {
                font-style: italic;
            }
        </style>

    </head>
    <body class="general">
        <nav class="navbar navbar-default navbar-inverse" role="navigation">
            <div class="container-fluid" align="right">
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right" >
                        <li><a id="linkLogIn" href="#">Ingresa</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div id="intro" align="center">
            <img src="View/images/header.png" alt="Chiken_Gol" class="img-responsive">
            
            	<div class="col-md-4">
                	<div class="panel-1"><img src="View/images/dollar_coin.png"><span>Acumulado:</span><div class="sep"></div><h2 id="inputAcum">500.000</h2></div>
                </div>
            	<div class="col-md-4">
                	<div class="panel-2"><img src="View/images/history.png"><span>Pr�ximo Encuentro en ...</span><div class="sep"></div> <h2 id="inputRest">tres d�as</h2></div>
                </div>
				<div class="col-md-4">
                	<div class="panel-3"><img src="View/images/laptop_help.png"><a href="#" id="windowHowTo" >�C�mo funciona?</a></div>
                </div>                
        </div>
        <div id="divHowTo" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">�C�mo funciona?</h4>
                    </div>
                    <div class="modal-body">
                        <b>Paso 1:</b> Reg�strate, con solo dos datos 
                        <ol>
                            <li>Un Nick para proteger tu identidad, este ser� p�blico ya que se podr� ver desde las tablas de clasificaci�n.</li>
                            <li>Tu n�mero de Identificaci�n, ser� privado y se usara solo para validar que eres el due�o del Nick Ganador.</li>
                        </ol>
                        <b>Paso 2:</b> Paga 
                        <ol>
                            <li>
                                La cuota para empezar a alimentar tus pron�sticos es de COP$ 50.000
                            </li>
                        </ol>
                        <b>Paso 3:</b> Ingresa tus pron�sticos 
                        <ol>
                            <li>Tendr�s 8 variables por partido para pronosticar, entre ellas marcadores, tarjetas y faltas.</li>
                            <li>Podr�s registrar tus marcadores para toda la primera ronda de forma inmediata e irlas modificando hasta diez (10) minutos antes de cada partido especifico. Las siguientes rondas se habilitaran a medida que se conozcan los equipos clasificados.</li>
                            <li>Cada pron�stico acertado otorgara puntos que se acumularan para la premiaci�n.</li>
                        </ol>
                        <b>Paso 4:</b> Gana!
                        <ol><li>Si al final del mundial tienes uno de los tres mejores puntajes, reclama tu premio.</li></ol>
                        <b>Aclaraci�n</b> 
                        <ul>
                            <li>Tomaremos el 6% del total del bote para los gastos de administraci�n del sitio web, el resto ser� divido de la siguiente forma: </li>
                            <li>1er Puesto: 67%</li>
                            <li>2do Puesto: 18%</li>
                            <li>3er Puesto: 9%</li>

                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="divLogin" class="modal fade" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Ingresa</h4>
                    </div>

                    <div class="modal-body">
                        <input type="text" name="nickname" id="nickname"  class="form-control myTop" required placeholder="Nickname">
                        <input type="password" name="password" id="password" class="form-control myBottom" required placeholder="Password">
                        <input type="button" value="Acceder" id="login" class="btn btn-lg btn-primary btn-block">
                        <a href="#" id="linkRegistro" class="btn btn-lg btn-success btn-block">Registrarse</a>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="salida" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Problemas para acceder</h4>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="divRegistrar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Crear Usuario</h4>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="username" id="username"  class="form-control myTop" placeholder="Nickname">
                        <input type="text" name="identificacion" id="identificacion"  class="form-control myMiddle" placeholder="Identificaci�n">
                        <input type="password" name="contra" id="contra"  class="form-control myBottom" placeholder="Password">
                        <input type="button" value="Registrar" id="btnRegistrar" class="btn btn-primary">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
