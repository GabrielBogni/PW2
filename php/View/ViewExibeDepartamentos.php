<?php
$titulo="Exibir Departamentos";
include $_SESSION["root"].'includes/header.php';
?>
<body>
	<div class="container">
		<!-- add no menu -->
		<?php include $_SESSION["root"].'includes/menu.php';?>
		<!-- fim menu -->	
		<div id="principal">
			<h1 class="text-center">Departamentos</h1>
			<table class="table table-striped">
			<?php 
				//$funcionarios foi criado no controller que chamou essa classe;
				echo "<tr>";
					echo "<th>Nome</th>";
					echo "<th>Sigla</th>";
				echo "</tr>";
				if($departamentos){
					foreach ($departamentos as $value) {
						echo "<tr>";
							echo "<td>".$value->getNome()."</td>";
							echo "<td>".$value->getSigla()."</td>";
						echo "</tr>";
					}
				}
			?>
			</table>
		</div>
	</div>	
</body>
<!-- add no footer -->
<?php 
	include $_SESSION["root"].'includes/footer.php';
	if(isset($_SESSION["flash"])){
		foreach ($_SESSION["flash"] as $key => $value) {
			unset($_SESSION["flash"][$key]);	
		}
	}?>
<!-- fim footer -->
<script>		
	$(document).ready(function () {
        $('.visualizarDepartamento').addClass('active');
    });
</script>