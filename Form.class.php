<?php
/**
**  @file Form.class.php
**  @author immeëmosol (programmer dot willfris at nl) 
**  @date 2011-01-21
**  Created: ven 2011-01-21, 10:18.49 CET
**  Last modified: ven 2011-01-21, 12:12.44 CET
**/

class Form
{
	private $prefix  =  '_';
	private $fields  =  array();
	private $sub_form;
	public function __construct ( DataObject $data , $sub_form = FALSE )
	{
		//$this->prefix  =  $prefix;
		$fields  =  $data->fields();
		$this->fields( $fields );
		$this->sub_form  =  $sub_form;
	}
	private function fields ( $fields )
	{
		foreach ( $fields as $field )
		{
			if ( DataField::OBJECT === $field->type() )
			{
				$this->fields[]  =  new Form( $field->name() , TRUE );
				continue;
			}
			$this->fields[]  =  $field;
		}
	}
	private function parse_form ()
	{
		$form  =  '';

		if ( FALSE === $this->sub_form )
			$form .=  '<form method="post" action="'.$_SERVER['REQUEST_URI'].'">';
		else
			$form .=  '<fieldset><legend>Sub</legend>';

		$form .=  '<dl>';

		foreach ( $this->fields as $field )
			if ( $field instanceof Form )
				$form .=  $field;
			else
				$form .=  $this->element( $field );

		$form .=  '</dl>';

		if ( FALSE === $this->sub_form )
			$form .=  '<input type="submit" /><input type="reset" /></form>';
		else
			$form .=  '</fieldset>';

		return $form;
	}
	public function __toString ()
	{
		return $this->parse_form();
	}
	/**
	 *  @todo[~immeëmosol, ven 2011-01-21, 10:33.01 CET]
	 *    mogelijkheid inbouwen voor $_GET
	**/
	private function element ( DataField $field )
	{
		$self_closing  =  TRUE;
		$type  =  'text';
		$tag   =  'input';
		switch ( $field->type() )
		{
			case DataField::TEXT :
					$self_closing  =  FALSE;
					$tag  =  'textarea';
				break;
			case DataField::INT :
			case DataField::TINYINT :
					$type  =  'number';
				break;
			case DataField::BOOLEAN :
					$type  =  'checkbox';
				break;
			case DataField::DATETIME :
					$type  =  'datetime';
				break;
		}
		$element  =  '';
		$id  =  $this->prefix() . $field->name();
		$name  =  $id;
		$element .=  '<dt>' .
			'<label for="' . $id . '">' .
			$field->name() .
			'</label>' .
			'</dt>' .
		'';
		$element .=  '<dd>';
		$element .=  '<' .
			$tag .
			' type="' . $type . '"'
		;
		$element .=  ' name="' . $name . '"';
		$element .=  ' id="' . $id . '"';

		if ( !$self_closing )
			$element .=  '>';

		if ( isset( $_POST[ $name ] ) )
		{
			$content  =  $_POST[ $name ];
			if ( $self_closing )
				$element .=  ' value="' . $content . '"';
			else
				$element .=  $content;
		}

		if ( $self_closing )
			$element .=  ' />';
		else
			$element .=  '</' . $tag . '>';

		$element .=  '</dd>';

		return $element;
	}
	private function prefix ()
	{
		return $this->prefix;
	}
}


