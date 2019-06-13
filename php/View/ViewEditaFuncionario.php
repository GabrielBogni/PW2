<?php
$titulo="Edita Funcionario";
include $_SESSION["root"].'includes/header.php';
?>
<body>
	<div class="container" >
		<!-- add no menu -->
		<?php include $_SESSION["root"].'includes/menu.php';?>
		<!-- fim menu -->	
		<div id="principal">
			<h1 class="text-center">Correção de Cadastro de Funcionário</h1>
			<form action="postEditaFuncionario" method="POST">
				<div class="row">
				
					
					<div class="col-md-6">

						<div class="form-group">
							<label for="email">Login:<span class="requerido">*</span></label>
							<input type="login" name="login" class="form-control" id="login" 
								value="<?php if(isset($_POST["login"]))echo $_POST["login"];?>">
						</div>

						<div class="form-group">
							<label for="pwd">Senha:<span class="requerido">*</span></label>
							<input type="password" name="senha" class="form-control" id="pwd" value="">
						</div>
						
					</div>

					<div class="col-md-6">

						<div class="form-group">
							<label for="nome">Nome:<span class="requerido">*</span></label>
							<input type="text" name="nome" class="form-control" id="nome" value="<?php if(isset($_POST["nome"]))echo $_POST["nome"];?>">
						</div>

						<div class="form-group">
							<label for="salario">Salario:<span class="requerido">*</span></label>
							<input type="text" name="salario" class="form-control" id="salario" value="<?php if(isset($_POST["salario"]))echo $_POST["salario"];?>">
						</div>	
					</div>
					<div class="col-md-12">
						<label for="departamento">Departamento</label>
						<select id ="departamento" name="departamento" class="form-control">
							<?php
							foreach ($departamentos as $value) {
								echo '<option';
								if($value->getId() == $_POST["idDepartamento"]){echo' selected';}
								echo' value="' . $value->getId() . '">' . $value->getNome() . '</option>';
							}
							?>
						</select>
					</div>

					<div class="col-md-12">
						<label for="projeto">Projetos</label>
						<select id ="projeto" name="idProjeto" class="form-control">
							<?php
							foreach ($projetos as $value) {
								echo '<option';
								
								echo ' value="' . $value->getId() . '">' . $value->getNome() . '</option>';
							}
							?>
						</select>
						
					</div>	
					
					<div class="col-md-3">
						<label><input type="checkbox" name="isAdmin" value="1" <?php if(isset($_POST["isAdmin"]) && $_POST["isAdmin"] == 1) echo 'checked';?> >Admin</label>
					</div>

			  	</div>
			  	<input type = "hidden"  name = "idFuncionario" value = "<?php if(isset($_POST["idFuncionario"]))echo $_POST["idFuncionario"];?>">
			  	
			  <button type="submit" class="btn btn-default center-block">Submit</button>
			</form>
		</div>
	</div>	
</body>
<!-- add no footer -->
<?php 
	include $_SESSION["root"].'includes/footer.php';
	
	?>
<!-- fim footer -->
<script>		
	$(document).ready(function () {
        $('.cadastrarFuncionario').addClass('active');
    });
</script>