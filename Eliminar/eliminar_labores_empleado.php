<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0,minimum-scale=1.0">
                <link rel="stylesheet" href="../css/bootstrap.min.css">
	<title>Eliminar labores</title>
</head>
<body>
        <?php 
        if (isset($_POST['Eliminar'])) 
	{
                $codLabor = $_POST["codLabor"];
		require('../conexion.php');
                
                $sql="UPDATE `labores_empleados` SET `eliminar` = 1"
                        . " WHERE `codigo_labor_empleado`= $codLabor ";
                
		if ($link->query($sql) === TRUE) {
		    echo "<center><p>Registro eliminado satisfactoriamente</p></center>";
                    ?>
                    <center><td><input type="button" name="volver" value="Volver" class="btn btn-primary" onclick="window.location.href='../Lista/lista_labores_empleado.php'"></td></center>
                    <?php
		} else {
		    echo "Error: " . $sql . "<br>" . $link->error;
		}
        
        }else{
            ?>
                 <table align="center" class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="thead-dark" scope="col"><center>CODIGO LABOR EMPLEADO</center></th>
                                        <th class="thead-dark" scope="col"><center>Nombre EMPLEADO</center></th>
                                        <th class="thead-dark" scope="col"><center>Nombre LABOR</center></th>
                                    </tr>
                                    </thead>

					<?php
						require('../conexion.php');
						//$query="SELECT * FROM labores_empleados WHERE eliminar = 0 ORDER BY codigo_labor_empleado";
						$query="SELECT codigo_labor_empleado,empleado.nombre,labores.nombre FROM labores_empleados INNER JOIN empleado ON labores_empleados.codigo_empleado=empleado.codigo_empleado INNER JOIN labores ON labores_empleados.codigo_labor=labores.codigo_labor WHERE (empleado.eliminar=0 AND labores.eliminar=0)";
						$resultado=mysqli_query($link,$query);
						while ($extraido= mysqli_fetch_array($resultado)) {
							echo "<tr align='center'><td>".$extraido[0]."</td>";
							echo "<td>".$extraido[1]."</td>";
							echo "<td>".$extraido[2]."</td></tr>";
						}
					?>
			</table>
                <form method="post" action="eliminar_labores_empleado.php">
                    <center><label>
                    <tr><td>Codigo labor empleado: </td>
                        <td><select class="form-control" name="codLabor">
                            <?php    
                                $query= "SELECT `codigo_labor_empleado`"
                                        ." FROM `labores_empleados` WHERE `eliminar` = 0 "
                                        ." ORDER BY `codigo_labor_empleado`";
                                $resultado= mysqli_query($link,$query);
                                while($extraido= mysqli_fetch_array($resultado))
                                {
                                    echo "<option value='$extraido[codigo_labor_empleado]'>$extraido[codigo_labor_empleado]</option>";
                                }
                            ?>
                        </select></td></tr>
                <br/></label>
                        <p><input class="btn btn-primary" type="submit" name="Eliminar" value="Eliminar" /></p>
                </form>
        <?php
        }
	?>
</body>
</html>