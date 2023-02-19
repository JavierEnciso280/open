<?php
    /**en el archivo view de user se encuentra el button 'Agregar'
     * dicho boton hace referencia a este archivo form-user
     * en este archivo se van llamando a las condiciones con las sentencias que en el caso del button
     * es '?form=add'
     * href='?module=form-user?form=add'
     */


    if($_GET['form']=='add'){?> 
        <section class="content-header">
            <h1>
                <i class="fa fa-edit icon-title"></i> Agregar usuario
            </h1>
            <ol class="breadcrumb">
                <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
                <li><a href="?module=user">Usuario</a></li>
                <li class="active"></li>
            </ol>
        </section>
        
        <section class="contenido">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <form action="modules/user/proces.php?act=insert" enctype="multipart/form-data" role="form" class="form-horizontal" method="POST">
                            <div class="box-body">

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Usuario</label>
                                    <div class="col-sm-5">
                                        <input type="text" name="username" class="form-control" autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Contraseña</label>
                                    <div class="col-sm-5">
                                        <input type="password" name="contraseña" class="form-control" autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Nombre y Apellido</label>
                                    <div class="col-sm-5">
                                        <input type="text" name="name_user" class="form-control" autocomplete="off" required>
                                    </div>
                                </div>

                                <!-- <div class="form-group">
                                    <label class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-5">
                                        <input type="email" name="correo" class="form-control" autocomplete="off" required>
                                    </div>
                                </div> -->

                                <!-- <div class="form-group">
                                    <label class="col-sm-2 control-label">Telefono</label>
                                    <div class="col-sm-5">
                                        <input type="text" name="telefono" onkeypress="return goodchars(event, '0123456789',this)"  maxlength="12" class="form-control" autocomplete="off" required>
                                    </div>
                                </div>
 -->
                                

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Permisos de acceso</label>
                                    <div class="col-sm-5">
                                        <select name="permisos_acceso" class="form-control" required>
                                            <option value=""></option>
                                            <option value="Super Admin">Administrador de sistemas</option>
                                            <option value="Compras">Usuario de compras</option>
                                            <option value="Ventas">Usuario de ventas</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="box-footer">

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="submit" class="btn btn-primary btn-submit" name="guardar" value="Guardar">
                                        <a href="?module=user" class="btn btn-default btn-reset">Cancelar</a>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    <?php
    }
    elseif($_GET['form']=='edit'){ 
        if(isset($_GET['id'])){
            $query = mysqli_query($conex, "SELECT * FROM usuarios WHERE id_user='$_GET[id]'")
            or die('error'.mysqli_error($conex));

            $data = mysqli_fetch_assoc($query);//hasta aca los datos a la pestaña nueva
            //ahora crear la vista html
        } ?>

        <section class="content-header">
            <h1>
                <i class="fa fa-edit icon-title"></i> Modificar Usuario
            </h1>
            <ol class="breadcrumb">
                <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
                <li><a href="?module=user">Usuario</a></li>
                <li class="active"></li>
            </ol>
        </section>
        
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <form action="modules/user/proces.php?act=update" enctype="multipart/form-data" role="form" class="form-horizontal" method="POST">
                            <div class="box-body">
                                <!--traer el parametro id de la base de datos para poder hacer update, type='text' para visualizar-->
                                <input type="hidden" name="id_user" value="<?php echo $data['id_user']; ?>">

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Nombre de usuario</label>
                                    <div class="col-sm-5">
                                        <input type="text" name="username" class="form-control" autocomplete="off" value="<?php echo $data['username'];?>" required><!--el value trae los datos de la bd-->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Nombre y Apellido</label>
                                    <div class="col-sm-5">
                                        <input type="text" name="name_user" class="form-control" autocomplete="off" value="<?php echo $data['name_user']; ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-5">
                                        <input type="email" name="email" class="form-control" autocomplete="off" value="<?php echo $data['email']; ?>" required>
                                    </div>
                                </div>
                                    <!--validar ingresar solo numeros y maxlenght 12-->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Teléfono</label>
                                    <div class="col-sm-5">
                                        <input type="text" name="telefono" class="form-control" autocomplete="off" maxlength="12" onkeypress="return goodchars(event, '0123456789',this)" value="<?php echo $data['telefono']; ?>" required>
                                    </div>
                                </div>

                                

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Foto</label>
                                    <div class="col-sm-5">
                                        <input type="file" name="foto"><br>

                                        <?php
                                        if($data['foto']==""){ ?>

                                            <img style="border: 1px solid black; border-radius:5px;" src="images/user/user-default.png" width="128">

                                            <?php
                                        }else{ ?>

                                        <img style="border: 1px solid black; border-radius:5px;" src="images/user/<?php echo $data['foto'];?>" width="128">

                                            <?php 
                                        }
                                        
                                        ?>

                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Permisos de acceso</label>
                                    <div class="col-sm-5">
                                        <select name="permisos_acceso" class="form-control" required>
                                            <option value="<?php echo $data['permisos_acceso'];?>"><?php echo $data['permisos_acceso'];?></option>
                                            <option value="Super Admin">Administrador de sistemas</option>
                                            <option value="Compras">Usuario de compras</option>
                                            <option value="Ventas">Usuario de ventas</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="box-footer">

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="submit" class="btn btn-primary btn-submit" name="guardar" value="Guardar">
                                        <a href="?module=user" class="btn btn-default btn-reset">Cancelar</a>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        

    <?php
    }
?>