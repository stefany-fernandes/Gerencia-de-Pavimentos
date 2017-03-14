<?php

namespace tests\fotos;

use Fotos\Foto;

class testFoto extends \PHPUnit\Framework\TestCase {

    /**
     * @param string $nome
     * @param string $defeito
     * @param string $caminho
     * @param string $autor
     * @dataProvider providerTestConstruct
     */
    public function testConstruct(string $defeito, string $caminho, string $autor) {
        $fotoObj = new Foto($defeito, $caminho, $autor);
        $this->assertEquals($fotoObj->getAutor(), $autor);
        $this->assertEquals($fotoObj->carregarDefeito(), $defeito);
        $this->assertEquals($fotoObj->carregarFoto(), $caminho);
    }


    /**
     * @return array
     * @dataprovider
     */
    public function providerTestConstruct() {
        return [
            ['Rachadura', 'fotosUsuario/foto1.png', 'cesarjunior'],
            ['Couro de Jacaré', 'fotosUsuario/foto2.png', 'stefanyfernandes'],
            ['Ranhura', 'fotosUsuario/foto3.png', 'alessandror']

        ];
    }
}
