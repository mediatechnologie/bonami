<?php
/**
**  @file Reservering.class.php
**  @author immeëmosol (programmerdotwillfrisatnl) 
**  @date 2011-01-21
**  Created: ven 2011-01-21, 07:59.03 CET
**  Last modified: sab 2011-01-22, 22:03.16 CET
**/

class Reservation extends DataObject
{
	public function __construct ()
	{
		$this->name( 'Reservering' );

		$this->fields(
			//  int(10) unsigned NOT NULL AUTO_INCREMENT
			//  PRIMARY KEY
			array(
				'reservationID' ,
				DataField::POS_INT ^ DataField::PK ^ DataField::AUTO ,
				10 ,
				NULL ,
				'unieke identifier'
			) ,
			//  int(10) unsigned NOT NULL COMMENT 'gekoppelde event'
			//  CONSTRAINT `reservations_ibfk_1`
			//  FOREIGN KEY (`eventID`)REF.`events`(`eventID`) ON UPD. CASCADE
			array(
				new Event() ,
				DataField::OBJECT ^ DataField::FK ^ DataField::POS_INT ,
				NULL ,
				NULL ,
				'gekoppelde event'
			) ,
			//  int(2) unsigned DEFAULT '1'
			array(
				'persons' ,
				DataField::POS_INT ,
				2 ,
				1 ,
				'het aantal te reserveren plaatsen'
			) ,
			//  datetime NOT NULL COMMENT 'datum waarop de reservering gedaan is'
			array(
				'reservation_date' ,
				DataField::DATETIME ,
				NULL ,
				NULL ,
				'datum waarop de reservering gedaan is'
			) ,
			//  datetime DEFAULT NULL COMMENT 'of en zo ja wanneer er betaald is'
			array(
				'pay_date' ,
				DataField::DATETIME ^ DataField::OPTIONAL ,
				NULL ,
				NULL ,
				'of en zo ja wanneer er betaald is'
			) ,
			//  varchar(222) NOT NULL
			array(
				'contact_info' ,
				DataField::TEXT ,
				222 ,
				NULL ,
				''
			)
		);
	}
}


