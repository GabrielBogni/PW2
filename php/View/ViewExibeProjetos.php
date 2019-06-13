<?php
$titulo="Exibir Projetos";
include $_SESSION["root"].'includes/header.php';
?>
<body>
	<div class="container">
		<!-- add no menu -->
		<?php include $_SESSION["root"].'includes/menu.php';?>
		<!-- fim menu -->	
		<div id="principal">
			<h1 class="text-center">Projetos</h1>
			<table class="table table-striped">
			<?php 
				
				echo "<tr>";
					echo "<th>Nome</th>";
					echo "<th>Sigla</th>";
				echo "</tr>";
				if($projetos){
					foreach ($projetos as $value) {
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
        $('.exibeProjetos').addClass('active');
    });
</script>