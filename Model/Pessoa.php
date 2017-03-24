<?php

namespace Model;

use Service\EnderecoService;

class Pessoa implements \JsonSerializable {
	/**
	* @var $id Int
	**/
	protected $id;
	
	/**
	* @var $nome String
	**/
	protected $nome;

	/**
	* @var $sobrenome String
	**/
	protected $sobrenome;

	/**
	* @var $dataNascimento Datetime
	**/
	protected $dataNascimento;

	/**
	* @var $endereco Model\Endereco 
	**/
	protected $endereco;

	/************************************************************/

	public function __construct($params) {
		if (isset($params["pessoa_id"])) {
			$this->setId($params["pessoa_id"]);
		} else if (isset($params["id"])) {
            $this->setId($params["id"]);
        }
		
		if (isset($params["nome"])) {
			$this->setNome($params["nome"]);
		}
		
		if (isset($params["sobrenome"])) {
			$this->setSobrenome($params["sobrenome"]);
		}
        
        if (isset($params["data_nascimento"])) {
            $this->setDataNascimento($params["data_nascimento"]);
        }

		if (isset($params["endereco_id"])) {
            $enderecoService = new EnderecoService();
			$this->setEndereco($enderecoService->getEnderecoById($params["endereco_id"]));
		}
	}

    /**
     * Gets the value of id.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the value of id.
     *
     * @param mixed $id the id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the value of nome.
     *
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Sets the value of nome.
     *
     * @param mixed $nome the nome
     *
     * @return self
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Gets the value of sobrenome.
     *
     * @return mixed
     */
    public function getSobrenome()
    {
        return $this->sobrenome;
    }

    /**
     * Sets the value of sobrenome.
     *
     * @param mixed $sobrenome the sobrenome
     *
     * @return self
     */
    public function setSobrenome($sobrenome)
    {
        $this->sobrenome = $sobrenome;

        return $this;
    }

    /**
     * Gets the value of dataNascimento.
     *
     * @return mixed
     */
    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    /**
     * Sets the value of dataNascimento.
     *
     * @param mixed $dataNascimento the data nascimento
     *
     * @return self
     */
    public function setDataNascimento($dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;

        return $this;
    }

    /**
     * Gets the value of endereco.
     *
     * @return mixed
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * Sets the value of endereco.
     *
     * @param mixed $endereco the endereco
     *
     * @return self
     */
    public function setEndereco(Endereco $endereco)
    {
        $this->endereco = $endereco;

        return $this;
    }

    public function jsonSerialize() {
        return (object) get_object_vars($this);
    }
}