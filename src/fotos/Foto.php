<?php

declare (strict_types=1);

namespace Fotos;
use Administrador\Administrador;
use defeitos\Defeitos;
use save\Save;
use Symfony\Component\HttpFoundation\Session\Session;

class Foto extends Save {
    protected $nome;
    protected $defeito;
    public $fotoDefeito;
    public $autor; // usuario que enviou a foto.

    public function __construct(string $nome, string $defeito, string $caminho, string $autor) {
        $this->nome=$nome;
        $this->defeito = Defeitos::load($defeito);
        $this->fotoDefeito=$caminho;
        $this->autor = $autor;
    }

    public function carregarFoto(){
        return $this->fotoDefeito;
    }

    public function getNome(){
        return $this->nome;
    }
    public static function getCaminho ()
    {
        $A = '';
        $formCount  = 0;
        $d = ('Foto.txt');//self::getClassName() . 'txt');
        $contents = @file_get_contents($d);
        $objects = explode(PHP_EOL, $contents);
        foreach ($objects as $obj) {
            if (!$obj){
                break;
            }
            $serial = unserialize($obj);
            $A = $A . '<div class="col s12 m6">
                <div class="card">
                    <div class="card-image">
                        <img src="../'.$serial->carregarFoto().'">
                        <form id ="Form'.$formCount.'" form action = "delete" method="POST">
                        <span class="card-title">'.$serial->getNome().'</span>
                        <input type="hidden" value = "'.$serial->getNome().'" name="A" />
                        <a class="btn-floating halfway-fab waves-effect waves-light red" onclick="document.getElementById(\'Form'.$formCount.'\').submit()"><i class="material-icons">mode_edit</i></a>
                        </form>
                    </div>
                    <div class="card-content">
                        <p>'.'</p>
                    </div>
                </div>
            </div>
            ';
            $formCount++;
        }
        return $A;

    }

    protected function deletarFoto() {

    }

    protected function verFoto() {

    }

    protected function incluirDescricao(){

    }

    protected function lerDescricao(){

    }
    protected function alterarDescricao(){

    }
    protected function incluirFoto(){

    }
    public function delete() {
        $contents = file_get_contents(static::getClassName() . '.txt');
        $contents = str_replace(serialize($this) . PHP_EOL, '', $contents);
        file_put_contents($this->getClassName() . '.txt', $contents);
        unlink(__DIR__.'/../../web/'.$this->fotoDefeito);
    }

    public static function getIdAttribute()
    {
        return 'nome';
    }
    public static function getClassName()
    {
        return 'Foto';
    }

}