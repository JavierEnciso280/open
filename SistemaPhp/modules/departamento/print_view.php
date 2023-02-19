<?php
require_once "../../config/database.php";

$query = mysqli_query($conex, "SELECT * FROM departamento")
    or die('error' . mysqli_error($conex));
$count = mysqli_num_rows($query);

?>

<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Reporte de departamentos</title>
        <link rel="stylesheet" type="text/css" href="../../assets/img/favicon.ico">
    </head>
    <body>
        
        <div align="center">
            <img src="../../assets/img/compu2.jpg" style="width:50% ;" alt="">
        </div>

        <div>
            Reporte de departamento
        </div>

        <div align="center">
            Cantidad: <?php echo $count; ?>
        </div>
        <hr>

        <div class="">
            <table width="100%" border="0.3" cellpadding="0" cellspacing="0" align="center">
                <thead style="background: gray;">
                    <tr class="table-title">
                        <th heigth="20" align="center" valing="middle"><small>Código</small></th>
                        <th heigth="20" align="center" valing="middle"><small>Descripción</small></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        while($data = mysqli_fetch_assoc($query)){
                        $codigo = $data['id_departamento'];
                        $descrip = $data['dep_descripcion'];
                        echo "<tr>
                            <td width = '100' align='left'>$codigo</td>
                            <td width = '100' align='left'>$descrip</td>
                            </tr>
                        ";

                        }
                    ?>
                </tbody>
            </table>
        </div>
        
    </body>
</html>