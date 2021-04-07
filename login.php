<?php
include "conectar.php";
if(isset($_POST['login'])){
	$ci = $_POST['ci'];
	$pass = $_POST['comtraseña']; 
	$color = $_POST['color'];
	if($ci == "" || $_POST['comtraseña'] == null){
		echo "<script>alert('Error: usuario y/o clave vacios!!');window.location.href='index.php';</script>"; 
	}else{
		$consulta = mysqli_query($con,"SELECT * FROM usuario WHERE ci = '$ci' AND password = '$pass'");
		if(!$consulta){
			echo "ERROR: no se pudo ejecutar la consulta!";
		}else{
			$filas = mysqli_num_rows($consulta);
			if($filas == 0){
				echo "<script>alert('Error: usuario y/o clave incorrectos!!');window.location.href='index.php';</script>";
			}else{
				$f = mysqli_fetch_array($consulta);
				if($f['rol']== 1){
					header("location:docente.php/?ci=$ci&color=$color");
				}else{
					$query = mysqli_query($con,"SELECT * FROM persona WHERE ci = '$ci'");
					$fila = mysqli_fetch_array($query);
					$nombre=$fila["nombre"];
				}
			}
		}
	}
} 
if(isset($_POST['nota'])) {
	$nombre = $_POST['nombre'];
	$color = $_POST['color'];
	$ci = $_POST['ci'];
	$query = mysqli_query($con,"SELECT * FROM nota WHERE ci = '$ci'");
}

?>

<!DOCTYPE html>
<html lang="es-BO">
  <head>
		<title>UMSA</title>
	</head>
	<link rel='stylesheet' type='text/css' href='/ejercicio3/style.css' />
  <body>
    <header id="cabeza">
    	<div>
      	<div>
        	<ul> 
						<h2 class="title">UMSA FCPN</h2>
						<li><a href="/ejercicio3">Inicio</a></li>
        	</ul>
      	</div>
    	</div>
		</header>
		<h2>Bienvenido <?php echo $nombre?></h2><br>
		<form method="POST">
			<input type="hidden" name="ci" value="<?php echo $ci;?>"/>	
			<input type="hidden" name="color" value="<?php echo $color;?>"/>
			<input type="hidden" name="nombre" value="<?php echo $nombre;?>"/>	
			<input type="submit" name="nota" value="Ver Nota"/>	
		</form>
		<table>
			<tr>
				<th>Materia</th>
				<th>Nota 1</th>
				<th>Nota 2</th>
				<th>Nota 3</th>
				<th>Nota Final</th>
			</tr>
			<?php
				while ($q = $query->fetch_row()) {
					echo "<tr>";
					echo "<td>$q[1]</td>";
					echo "<td>$q[2]</td>";
					echo "<td>$q[3]</td>";
					echo "<td>$q[4]</td>";
					echo "<td>$q[5]</td>";
					echo "</tr>";
				}
			?>
		</table>
<?php 
include "footer.php";
echo "<script>colorChange2('$color')</script>";?>
