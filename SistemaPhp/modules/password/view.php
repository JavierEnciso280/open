
<?php
    //include 'procesar.php';
?>
<section class="content-header">
    <h1>
        <i class="fa fa-lock icon-title"></i>Modificar contraseña
    </h1>
        
    <ol class="breadcrumb">
        <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
        <li class="active">Contraseña</li>
        <li class="active">Modificar</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!--mensajes de error-->
            <?php
                if(empty($_GET['alert'])){
                    echo "";
                }elseif($_GET['alert']==1){
                    echo "
                        <div class='alert alert-danger alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h4><i class= 'icon fa fa-times-circle'></i>Error</h4>
                            La contraseña que ingresaste no es correcta, vuelve a intentarlo
                        </div>
                    ";
                }elseif($_GET['alert']==2){
                    echo "
                        <div class='alert alert-danger alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h4><i class= 'icon fa fa-times-circle'></i>Error</h4>
                            Vuelva a escribir la contraseña nueva
                        </div>
                    ";
                }elseif($_GET['alert']==3){
                    echo "
                        <div class='alert alert-succes alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h4><i class= 'icon fa fa-times-circle'></i></h4>
                            Operación exitosa, su contraseña se ha actualizado.
                        </div>
                    ";
                }
            ?>

            <!--Formulario cambiar contraseña-->
            <div class="box box-primary">
                <form action="modules/pass/procesar.php" role="form" class="form-horizontal" method="POST">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Contraseña anterior</label>
                            <div class="col-sm-5">
                                <input type="password" class="form-control" name="old-password" autocomplete="off" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Contraseña nueva</label>
                            <div class="col-sm-5">
                                <input type="password" class="form-control" name="new-password" autocomplete="off" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Repetir contraseña</label>
                            <div class="col-sm-5">
                                <input type="password" class="form-control" name="retype-password" autocomplete="off" required>
                            </div>
                        </div>
                    </div>

                    <!--botones-->
                    <div class="box-footer bg-btn-action">
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <input type="submit" class="btn btn-primary btn-submit" name="guardar" value="Save">
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>