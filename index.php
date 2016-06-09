<?php
/**
 * ShopBack Challange
 * Link Recognizer
 * @author João Escribano <joao.escribano@gmail.com>
 */

error_reporting(E_ALL);
ini_set('display_errors', '1');

date_default_timezone_set("America/Sao_Paulo");
header('Content-Type: text/html; charset=utf-8');
ini_set("memory_limit", "128M");

require_once './recognizer.class.php';
$tests = [];

/* lojadojoao.com.br */
$joao = new LinkReconizer("lojadojoao.com.br");
$urls = [
	'http://www.lojadojoao.com.br/',
	'http://www.lojadojoao.com.br/produto-de-teste-1-16599221',
	'http://www.lojadojoao.com.br/categoria-teste',
	'http://www.lojadojoao.com.br/search/helloword',
	'http://www.lojadojoao.com.br/produto-de-teste-1-16599221?utm_teste=testando'
];
$tests = array_merge($joao->test($urls), $tests);

/* lojadamaria.com.br */
$maria = new LinkReconizer("lojadamaria.com.br");
$urls = [
	'http://www.lojadamaria.com.br/perfume-the-one-sport-masculino-edt?utm_source=ShopBack',
	'http://www.lojadamaria.com.br/search/helloword',
	'http://www.lojadamaria.com.br/categoria-legais',
	'http://www.lojadamaria.com.br/perfume-the-one-sport-masculino-edt'
];
$tests = array_merge($maria->test($urls), $tests);

/* lojadoze.com.br */
$jose = new LinkReconizer("lojadoze.com.br");
$urls = [
	'http://www.lojadoze.com.br/chapeu-caipira-de-palha-desfiado',
	'http://www.lojadoze.com.br/home',
	'http://www.lojadoze.com.br/categoria-teste',
	'http://www.lojadoze.com.br/chapeu-caipira-de-palha-desfiado?google'
];
$tests = array_merge($jose->test($urls), $tests);

echo "<h1>Test results:</h1>";
foreach ($tests as $url => $status) {
	echo "<b>$url:</b> <span style='color: " . ($status ? "green" : "red") . "'>".($status ? "Is a product" : "Is not a product") . "</span><br/>";
}