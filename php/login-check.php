<?php
require_once '../config/conexion.php';

if(isset($_POST['btn-next'])){
    //verificar que todos los campos requeridos esten cargados
    $existenDatos = (isset($_POST['name']) && !empty($_POST['name']) &&
    isset($_POST['lastname']) && !empty($_POST['lastname']) && 
    isset($_POST['email']) && !empty($_POST['email']) &&
    isset($_POST['phone']));
    
    if($existenDatos){
        //validaciones 
        $nombre = mysqli_real_escape_string($conex, stripslashes(strip_tags(htmlspecialchars(trim($_POST['name'])))));
        $apellido = mysqli_real_escape_string($conex, stripslashes(strip_tags(htmlspecialchars(trim($_POST['lastname'])))));
        $email = mysqli_real_escape_string($conex, stripslashes(strip_tags(htmlspecialchars(trim($_POST['email'])))));
        $telefono = mysqli_real_escape_string($conex, stripslashes(strip_tags(htmlspecialchars(trim($_POST['phone'])))));

        //validaciones para los errores, con redirección a alertas en el index 
        if(!ctype_alnum($nombre) or !ctype_alnum($apellido)){
            header("Location: index.php?alert=3");
            //si el email es ... lanzar mensaje de error
        }elseif($email == 'john@smith.com'){
            header("Location: index.php?alert=5");
            //solo si no está vacio el campo telefono, valida el tipo de dato ingresado si es o no es numérico
        }elseif(!empty($telefono) && (!is_numeric($telefono) or !ctype_alnum($telefono))){
            header("Location: index.php?alert=6");//insertar solo números
           
        }else{
            //si todo esta ok, primer paso insertar valores a la base de datos
            $insertar = mysqli_query($conex, "INSERT INTO usuario values (null,'$nombre', '$apellido', '$email', '$telefono');")
            or die('error'.mysqli_error($conex));
            if($insertar){
                //si la consulta sql es correcta, volver a traer los datos que se acaban de ingresar
                $consultar = mysqli_query($conex, "SELECT * FROM usuario WHERE usu_name = '$nombre' and usu_email = '$email'");

                //verificar si la consula anterior tiene resultados
                $filas = mysqli_num_rows($consultar);
                //de tener resultados converir a array para extraer los valores y guardar en variables de session
                if($filas > 0 ){
                    $data = mysqli_fetch_assoc($consultar);

                    session_start();

                    $_SESSION['usu_id'] = $data['usu_id'];
                    $_SESSION['usu_name'] = $data['usu_name'];
                    $_SESSION['usu_lastname'] = $data['usu_lastname'];
                    $_SESSION['usu_email'] = $data['usu_email'];
                    $_SESSION['usu_phone'] = $data['usu_phone'];

                    header("Location: main.php?alert=1");//redirigir al main, donde muestra los datos ingresados
                }
            }else{
                header("Location: index.php?alert=4");//mensaje de error si algo ha salido mal en el insert
            }
        }
    }else{
        header("Location: index.php?alert=2");//mensaje de error, cargar los campos requeridos
    }
         
}

?>