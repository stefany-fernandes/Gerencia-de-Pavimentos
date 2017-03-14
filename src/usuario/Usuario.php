<?php

declare (strict_types=1);

namespace Usuario;

use save\Save;

class Usuario extends Save {
    protected $login;
    protected $senha;
    protected $nome;
    protected $numFotos = 2;
    protected $nivel = 0; // nivel de acesso do usuário comum.

    public function __construct(string $login, string $senha, string $nome) {
        $this->login=$login;
        $this->senha = $senha;
        $this->nome=$nome;
    }

    /**
     *
     * retorna -1 se o usuário já atingiu seu limite de fotos (17)
     * retorna 0 se ele pode adicionar uma foto.
     * @return int
     *
     */
    public function diminuiFotos(){
        $this->numFotos = $this->numFotos - 1;
        if ($this->numFotos == 0) {
            return -1;
        }
        return 0;
    }
    public function getNumFotos(){
        return $this->numFotos;
    }

    public function tornarADM() {
        $this->nivel = 1;
    }

    public function tornarUComum(){
        $this->nivel = 0;
    }

    /**
     * @return string
     */
    public function getNome(): string {
        return $this->nome;
    }


    /**
     * @return int
     */
    public function getNivel(): int
    {
        return $this->nivel;
    }

    /**
     * @return string
     */
    public function getLogin(): string {
        return $this->login;
    }

    /**
     * @return string
     */
    public function getSenha(): string {
        return $this->senha;
    }

    public static function getClassName()
    {
        return 'Usuario';
    }
    public static function getIdAttribute()
    {
        return 'login';
    }
}