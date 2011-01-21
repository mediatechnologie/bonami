<?php
/**
**  @file reserveren.inc.php
**  @author immeëmosol (programmer dot willfris at nl) 
**  @date 2011-01-21
**  Created: ven 2011-01-21, 10:22.09 CET
**  Last modified: ven 2011-01-21, 10:22.15 CET
**/


require 'Form.class.php';
require 'DataObject.class.php';
require 'Event.class.php';
require 'Reservation.class.php';

$reservation  =  new Reservation();
$formulier    =  new Form( $reservation->dataFields() );
echo $formulier;


