<?php
/**
**  @file Event.class.php
**  @author immeëmosol (programmer dot willfris at nl) 
**  @date 2011-01-21
**  Created: ven 2011-01-21, 08:46.55 CET
**  Last modified: sab 2011-01-22, 22:00.32 CET
**/

class Event extends DataObject
{
	public function __construct ()
	{
		$this->name( 'Gebeurtenis' );

		//  int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'unieke identifier'
		$this->field(
			'eventID' ,
			DataField::POS_INT ^ DataField::PK ^ DataField::AUTO ,
			10 ,
			NULL ,
			'unieke identifier'
		);
		//  datetime NOT NULL COMMENT 'datum waarop het event gebeurd'
		$this->field(
			'event_date' ,
			DataField::DATETIME ,
			NULL ,
			NULL ,
			'datum waarop het event gebeurd'
		);
		//  varchar(111) NOT NULL COMMENT 'de naam van het event'
		$this->field(
			'title' ,
			DataField::STRING ,
			111 ,
			NULL ,
			'de naam van het event'
		);
		//  text NOT NULL COMMENT 'beschrijvende tekst van het event/de gebeurtenis'
		$this->field(
			'description' ,
			DataField::TEXT ,
			NULL ,
			NULL ,
			'beschrijvende tekst van het event/de gebeurtenis'
		);
		//  tinyint(1) DEFAULT '0' COMMENT 'of het event gepubliceerd mag worden'
		$this->field(
			'published' ,
			DataField::BOOLEAN ,
			NULL ,
			FALSE ,
			'of het event gepubliceerd mag worden'
		);
		//  int(3) unsigned DEFAULT NULL COMM. 'het aantal plaatsen voor het event'
		$this->field(
			'capacity' ,
			DataField::POS_INT ^ DataField::OPTIONAL ,
			array() ,#restrictions
			NULL ,
			'het aantal plaatsen voor het event'
		);
	}
}


