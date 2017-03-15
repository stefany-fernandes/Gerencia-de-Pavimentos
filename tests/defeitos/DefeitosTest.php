<?php

namespace tests\defeitos;

use Defeitos\Defeitos;

class testDefeitos extends \PHPUnit\Framework\TestCase {

    /**
     * @param string $nomeDefeito
     * @param string $descricao
     * @dataProvider providerTestConstruct
     */
    public function testConstruct(string $nomeDefeito, string $descricao){
        $defeito = new Defeitos($nomeDefeito, $descricao);
        $this->assertEquals($defeito->getDescricao(), $descricao);
        $this->assertEquals($defeito->getNomeDefeito(), $nomeDefeito);
    }


    /**
     * @return array
     */
    public function providerTestConstruct(){
        return [
        ["Trinca por fadiga ou Couro de Jacaré",
            "Essas trincas são causadas pela fadiga do Concreto Asfáltico (CA) referente as cargas repetidas do tráfico.
Ocorrência: este tipo de defeito ocorre em áreas sujeitas a cargas de tráfego repetidas, geralmente trilha de rodas.
Influência na segurança operacional: o pricnipal risco pode ser o desprendimento da camada de rolamento do pavimento, gerando a presença de FOD.
"],
            ["Exsudação", "É uma película de ligante sobre a superfície do pavimento que resulta em uma superfície brilhante.
Causa: pode ser causado pelo excesso de ligante no CA, excesso na aplicação de selantes de betume, e ou vazios que possuem pouco ar.
Ocorrência: Ocorre quando há preenchimento dos vazios da mistura por asfalto durante o período quente, em seguida o asfalto emerge para a superfície do pavimento.Influência na segurança operacional: este tipo de problema pode  deixar a superfície lisa devido a película de material betuminoso influenciando na aderência pneu-pavimento .
"],
            ["Trinca em bloco ", "São rachaduras interligadas que separam o pavimento em blocos aproximadamente retangulares.
Causa: geralmente esse defeito é causado pela retração do C A e variação de temperatura diária.
Ocorrência: Pode ser encontrado em extensas áreas do pavimento, e na maioria das vezes em áreas não trafegadas.
Influência na segurança operacional: o principal risco pode ser o desprendimento de blocos e permanência de FOD na pista.
"],
        ];
    }


}