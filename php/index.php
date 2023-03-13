<?php



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-type" content="text/html charset=utf-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0
    maximun-scale=1, user-scalable=yes'>    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/stylesForm.css">
    <title>Registro</title>
</head>
<body>
    <div class="container">
        <div class="title">
            <h2>Registrarse</h2>
            <?php
            if(empty($_GET['alert'])){
                echo " ";
            }
            elseif($_GET['alert']==2){
                echo "
                    <div class='alert alert-danger alert-dismissible' role='alert'>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-hidden='true'></button>
                        <p>Por favor complete los campos requeridos</p>
                    </div>
                ";
            }elseif($_GET['alert']==3){
                echo "
                    <div class='alert alert-danger alert-dismissible' role='alert'>
                        <button type='button' class='btn-close' aria-hidden='true' data-bs-dismiss='alert'></button>
                        <p>Datos incorrectos, por favor ingrese caracteres válidos</p>
                    </div>
                ";
            }elseif($_GET['alert']==4){
                echo "
                    <div class='alert alert-dismissible alert-success' role='alert'>
                        <button type='button' class='btn-close' aria-hidden='true' data-bs-dismiss='alert'></button>
                        <p>Error, algo ha pasado </p>
                    </div>

                ";
            }elseif($_GET['alert']==5){
                echo "
                    <div class='alert alert-dismissible alert-danger' role='alert'>
                        <button type='button' class='btn-close' aria-hidden='true' data-bs-dismiss='alert'></button>
                        <p>Error, no puede ingresar con ese correo!</p>
                    </div>
                ";
            }elseif($_GET['alert']==6){
                echo "
                    <div class='alert alert-dismissible alert-danger' role='alert'>
                        <button type='button' class='btn-close' aria-hidden='true' data-bs-dismiss='alert'></button>
                        <p>Error, ingrese solo números en el campo teléfono</p>
                    </div>
                ";
            }
        ?>
        </div>
        <div class="formulario">
            <form action="./login-check.php" method="POST">
           
                <div class="row">
                    <div class="form-group col">
                        <input class="input-required" type="text" name="name" id="name" placeholder="Nombre *">      
                        <small>Requerido</small>
                    </div>
                    <div class="form-group col">
                        <input class="input-required" type="text" name="lastname" id="lastname" placeholder="Apellidos *">
                        <small>Requerido</small>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col">
                        <input class="input-required" type="email" name="email" id="email" placeholder="Correo electrónico *">
                            <small>Requerido</small>
                    </div>
                    <div class="form-group col">
                        <input class="input-phone" type="text" name="phone" id="phone" placeholder="Teléfono">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-next" name="btn-next">Siguiente</button>

            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"  integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>

<script src="../js/control-user.js"></script>
</body>
</html>