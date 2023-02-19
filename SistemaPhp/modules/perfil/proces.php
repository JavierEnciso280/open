<?php

    session_start();
    require_once "../../config/database.php";

    if(empty($_SESSION['username']) && empty($_SESSION['password'])){
        echo "<meta http-equiv='refresh' content='0; url-index.php?alert=3'>";
    }else{
        if($_GET['act']=='update'){
            if(isset($_POST['guardarbtn'])){
                if(isset($_POST['id_user'])){
                    //capturar los datos ingresados en los inputs de form
                    $usuario =  mysqli_real_escape_string($conex,trim($_POST['username']));
                    $userNombre = mysqli_real_escape_string($conex, trim($_POST['name_user']));
                    $email = mysqli_real_escape_string($conex,trim($_POST['email']));
                    $telf = mysqli_real_escape_string($conex, trim($_POST['telefono']));
                    $id = mysqli_real_escape_string($conex, trim($_POST['id_user']));
                    //el $id es el input hidden de form

                    //variables para la foto
                    $name_file = $_FILES['foto']['name'];
                    $size_file = $_FILES['foto']['size'];
                    $type_file = $_FILES['foto']['type'];
                    $tem_file  = $_FILES['foto']['temp'];

                    $allowed_ext = array('jpg','jpeg','png');

                    $path = "../images/user/".$name_file;

                    $file = explode(".",$name_file);

                    $extension = array_pop($file);

                    if(empty($_FILES['foto']['name'])){
                        $query = mysqli_query($conex, "UPDATE usuarios SET username     = '$usuario',
                                                                            name_user   = '$userNombre',
                                                                            email       = '$email',
                                                                            telefono    = '$telf'
                                                                        WHERE id_user   = '$id'")
                        or die('error'.mysqli_error($conex));

                        if($query){
                            header("location: ../../main.php?module=perfil&alert=1");
                        }///////////////////////
                    }else{
                        if(in_array($extension, $allowed_ext)){
                            if($size_file <= 1000000){
                                if(move_uploaded_file($tempS_file,$path)){
                                    $query = mysqli_query($conex, "UPDATE usuarios SET username = '$usuario',
                                                                            name_user = '$userNombre',
                                                                            email     = '$email',
                                                                            telefono  = '$telf',
                                                                            foto      = '$name_file'
                                                                            WHERE id_user = '$id'")
                                    or die('error'.mysqli_error($conex));

                                    if($query){
                                    header("location: ../../main.php?module=perfil&alert=1");
                                    }
                                }else{
                                    header("location: ../../main.php?module=perfil&alert=2");
                                }
                                
                            }else{
                                header("location: ../../main.php?module=perfil&alert=3");
                            }
                            
                        }else{
                            header("location: ../../main.php?module=perfil&alert=4");
                        }
                    }


                }
            }
        }
    }
?>