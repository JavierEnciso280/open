
<?php
    
    ?>
    
    <section class="content-header">
        <ol class="breadcrumb" style="margin-right:150px ;">
            <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
            <li class="active">Stock</li>  
        </ol>
    
        <h1>
            <i class="fa fa-edit icon-title"></i> Stock de productos
        </h1>
        <br>
    </section>
    
    <section class="content">
        <div class="row">
            <div class="col-md-12">
          
    
                <div class="box box-primary">
                    

                    <div class="box-body">

                        <form role="form" class="horizontal" method="POST">

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Depósito</label>
                            <!--combo buscar deposito y boton-->
                            <div class="col-sm-3">
                                    <select name="deposito_selected" class="chosen-select" data-placeholder="--Seleccionar depósito--" autocomplete="off" required>
                                        <option value=""></option>
                                            <?php
                                            $consultaDep = mysqli_query($conex, "SELECT * FROM deposito order by cod_deposito asc") or die('error' . mysqli_error($conex));
                                            while($dataDepo = mysqli_fetch_assoc($consultaDep)){
                                                echo "<option value='$dataDepo[cod_deposito]'>$dataDepo[cod_deposito] | $dataDepo[descrip]";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <!--boton para enviar los datos del form-->
                            <div class="col-sm-3">
                                <button type="submit" style="width:200px; bottom:18px;" class="btn btn-primary btn-social btn-submit">
                                    <i class="fa fa-file-text-o icon-title"></i>Buscar depósito
                                </button>
                            </div>
                         

                        </form>
                        <table id="dataTables1" class="table table-bordered table-striped table-hover">
                            <?php 
                            if(!empty($_POST['deposito_selected'])){//preguntar si existe una opcion seleccionada del combo buscador deposito,que tiene como name deposito_selected
                                $cod_deposito = $_POST['deposito_selected'];
                            }else{
                                $cod_deposito = 1;
                            }

                            $query = mysqli_query($conex, "SELECT * FROM v_stock WHERE cod_deposito = $cod_deposito") or die('error' . mysqli_error($conex));
                            while($data = mysqli_fetch_array($query)){
                                $descrip_deposito = $data['descrip'];
                            }
                            ?>
                            <h2>Stock de productos:</h2><?php echo $descrip_deposito;?>
                            <!--Cabecera de la tabla-->
                            <thead>
                                <tr>
                                    <th>Deposito</th>
                                    <th>Descripción</th>
                                    <th>Tipo de Producto</th>
                                    <th>u_medida</th>
                                    <th>cantidad</th>
                                    
                                    
                                </tr>
                            </thead>
    
                            <tbody>
                                <!--mostrar la lista de datos de la bd con php-->
                                <?php
                                $nro = 1;
                                $query = mysqli_query($conex, "SELECT * FROM v_stock where cod_deposito = $cod_deposito")
                                or die('error'.mysqli_error($conex));
                                //vista solo donde estado sea activo, porque se pueden anular las compras con el estado 'anulado'
    
                                //asignar a un array los datos y recorrer con while
                                while($data = mysqli_fetch_assoc($query)){
                                    //ir capturando los datos
                                    $prod_descrip = $data['p_descrip'];
                                    $cod_deposito = $data['cod_deposito'];
                                    $dep_descrip = $data['descrip'];
                                    $tipo_producto = $data['t_p_descrip'];
                                    $u_descrip = $data['u_descrip'];
                                    $cantidad = $data['cantidad'];
                                    
    
                                    echo "
                                    <tr>
                                    <td class='center'>$dep_descrip</td>
                                    <td class='center'>$prod_descrip</td>
                                    <td class='center'>$tipo_producto</td>
                                    <td class='center'>$u_descrip</td>
                                    <td class='center'>$cantidad</td>
                                    
                                    </tr> ";
                                }?>
    
                            </tbody>
    
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>