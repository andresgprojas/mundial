<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <title></title>
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
        <link rel="stylesheet" href="View/css/general.css" />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!--<link href="View/css/bootstrap.css" rel="stylesheet" media="screen">-->
        <link href="View/css/bootstrap.css" rel="stylesheet" media="screen">
        <script src="View/js/bootstrap.min.js"></script>
        <script>
            $(function(){
                $("#linkRegistro").click(function(){
                    $('#divRegistrar').modal('show')
                    return false;
                })
                
                $("#login").click(function(){
                    var nick = $("#nickname").val();
                    var pass = $("#password").val();
                    $.ajax({
                        type:   'POST',
                        url:    'Controller/login',
                        data:{
                            'nick': nick,
                            'pass': pass,
                            'action':'login'
                        },
                        success: function(a){
                            if (a=='1'){
                                window.location.replace("View/home");
                            }
                            else{
                                $("#salida .modal-body").html(a)
                                $('#salida').modal('show')
                            }
                        }
                    })
                })
                
                $("#btnRegistrar").click(function(){
                    var nick = $("#username").val();
                    var pass = $("#contra").val();
                    var id = $("#identificacion").val();
                    $.ajax({
                        type:   'POST',
                        url:    'Controller/login',
                        data:{
                            'action': 'save',
                            'nick': nick,
                            'pass': pass,
                            'iden': id
                        },
                        success: function(a){
                            $("#divRegistrar .modal-body").html(a)
                        }
                    })
                })
              
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
    <body>
        <div class="jumbotron boxlogin">
            <h2 class="form-signin-heading">Ingresa</h2>
            <input type="text" name="nickname" id="nickname"  class="form-control myTop" required placeholder="Nickname">
            <input type="password" name="password" id="password" class="form-control myBottom" required placeholder="Password">
            <input type="button" value="Acceder" id="login" class="btn btn-lg btn-primary btn-block">
            <a href="#" id="linkRegistro" class="btn btn-lg btn-success btn-block">Registrarse</a>
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
                        <input type="text" name="identificacion" id="identificacion"  class="form-control myMiddle" placeholder="Identificación">
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
