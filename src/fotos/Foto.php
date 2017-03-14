<?php

declare (strict_types=1);

namespace Fotos;

use defeitos\Defeitos;
use save\Save;
use Symfony\Component\HttpFoundation\Session\Session;

class Foto extends Save {
    protected $defeito;
    public $fotoDefeito;
    public $autor; // usuario que enviou a foto.

    /**
     * Foto constructor.
     * @param string $defeito
     * @param string $caminho
     * @param string $autor
     */
    public function __construct(string $defeito, string $caminho, string $autor) {
        $this->defeito = $defeito;
        $this->fotoDefeito=$caminho;
        $this->autor = $autor;
    }

    /**
     * @return string
     * retorna o defeito da foto
     */
    public function carregarDefeito(){
        return $this->defeito;
    }

    /**
     * @return string
     * retorna o caminho da foto.
     */
    public function carregarFoto(){
        return $this->fotoDefeito;
    }

    /**
     * @return string
     * retorna o usuario que enviou a foto
     */
    public function getAutor(){
        return $this->autor;
    }

    /**
     * @param string $nomeUser
     * @param int $nivel
     * @return string
     *
     * método responsável por retornar o caminho da foto, juntamente com um css.
     *
     */
    public static function getCaminho (string $nomeUser, int $nivel)
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
            $defeit = Defeitos::load($serial->carregarDefeito());
            if($nomeUser == $serial->getAutor() || $nivel == 1){

            $A = $A . '<div class="col s12 m6">
                <div class="card">
                    <div class="card-image">
                        <img src="../'.$serial->carregarFoto().'">
                        <form id ="Form'.$formCount.'" form action = "delete" method="POST">
                        <span class="card-title">'.$serial->carregarDefeito().'</span>
                        <input type="hidden" value = "'.$serial->carregarDefeito().'" name="A" />
                        <a class="btn-floating halfway-fab waves-effect waves-light red" onclick="document.getElementById(\'Form'.$formCount.'\').submit()"><i class="material-icons">mode_edit</i></a>
                        </form>
                    </div>
                    <div class="card-content">
                        <p>'.(($defeit != null)? $defeit->getDescricao():'').'</p>
                    </div>
                </div>
            </div>
            ';
            $formCount++;
        }
        }
        return $A;

    }

    /**
     * Metodo resposável pela deleção da foto no servidor.
     */
    public function delete() {
        $contents = file_get_contents(static::getClassName() . '.txt');
        $contents = str_replace(serialize($this) . PHP_EOL, '', $contents);
        file_put_contents($this->getClassName() . '.txt', $contents);
        $A = __DIR__.'/../../web/'.$this->carregarFoto();
        unlink($A);
    }

    /**
     * @return string
     */
    public static function getIdAttribute()
    {
        return 'defeito';
    }

    /**
     * @return string
     */
    public static function getClassName()
    {
        return 'Foto';
    }

}