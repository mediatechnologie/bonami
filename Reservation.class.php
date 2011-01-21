<?php
/**
**  @file Reservering.class.php
**  @author immeëmosol (programmerdotwillfrisatnl) 
**  @date 2011-01-21
**  Created: ven 2011-01-21, 07:59.03 CET
**  Last modified: ven 2011-01-21, 12:04.41 CET
**/

class Reservation extends DataObject
{
	public function __construct ()
	{
		//  int(10) unsigned NOT NULL AUTO_INCREMENT
		//  PRIMARY KEY
		$this->datafields[]  =  new DataField(
			'reservationID' ,
			DataField::INT ,
			'len:10'
		);
		//  int(10) unsigned NOT NULL COMMENT 'gekoppelde event'
		//  CONSTRAINT `reservations_ibfk_1`
		//  FOREIGN KEY (`eventID`)REF.`events`(`eventID`) ON UPD. CASCADE
		$this->datafields[]  =  new DataField(
			new Event() ,
			DataField::OBJECT
		);
		//  int(2) unsigned DEFAULT '1'
		$this->datafields[]  =  new DataField(
			'persons' ,
			DataField::INT ,
			'len:2'/*restrictie*/
		);
		//  datetime NOT NULL COMMENT 'datum waarop de reservering gedaan is'
		$this->datafields[]  =  new DataField(
			'reservation_date' ,
			DataField::DATETIME ,
			''/*restrictie*/
		);
		//  datetime DEFAULT NULL COMMENT 'of en zo ja wanneer er betaald is'
		$this->datafields[]  =  new DataField(
			'pay_date' ,
			DataField::DATETIME ,
			''/*restrictie*/
		);
		//  varchar(222) NOT NULL
		$this->datafields[]  =  new DataField(
			'contact_info' ,
			DataField::TEXT ,
			'len:222'
		);
	}
}


