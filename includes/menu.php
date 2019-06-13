<nav class="navbar navbar-default menu">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand"><?php if (isset($_SESSION["nomeLogado"])) echo strtoupper($_SESSION["nomeLogado"]) ?></a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
            <?php
              if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == true){
                echo '<li class="cadastrarFuncionario"><a href="cadastraFuncionario">Cadastra Funcionário</a></li>';
              }

              echo '<li class="visualizarFuncionario"><a href="exibeFuncionarios">Exibe Funcionário</a></li>';

              if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == true){
                echo '<li class="cadastrarDepartamento"><a href="cadastraDepartamento">Cadastra Departamento</a></li>';

                echo '<li class="cadastraProjeto"><a href="cadastraProjeto">Cadastra Projeto</a></li>';
              }
              echo '<li class="visualizarDepartamento"><a href="exibeDepartamentos">Exibe Departamento</a></li>';
              echo '<li class="exibeProjeto"><a href="exibeProjeto">Exibe Projeto</a></li>';
              echo '<li class="exibeProjetoFuncionario"><a href="exibeProjetoFuncionario">Exibe Funcionarios/Projeto </a></li>';
              echo '<li class="logout"><a href="logout">Sair</a></li>';  

            ?>            
            </ul>            
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>