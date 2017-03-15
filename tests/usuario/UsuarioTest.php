<?php
namespace tests\Defeitos;
use Usuario\Usuario;


class defeitosTests extends \PHPUnit\Framework\TestCase{

    /**
     * @param string $login
     * @param string $senha
     * @param string $nome
     *
     * @dataProvider providerTestConstruct
     *
     */
    public function testConstruct(string $login, string $senha, string $nome){
        $objUser = new Usuario($login, $senha, $nome);
        $this->assertEquals($objUser->getNome(), $nome);
        $this->assertEquals($objUser->getNumFotos(), 17);
        $this->assertEquals($objUser->getLogin(), $login);
        $this->assertEquals($objUser->getSenha(), $senha);
        $this->assertEquals($objUser->diminuiFotos(), 0);
        $this->assertEquals($objUser->getNivel(), 0);
    }

    public function providerTestConstruct(){
        return [
            ['stefanyfer', '123456', 'Stefany'],
            ['arya_stark', 'valarmorghulis', 'Arya Stark'],
            ['daenerystargaryen', 'ilovedragons', 'Daenerys Stormborn of the House Targaryen, First of Her Name, the Unburnt, Queen of the Andals and the First Men, Khaleesi of the Great Grass Sea, Breaker of Chains, and Mother of Dragons'],
        ];
    }
}