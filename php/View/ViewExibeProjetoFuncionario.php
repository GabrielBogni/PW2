<?php
$titulo="Exibir Projetos e Funcionarios";
include $_SESSION["root"].'includes/header.php';
?>
<body>
	<div class="container">
		<!-- add no menu -->
		<?php include $_SESSION["root"].'includes/menu.php';?>
		<!-- fim menu -->	
		<div id="principal">
			<h1 class="text-center">Funcionários dos projetos</h1>
			<table class="table table-striped">
			<?php 
				//$funcionarios foi criado no controller que chamou essa classe;
				echo "<tr>";
					echo "<th>Nome do projeto</th>";
					echo "<th>Nome do funcionário</th>";
				echo "</tr>";
				if($projetosFuncionarios){
					foreach ($projetosFuncionarios as $value) {
						echo "<tr>";
							echo "<td>".$value['nomeP']."</td>";
							echo "<td>".$value['nomeF']."</td>";
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
        $('.exibeProjetoFuncionario').addClass('active');
    });
</script>