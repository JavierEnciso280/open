<?php
session_start();

include '../config/conexion.php';
$consulta = mysqli_query($conex, "SELECT usu_name, usu_lastname, usu_email, usu_phone FROM usuario WHERE usu_id = $_SESSION[usu_id]");

$data = mysqli_fetch_assoc($consulta);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-type" content="text/html charset=utf-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=yes'>    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/stylesForm.css">
    <title>Registro</title>
</head>
<body style="background-image: linear-gradient(blue, purple); background-repeat:no-repeat;">
    <div class="container-fluid" style="">
        <div class="title">
            <span>Serás redirigido a la página principal en 10 segundos</span>
        </div>
        <div class="alerta">
        <?php
        //alerta de Bienvenida
        if($_GET['alert']==1){
            echo "
            <div class='alert alert-success alert-dismissible fade show' role='alert' style='width: 20rem;' m-auto>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-hidden='true'></button>
                <p>Bienvenido/a $data[usu_name]</p>
            </div>
            ";
        }
        ?>
        </div>
            <div class="card" style="width:100%; margin:auto;">
                <div class="card-header">
                    Datos ingresados
                </div>
                <div class="card-body">
                    
                    <table class="table w-400px" style="background: white">
                        <thead>
                            <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellido</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Token generado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            
                            <td class="td"><?= $data['usu_name']?></td>
                            <td class="td"><?= $data['usu_lastname']?></td>
                            <td class="td"><?= $data['usu_email']?></td>
                            <td class="td"><?= $data['usu_phone']?></td>
                            <td>
                                <?php
                                //Generar Token
                                $nombreAct = $data['usu_name'];
                                $vocales = ['a','e','i', 'o', 'u'];
                                $extraer = [];

                                for($i = 0; $i<strlen($nombreAct); $i++){
                                    if(in_array($nombreAct[$i], $vocales)){
                                        $extraer[$i]= $nombreAct[$i];
                                    }
                                }
        
                                foreach($extraer as $v){
                                    echo $v;//imprimir primera parte con vocales del nombre
                                }
                                
                                $first = substr($nombreAct, 0, 1);//primera letra
                                $last = substr($nombreAct,-1);//ultima letra
                                
                                $numRandom = random_int(000, 999);//numeros aleatorios
                                echo $first.$last.$numRandom; //imprimir segunda parte con letras y numeros
                                ?>
                            </td>
                        </tbody>
                    </table>
                        <!--Boton volver al index-->
                    <a href="./index.php" class="btn btn-primary">Volver</a>
                </div>
            </div>
            <!--redireccionar automáticamente al index-->
            <meta http-equiv="refresh" content="10; url=http://localhost/ProyectosPropios/PruebaTecnicaSkytel/php/">


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>
</html>
