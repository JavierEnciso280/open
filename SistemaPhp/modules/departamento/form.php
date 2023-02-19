<?php
    if($_GET['form']=='add'){ ?>
        <section class="content-header">
            <h1>
                <i class="fa fa-edit icon title"></i> Agregar departamento
            </h1>

            <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="?module=start">Inicio</a></li>
                <li class=""><a href="?module=depto">Departamento</a></li>
                <li class="active">Agregar</li>
                
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <form role="form" class="form-horizontal" method="POST" action="modules/departamento/proces.php?act=insert">
                            <div class="box-body">

                                <!--generar automaticamente el codigo en este bloque-->
                                <?php
                                $consulta_Id = mysqli_query($conex, "SELECT MAX(id_departamento) as id FROM departamento")
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
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Departamento</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="dep_descripcion" placeholder="Escriba un departamento">
                                    </div>
                                </div>

                                <div class="box-footer">
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <input type="submit" class="btn btn-primary btn-submit" name="guardar" value="Guardar">
                                            <a class="btn btn-default btn-reset" href="?module=depto">Cancelar</a>
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
        if(isset($_GET['id'])){
            $consulta = mysqli_query($conex, "SELECT * FROM departamento WHERE id_departamento = '$_GET[id]'")
            or die('error'.mysqli_error($conex));

            $data = mysqli_fetch_assoc($consulta);
            //var_dump($data['id_departamento']);
        }?>
        <section class="content-header">
            <h1>
                <i class="fa fa-edit icon title"></i> Modificar departamento
            </h1>

            <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="?module=start">Inicio</a></li>
                <li class=""><a href="?module=depto">Departamento</a></li>
                <li class="active">Modificar</li>
                
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <form role="form" class="form-horizontal" method="POST" action="modules/departamento/proces.php?act=update">
                            <div class="box-body">

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Codigo</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="codigo-update" value="<?php echo $data['id_departamento']; ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Departamento</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="depto-update" value="<?php echo $data['dep_descripcion'];?>">
                                    </div>
                                </div>

                                <div class="box-footer">
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <input type="submit" class="btn btn-primary btn-submit" name="btn-update" value="Guardar">
                                            <a class="btn btn-default btn-reset" href="?module=depto">Cancelar</a>
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