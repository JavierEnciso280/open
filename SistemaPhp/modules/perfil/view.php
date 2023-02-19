
<!--cabecera-->
<!--primero verificar si existen los parametros para proceder a visualizar la vista-->
<?php
    if(isset($_SESSION['id_user'])){//consulta si es el id_user principal declarado en login-check
        $consulta = mysqli_query($conex, "SELECT * FROM usuarios WHERE id_user = '$_SESSION[id_user]'")
        or die('error'.mysqli_error($conex));
        $data = mysqli_fetch_assoc($consulta);
    }

?>
<section class="content-header">
    <h1>
        <i class="fa fa-user icon-title"></i>Perfil de usuarios
    </h1>
    <ol class="breadcrumb">
        <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
        <li class="active">Perfil de usuario</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php
            if(empty($_GET['alert'])){
                echo "";
            }
            elseif($_GET['alert']==1){
            echo "
            <div class ='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-check-circle'></i>Exito</h4>
                Datos modifacdos correctamente
            </div>
            
            ";
            }elseif($_GET['alert']==2){
                echo "
                <div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon fa fa-check-circle'></i>Algo salió mal!</h4>
                    No se guardaron los datos!
                </div>
                ";
            }elseif($_GET['alert']==3){
                echo "
                <div class=alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon fa fa-check-circle'></i>Error</h4>
                    El tamaño de su archivo supera el limite permitido, tamaño máximo 1MB.

                </div>
                ";
            }elseif($_GET['alert']==4){
                echo "
                <div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon fa fa-check-circle'></i>Error</h4>
                    El formato de archivo no es válido, seleccione archivos JPG, JPEG, PNG.
                </div>
                ";
            }
            ?>

            <div class="box box-primary">
                <form class="form-horizontal" role="form" method="POST" action="?module=form-perfil" enctype="multipart/form-data">
                    <div class="box-body">
                        <input type="text" name="id_user" value="<?php echo $data['id_user']; ?>">

                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                                <?php
                                if($data['foto']==""){ ?>
                                <img style="border:1px solid gray ; border-radius:50%; height:100px;" src="images/user/user-default.png" alt="imagen">
                                <?php
                                }else{ ?>
                                
                                <img style="border:1px solid gray ; border-radius:50%; height:100px;" src="images/user/<?php echo $data['foto'];?>" alt="imagen">
                                
                                <?php
                                }
                                ?>
                            </label>

                            <label class="col-sm-8" style="font-size:25px; margin-top:40px;">
                                <?php echo $data['name_user'];?>
                            </label>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Usuario</label>
                            <label class="col-sm-8 control-label" style="text-align:left;"><?php echo $data['username']; ?></label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nombre y Apellido</label>
                            <label class="col-sm-8 control-label" style="text-align:left;"><?php echo $data['name_user']; ?></label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Correo</label>
                            <label class="col-sm-8 control-label" style="text-align:left;"><?php echo $data['email']; ?></label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Telefono</label>
                            <label class="col-sm-8 control-label" style="text-align:left;"><?php echo $data['telefono']; ?></label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tipo de acceso</label>
                            <label class="col-sm-8 control-label" style="text-align:left;"><?php echo $data['permisos_acceso']; ?></label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Estado</label>
                            <label class="col-sm-8 control-label" style="text-align:left;"><?php echo $data['status']; ?></label>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-8">
                                <input type="submit" class="btn btn-primary btn-submit" name="modificar" value="Modificar">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

