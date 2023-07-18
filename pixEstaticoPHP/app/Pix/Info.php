<?php

namespace App\pix;

class Info {

    private $chavePix; //chave pix
    private $descricao; //descrição que aparece na hora do pagamento
    private $nomeTitular; //Nome do titular da conta
    private $cidadeTitular; //cidade do titular da conta
    private $idTransacao; //id da transação pix
    private $valor; //valor da transação



    /**
     * Get the value of chavePix
     */ 
    public function getChavePix()
    {
        return $this->chavePix;
    }

    /**
     * Set the value of chavePix
     *
     * @return  self
     */ 
    public function setChavePix($chavePix)
    {
        $this->chavePix = $chavePix;

        return $this;
    }

    /**
     * Get the value of descricao
     */ 
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set the value of descricao
     *
     * @return  self
     */ 
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get the value of nomeTitular
     */ 
    public function getNomeTitular()
    {
        return $this->nomeTitular;
    }

    /**
     * Set the value of nomeTitular
     *
     * @return  self
     */ 
    public function setNomeTitular($nomeTitular)
    {
        $this->nomeTitular = $nomeTitular;

        return $this;
    }

    /**
     * Get the value of cidadeTitular
     */ 
    public function getCidadeTitular()
    {
        return $this->cidadeTitular;
    }

    /**
     * Set the value of cidadeTitular
     *
     * @return  self
     */ 
    public function setCidadeTitular($cidadeTitular)
    {
        $this->cidadeTitular = $cidadeTitular;

        return $this;
    }

    /**
     * Get the value of idTransacao
     */ 
    public function getIdTransacao()
    {
        return $this->idTransacao;
    }

    /**
     * Set the value of idTransacao
     *
     * @return  self
     */ 
    public function setIdTransacao($idTransacao)
    {
        $this->idTransacao = $idTransacao;

        return $this;
    }

    /**
     * Get the value of valor
     */ 
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set the value of valor
     *
     * @return  self
     */ 
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }
}