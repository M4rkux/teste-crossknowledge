<?php

namespace Controller;

use Service\EnderecoService;
use Service\PessoaService;
use Model\Pessoa;
use Model\Endereco;

class RequestController {

	public function listPessoas () {
		$pessoaService = new PessoaService();
		$pessoas = $pessoaService->listPessoas();
		foreach ($pessoas as $pessoa) {
			$pessoa->jsonSerialize();
		}
		$json = json_encode(["code" => 200, "data" => $pessoas]);
		return $json;
	}

	public function getPessoaById(int $id) {
		$pessoaService = new PessoaService();
		$pessoa = $pessoaService->getPessoaById($id);

		if ($pessoa) {
			$pessoa->jsonSerialize();
		}
		
		$json = json_encode(["code" => 200, "data" => $pessoa]);
		return $json;
	}

	public function getEnderecoById(int $id) {
		$enderecoService = new EnderecoService();
		$endereco = $enderecoService->getEnderecoById($id);
		if ($endereco) {
			$endereco->jsonSerialize();	
		}
		$json = json_encode(["code" => 200, "data" => $endereco]);
		return $json;
	}

	public function inserirDados() {
		$pessoaService = new PessoaService();
		$enderecoService = new EnderecoService();

		$endereco = new Endereco($_REQUEST);
		if ($enderecoService->inserirEndereco($endereco)) {
			$pessoa = new Pessoa($_REQUEST);
			$pessoa->setEndereco($endereco);
			if ($pessoaService->inserirPessoa($pessoa)) {
				$pessoa->jsonSerialize();
				return json_encode(["code" => 200, "data" => $pessoa]);
			} else {
				return json_encode(["code" => 500, "message" => "Ocorreu um erro."]);
			}
		} else {
			return json_encode(["code" => 500, "message" => "Ocorreu um erro."]);
		}
	}

	public function updateDados ($params) {
		$pessoaService = new PessoaService();
		$enderecoService = new EnderecoService();

		$pessoa = new Pessoa($params);
		$endereco = new Endereco($params);

		$enderecoService->updateEndereco($endereco);
		$pessoaService->updatePessoa($pessoa);

		if ($endereco && $pessoa) {
			$pessoa->setEndereco($endereco);
			$pessoa->jsonSerialize();
			return json_encode(["code" => 200, "data" => $pessoa]);
		} else {
			return json_encode(["code" => 500, "message" => "Ocorreu um erro."]);
		}
	}

	public function deleteDados ($pessoaId) {
		$resultPessoa = false;
		$resultEndereco = false;

		$pessoaService = new PessoaService();
		$enderecoService = new EnderecoService();

		$pessoa = $pessoaService->getPessoaById($pessoaId);

		if ($pessoa) {
			$endereco = $pessoa->getEndereco();
			$resultPessoa = $pessoaService->deletePessoa($pessoa);
			if ($resultPessoa && $endereco) {
				$resultEndereco = $enderecoService->deleteEndereco($endereco);
			}
		}

		if ($resultPessoa && $resultEndereco) {
			return json_encode(["code" => 200, "data" => "Dados deletados com sucesso!"]);
		} else {
			return json_encode(["code" => 500, "message" => "Ocorreu um erro."]);
		}
	}

}