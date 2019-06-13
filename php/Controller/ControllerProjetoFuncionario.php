<?php

include_once $_SESSION["root"].'php/DAO/ProjetoFuncionarioDAO.php';

include_once $_SESSION["root"].'php/Model/ModelProjetoFuncionario.php';
include_once $_SESSION["root"].'php/Model/ModelFuncionario.php';

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
		//include_once $_SESSION["root"].'php/View/ViewCadastraFuncionario.php';
	}
	
	function corrigeProjetoFuncionario () {

        $proFunDAO = new ProjetoFuncionarioDAO();
        $funcionario = new ModelFuncionario();
        $funcionario->setFuncionarioFromPOST2();
        $resultado = $proFunDAO->corrigeProjetoFuncionario($funcionario);

        if ($resultado) {
            $_SESSION["flash"]["msg"]="Funcionário Atualizado com Sucesso";
            $_SESSION["flash"]["sucesso"] = true;
        }

        else {
            $_SESSION["flash"]["msg"]="Erro! Tente novamente!";
            $_SESSION["flash"]["sucesso"] = false;
        }

        include_once $_SESSION["root"].'php/View/ViewExibeFuncionario.php';
    }

		
}
?>