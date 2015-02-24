<?php
require_once('ooeHtml.class.php');

$fileTemplate='ooeHtml.html5.html';

$Objeto = new ooeHtml; // cria o objeto template

$Objeto->setHtmlContent($fileTemplate); // carrega o template html com as marcacoes

$Objeto->setHtmlVar('AUTHOR', 'Marcelo Soares da Costa');
$Objeto->setHtmlVar('PACKAGE', 'ooeHtml');

$Objeto->setHtmlVar('ASIDEIPSUM', 'Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits. Dramatically visualize customer directed convergence without revolutionary ROI.

Efficiently unleash cross-media information without cross-media value. Quickly maximize timely deliverables for real-time schemas. Dramatically maintain clicks-and-mortar solutions without functional solutions.

Completely synergize resource sucking relationships via premier niche markets. Professionally cultivate one-to-one customer service with robust ideas. Dynamically innovate resource-leveling customer service for state of the art customer service.');

$Objeto->setHtmlVar('BEERIPSUM', 'lauter tun kolsch: alcohol; hand pump rims. ipa sour/acidic. conditioning tank bung wort! keg lagering; length: hoppy racking gravity, pint glass. specific gravity chocolate malt cask conditioned ale aau ipa pitching grainy. beer, balthazar: beer oxidized racking oxidized additive noble hops hydrometer, craft beer, heat exchanger. barley cask conditioned ale bung beer pub pint glass. bunghole fermentation malt yeast. double bock/dopplebock brewing bittering hops anaerobic berliner weisse? lauter trappist chocolate malt ibu wit mash. carboy hoppy, keg pilsner becher, barleywine heat exchanger, ipa.');

$Objeto->setHtmlVar('BIGTITLE', 'Titulo Grande');

$Objeto->setHtmlVar('ITEM1', 'Menu item 1');
$Objeto->setHtmlVar('ITEM2', 'Menu item 2');
$Objeto->setHtmlVar('ITEM3', 'Menu item 3');

$Objeto->setHtmlVar('ARTICLE1', 'Artigo com título header h1');
$Objeto->setHtmlVar('ARTICLE2', 'Artigo com título section h2');
$Objeto->setHtmlVar('ARTICLE3', 'Artigo com título section h2 e bloco');
$Objeto->setHtmlVar('ARTICLE4', 'Artigo com título footer h3 e bloco');

$Objeto->setHtmlVar('CONTENT1', 'Silvio Santos Ipsum ma você, topa ou não topamm. Patríciaaammmm... Luiz Ricardouaaammmmmm. Vem pra lá, mah você vai pra cá. Agora vai, agora vem pra láamm. Qual é a musicamm? O arriscam tuduam, valendo um milhão de reaisuam. Ma quem quer dinheiroam? Patríciaaammmm... Luiz Ricardouaaammmmmm. Um, dois três, quatro, PIM, entendeuam? Boca sujuam... sem vergonhuamm. Boca sujuam... sem vergonhuamm. É namoro ou amizadeemm?');
$Objeto->setHtmlVar('CONTENT2', 'Eiiitaaa Mainhaaa!! Esse Lorem ipsum é só na sacanageeem!! E que abundância meu irmão viuu!! Assim você vai matar o papai. Só digo uma coisa, Domingo ela não vai! Danadaa!! Vem minha odalisca, agora faz essa cobra coral subir!!! Pau que nasce torto, Nunca se endireita. Tchannn!! Tchannn!! Tu du du pááá! Eu gostchu muitchu, heinn! danadinha! Mainhaa! Agora use meu lorem ipsum ordinária!!! Olha o quibeee! rema, rema, ordinária!.');

@$block_array[]=array('auhor'=>'Silvio Santos','content'=>'Quem quer dinheiro !?','url'=>'http://silviosantosipsum.com/');
$block_array[]=array('auhor'=>'Cumpade Wash','content'=>'Eitá mainha !','url'=>'http://compadreipsum.com.br/');
$block_array[]=array('auhor'=>'Mussum','content'=>'Cacildis','url'=>'http://mussumipsum.com/');
$block_array[]=array('auhor'=>'Dilma','content'=>'Dilmês Ipsum','url'=>'http://dilmesipsum.com.br/');

$Objeto->setHtmlBlock('CONTENT3');

foreach ($block_array as $value)
{
	$Objeto->setHtmlBlockVar('CONTENT3','AUTHORIPSUM',$value['auhor']);
	$Objeto->setHtmlBlockVar('CONTENT3','FRASEIPSUM',$value['content']);
	$Objeto->setHtmlBlockVar('CONTENT3','URLIPSUM',$value['url']);
	$Objeto->setHtmlBlockVar('CONTENT3','STATICIPSUM','estático'); // teste estatico
}

@$block_array2[]=array('CONTENT40'=>'alguma coisa 1','CONTENT41'=>'teste 1');
$block_array2[]=array('CONTENT40'=>'alguma coisa 2','CONTENT41'=>'teste 2');
$block_array2[]=array('CONTENT40'=>'alguma coisa 3','CONTENT41'=>'teste 3');
$block_array2[]=array('CONTENT40'=>'alguma coisa 4','CONTENT41'=>'teste 4');

$Objeto->setHtmlBlock('CONTENT4');

foreach ($block_array2 as $value2)
{
	$Objeto->setHtmlBlockVar('CONTENT4','CONTENT40',$value2['CONTENT40']);
	$Objeto->setHtmlBlockVar('CONTENT4','CONTENT41',$value2['CONTENT41']);
}

$Objeto->printHtmlScreen();
?>
