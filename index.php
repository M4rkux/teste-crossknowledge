<?php

require_once("autoload.php");

use Controller\RequestController;

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['REQUEST_URI'],'/'));	
parse_str(file_get_contents("php://input"),$input);

$controller = new RequestController();

switch ($method) {
	case 'GET':
		switch ($request[0]) {
			case 'pessoas':
				echo $controller->listPessoas();
				break;

			case 'pessoa':
				if (isset($request[1]) && is_numeric($request[1])) {
					$id = intval($request[1]);
					echo $controller->getPessoaById($id);
				}
				
				break;

			case 'endereco':
				if (isset($request[1]) && is_numeric($request[1])) {
					$id = intval($request[1]);
					echo $controller->getEnderecoById($id);
				}
				
				break;
			
			default:
				echo json_encode(["code" => 404, "message" => "Página não encontrada"]);
				break;
		}

		break;
	
	case 'POST':
		switch ($request[0]) {
			case 'dados':
				echo $controller->inserirDados();
				break;
		}
		break;

	case 'PUT':
		switch ($request[0]) {
			case 'dados':
				echo $controller->updateDados($input);
				break;
		}
		break;

	case 'DELETE':
		switch ($request[0]) {
			case 'dados':
				if (isset($request[1]) && is_numeric($request[1])) {
					$pessoaId = intval($request[1]);
					echo $controller->deleteDados($pessoaId);
				}
				break;
		}
		break;

	default:
		echo json_encode(["code" => 403, "message" => "Método não permitido."]);
		break;
}
