<?php
include_once $_SESSION["root"].'php/DAO/DatabaseConnection.php';
include_once $_SESSION["root"].'php/Model/ModelProjetoFuncionario.php';

class ProjetoFuncionarioDAO {
    

    function getAllProjetosFuncionarios() {
        $instance = DatabaseConnection::getInstance();
        $conn = $instance->getConnection();

        $statement = $conn->prepare("SELECT p.nome as nomeP, f.nome as nomeF FROM projeto_funcionario pf, projetos p ,funcionarios f WHERE 
            f.idFuncionario = pf.idFuncionario AND pf.idProjeto = p.id");
        $statement->execute();

        $linhas = $statement->fetchAll();

        if (count($linhas) == 0) 
            return null;

        $projetoFuncionario;


        foreach ($linhas as $value) {
            
            $projetosFuncionarios[] = $value;
        }

        return $projetosFuncionarios;
    }

    function setProjetoFuncionario($proFun) {

        try {
            $sql = "INSERT INTO projeto_funcionario (idFuncionario,idProjeto) VALUES (:idFuncionario, :idProjeto)";

            $instance = DatabaseConnection::getInstance();
            $conn = $instance->getConnection();

            $statement = $conn->prepare($sql);

            $statement->bindValue(":idFuncionario", $proFun->getIdFuncionario());
            $statement->bindValue(":idProjeto", $proFun->getIdProjeto());

            return $statement->execute();
        } catch (PDOException $e) {
            echo "Erro ao inserir na base de dados. " . $e->getMessage();
        }
    }

    function corrigeProjetoFuncionario ($func) {
        try {
            $sql = "UPDATE projeto_funcionario SET
               idProjeto = :idProjeto
               WHERE idFuncionario = :idFuncionario";


           
            //pego uma ref da conexão
            $instance = DatabaseConnection::getInstance();
            $conn = $instance->getConnection();
            //Utilizando Prepared Statements
           
            
            $statement = $conn->prepare($sql);
              
            $statement->bindValue(":idFuncionario", $func->getIdFuncionario());
            $statement->bindValue(":idProjeto",$_POST['idProjeto']);
            
            return $statement->execute();
            

        } catch (PDOException $e) {
            echo "Erro ao atualizar informações na base de dados.".$e->getMessage();
        }

    }
   
}

?>