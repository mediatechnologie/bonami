<?php
/**
**  @file DataObject.class.php
**  @author immeëmosol (programmer dot willfris at nl) 
**  @date 2011-01-21
**  Created: ven 2011-01-21, 10:19.59 CET
**  Last modified: ven 2011-01-21, 10:21.09 CET
**/

abstract class DataObject
{
	protected $datafields  =  array();
	public function dataFields ()
	{
		return $this->datafields;
	}
}


