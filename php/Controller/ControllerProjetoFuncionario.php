<?php

include_once $_SESSION["root"].'php/DAO/ProjetoFuncionarioDAO.php';
include_once $_SESSION["root"].'php/Model/ModelProjetoFuncionario.php';

class ControllerProjetoFuncionario {

	function getAllProjetosFuncionarios(){
		$proFunDAO = new ProjetoFuncionarioDAO();
		
		$projetosFuncionarios =$proFunDAO->getAllProjetosFuncionarios();
		
		
		include_once $_SESSION["root"].'php/View/ViewExibeProjetoFuncionario.php';


		}
	
	function setProjetoFuncionario(){
		
		$funcionario = new ModelFuncionario();
		$funcionario->setFuncionarioFromPOST();
		
		$funcDAO = new FuncionarioDAO();
		// buscando o id do funcionario no banco após cria-lo
		$idFuncionario = $funcDAO->getIdFuncionario($funcionario);
	
		
		
		$proFunDAO = new ProjetoFuncionarioDAO();
		$projetoFuncionario = new ModelProjetoFuncionario();
		


		// criando um objeto projetoFuncionario com o id do funcinario obtido no funcionarioDAO e com id do projeto obtido por post
		$projetoFuncionario->setProjetoFuncionario($idFuncionario);
		
		
		// inserindo o objeto criado no banco;
		$proFunDAO->setProjetoFuncionario($projetoFuncionario);



		$resultadoInsercao = $proFunDAO->setProjetoFuncionario($projetoFuncionario);

			
		if($resultadoInsercao){
			$_SESSION["flash2"]["sucesso"] = true;			
		}
		else{
			$_SESSION["flash2"]["msg"]="O projeto não existe no banco";
			$_SESSION["flash2"]["sucesso"] = false;
			//Var temp de feedback	
			
		}
		include_once $_SESSION["root"].'php/View/ViewCadastraFuncionario.php';
	}
	
		
}