<?php
    if($_GET['form']=='agregar'){ ?>
        <section class="content-header">
            <h1>
                <i class="fa fa-edit icon title"></i> Agregar Clientes
            </h1>

            <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="?module=start">Inicio</a></li>
                <li class=""><a href="?module=clientes">Clientes</a></li>
                <li class="active">Agregar</li>
                
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <form role="form" class="form-horizontal" method="POST" action="modules/clientes/proces.php?act=add">
                            <div class="box-body">

                                <!--generar automaticamente el codigo en este bloque-->
                                <?php
                                $consulta_Id = mysqli_query($conex, "SELECT MAX(id_cliente) as id FROM clientes")
                                or die('error'.mysqli_error($conex));
                                //contar
                                $contar = mysqli_num_rows($consulta_Id);
                                if($contar<>0){
                                    $data_id = mysqli_fetch_assoc($consulta_Id);
                                    $codigo = $data_id['id']+1; //id declarado como alias en la consulta_Id
                                }else{
                                    $codigo = 1;
                                }
                                ?>
                                <!--fin de bloque generar codigo-->

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Codigo</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="codigo" value="<?php echo $codigo;?>" readonly>
                                    </div>
                                </div>

                                <!--combo buscador-->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Ciudad</label>
                                    <div class="col-sm-5">
                                        <select class="chosen-select" name="cod_ciud" data-placeholder="--Seleccionar Ciudad--" autocomplete="off" required>
                                            <option value="<?php echo $codigo['cod_ciudad'];?>"><?php echo $codigo['cod_ciudad'];?></option>
                                            <?php
                                                $query_ciudad = mysqli_query($conex, "SELECT cod_ciudad, dep.id_departamento, descrip_ciudad, dep.dep_descripcion
                                                FROM ciudad ciu
                                                JOIN departamento dep
                                                WHERE ciu.id_departamento = dep.id_departamento ORDER BY cod_ciudad ASC
                                                ")
                                                or die('error'.mysqli_error($conex));

                                                while($data_ciud = mysqli_fetch_assoc($query_ciudad)){
                                                    echo "
                                                    <option value=\"$data_ciud[cod_ciudad]\">$data_ciud[dep_descripcion] | $data_ciud[descrip_ciudad]</option>
                                                    ";
                                                };
                                            
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Ci_ruc</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="ci_ruc" placeholder="Ingresar ci o ruc" autocomplete="off" onkeypress="return goodchars(event,'0123456789', this)" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Nombres</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="nombres" placeholder="Ingresar nombres" autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Apellidos</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="apellidos" placeholder="Ingresar apellidos" autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Direccion</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="direccion" placeholder="Ingresar direccion" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Teléfono</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="tel" placeholder="Ingresar telefono" onkeypress="return goodchars(event,'0123456789',this)" autocomplete="off">
                                    </div>
                                </div>

                                

                                <div class="box-footer">
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <input type="submit" class="btn btn-primary btn-submit" name="guardar" value="Guardar">
                                            <a class="btn btn-default btn-reset" href="?module=clientes">Cancelar</a>
                                        </div>
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
        if(isset($_GET['id_modify_client'])){
            $consulta = mysqli_query($conex, "SELECT * FROM v_clientes WHERE id_cliente = '$_GET[id_modify_client]'")
            or die('error'.mysqli_error($conex));

            $data_client = mysqli_fetch_assoc($consulta);
        }?>
        <!--VISTA DE LA OPCION EDITAR-->
        <section class="content-header">
            <h1>
                <i class="fa fa-edit icon title"></i> Modificar Cliente
            </h1>

            <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="?module=start">Inicio</a></li>
                <li class=""><a href="?module=clientes">Cliente</a></li>
                <li class="active">Modificar</li>
                
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary"><!--el act=update lleva al proceso a ser realizado en poces.php en la condicion act=update-->
                        <form role="form" class="form-horizontal" method="POST" action="modules/clientes/proces.php?act=update">
                            <div class="box-body">
                                <!--Vista con los campos traidos de la bd-->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Codigo</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="codigo" value="<?php echo $data_client['id_cliente']; ?>" readonly>
                                    </div>
                                </div>
                                <!--cargar datos-->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Ciudad</label>
                                    <div class="col-sm-5">
                                        <select class="chosen-select" name="up_codCiud" data-placeholder="--Seleccionar Ciudad--" autocomplete="off" required>
                                            <option value="<?php $data_client['cod_ciudad']; ?>"><?php echo $data_client['descrip_ciudad'];?></option>
                                            <?php
                                                $query_ciudad = mysqli_query($conex, "SELECT cod_ciudad, dep.id_departamento, descrip_ciudad, dep.dep_descripcion
                                                FROM ciudad ciu
                                                JOIN departamento dep
                                                WHERE ciu.id_departamento = dep.id_departamento ORDER BY cod_ciudad ASC
                                                ")
                                                or die('error'.mysqli_error($conex));

                                                while($data_ciud = mysqli_fetch_assoc($query_ciudad)){
                                                    echo "
                                                    <option value=\"$data_ciud[dep_departamento]\">$data_ciud[descrip_ciudad] | $data_ciud[dep_descripcion]</option>
                                                    ";
                                                };
                                            
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Ci_ruc</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="up_ciRuc" value="<?php echo $data_client['ci_ruc'];?>" onkeypress="return goodchars(event,'0123456789', this)" required><!--el data_client es el query 1-->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Nombres</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="up_nombres" value="<?php echo $data_client['cli_nombre']?>" autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Apellidos</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="up_apellidos" value="<?php echo $data_client['cli_apellido']?>" autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Direccion</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="up_direccion" value="<?php echo $data_client['cli_direccion']?>" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Teléfono</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="up_telefono" value="<?php echo $data_client['cli_telefono'];?>" onkeypress="return goodchars(event,'0123456789',this)" autocomplete="off">
                                    </div>
                                </div>

                                

                                <div class="box-footer">
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <input type="submit" class="btn btn-primary btn-submit" name="guardar" value="Guardar">
                                            <a class="btn btn-default btn-reset" href="?module=clientes">Cancelar</a>
                                        </div>
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