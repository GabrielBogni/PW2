<?php
include_once $_SESSION["root"].'php/DAO/DatabaseConnection.php';
include_once $_SESSION["root"].'php/Model/ModelProjeto.php';

class ProjetoDAO {
    
    function getAllProjetos() {
        $instance = DatabaseConnection::getInstance();
        $conn = $instance->getConnection();

        $statement = $conn->prepare("SELECT * FROM projetos");
        $statement->execute();


        $linhas = $statement->fetchAll();

        if (count($linhas) == 0) 
            return null;

        $projeto;

        foreach ($linhas as $value) {
            $projeto = new ModelProjeto();
            $projeto->setProFromDataBase($value);
            $projetos[] = $projeto;
        }

        return $projetos;
    }

    function setProjeto($pro) {

        try {
            $sql = "INSERT INTO projetos (sigla,nome) VALUES (:sigla, :nome)";

            $instance = DatabaseConnection::getInstance();
            $conn = $instance->getConnection();

            $statement = $conn->prepare($sql);

            $statement->bindValue(":sigla", $pro->getSigla());
            $statement->bindValue(":nome", $pro->getNome());

            return $statement->execute();
        } catch (PDOException $e) {
            echo "Erro ao inserir na base de dados. " . $e->getMessage();
        }
    }
   
}

?>