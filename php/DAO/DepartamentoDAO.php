<?php
include_once $_SESSION["root"].'php/DAO/DatabaseConnection.php';
include_once $_SESSION["root"].'php/Model/ModelDepartamento.php';

class DepartamentoDAO {
    
    function getAllDepartamentos() {
        $instance = DatabaseConnection::getInstance();
        $conn = $instance->getConnection();

        $statement = $conn->prepare("SELECT * FROM departamentos");
        $statement->execute();

        $linhas = $statement->fetchAll();

        if (count($linhas) == 0) 
            return null;

        $departamentos;

        foreach ($linhas as $value) {
            $departamento = new ModelDepartamento();
            $departamento->setDepFromDataBase($value);
            $departamentos[] = $departamento;
        }

        return $departamentos;
    }

    function setDepartamento($dep) {

        try {
            $sql = "INSERT INTO departamentos (sigla,nome) VALUES (:sigla, :nome)";

            $instance = DatabaseConnection::getInstance();
            $conn = $instance->getConnection();

            $statement = $conn->prepare($sql);

            $statement->bindValue(":sigla", $dep->getSigla());
            $statement->bindValue(":nome", $dep->getNome());

            return $statement->execute();
        } catch (PDOException $e) {
            echo "Erro ao inserir na base de dados. " . $e->getMessage();
        }
    }
}

?>