<?php
include "config/database.php";

$query = mysqli_query($conex, "SELECT id_user, name_user, foto, permisos_acceso FROM usuarios 
WHERE id_user=$_SESSION[id_user]")
or die('error'.mysqli_error($conex));
$data = mysqli_fetch_assoc($query);

?>
<li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <?php
        //si la foto está vacía, asignarle uno por defecto
            if($data['foto']==""){
        ?>
            <img src="images/user/user-default.png" class="user-image" alt="imagen">
        <?php 
        }else{
        ?>
        <!--foto de usuario-->
        <img src="images/user/<?php echo $data['foto'];?>" class="user-image" alt="imagen1">
        <?php
        }
        ?>
        <!--nombre de usuario aqui-->
        <span class="hidden-xs"><?php echo $data['name_user'];?><i style="margin-left:5px" class="fa fa-angle-down"></i></span>
    </a>
        <!--desplegable al dar click-->
    <ul class="dropdown-menu">
        <li class="user-header">
        <?php
        //si la foto está vacía, asignarle uno por defecto
            if($data['foto']==""){
        ?>
            <img src="images/user/user-default.png" class="img-circle" alt="imagen">
        <?php 
        }else{
        ?>
        <!--foto de usuario-->
        <img src="images/user/<?php echo $data['foto'];?>" class="img-circle" alt="imagen1">
        <?php
        }
        ?>
        <p>
            <?php echo $data['name_user'];?>
            <small><?php echo $data['permisos_acceso'];?></small>
        </p>
        </li>
        <li class="user-footer">
            <div class="pull-left">
                <a href="?module=perfil" style="width:80px" class="btn btn-default btn-flat">Perfil</a>
            </div>
            <div class="pull-right">
                <a href="#logout" data-toggle="modal" style="width:80px" class="btn btn-default btn-flat">Salir</a>
            </div>
        </li>
    </ul>
</li>