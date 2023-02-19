<?php
    if($_GET['form']=='agregar'){ ?>
        <section class="content-header">
            <h1>
                <i class="fa fa-edit icon title"></i> Agregar Ciudad
            </h1>

            <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="?module=start">Inicio</a></li>
                <li class=""><a href="?module=city">Ciudad</a></li>
                <li class="active">Agregar</li>
                
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <form role="form" class="form-horizontal" method="POST" action="modules/ciudad/proces.php?act=add">
                            <div class="box-body">

                                <!--generar automaticamente el codigo en este bloque-->
                                <?php
                                $consulta_Id = mysqli_query($conex, "SELECT MAX(cod_ciudad) as id FROM ciudad")
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

                                <!--lista para seleccionar departameno-->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Departamento</label>
                                    <div class="col-sm-5">
                                        <select name="depart" class="form-control"><!--name a llamar en el proces act=add-->
                                            <option value=""></option>
                                            <?php
                                                $query = mysqli_query($conex,"SELECT * FROM departamento")
                                                or die('error'.mysqli_error($conex));

                                                while($data = mysqli_fetch_assoc($query)){
                                                    //atributos de la etiqueta option
                                                    echo "<option value='".$data['id_departamento']."'";
                                                    if($_POST['depart']==$data['id_departamento']){
                                                        echo "SELECTED";
                                                        echo ">";
                                                        echo $data['dep_descripcion'];
                                                        echo "</option>";
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Descripción</label>
                                    <div class="col-sm-5">
                                        <!--Este input debe ser llamado en el proces act=add-->
                                        <input type="text" class="form-control" name="descrip_ciudad" placeholder="Ingrese una ciudad" required>
                                    </div>
                                </div>

                                <div class="box-footer">
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <input type="submit" class="btn btn-primary btn-submit" name="guardar" value="Guardar">
                                            <a class="btn btn-default btn-reset" href="?module=ciudad">Cancelar</a>
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
    elseif($_GET['form']=='edit'){ //form==edit esta como referencia en el boton modificar de view.php, ese btn trae a este bloque
        if(isset($_GET['id'])){
            $consulta = mysqli_query($conex, "SELECT * FROM ciudad WHERE cod_ciudad = '$_GET[id]'")
            or die('error'.mysqli_error($conex));

            $data = mysqli_fetch_assoc($consulta);
            //var_dump($data['id_departamento']);
        }?>
        <!--VISTA DE LA OPCION EDITAR-->
        <section class="content-header">
            <h1>
                <i class="fa fa-edit icon title"></i> Modificar ciudad
            </h1>

            <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="?module=start">Inicio</a></li>
                <li class=""><a href="?module=ciudad">Ciudad</a></li>
                <li class="active">Modificar</li>
                
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary"><!--el act=update lleva al proceso a ser realizado en poces.php en la condicion act=update-->
                        <form role="form" class="form-horizontal" method="POST" action="modules/ciudad/proces.php?act=update">
                            <div class="box-body">
                                <!--Vista con los campos traidos de la bd-->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Codigo</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="codigo-update" value="<?php echo $data['cod_ciudad']; ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Departamento</label>
                                    <div class="col-sm-5">

                                        <select name="depart" class="form-control">
                                            <option value="<?php echo $data['id_departamento']; ?>"><?php echo $data['dep_descripcion'];?></option>
                                            <?php
                                                $query = mysqli_query($conex,"SELECT * FROM departamento")
                                                or die('error'.mysqli_error($conex));
                                                //data2 en este caso, por el scope
                                                while($data2 = mysqli_fetch_assoc($query)){
                                                    //atributos de la etiqueta option
                                                    echo "<option value='".$data2['id_departamento']."'";
                                                    if($_POST['depart']==$data2['id_departamento']){
                                                        echo "SELECTED";
                                                        echo ">";
                                                        echo $data2['dep_descripcion'];
                                                        echo "</option>";
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Descripción</label>
                                    <div class="col-sm-5">
                                        <!--traer el valor que muestra la ciudad, data[descrip_ciudad] del primer query del bloque-->
                                        <input type="text" class="form-control" name="descrip_ciudad" value="<?php echo $data['descrip_ciudad'];?>">
                                    </div>
                                </div>

                                <div class="box-footer">
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <input type="submit" class="btn btn-primary btn-submit" name="btn-update" value="Guardar">
                                            <a class="btn btn-default btn-reset" href="?module=ciudad">Cancelar</a>
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