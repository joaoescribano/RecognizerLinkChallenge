<?php

require_once('../src/Recognizer.class.php');
use phpunit\framework\TestCase;

class RecognizerTest extends TestCase {

    public function testLojaDoJoao() {
        $recognizer = new Recognizer("lojadojoao.com.br");
        
        /* Links que são produtos, espera-se um retorno TRUE para os testes */
        $this->assertTrue($recognizer->isProduct("http://www.lojadojoao.com.br/produto-de-teste-1-16599221"));
        $this->assertTrue($recognizer->isProduct("http://www.lojadojoao.com.br/produto-de-teste-1-16599221?utm_teste=testando"));
        /* Links que não são produtos, espera-se um retorno FALSE para os testes */
        $this->assertFalse($recognizer->isProduct("http://www.lojadojoao.com.br/"));
        $this->assertFalse($recognizer->isProduct("http://www.lojadojoao.com.br/categoria-teste"));
        $this->assertFalse($recognizer->isProduct("http://www.lojadojoao.com.br/search/helloword"));
    }

    public function testLojaDaMaria() {
        $recognizer = new Recognizer("lojadamaria.com.br");
        
        /* Links que são produtos, espera-se um retorno TRUE para os testes */
        $this->assertTrue($recognizer->isProduct("http://www.lojadamaria.com.br/perfume-the-one-sport-masculino-edt?utm_source=ShopBack"));
        $this->assertTrue($recognizer->isProduct("http://www.lojadamaria.com.br/perfume-the-one-sport-masculino-edt"));
        /* Links que não são produtos, espera-se um retorno FALSE para os testes */
        $this->assertFalse($recognizer->isProduct("http://www.lojadamaria.com.br/search/helloword"));
        $this->assertFalse($recognizer->isProduct("http://www.lojadamaria.com.br/categoria-legais"));
    }

    public function testLojaDoJose() {
        $recognizer = new Recognizer("lojadoze.com.br");

        /* Links que são produtos, espera-se um retorno TRUE para os testes */
        $this->assertTrue($recognizer->isProduct("http://www.lojadoze.com.br/chapeu-caipira-de-palha-desfiado"));
        $this->assertTrue($recognizer->isProduct("http://www.lojadoze.com.br/chapeu-caipira-de-palha-desfiado?google"));
        /* Links que não são produtos, espera-se um retorno FALSE para os testes */
        $this->assertFalse($recognizer->isProduct("http://www.lojadoze.com.br/home"));
        $this->assertFalse($recognizer->isProduct("http://www.lojadoze.com.br/categoria-teste"));
    }
}