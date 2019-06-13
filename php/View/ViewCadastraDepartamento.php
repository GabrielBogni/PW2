<?php
$titulo="Cadastrar Departamento";
include $_SESSION["root"].'includes/header.php';
?>
<body>
	<div class="container" >
		<!-- add no menu -->
		<?php include $_SESSION["root"].'includes/menu.php';?>
		<!-- fim menu -->	
		<div id="principal">
			<h1 class="text-center">Cadastro de Departamento</h1>
			<form action="postCadastraDepartamento" method="POST">
				<div class="row">
					<?php if(isset($_SESSION["flash"]["msg"])){
							if($_SESSION["flash"]["sucesso"] == false)
								echo"<div class='bg-danger text-center msg'>".$_SESSION["flash"]["msg"]."</div>";
							else{
								echo"<div class='bg-success text-center msg'>".$_SESSION["flash"]["msg"]."</div>";
							}
						} ?>
					<div class="col-md-6">
                        <div class="form-group">
							<label for="nome">Nome:<span class="requerido">*</span></label>
							<input type="text" name="nome" class="form-control" id="nome" value="<?php if(isset($_SESSION["flash"]["nomeDep"]))echo $_SESSION["flash"]["nomeDep"];?>">
						</div>					
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="sigla">Sigla:<span class="requerido">*</span></label>
							<input type="text" name="sigla" class="form-control" id="sigla" value="<?php if(isset($_SESSION["flash"]["sigla"]))echo $_SESSION["flash"]["sigla"];?>">
						</div>						
					</div>
			  	</div>
			  <button type="submit" class="btn btn-default center-block">Submit</button>
			</form>
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
        $('.cadastrarDepartamento').addClass('active');
    });
</script>