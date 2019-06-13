<?php

include_once $_SESSION["root"].'php/DAO/DepartamentoDAO.php';
include_once $_SESSION["root"].'php/Model/ModelDepartamento.php';

class ControllerDepartamento {

	function getAllDepartamentos(){
		$depDAO = new DepartamentoDAO();
		$departamentos=$depDAO->getAllDepartamentos();
		include_once $_SESSION["root"].'php/View/ViewExibeDepartamentos.php';
	}

	function setDepartamento(){
		$depDAO = new DepartamentoDAO();
		$departamento = new ModelDepartamento();
		$departamento->setDepFromPOST();
		$resultadoInsercao = $depDAO->setDepartamento($departamento);
			
		if($resultadoInsercao){
			$_SESSION["flash"]["msg"]="Departamento Cadastrado com Sucesso";
			$_SESSION["flash"]["sucesso"] = true;			
		}
		else{
			$_SESSION["flash"]["msg"]="O departamento já existe no banco ou você inseriu mais que 3 caracteres na sigla";
			$_SESSION["flash"]["sucesso"] = false;
			//Var temp de feedback	
			$_SESSION["flash"]["nome"]=$departamento->getNome();
			$_SESSION["flash"]["sigla"]=$departamento->getSigla();
		}
		include_once $_SESSION["root"].'php/View/ViewCadastraDepartamento.php';
	}
}