<?php

namespace Defeitos;

use save\Save;

class Defeitos extends Save {
    protected $nomeDefeito;
    protected $descricao;

    /**
     * Defeitos constructor.
     * @param string $nomeDef
     * @param string $descricao
     */
    public function __construct(string $nomeDef, string $descricao) {
        $this->nomeDefeito = $nomeDef;
        $this->descricao = $descricao;
    }

    /**
     * @return string
     */
    public function getDescricao(){
        return $this->descricao;
    }

    /**
     * @return string
     */
    public function getNomeDefeito(){
        return $this->nomeDefeito;
    }

    /**
     * @return string
     */
    public static function getClassName()
    {
        return 'Defeitos';
    }

    /**
     * @return string
     */
    public static function getIdAttribute()
    {
        return 'nomeDefeito';
    }
}