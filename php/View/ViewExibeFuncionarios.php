<?php
$titulo="Exibir Funcionários";
include $_SESSION["root"].'includes/header.php';
?>
<body>
	<div class="container" >
		<!-- add no menu -->
		<?php include $_SESSION["root"].'includes/menu.php';?>
		<!-- fim menu -->
		<?php if(isset($_SESSION["flash"]["msg"])){
				if($_SESSION["flash"]["sucesso"] == false)
					echo"<div class='bg-danger text-center msg'>".$_SESSION["flash"]["msg"]."</div>";
				else{
					echo"<div class='bg-success text-center msg'>".$_SESSION["flash"]["msg"]."</div>";
				}
			} 
		?>	
		<div id="principal">
			<h1 class="text-center">Funcionários</h1>
			<table class="table table-striped">
			<?php 
				//$funcionarios foi criado no controller que chamou essa classe;
				echo "<tr>";
					// echo "<th><button class='btn btn-secondary'
							//  type='submit' value='nome' formaction='ordena'>Nome</button></th>";
					echo "<th><a href='ordenaNome'>Nome</a></th>";
					echo "<th>Salário</th>";
					echo "<th>Login</th>";
					echo "<th>Permissão</th>";
					echo "<th><a href='ordenaDep'>Departamento</a></th>";
					// echo "<th><button class='btn btn-secondary' type='submit' value='departamento'>Departamento</button></th>";
					if ($_SESSION["isAdmin"] == true)
						echo "<th colspan='2'>Opções</th>";
				echo "</tr>";
				foreach ($funcionarios as $value) {
					if ($value->getAtivo() == "1") {
						echo "<tr>";
						echo "<td>".$value->getNome()."</td>";
						echo "<td>".$value->getSalario()."</td>";
						echo "<td>".$value->getLogin()."</td>";
						if ($value->getIdPermissao() == "1") 
							echo "<td>Admin</td>";
						else if ($value->getIdPermissao() == "0") 
							echo "<td>Usuário</td>";

						foreach ($departamentos as $valueDep) {
							if ($value->getIdDepartamento() == null){
								echo "<td> ---------- </td>";
								break;
							}
							else if ($valueDep->getId() == $value->getIdDepartamento()){
								echo "<td>". $valueDep->getNome() ."</td>"; 
								break;
							}
						}

						if ($_SESSION["isAdmin"] == true) {
						echo '<td>
								<form action = "deleteFunc" method = "POST">
									<input type = "hidden" name ="deleteFunc" value ="'.$value->getIdFuncionario().'">
									<input class = "btn btn-primary btn-sm fa" type = "submit"  value = "&#xf2ed"> 
								</form>
							</td>';
						
						echo '<td>
							<form action = "editaFuncionario" method = "POST">
								<input type = "hidden" name ="nome" value ="'.$value->getNome().'">
								<input type = "hidden" name ="salario" value ="'.$value->getSalario().'">
								<input type = "hidden" name ="login" value ="'.$value->getLogin().'">
								<input type = "hidden" name ="isAdmin" value ="'.$value->getIdPermissao().'">
								<input type = "hidden" name ="idDepartamento" value ="'.$value->getIdDepartamento().'">
								<input type = "hidden" name = "idFuncionario" value = "'.$value->getIdFuncionario().'">
								<input class = "btn btn-primary btn-sm fa" type = "submit"  value = "&#xf044"> 
							</form>
						</td>';
						}
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
        $('.visualizarFuncionario').addClass('active');
    });
</script>