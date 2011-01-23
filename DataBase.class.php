<?php
/**
**  @file DataBase.class.php
**  @author immeëmosol (programmer dot willfris at nl) 
**  @date 2011-01-21
**  Created: ven 2011-01-21, 18:49.39 CET
**  Last modified: ven 2011-01-21, 18:50.32 CET
**/

abstract class DataBase
{
	/**
	 *  the name given to the data, it's identifier.
	**/
	protected $name;

	public function name ( $name = NULL )
	{
		if ( NULL !== $name )
		{
			$this->name  =  $name;
			return;
			return $this;
		}
		return $this->name;
	}
}


