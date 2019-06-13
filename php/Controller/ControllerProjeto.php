<?php

include_once $_SESSION["root"].'php/DAO/ProjetoDAO.php';
include_once $_SESSION["root"].'php/Model/ModelProjeto.php';

class ControllerProjeto {

	function getAllProjetos(){
		$proDAO = new ProjetoDAO();
		$projetos=$proDAO->getAllProjetos();

		

		include_once $_SESSION["root"].'php/View/ViewExibeProjetos.php';
	}

	function setProjeto(){
		$proDAO = new ProjetoDAO();
		$projeto = new ModelProjeto();
		$projeto->setProFromPOST();
		$resultadoInsercao = $proDAO->setProjeto($projeto);
			
		if($resultadoInsercao){
			$_SESSION["flash"]["msg"]="Projeto Cadastrado com Sucesso";
			$_SESSION["flash"]["sucesso"] = true;			
		}
		else{
			$_SESSION["flash"]["msg"]="O projeto já existe no banco ou voce passou do limite de caracteres na sigla que é 3";
			$_SESSION["flash"]["sucesso"] = false;
			//Var temp de feedback	
			$_SESSION["flash"]["nome"]=$projeto->getNome();
			$_SESSION["flash"]["sigla"]=$projeto->getSigla();
		}
		include_once $_SESSION["root"].'php/View/ViewCadastraProjeto.php';
	}
	

}
