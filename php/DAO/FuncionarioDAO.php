<?php
//Add a classe responsavel por fazer a conexao com banco de dados
include_once $_SESSION["root"].'php/DAO/DatabaseConnection.php';
include_once $_SESSION["root"].'php/Model/ModelFuncionario.php';
class FuncionarioDAO {
	/*Como o PHP tem inferência de tipo, esse método, assim como outros, poderia ser mais "simples", porém estou fazendo de uma maneira que acho mais didático*/
	function getAllFuncionarios(){

		//pego uma ref da conexão
		$instance = DatabaseConnection::getInstance();
		$conn = $instance->getConnection();

		//Faço o select usando prepared statement
		$statement = $conn->prepare("SELECT * FROM funcionarios");		
		$statement->execute();

		//linhas recebe todas as tuplas retornadas do banco		
		$linhas = $statement->fetchAll();
		
		//Verifico se houve algum retorno, senão retorno null
		if(count($linhas)==0)
				return null;

		//Var que irá armazenar um array de obj do tipo funcionário
		$funcionarios;		
		
		foreach ($linhas as $value) {
			$funcionario = new ModelFuncionario();
			$funcionario->setFuncionarioFromDataBase($value);			
			$funcionarios[]=$funcionario;
		}	
		return $funcionarios;		
	}

    function getIdFuncionario($func){

            //pego uma ref da conexão
        $instance = DatabaseConnection::getInstance();
        $conn = $instance->getConnection();

        //Faço o select usando prepared statement
        $statement = $conn->prepare("SELECT idFuncionario FROM funcionarios where login = :login"); 
        $statement->bindValue(":login", $func->getLogin());
        
         echo "<pre>";
        var_dump($func->getLogin());
        echo "</pre>";
        $statement->execute();

        //linhas recebe todas as tuplas retornadas do banco     
        $linhas = $statement->fetchAll();
        
        //Verifico se houve algum retorno, senão retorno null
        if(count($linhas)==0)
                echo "fodase";

        foreach ($linhas as $value) {
            $id = intval($value['idFuncionario']);
           
        }
        return $id;    



    }
	//Retorna 1 se conseguiu inserir;
	function setFuncionario($func){		

		try {
			//monto a query
            $sql = "INSERT INTO funcionarios (		
                idFuncionario,
                nome,
                salario,
                login,
                senha,
                idPermissao,
                idDepartamento) 
                VALUES (
                :idFuncionario,
                :nome,
                :salario,
                :login,
                :senha,
                :idPermissao,
                :idDepartamento)"
        	;

            //pego uma ref da conexão
			$instance = DatabaseConnection::getInstance();
			$conn = $instance->getConnection();
			//Utilizando Prepared Statements
			$statement = $conn->prepare($sql);

            $statement->bindValue(":idFuncionario", $func->getIdFuncionario());
            $statement->bindValue(":nome", $func->getNome());
            $statement->bindValue(":salario", $func->getSalario());
            $statement->bindValue(":login", $func->getLogin());
            $statement->bindValue(":senha", $func->getSenha());
            $statement->bindValue(":idPermissao", $func->getIdPermissao());
            $statement->bindValue(":idDepartamento", $func->getIdDepartamento());
            return $statement->execute();

        } catch (PDOException $e) {
            echo "Erro ao inserir na base de dados.".$e->getMessage();
        }		
	}

	function deleteFunc ($id) {
        $sql = "update funcionarios set ativo = 0 where idFuncionario = :id";
        //pego uma ref da conexão
        $instance = DatabaseConnection::getInstance();
        $conn = $instance->getConnection();
        //Utilizando Prepared Statements
        $statement = $conn->prepare($sql);
        $statement->bindParam(':id', $id);
        $retorno = $statement->execute();
        //linha recebe a primeira linha de retorno do banco
        if($retorno){
            return 1;
        }
        return 0;
	}
	
	function corrigeFuncionario ($func) {
        try {
            $sql = "UPDATE funcionarios SET
                nome = :nome,
                salario = :salario,
                login = :login,
                senha = :senha,
                idPermissao = :idPermissao,
                idDepartamento = :idDepartamento 
                WHERE idFuncionario = :idFuncionario";


            $sql2 = "UPDATE funcionarios SET
                nome = :nome,
                salario = :salario,
                login = :login,
                idPermissao = :idPermissao,
                idDepartamento = :idDepartamento 
                WHERE idFuncionario = :idFuncionario";

            //pego uma ref da conexão
            $instance = DatabaseConnection::getInstance();
            $conn = $instance->getConnection();
            //Utilizando Prepared Statements
           
            
            if(!password_verify("",$func-> getSenha())){
                 $statement = $conn->prepare($sql);
                 $statement->bindValue(":senha", $func->getSenha());
            }   
            else{
                 $statement = $conn->prepare($sql2);
            }            
            
            $statement->bindValue(":idFuncionario", $func->getIdFuncionario());
            $statement->bindValue(":nome", $func->getNome());
            $statement->bindValue(":salario", $func->getSalario());
            $statement->bindValue(":login", $func->getLogin());
            $statement->bindValue(":idPermissao", $func->getIdPermissao());
            $statement->bindValue(":idDepartamento", $func->getIdDepartamento());


            return $statement->execute();
            

        } catch (PDOException $e) {
            echo "Erro ao atualizar informações na base de dados.".$e->getMessage();
        }

    }

}