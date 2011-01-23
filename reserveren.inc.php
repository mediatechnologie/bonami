<?php
/**
**  @file reserveren.inc.php
**  @author immeëmosol (programmer dot willfris at nl) 
**  @date 2011-01-21
**  Created: ven 2011-01-21, 10:22.09 CET
**  Last modified: sab 2011-01-22, 21:57.14 CET
**/
require '/srv/web/my_lib/autoloader.inc.php';
ob_start();
echo <<<CSS
<style>
:required:hover , :required:active , :required:focus
{
	outline-color  :  rgba( 255 , 0 , 0 , 1 );
}
:required:active
{
	border-color  :  rgba( 255 , 0 , 0 , 0.8 );
}
</style>
CSS;
$reserveringsformulier    =  new Form( new Reservation() );
echo $reserveringsformulier;
if ( 0 )
{
	$html  =  ob_get_clean();
	$tidy  =  new Tidy();
	$tidy->parseString(
		$html ,
		array(
			'indent'         =>  TRUE ,
			'output-xhtml'   =>  TRUE ,
			'wrap'           =>  200 ,
			'add-xml-decl'   =>  TRUE ,
		) ,
		'utf8'
	);
	$tidy->cleanRepair();
	echo $tidy;
}

