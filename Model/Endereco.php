<?php

namespace Model;

class Endereco implements \JsonSerializable {

	/**
	* @var id Int
	**/
	protected $id;

	/**
	* @var rua String
	**/
	protected $rua;

	/**
	* @var numero Int
	**/
	protected $numero;

	/**
	* @var complemento String
	**/
	protected $complemento;

	/**
	* @var cep String
	**/
	protected $cep;

	/***************************************************/

	public function __construct($params) {
		if (isset($params["endereco_id"])) {
			$this->setId($params["endereco_id"]);
		} else if (isset($params["id"])) {
            $this->setId($params["id"]);
        }
		
		if (isset($params["rua"])) {
			$this->setRua($params["rua"]);
		}
		
		if (isset($params["numero"])) {
			$this->setNumero($params["numero"]);
		}
		
		if (isset($params["complemento"])) {
			$this->setComplemento($params["complemento"]);
		}
		
		if (isset($params["cep"])) {
			$this->setCep($params["cep"]);
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
     * Gets the value of rua.
     *
     * @return mixed
     */
    public function getRua()
    {
        return $this->rua;
    }

    /**
     * Sets the value of rua.
     *
     * @param mixed $rua the rua
     *
     * @return self
     */
    public function setRua($rua)
    {
        $this->rua = $rua;

        return $this;
    }

    /**
     * Gets the value of numero.
     *
     * @return mixed
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Sets the value of numero.
     *
     * @param mixed $numero the numero
     *
     * @return self
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Gets the value of complemento.
     *
     * @return mixed
     */
    public function getComplemento()
    {
        return $this->complemento;
    }

    /**
     * Sets the value of complemento.
     *
     * @param mixed $complemento the complemento
     *
     * @return self
     */
    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;

        return $this;
    }

    /**
     * Gets the value of cep.
     *
     * @return mixed
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * Sets the value of cep.
     *
     * @param mixed $cep the cep
     *
     * @return self
     */
    public function setCep($cep)
    {
        $this->cep = $cep;

        return $this;
    }

    public function jsonSerialize() {
        return (object) get_object_vars($this);
    }
}