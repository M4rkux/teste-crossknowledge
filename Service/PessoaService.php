<?php

namespace Service;

use Model\Pessoa;
use Database\Database;
use Service\EnderecoService;

class PessoaService {
	
	public function inserirPessoa(Pessoa $pessoa) {
		$pdo = new Database();
		$enderecoId = null;

		$nome = $pessoa->getNome();
		$sobrenome = $pessoa->getSobrenome();
		$dataNascimento = $pessoa->getDataNascimento();
		$endereco = $pessoa->getEndereco();

		if ($endereco) {
			$enderecoId = $endereco->getId();	
		}

		try {
			if ($enderecoId) {
				$stmt = $pdo->prepare('INSERT INTO `pessoas` VALUES(null, :nome, :sobrenome, :dataNascimento, :enderecoId);');
			} else {
				$stmt = $pdo->prepare('INSERT INTO `pessoas` VALUES(null, :nome, :sobrenome, :dataNascimento, null);');
			}

			$stmt->bindParam(':nome', $nome, \PDO::PARAM_STR);
			$stmt->bindParam(':sobrenome', $sobrenome, \PDO::PARAM_STR);
			$stmt->bindParam(':dataNascimento', $dataNascimento, \PDO::PARAM_STR);

			if ($enderecoId) {
				$stmt->bindParam(':enderecoId', $enderecoId, \PDO::PARAM_INT);	
			}
			
			$stmt->execute();

		} catch (\PDOException $e) {
			die($e->getMessage());
		}

		$pessoa->setId($pdo->lastInsertId());
		
		return $pessoa;
	}

	public function getPessoaById(int $id) {
		$pdo = new Database();

		$stmt = $pdo->prepare("SELECT * FROM `pessoas` WHERE id = :id");
		$stmt->bindParam(':id', $id, \PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetch(); 

		if ($result) {
			return new Pessoa($result);
		} else {
			return false;
		}
	}

	public function listPessoas() {
		$pdo = new Database();

		$sql = "SELECT * FROM `pessoas`";
		$pessoas = [];
		foreach ($pdo->query($sql) as $row) {
			$pessoa = new Pessoa($row);
			array_push($pessoas, $pessoa);
		}

		return $pessoas;
	}

	public function updatePessoa(Pessoa $pessoa) {
		$pdo = new Database();

		$id = $pessoa->getId();
		$nome = $pessoa->getNome();
		$sobrenome = $pessoa->getSobrenome();
		$dataNascimento = $pessoa->getDataNascimento();

		$stmt = $pdo->prepare("UPDATE `pessoas` SET nome = :nome, sobrenome = :sobrenome, data_nascimento = :dataNascimento WHERE id = :id");
		$stmt->bindParam(':nome', $nome, \PDO::PARAM_STR);
		$stmt->bindParam(':sobrenome', $sobrenome, \PDO::PARAM_STR);
		$stmt->bindParam(':dataNascimento', $dataNascimento, \PDO::PARAM_STR);
		$stmt->bindParam(':id', $id, \PDO::PARAM_INT);
		$stmt->execute();

		return $pessoa;
	}

	public function deletePessoa(Pessoa $pessoa) {
		$pdo = new Database();

		$id = $pessoa->getId();

		$stmt = $pdo->prepare("DELETE FROM `pessoas` WHERE id = :id");
		$stmt->bindParam(':id', $id, \PDO::PARAM_INT);
		return $stmt->execute();
	}
}