<?php
//llamar a la bd
require_once 'config/database.php';

//si existen los datos username y password del metodo post
if(isset($_POST['username']) and isset($_POST['password'])){
    //asignarles una variable y validar las mismas
    $userName = mysqli_real_escape_string($conex,stripslashes(strip_tags(htmlspecialchars(trim($_POST['username'])))));
    $userPassword = md5(mysqli_real_escape_string($conex, stripslashes(strip_tags(htmlspecialchars(trim($_POST['password']))))));
    //si los datos de las variables son distintos de valores alfanumericos, lanzar el alert=1 (danger)
    if(!ctype_alnum($userName) or !ctype_alnum($userPassword)){
        header("Location: index.php?alert=2");
    }else{
        //crear la sentencia sql para despues comparar qué se ingresó
        $consultaSql = mysqli_query($conex, "SELECT * FROM usuarios WHERE username='$userName' AND password = '$userPassword' AND status ='activo';")
        or die('error'.mysqli_error($conex));
        //funcion que verifica si la consulta tiene algo, guardar en otra variable en este caso rows
        $rows = mysqli_num_rows($consultaSql);
        //comparar si efectivamente hay datos en la consulta
        if($rows > 0){
            //si hay algo, crear variable para convertir en array la consulta sql
            $arrayConsulta = mysqli_fetch_assoc($consultaSql);
            //funcion para indicarle que inicie sesion
            session_start();
            //guardar los valores de esa sesión
            //a las variables propias de php se les asigna los valores obtenidos en la consulta
            $_SESSION['id_user'] = $arrayConsulta['id_user'];
            $_SESSION['username'] = $arrayConsulta['username'];
            $_SESSION['name_user'] = $arrayConsulta['name_user'];
            $_SESSION['password'] = $arrayConsulta['password'];
            $_SESSION['permisos_acceso'] = $arrayConsulta['permisos_acceso'];
            
            header("Location: main.php?module=start");//llama al archivo view.php dentro de start, en ese archivo está todo el menu de inicio
        }else{
            header("Location: index.php?alert=1");//lanza mensaje de error de contraseña o usuario
        }
        
    }
}


?>