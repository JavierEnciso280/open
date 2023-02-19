
<?php
session_start();
require "../../config/database.php";

if(empty($_SESSION['username']) && empty($_SESSION['password'])){
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=3'>";
    
}else{
    if(isset($_POST['guardar'])){
        if(isset($_SESSION['id_user'])){
            //capturar en variables los datos ingresados en los inputs de view
            $oldPass = md5(mysqli_real_escape_string($conex, trim($_POST['old-password'])));
            $newPass = md5(mysqli_real_escape_string($conex, trim($_POST['new-password'])));
            $retypePass = md5(mysqli_real_escape_string($conex, trim($_POST['retype-password'])));

            $id_user = $_SESSION['id_user'];//lo que viene de la base de datos
            //realizar consulta
            $sql = mysqli_query($conex, "SELECT password from usuarios WHERE id_user = $id_user")
            or die('error'.mysqli_error($conex));
            
            //convertir a array todo el resultado sql
            $data = mysqli_fetch_assoc($sql);
            
            //comparar si la contraseña es distinta a la contraseña de la bs
            if($oldPass != $data['password']){//nueva contraseña es distinta a la contraseña registrada antes
                header("Location: ../../main.php?module=pass&alert=1");
            }else{
                if($newPass != $retypePass){
                    header("Location: ../../main.php?module=pass&alert=2");
                }else{
                    //actualizacion de password
                    $consulta = mysqli_query($conex, "UPDATE usuarios SET password='$newPass'
                    WHERE id_user = '$id_user';")
                    or die('error'.mysqli_error($conex));
                    //mensaje con password ya actualizado
                    if($consulta){
                        header("Location: ../../main.php?module=pass&alert=1");
                    }
                }
            }
        }
    }
}

?>