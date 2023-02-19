<?php

//procesar los eventos de formularios que vienen del form-user


session_start();

require_once "../../config/database.php";

if(empty($_SESSION['username']) && empty($_SESSION['password'])){
    echo "<meta http-equiv='refresh' content='0; url=../../index.php?alert=3'>";
}

else{
    //hay dos eventos que son agregar(act=add) y editar(act=update)
    if($_GET['act']=='insert'){
        if(isset($_POST['guardar'])){
            //capturar los valores identificados por name, del name del form agregar
            $username = mysqli_real_escape_string($conex, trim($_POST['username']));
            $password = md5(mysqli_real_escape_string($conex, trim($_POST['contraseña'])));
            $nameUser = mysqli_real_escape_string($conex, trim($_POST['name_user']));
            $permisos = mysqli_real_escape_string($conex, trim($_POST['permisos_acceso']));
            $correo = mysqli_real_escape_string($conex, trim($_POST['correo']));
            $tel = mysqli_real_escape_string($conex, trim($_POST['telefono']));
            $photo = mysqli_real_escape_string($conex, trim($_POST['foto']));
            //crear la consulta
            $query = mysqli_query($conex, "INSERT INTO usuarios (name_user,username,password,permisos_acceso,email, telefono, foto) values ('$nameUser','$username','$password','$permisos', '$correo', '$tel', '$photo');")
            or die('error'.mysqli_error($conex));
            //comprobar si es correcto el query
            if($query){
                header("Location: ../../main.php?module=user&alert=1");
            }
        }
    }

    
    elseif($_GET['act']=='update'){
        if(isset($_POST['guardar'])){
            if(isset($_POST['id_user'])){
                //traer los datos que estan dentro con sus nuevos o iguales parametros
                $username = mysqli_real_escape_string($conex, trim($_POST['username']));
                $nameUser = mysqli_real_escape_string($conex, trim($_POST['name_user']));
                $permisos = mysqli_real_escape_string($conex, trim($_POST['permisos_acceso']));
                $correo = mysqli_real_escape_string($conex, trim($_POST['email']));
                $tel = mysqli_real_escape_string($conex, trim($_POST['telefono']));
                $idUs = mysqli_real_escape_string($conex, trim($_POST['id_user']));
                    
                //para las fotos
                $name_file = $_FILES['foto']['name'];
                $dimension_file = $_FILES['foto']['size'];
                $type_file = $_FILES['foto']['type'];
                $temp_file = $_FILES['foto']['temp'];

                $allowed_extensions = array('jpg', 'jpeg', 'png');

                $path_file = "../../images/user/".$name_file;
                    

                $file = explode(".",$name_file);

                $extension = array_pop($file);

                if(empty($_FILES['foto']['name'])){
                    $queryUpdate = mysqli_query($conex, "UPDATE usuarios SET username = '$username', 
                                                                            name_user ='$nameUser', 
                                                                            email = '$correo', 
                                                                            telefono = '$tel', 
                                                                            permisos_acceso = '$permisos'
                                                                            WHERE id_user = '$idUs'")
                                                                            or die('error'.mysqli_error($conex));

                    if($queryUpdate){
                        header("Location: ../../main.php?module=user&alert=2");
                    }
                }
                    
                elseif(!empty($_FILES['foto']['name'])){
                    //comprobar tamaño del archivo
                    if(in_array($extension, $allowed_extensions)){
                        if($dimension_file <= 1000000){
                            if(move_uploaded_file($temp_file, $path_file)){
                                $query = mysqli_query($conex, "UPDATE usuarios SET username = '$username', 
                                                                            name_user ='$nameUser', 
                                                                            email = '$correo', 
                                                                            telefono = '$tel', 
                                                                            foto = '$name_file',
                                                                            permisos_acceso = '$permisos' 
                                                                            WHERE id_user = '$idUs'")
                                                                            or die('error'.mysqli_error($conex));

                                if($query){
                                    header("location: ../../main.php?module=user&alert=2");
                                }
                            }else{
                                header("location: ../../main.php?module=user&alert=5");
                            }
                        }else{
                            header("location: ../../main.php?module=user&alert=6");
                            }
                    }else{
                        header("location: ../../main.php?module=user&alert=7");
                    }
                    
                }   
                    
            }
        }       

    }        // cierre del if update
        
    elseif($_GET['act']=='on'){
        if(isset($_GET['id'])){
            $idUser = $_GET['id'];
            $estado = "activo";

            $consulta = mysqli_query($conex, "UPDATE usuarios SET status = '$estado' WHERE id_user = '$idUser';")
            or die('error'.mysqli_error($conex));

            if($consulta){
                header("Location: ../../main.php?module=user&alert=3");
            }

        }
    }

    elseif($_GET['act']=='off'){
        if(isset($_GET['id'])){
            $idUser = $_GET['id'];
            $estado = "bloqueado";

            $consulta = mysqli_query($conex, "UPDATE usuarios SET status = '$estado' WHERE id_user = '$idUser';")
            or die('error'.mysqli_error($conex));

            if($consulta){
                header("Location: ../../main.php?module=user&alert=4");
            }
        }

    }
    
}    



?>