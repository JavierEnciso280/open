
<?php
require_once "../../config/database.php";

$query = mysqli_query($conex, "SELECT * from v_clientes")
    or die('error' . mysqli_error($conex));
$count = mysqli_num_rows($query);

?>

<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Reporte de Clientes</title>
        <link rel="stylesheet" type="text/css" href="../../assets/img/favicon.ico">
    </head>
    <body>
        
        <div align="center">
            <img src="../../assets/img/compu2.jpg" style="width:50% ;" alt="">
        </div>

        <div>
            Reporte de Clientes
        </div>

        <div align="center">
            Cantidad: <?php echo $count; ?>
        </div>
        <hr>

        <div class="">
            <table width="100%" border="0.3" cellpadding="0" cellspacing="0" align="center">
                <thead style="background: gray;">
                    <tr class="table-title">
                        <th heigth="20" align="center" valing="middle"><small>Ruc</small></th>
                        <th heigth="20" align="center" valing="middle"><small>Depto</small></th>
                        <th heigth="20" align="center" valing="middle"><small>Ciudad</small></th>
                        <th heigth="20" align="center" valing="middle"><small>Nombre</small></th>
                        <th heigth="20" align="center" valing="middle"><small>Apellido</small></th>
                        <th heigth="20" align="center" valing="middle"><small>Teléfono</small></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        while($data = mysqli_fetch_assoc($query)){
                            $ci_ruc = $data['ci_ruc'];
                            $cli_nombre = $data['cli_nombre'];
                            $cli_apellido = $data['cli_apellido'];
                            $cli_telefono = $data['cli_telefono'];
                            $dep_descripcion = $data['dep_descripcion'];
                            $descrip_ciudad = $data['descrip_ciudad'];
                        echo "<tr>
                            <td width = '100' align='left'>$ci_ruc</td>
                            <td width = '100' align='left'>$dep_descripcion</td>
                            <td width = '100' align='left'>$descrip_ciudad</td>
                            <td width = '100' align='left'>$cli_nombre</td>
                            <td width = '100' align='left'>$cli_apellido</td>
                            <td width = '100' align='left'>$cli_telefono</td>
                            </tr>
                        ";

                        }
                    ?>
                </tbody>
            </table>
        </div>
        
    </body>
</html>