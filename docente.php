<?php
include "conectar.php";
if( isset($_GET["ci"]) ){
	$ci = $_GET['ci'];
	$color = $_GET['color'];
	$query = mysqli_query($con,"SELECT * FROM persona WHERE ci = '$ci'");
	$fila = mysqli_fetch_array($query);
	$nombre=$fila["nombre"];
}
?>

<!DOCTYPE html>
<html lang="es-BO">
  <head>
		<title>UMSA</title>
	</head>
	<link rel='stylesheet' type='text/css' href='/ejercicio4/style.css' />
  <body>
    <header id="cabeza">
    	<div>
      	<div>
        	<ul> 
						<h2 class="title">UMSA FCPN</h2>
						<li><a href="/ejercicio4">Inicio</a></li>
        	</ul>
      	</div>
    	</div>
		</header>
		<h2>Bienvenido Docente <?php echo $nombre;?> </h2><br>
		<table>
			<tr>
				<th></th>
				<?php
					$query2 = mysqli_query($con,"SELECT depto,ci FROM persona GROUP BY depto");
					while($fila2 = $query2->fetch_row()){
						if($fila2[0]=="07"){
							echo "<th>SC</th>";
						}
						if($fila2[0]=="02"){
							echo "<th>LP</th>";
						}
						if($fila2[0]=="03"){
							echo "<th>CB</th>";
						}
					}
				?>
			</tr>
			<?php
				$query3 = mysqli_query($con,"SELECT sigla FROM nota group by sigla");
				while($fila3 = $query3->fetch_row()){
					echo "<tr>";
					echo "<td>$$fila3[0]</td>";
					$query4 = mysqli_query($con,"select n.sigla,p.depto,n.notaFinal from persona p, nota n WHERE n.ci=p.ci");
					while($fila4 = $query4->fetch_row()){
						if($fila4[0]==$fila3[0]){
							if($fila4[1]=="02"){
								echo "<td>$fila4[2]</td>";
							}else{
								echo "<td>0</td>";
							}
							if($fila4[1]=="03"){
								echo "<td>$fila4[2]</td>";
							}else{
								echo "<td>0</td>";
							}
							if($fila4[1]=="07"){
								echo "<td>$fila4[2]</td>";
							}else{
								echo "<td>0</td>";
							}
						}
					}
					echo "</tr>";
				}
			?>
		</table>
		<?php
		?>
<?php
include "footer.php";
echo "<script>colorChange2('$color')</script>";?>