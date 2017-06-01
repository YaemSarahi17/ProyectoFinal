<!DOCTYPE html>
<html>
<head>
	<title>Ley de Pareto</title>
</head>
<body>
<table border="1" align="center">
<tr>
	<td>
		Nombre
	</td>
	<td>
		Total
	</td>
</tr>
	<?php 
	$conexion = mysql_connect("localhost", "root", "");
	mysql_select_db("pareto");
	$sql = "SELECT (\n"
    . "	SELECT SUM(\n"
    . " Importe\n"
    . "	) FROM ventasmateriales\n"
    . " ) AS TotalImporte, NomProducto, convert(SUM(Importe), DECIMAL(12,1)) as ImporteIndividual\n"
    . "FROM prueba GROUP BY NomProducto ORDER BY ImporteIndividual DESC";
    $res = mysql_query($sql);
    if (mysql_num_rows($res)) {
    	$valorInv = 0;
    	$acu = 0;
    	while ($fila = mysql_fetch_array($res)) {
    		$valorInv=$fila[0] * 0.80;
    		$acu = $acu + $fila[2];
    		if ($acu <= $valorInv) {
    			echo "<tr bgcolor='red'>";
    			echo "<td>". $fila[1] . "</td>";
    			echo "<td>". $fila[2] . "</td>";
    			echo "</tr>";    			
    		}else{
    			echo "<tr bgcolor='yellow'>";
    			echo "<td>". $fila[1] . "</td>";
    			echo "<td>". $fila[2] . "</td>";
    			echo "</tr>";
    		}
    	}
        
    	echo $valorInv .    "VALOR DEL INVENTARIO";
    }
?>
</table>

</body>
</html>