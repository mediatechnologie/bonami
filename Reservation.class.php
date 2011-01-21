<?php
/**
**  @file Reservering.class.php
**  @author immeëmosol (programmer dot willfris at nl) 
**  @date 2011-01-21
**  Created: ven 2011-01-21, 07:59.03 CET
**  Last modified: ven 2011-01-21, 10:20.41 CET
**/

class Reservation extends DataObject
{
	//  int(10) unsigned NOT NULL AUTO_INCREMENT
	//  PRIMARY KEY
	private $reservationID;
	//  int(10) unsigned NOT NULL COMMENT 'gekoppelde event'
	//  CONSTRAINT `reservations_ibfk_1`
	//  FOREIGN KEY (`eventID`) REF. `events` (`eventID`) ON UPD. CASCADE
	private $eventID;
	//  int(2) unsigned DEFAULT '1'
	private $persons;
	//  datetime NOT NULL COMMENT 'datum waarop de reservering gedaan is'
	private $date;
	//  datetime DEFAULT NULL COMMENT 'of en zo ja wanneer er betaald is'
	private $paid;
	//  varchar(222) NOT NULL
	private $contact_info;

	public function __construct ()
	{
	}
}


