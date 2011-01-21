<?php
/**
**  @file DataField.class.php
**  @author immeëmosol (programmer dot willfris at nl) 
**  @date 2011-01-21
**  Created: ven 2011-01-21, 10:33.38 CET
**  Last modified: ven 2011-01-21, 11:16.34 CET
**/

/**
 *  @todo[~immeëmosol, ven 2011-01-21, 10:49.42 CET]
 *    make date , time & datetime be `bitmask-compatible`
**/
class DataField
{
	const INT       =  0;
	const BOOLEAN   =  1;
	const TINYINT   =  2;
	const TEXT      =  3;
	const STRING    =  4;
	const DATETIME  =  5;
	const DATE      =  6;
	const TIME      =  7;
	const POS_INT   =  8;
	const OBJECT    =  9;

	/**
	 *  the name given to the data, it's identifier.
	**/
	private $name;
	/**
	 *  one of this class' constants.
	**/
	private $type;
	/**
	 *  collection of restrictions on the input-data
	**/
	private $restrictions  =  array();

	public function __construct ( $name , $type , $restrictions =  array() )
	{
		$this->type          =  $type;
		$this->name          =  $name;
		$this->restrictions  =  $restrictions;
	}
	public function check ( $value )
	{
		$errors  =  array();
		foreach ( $this->restrictions as $restriction )
			if ( FALSE === $this->check_restriction( $value ) )
				$errors[]  =  $restriction;

		if ( empty( $errors ) )
			return TRUE;

		return FALSE;
	}

	public function name ()
	{
		return $this->name;
	}
	public function type ()
	{
		return $this->type;
	}
}


