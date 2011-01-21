<?php
/**
**  @file Event.class.php
**  @author immeëmosol (programmer dot willfris at nl) 
**  @date 2011-01-21
**  Created: ven 2011-01-21, 08:46.55 CET
**  Last modified: ven 2011-01-21, 10:20.08 CET
**/

class Event extends DataObject
{
	public function __construct ()
	{
		//  int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'unieke identifier'
		$this->datafields[]  =  new DataField(
			'eventID' ,
			Datatypes::INT ,
			''/*restrictie*/
		);
		//  datetime NOT NULL COMMENT 'datum waarop het event gebeurd'
		$this->datafields[]  =  new DataField(
			'date' ,
			Datatypes::DATETIME ,
			''/*restrictie*/
		);
		//  varchar(111) NOT NULL COMMENT 'de naam van het event'
		$this->datafields[]  =  new DataField(
			'title' ,
			Datatypes::VARCHAR ,
			''/*restrictie*/
		);
		//  text NOT NULL COMMENT 'beschrijvende tekst van het event/de gebeurtenis'
		$this->datafields[]  =  new DataField(
			'description' ,
			Datatypes::TEXT ,
			''/*restrictie*/
		);
		//  tinyint(1) DEFAULT '0' COMMENT 'of het event gepubliceerd mag worden'
		$this->datafields[]  =  new DataField(
			'published' ,
			Datatypes::BOOLEAN ,
			''/*restrictie*/
		);
		//  int(3) unsigned DEFAULT NULL COMM. 'het aantal plaatsen voor het event'
		$this->datafields[]  =  new DataField(
			'capacity' ,
			Datatypes::POSINT ,
			''/*restrictie*/
		);
	}
}


