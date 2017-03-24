<?php

namespace Service;

use Model\Endereco;
use Database\Database;

class EnderecoService {
	
	public function inserirEndereco(Endereco $endereco) {
		$pdo = new Database();

		$rua = $endereco->getRua();
		$numero = $endereco->getNumero();
		$complemento = $endereco->getComplemento();
		$cep = $endereco->getCep();

		$stmt = $pdo->prepare('INSERT INTO `enderecos` VALUES(null, :rua, :numero, :complemento, :cep);');
		$stmt->bindParam(':rua', $rua, \PDO::PARAM_STR);
		$stmt->bindParam(':numero', $numero, \PDO::PARAM_INT);
		$stmt->bindParam(':complemento', $complemento, \PDO::PARAM_STR);
		$stmt->bindParam(':cep', $cep, \PDO::PARAM_STR);
		$stmt->execute();

		$endereco->setId($pdo->lastInsertId());
		
		return $endereco;
	}

	public function getEnderecoById($id) {
		$pdo = new Database();

		$stmt = $pdo->prepare("SELECT * FROM `enderecos` WHERE id = :id");
		$stmt->bindParam(':id', $id, \PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetch();

		if ($result) {
			return new Endereco($result);
		} else {
			return false;
		}
		
	}

	public function updateEndereco(Endereco $endereco) {
		$pdo = new Database();

		$id = $endereco->getId();
		$rua = $endereco->getRua();
		$numero = $endereco->getNumero();
		$complemento = $endereco->getComplemento();
		$cep = $endereco->getCep();

		$stmt = $pdo->prepare("UPDATE `enderecos` SET rua = :rua, numero = :numero, complemento = :complemento, cep = :cep WHERE id = :id");
		$stmt->bindParam(':rua', $rua, \PDO::PARAM_STR);
		$stmt->bindParam(':numero', $numero, \PDO::PARAM_INT);
		$stmt->bindParam(':complemento', $complemento, \PDO::PARAM_STR);
		$stmt->bindParam(':cep', $cep, \PDO::PARAM_STR);
		$stmt->bindParam(':id', $id, \PDO::PARAM_INT);
		$stmt->execute();

		return $endereco;
	}

	public function deleteEndereco(Endereco $endereco) {
		$pdo = new Database();

		$id = $endereco->getId();

		$stmt = $pdo->prepare("DELETE FROM `enderecos` WHERE id = :id");
		$stmt->bindParam(':id', $id, \PDO::PARAM_INT);
		return $stmt->execute();
	}
}