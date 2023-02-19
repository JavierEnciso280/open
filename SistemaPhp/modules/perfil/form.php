<?php
    if(isset($_POST['id_user'])){
        $query = mysqli_query($conex, "SELECT * FROM usuarios WHERE id_user = '$_POST[id_user]'")
        or die('error'.mysqli_error($conex));
        $dataPerfil = mysqli_fetch_assoc($query);
    }
?>

<section class="content-header">
    <h1>
        <i class="fa fa-edit icon-title"></i>Modificar perfil de usuario
    </h1>
    <ol class="breadcrumb">
        <li><a href="?module=start"><i class="fa fa-home">Inicio</i></a></li>
        <li><a href="?module=perfil">Perfil de usuario</a></li>
        <li class="active">Modificar</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <form role="form" class="form-horizontal" method="POST" action="modules/perfil/proces.php?act=update" enctype="multipart/form-data">
                    <div class="box-body">
                        <input type="text" name="id_user" value="<?php echo $dataPerfil['id_user'];?>">

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Usuario</label>
                            <div class="col-sm-5">
                                <input style="margin-top:15px ;" type="text" name="username" autocomplete="off" value="<?php echo $dataPerfil['username']; ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nombre y apellido</label>
                            <div class="col-sm-5">
                                <input style="margin-top:15px ;" type="text" name="name_user" autocomplete="off" value="<?php echo $dataPerfil['name_user']; ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-5">
                                <input type="text" name="email" autocomplete="off" value="<?php echo $dataPerfil['email'];?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Telefono</label>
                            <div class="col-sm-5">
                                <input type="text" name="telefono" autocomplete="off" value="<?php echo $dataPerfil['telefono'];?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Foto</label>
                            <div class="col-sm-5">
                                <input type="file" name="foto">
                                <br>
                                <?php
                                    if($dataPerfil['foto']==""){ ?>
                                        <img style="border:1px solid gray; border-radius:50%; height:120px;" src="images/user/user-default.png" width="">
                                    <?php
                                    }else{ ?>
                                        <img style="border: 1px solid; border-radius:50%; height:120px;" src="../../images/user/<?php echo $dataPerfil['foto'] ;?>" width="128">
                                    <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-offset-2 col-sm-10">
                                <input class="btn btn-primary btn-submit" type="submit" name="guardarbtn" value="Guardar">
                                <a href="?module=perfil" class="btn btn-default btn-reset">Cancelar</a>
                            </div>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
</section>