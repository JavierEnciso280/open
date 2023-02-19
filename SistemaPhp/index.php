
 
<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta http-equiv="Content-type" content="text/html charset=utf-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0
    maximun-scale=1, user-scalable=yes'>
    <meta name="description" content="SystemWeb">
    <meta name="autor" content="Javier Enciso">
    <link rel="shortcut icon" href="assets/img/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="assets/plugins/font-awesome-4.6.3/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/AdminLTE.min.css" type="text/css">
    <title>Login1</title>
</head>
<body>
    <div class="login-box">
        <div style = "color: #2c8dbc" class="login-logo">
            <img style="margin-top: 15px;" src="assets/img/favicon.ico" alt="Sysweb" height="50">
            <b>SysWeb</b>
        </div>

            <?php
                if(empty($_GET['alert'])){
                    echo "";
                }
                elseif($_GET['alert']==1){
                    echo "<div class='alert alert-danger alert-dismissable'>
                    <button style= color:white type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4 style='color:white'>Error al iniciar sesión</h4>
                    <p style = 'color:white'>Usuario o contraseña incorrecta</p>
                    </div>";
                }
                elseif($_GET['alert']==2){
                    echo "<div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4>Operación exitosa</h4>
                    Sesión cerrada.
                    </div>";
                }
                elseif($_GET['alert']==3){
                    echo "<div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4>Atención!</h4>
                    Contraseña nueva resgistrada con éxito
                    </div>";
                }
                elseif($_GET['alert']== 4){
                    echo "<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4>Atención!</h4>
                    Las contraseñas no coinciden
                    </div>";
                }?>

                
        <div class="login-box-body">
            <p class="login-box-msg"><i class="fa fa-user icon-title"></i>Iniciar sesión</p>
            <br>
            <form action="login-check.php" method="POST">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="username" placeholder="User" autocomplete="off" required>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="password" placeholder="Your password here" autocomplete="off" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-12">
                        <input type="submit" class="btn btn-primary btn-lg btn-block btn-flat" name="login" value="Login">
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <script src="assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>