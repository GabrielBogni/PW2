<?php 

class ModelProjetoFuncionario {
    private $idFuncionario;
    private $idProjeto;


    public function setProFunFromDataBase ($linha) {
        $this->setIdFuncionario($linha["idFuncionario"])
            ->setIdProjeto($linha["idProjeto"]);
            
    }

    public function setProjetoFuncionario($idFuncionario){
        $this->setIdFuncionario($idFuncionario)
             ->setIdProjeto($_POST["idProjeto"]);  
    }

   
    public function getIdFuncionario()
    {
        return $this->idFuncionario;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setIdFuncionario($idFuncionario)
    {
        $this->idFuncionario = $idFuncionario;

        return $this;
    }


     public function getIdProjeto()
    {
        return $this->idProjeto;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setIdProjeto($idProjeto)
    {
        $this->idProjeto = $idProjeto;

        return $this;
    }
} 

?>