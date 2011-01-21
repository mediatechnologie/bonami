<?php
/**
**  @file reserveren.inc.php
**  @author immeëmosol (programmer dot willfris at nl) 
**  @date 2011-01-21
**  Created: ven 2011-01-21, 10:22.09 CET
**  Last modified: ven 2011-01-21, 11:48.27 CET
**/
vd($_POST);
ob_start();
require '/srv/web/my_lib/autoloader.inc.php';
$reservation  =  new Reservation();
$formulier    =  new Form( $reservation );
echo $formulier;
if ( 1 )
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

