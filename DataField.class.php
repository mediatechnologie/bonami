<?php
/**
**  @file DataField.class.php
**  @author immeëmosol (programmer dot willfris at nl) 
**  @date 2011-01-21
**  Created: ven 2011-01-21, 10:33.38 CET
**  Last modified: sab 2011-01-22, 21:32.09 CET
**/

/**
 *  @todo[~immeëmosol, ven 2011-01-21, 10:49.42 CET]
 *    make date , time & datetime be `bitmask-compatible`
**/
class DataField extends DataBase
{
	const AUTO      =  1;
	const OPTIONAL  =  2;
	const PK        =  4;
	const FK        =  8;
	const INT       =  16;
	const BOOLEAN   =  32;
	const TINYINT   =  64;
	const POS_INT   =  128;
	const TEXT      =  256;
	const STRING    =  512;
	const DATETIME  =  1024;
	const DATE      =  2048;
	const TIME      =  4096;
	const OBJECT    =  8192;

	/**
	 *  one of this class' constants.
	**/
	private $type;
	/**
	 *  collection of restrictions on the input-data
	**/
	private $restrictions  =  array();

	/**
	 *  collection of conditions that were not met by input.
	**/
	private $errors  =  array();

	private $hint  =  NULL;

	/**
	 *  the default option for the data, if any
	**/
	private $auto_value;
	const AV_DEFAULT  =  'elbasseugnu_gnihtemos';

	public function __construct (
		$name ,
		$type ,
		$restrictions = array() ,
		$auto_value = self::AV_DEFAULT ,
		$hint = NULL
	)
	{
		$this->type( $type );
		$this->name( $name );
		$this->hint( $hint );
		$this->gsAutoValue( $auto_value );
		if ( !is_array( $restrictions ) )
			$restrictions  =  array( $restrictions );
		foreach ( $restrictions as $restriction )
			$this->restriction( $restriction );
	}
	public function autoValue ()
	{
		return $this->gsAutovalue();
	}
	private function gsAutoValue ( $auto_value = self::AV_DEFAULT )
	{
		//if ( 0 === func_num_args() )
		if ( self::AV_DEFAULT === $auto_value )
			return $this->auto_value;

		$this->auto_value  =  $auto_value;
	}
	public function required ()
	{
		if (
			self::AV_DEFAULT === $this->gsAutoValue()
			|| DataField::OPTIONAL & $this->type()
		)
			return FALSE;
		return TRUE;
	}
	public function check ( $value )
	{
		foreach ( $this->restrictions as $restriction )
		{
			$check  =  call_user_func_array(
				array(
					$this ,
					'check_restriction'
				) ,
				array(
					$restriction ,
					$value ,
				)
			);
			if ( FALSE === $check )
				$this->errors[]  =  $restriction[ 'message' ];
		}

		if ( empty( $this->errors ) )
			return TRUE;

		return FALSE;
	}

	public function hint ( $hint = NULL )
	{
		if ( NULL === $hint )
			return $this->hint;

		$this->hint  =  $hint;
		return;
		return $this;
	}
	public function errors ()
	{
		return $this->errors;
	}
	public function type ( $type = NULL )
	{
		if ( NULL === $type )
			return $this->type;

		$this->type  =  $type;
		return;
		return $this;
	}
	protected function restriction ( $restriction )
	{
		if ( is_numeric( $restriction ) )
			$restriction  =  array(
				'function' => 'strlen' ,
				'check' => array( 'lte' => $restriction ) ,
				'message' => 'to many chars' ,
			);

		$this->restrictions[]  =  $restriction;
	}
	private function check_restriction ( $restriction , $value )
	{
		$check  =  TRUE;
		if ( isset( $restriction[ 'function' ] ) )
			$check  =  call_user_func( $restriction[ 'function' ] , $value );

		if ( isset( $restriction[ 'check' ] ) )
		{
			$key  =  key( $restriction[ 'check' ] );
			switch ( $key )
			{
				case 'lte' :
						$check  =
							$check <= $restriction[ 'check' ][ 'lte' ]
							? TRUE
							: FALSE
						;
					break;
			}
		}

		return $check;
	}
}


