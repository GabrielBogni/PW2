<?php
/*
Esse script funciona como um front controller, todas as requisições passam primeiro por aqui, também podemos enxergar como um gateway padrão. Isso só é possível graças ao htaccess que faz com que o todas as requisições feitas sejam redirecionadas para cá.
Da forma como esse arquivo de rotas funciona, nós não fazemos “links” para arquivos, nós associamos uma url a um controller.
****Descomentar os print_r abaixo para entender melhor****
*/

//Path é um array onde cada posição é um elemento da URL
$path = explode('/', $_SERVER['REQUEST_URI']);
//Action é a posição do array
$action = $path[sizeOf($path) - 1];
//Caso a ação tenha param GET esse param é ignorado, isso é particularmente útil para trabalhar com AJAX, já que o conteúdo do get será útil apenas para o controller e não para a rota
$action = explode('?', $action);
$action = $action[0];

//Descomentar esse bloco e acessar qualquer url do sistema.
/*echo "<pre>";
echo "A URL digitada<br>";
print_r($_SERVER['REQUEST_URI']);
echo "<br><br>A URL digitada explodida por / e tranformada em um array<br>";
print_r($path);
echo "<br><br>A ultima posição do array, que é a ação que o usuário/sistema quer realizar, é essa ação(string) que é mapeada(roteada) a um método de um controller<br>";
print_r($action);
echo "</pre>";*/

//Todo controller que tiver pelo menos uma rota associada a ele deve aparecer aqui.
include_once $_SESSION["root"].'php/Controller/ControllerLogin.php';
include_once $_SESSION["root"].'php/Controller/ControllerFuncionario.php';
include_once $_SESSION["root"].'php/Controller/ControllerDepartamento.php';
include_once $_SESSION["root"].'php/Controller/ControllerProjeto.php';
include_once $_SESSION["root"].'php/Controller/ControllerProjetoFuncionario.php';

include_once $_SESSION["root"].'php/DAO/DepartamentoDAO.php';
include_once $_SESSION["root"].'php/DAO/FuncionarioDAO.php';
include_once $_SESSION["root"].'php/DAO/ProjetoDAO.php';
include_once $_SESSION["root"].'php/DAO/ProjetoFuncionarioDAO.php';


//Sequencia de condicionais que verificam se a ação informada está roteada
if ($action == '' || $action == 'index' || $action == 'index.php' || $action == 'login') {
	require_once $_SESSION["root"].'php/View/ViewLogin.php';
}

// login



else if ($action == 'postLogin') {
	$cLogin = new ControllerLogin();
	$cLogin->verificaLogin();
}
else if ($_SESSION["logado"] == true) {
	if ($action == 'exibeFuncionarios') {
		$cFunc = new FuncionarioDAO();
		$depDAO = new DepartamentoDAO();

		$departamentos = $depDAO->getAllDepartamentos();
		$funcionarios = $cFunc->getAllFuncionarios();

		require_once $_SESSION["root"].'php/View/ViewExibeFuncionarios.php';
	}


//funcionario



	else if ($action == 'cadastraFuncionario' && $_SESSION["isAdmin"] == true) {
		$cFunc = new ControllerFuncionario();
		$depDAO = new DepartamentoDAO();
		$proDAO = new ProjetoDAO();

		$departamentos = $depDAO->getAllDepartamentos();

		$projetos = $proDAO->getAllProjetos();


		require_once $_SESSION["root"].'php/View/ViewCadastraFuncionario.php';
	}

	else if ($action == 'postCadastraFuncionario' && $_SESSION["isAdmin"] == true) {
		
	
		$cFunc = new ControllerFuncionario();
		$cFunc->setFuncionario();

		$cProFun = new ControllerProjetoFuncionario();
		$cProFun->setProjetoFuncionario();

		header("Location: cadastraFuncionario");


	

		
	}

	else if ($action == 'deleteFunc' && $_SESSION["isAdmin"] == true) {
		$cFunc = new ControllerFuncionario();
		$cFunc->deleteFunc($_POST["deleteFunc"]);
		
        header("Location: exibeFuncionarios");
	}
	else if ($action == 'editaFuncionario' && $_SESSION["isAdmin"] == true) {
        $cFunc = new ControllerFuncionario();
        $depDAO = new DepartamentoDAO();
        $proDAO = new ProjetoDAO();

        $departamentos = $depDAO->getAllDepartamentos();
        $projetos = $proDAO->getAllProjetos();


        require_once $_SESSION["root"].'php/View/ViewEditaFuncionario.php';
    }
    else if ($action == 'postEditaFuncionario' && $_SESSION["isAdmin"] == true) {
        $cFunc = new ControllerFuncionario();
        $cFunc->corrigeFuncionario();
        $cProFun = new ControllerProjetoFuncionario();
        $cProFun->corrigeProjetoFuncionario();

        header("Location: exibeFuncionarios");
	}



//departamento



	else if ($action == 'exibeDepartamentos') {
		$cDep = new ControllerDepartamento();
		$cDep->getAllDepartamentos();
		require_once $_SESSION["root"].'php/View/ViewExibeDepartamentos.php';
	}
	else if ($action == 'cadastraDepartamento' && $_SESSION["isAdmin"] == true) {
		$cDep = new ControllerDepartamento();
		require_once $_SESSION["root"].'php/View/ViewCadastraDepartamento.php';
	}
	else if ($action == 'postCadastraDepartamento' && $_SESSION["isAdmin"] == true) {
		$cDep = new ControllerDepartamento();
		$cDep->setDepartamento();

	}


	// ordenação
	
	else if ($action == 'ordenaNome') {
		$cFunc = new FuncionarioDAO();
		$depDAO = new DepartamentoDAO();

		$departamentos = $depDAO->getAllDepartamentos();
		$funcionarios = $cFunc->getAllFuncionarios();

		usort($funcionarios, function ($obj1, $obj2) {
			if (strcasecmp($obj1->getNome(), $obj2->getNome()) == 0) {return 0;}
		
			return (strcasecmp($obj1->getNome(), $obj2->getNome()) < 0 ? -1 : 1);
		});

		require_once $_SESSION["root"].'php/View/ViewExibeFuncionarios.php';
	}
	else if ($action == 'ordenaDep') {
		$cFunc = new FuncionarioDAO();
		$depDAO = new DepartamentoDAO();

		$departamentos = $depDAO->getAllDepartamentos();
		$funcionarios = $cFunc->getAllFuncionarios();

		usort($departamentos, function ($obj1, $obj2) {
			if (strcasecmp($obj1->getNome(), $obj2->getNome()) == 0) {return 0;}
		
			return (strcasecmp($obj1->getNome(), $obj2->getNome()) < 0 ? -1 : 1);
		});

		require_once $_SESSION["root"].'php/View/ViewExibeFuncionarios.php';
	}


	// projeto


	else if($action == 'cadastraProjeto'){
		
		require_once $_SESSION["root"].'php/View/ViewCadastraProjeto.php';

	}

	else if($action == 'postCadastraProjeto'){

		print($_POST['nome']);
		print($_POST['sigla']);

		
		$cPro = new ControllerProjeto();
		
		$cPro->setProjeto();

		require_once $_SESSION["root"].'php/View/ViewCadastraProjeto.php';

	}

	else if($action == 'exibeProjeto'){


		$cPro = new ControllerProjeto();
		
		$projetos = $cPro->getAllProjetos();
		


		include_once $_SESSION["root"].'php/View/ViewExibeProjetos.php';


	}


	// projetoFuncionario

	else if($action == 'exibeProjetoFuncionario'){
		$cProFun = new ControllerProjetoFuncionario;

		$cProFun->getAllProjetosFuncionarios();
		include_once $_SESSION["root"].'php/View/ViewExibeProjetoFuncionario.php';


	}






	else if ($action == 'logout') {
		session_destroy();
		header("Location: login");
	}	
	else {
		$_SESSION["flash"]["sucesso"] = false;
		$_SESSION["flash"]["msg"] = "Você não possui o nível de permissão necessário para acessar essa página";
		header("Location: exibeFuncionarios");
	}


	


}
else {
	$_SESSION["flash"]["sucesso"] = false;
	$_SESSION["flash"]["msg"] = "Faça login para poder acessar o sistema!";
	header("Location: login");
	//isso trata todo erro 404, podemos criar uma view mais elegante para exibir o aviso ao usuário.
}

?>