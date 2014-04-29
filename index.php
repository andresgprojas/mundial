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
        <script>
            $(function(){
                $("#linkRegistro").click(function(){
                    $("#divRegistrar").dialog({
                                modal:true,
                                title:'Registro',
                                resizable: false,
                                draggable: false
                            })
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
                                $("#salida").html(a)
                                $("#salida").dialog({
                                    modal:true,
                                    title:'Error!!!'
                                })
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
                            $("#divRegistrar").html(a)
                        }
                    })
                })
              
            })
    </script>
           
    </head>
    <body>
        <div style="text-align: center">
            <label>Nombre:</label><input type="text" name="nickname" id="nickname" ><br>
            <label>Contraseña:</label><input type="password" name="password" id="password" ><br>
            <input type="button" value="Ingresar" id="login"><br>
            <a href="#" id="linkRegistro">Registrarse</a>
        </div>
        <div id="salida" style="display: none"></div>
        <div id="divRegistrar" style="display: none">
            Nickname:<input type="text" name="username" id="username" ><br>
            Identifi:<input type="text" name="identificacion" id="identificacion" ><br>
            Password:<input type="password" name="contra" id="contra" ><br>
            <input type="button" value="Registrar" id="btnRegistrar"><br>
        </div>
        
        
    </body>
</html>
