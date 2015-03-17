# ooehtml
php simple minimal template

This are simples template to parse blocks and vars to populate a simple template

How to use :

Create a objected

$Objeto = new ooeHtml;

Load a template

$Objeto->setHtmlContent('ooeHtml.html5.html');

Parse var to replace in template

$Objeto->setHtmlVar('AUTHOR', 'Marcelo Soares da Costa'); // static , array or database values
$Objeto->setHtmlVar('PACKAGE', 'ooeHtml');

Set a block to replace in template

$Objeto->setHtmlBlock('CONTENT3');

Parse block var values estatic or from array 

foreach ($block_array as $value)
{
	$Objeto->setHtmlBlockVar('CONTENT3','AUTHORIPSUM',$value['auhor']); // from array / database
	$Objeto->setHtmlBlockVar('CONTENT3','FRASEIPSUM',$value['content']);
	$Objeto->setHtmlBlockVar('CONTENT3','URLIPSUM',$value['url']);
	$Objeto->setHtmlBlockVar('CONTENT3','STATICIPSUM','estático'); // teste estatico , static content
}

parse template and print from buffer

$Objeto->printHtmlScreen();
