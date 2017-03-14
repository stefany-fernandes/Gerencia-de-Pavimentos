<?php

namespace Defeitos;

use save\Save;

class Defeitos extends Save {
    protected $nomeDefeito;
    protected $descricao;

    public function __construct(string $nomeDef, string $descricao) {
        $this->nomeDefeito = $nomeDef;
        $this->descricao = $descricao;
    }

    public function alterarDescricao(string $novaDescricao){
        $this->descricao = $novaDescricao;
    }

    public function alterarFoto(string $caminhoFoto){
        $this->fotoDefeito = $caminhoFoto;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public static function getClassName()
    {
        return 'Defeitos';
    }

    public static function getIdAttribute()
    {
        return 'nomeDefeito';
    }
}