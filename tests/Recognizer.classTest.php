<?php
/**
 * ShopBack Challange - Link Recognizer (PHPUnit tests)
 * @author João Escribano <joao.escribano@gmail.com>
 */
require_once dirname(__FILE__) . '/../src/Recognizer.class.php';

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

        /* Links adicionados apenas para teste */
        $this->assertTrue($recognizer->isProduct("http://www.lojadojoao.com.br/sku/16599221/produto-de-teste-1"));
        $this->assertTrue($recognizer->isProduct("http://www.lojadojoao.com.br/produto-de-teste-1/sku/16599221"));
        $this->assertTrue($recognizer->isProduct("http://www.lojadojoao.com.br/prod/16599221/?google"));
        $this->assertTrue($recognizer->isProduct("http://www.lojadojoao.com.br/produto-de-teste-1"));
        $this->assertTrue($recognizer->isProduct("http://www.lojadojoao.com.br/produto-16599221"));
        $this->assertTrue($recognizer->isProduct("http://www.lojadojoao.com.br/p-16599221"));
        $this->assertFalse($recognizer->isProduct("http://www.lojadojoao.com.br/myAccount/products"));
        $this->assertFalse($recognizer->isProduct("http://www.lojadojoao.com.br/minhaConta/products"));
        $this->assertFalse($recognizer->isProduct("http://www.lojadojoao.com.br/myAccount"));
        $this->assertFalse($recognizer->isProduct("http://www.lojadojoao.com.br/minhaConta"));
        $this->assertFalse($recognizer->isProduct("http://www.lojadojoao.com.br/carrinho"));
        $this->assertFalse($recognizer->isProduct("http://www.lojadojoao.com.br/checkout"));
        $this->assertFalse($recognizer->isProduct("http://www.lojadojoao.com.br/promotions"));

        /* Segundo produto adicionado para teste de XML com mais de um produto */
        $this->assertTrue($recognizer->isProduct("http://www.lojadojoao.com.br/produto-shopback-teste-2-84623738"));
        $this->assertTrue($recognizer->isProduct("http://www.lojadojoao.com.br/produto-shopback-teste-2-84623738?utm_teste=testando"));
        $this->assertTrue($recognizer->isProduct("http://www.lojadojoao.com.br/sku/84623738/produto-shopback-teste-2"));
        $this->assertTrue($recognizer->isProduct("http://www.lojadojoao.com.br/produto-shopback-teste-2/sku/84623738"));
        $this->assertTrue($recognizer->isProduct("http://www.lojadojoao.com.br/prod/84623738/?google"));
        $this->assertTrue($recognizer->isProduct("http://www.lojadojoao.com.br/produto-shopback-teste-2"));
        $this->assertTrue($recognizer->isProduct("http://www.lojadojoao.com.br/produto-84623738"));
        $this->assertTrue($recognizer->isProduct("http://www.lojadojoao.com.br/p-84623738"));
    }

    public function testLojaDaMaria() {
        $recognizer = new Recognizer("lojadamaria.com.br");

        /* Links que são produtos, espera-se um retorno TRUE para os testes */
        $this->assertTrue($recognizer->isProduct("http://www.lojadamaria.com.br/perfume-the-one-sport-masculino-edt?utm_source=ShopBack"));
        $this->assertTrue($recognizer->isProduct("http://www.lojadamaria.com.br/perfume-the-one-sport-masculino-edt"));

        /* Links que não são produtos, espera-se um retorno FALSE para os testes */
        $this->assertFalse($recognizer->isProduct("http://www.lojadamaria.com.br/search/helloword"));
        $this->assertFalse($recognizer->isProduct("http://www.lojadamaria.com.br/categoria-legais"));

        /* Links adicionados apenas para teste */
        $this->assertTrue($recognizer->isProduct("http://www.lojadamaria.com.br/sku/12345/perfume-the-one-sport-masculino-edt"));
        $this->assertTrue($recognizer->isProduct("http://www.lojadamaria.com.br/perfume-the-one-sport-masculino-edt/sku/12345"));
        $this->assertTrue($recognizer->isProduct("http://www.lojadamaria.com.br/prod/12345/?google"));
        $this->assertTrue($recognizer->isProduct("http://www.lojadamaria.com.br/perfume-the-one-sport-masculino-edt"));
        $this->assertTrue($recognizer->isProduct("http://www.lojadamaria.com.br/produto-12345"));
        $this->assertTrue($recognizer->isProduct("http://www.lojadamaria.com.br/p-12345"));

        $this->assertFalse($recognizer->isProduct("http://www.lojadamaria.com.br/myAccount/products"));
        $this->assertFalse($recognizer->isProduct("http://www.lojadamaria.com.br/minhaConta/products"));
        $this->assertFalse($recognizer->isProduct("http://www.lojadamaria.com.br/myAccount"));
        $this->assertFalse($recognizer->isProduct("http://www.lojadamaria.com.br/minhaConta"));
        $this->assertFalse($recognizer->isProduct("http://www.lojadamaria.com.br/carrinho"));
        $this->assertFalse($recognizer->isProduct("http://www.lojadamaria.com.br/checkout"));
        $this->assertFalse($recognizer->isProduct("http://www.lojadamaria.com.br/promotions"));
    }

    public function testLojaDoJose() {
        $recognizer = new Recognizer("lojadoze.com.br");

        /* Links que são produtos, espera-se um retorno TRUE para os testes */
        $this->assertTrue($recognizer->isProduct("http://www.lojadoze.com.br/chapeu-caipira-de-palha-desfiado"));
        $this->assertTrue($recognizer->isProduct("http://www.lojadoze.com.br/chapeu-caipira-de-palha-desfiado?google"));

        /* Links que não são produtos, espera-se um retorno FALSE para os testes */
        $this->assertFalse($recognizer->isProduct("http://www.lojadoze.com.br/home"));
        $this->assertFalse($recognizer->isProduct("http://www.lojadoze.com.br/categoria-teste"));

        /* Links adicionados apenas para teste */
        $this->assertTrue($recognizer->isProduct("http://www.lojadoze.com.br/sku/8595/chapeu-caipira-de-palha-desfiado"));
        $this->assertTrue($recognizer->isProduct("http://www.lojadoze.com.br/chapeu-caipira-de-palha-desfiado/sku/8595"));
        $this->assertTrue($recognizer->isProduct("http://www.lojadoze.com.br/prod/8595/?google"));
        $this->assertTrue($recognizer->isProduct("http://www.lojadoze.com.br/chapeu-caipira-de-palha-desfiado"));
        $this->assertTrue($recognizer->isProduct("http://www.lojadoze.com.br/produto-8595"));
        $this->assertTrue($recognizer->isProduct("http://www.lojadoze.com.br/p-8595"));

        $this->assertFalse($recognizer->isProduct("http://www.lojadoze.com.br/myAccount/products"));
        $this->assertFalse($recognizer->isProduct("http://www.lojadoze.com.br/minhaConta/products"));
        $this->assertFalse($recognizer->isProduct("http://www.lojadoze.com.br/myAccount"));
        $this->assertFalse($recognizer->isProduct("http://www.lojadoze.com.br/minhaConta"));
        $this->assertFalse($recognizer->isProduct("http://www.lojadoze.com.br/carrinho"));
        $this->assertFalse($recognizer->isProduct("http://www.lojadoze.com.br/checkout"));
        $this->assertFalse($recognizer->isProduct("http://www.lojadoze.com.br/promotions"));
    }
}