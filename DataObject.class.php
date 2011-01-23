<?php
/**
**  @file DataObject.class.php
**  @author immeëmosol (programmer dot willfris at nl) 
**  @date 2011-01-21
**  Created: ven 2011-01-21, 10:19.59 CET
**  Last modified: ven 2011-01-21, 18:52.05 CET
**/

abstract class DataObject extends DataBase
{
	protected $fields  =  array();

	public function fields ( $fields = NULL )
	{
		if ( NULL !== $fields )
		{
			$fields  =  func_get_args();
			foreach ( $fields as $field )
				call_user_func_array(
					array(
						$this ,
						'field'
					) ,
					$field
				);
			return;
			return $this;
		}
		return $this->fields;
	}

	protected function field ()
	{
		$r  =  new ReflectionClass( 'DataField' );
		$args  =  func_get_args();
		$this->fields[]  =  $r->newInstanceArgs( $args );
	}
}


