<?php
/**
**  @file DataObject.class.php
**  @author immeëmosol (programmer dot willfris at nl) 
**  @date 2011-01-21
**  Created: ven 2011-01-21, 10:19.59 CET
**  Last modified: ven 2011-01-21, 10:47.43 CET
**/

abstract class DataObject
{
	protected $datafields  =  array();
	public function fields ()
	{
		return $this->datafields;
	}
}


