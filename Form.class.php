<?php
/**
**  @file Form.class.php
**  @author immeëmosol (programmer dot willfris at nl) 
**  @date 2011-01-21
**  Created: ven 2011-01-21, 10:18.49 CET
**  Last modified: sab 2011-01-22, 21:27.32 CET
**/

class Form
{
	private $data;
	private $sub  =  FALSE;
	public function __construct ( DataObject $data , $sub = FALSE )
	{
		$this->data  =  $data;
		$this->sub   =  $sub;
	}
	public function __toString ()
	{
		$form  =  '';

		if ( FALSE === $this->sub )
			$form .=  '<form method="post" action="' .
				$_SERVER[ 'REQUEST_URI' ] . '">'
			;

		$form .=  '<fieldset><legend>' . $this->data->name() . '</legend>';

		$form .=  '<dl>';

		$fields  =   $this->data->fields();
		foreach ( $fields as $field )
			if ( DataField::AUTO & $field->type() )
				$form .=  '';
			else
				$form .=  $this->element( $field );

		$form .=  '</dl>';
		$form .=  '</fieldset>';

		if ( FALSE === $this->sub )
			$form .=  '' .
				'<input name="post" type="submit" />' .
				'<input type="reset" />' .
				'</form>'
			;


		return $form;
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

		$field_type  =  $field->type();
		if ( DataField::OBJECT & $field_type )
			return new Form( $field->name() , 'Reservering' );
		elseif ( DataField::TEXT & $field_type )
		{
			$self_closing  =  FALSE;
			$tag  =  'textarea';
		}
		elseif ( ( DataField::INT & $field_type ) || ( DataField::TINYINT & $field_type ) )
			$type  =  'number';
		elseif ( DataField::BOOLEAN & $field_type )
			$type  =  'checkbox';
		elseif ( DataField::DATETIME & $field_type )
			$type  =  'datetime';

		$element  =  '';

		$id  =  $field->name();
		$label  =  $field->name();
		$required  =  $field->required();
		$name  =  $id;
		$element .=  '<dt>' .
			'<label for="' . $id . '">' .
			$label .
			'</label>' .
			'</dt>' .
		'';
		$element .=  '<dd>';
		$element .=  '<' . $tag .
			' type="' . $type . '"' .
			' name="' . $name . '"' .
			' id="' . $id . '"' .
			( isset( $placeholder ) && NULL !== $placeholder
			  ? ' placeholder="' . $placeholder . '"'
			  : ''
			) .
			( $required ? ' required="required"' : '' ) .
		'';


		//@todo[~immeëmosol, sab 2011-01-22, 19:26.30 CET]
		//  check for xss-vulnerabilities
		if ( isset( $_POST[ $name ] ) )
			$content  =  $_POST[ $name ];
		elseif ( NULL !== $field->autoValue() )
			$content  =  $field->autoValue();
		else
			$content  =  NULL;

		if ( !$self_closing )
			$element .=  '>' . $content . '</' . $tag . '>';
		else
		{
			if ( 'checkbox' === $type )
				$element .=  $content?'checked="checked"':'';
			else
				$element .=  ' value="' . $content . '"';

			$element .= ' />';
		}

		if ( isset( $content ) && TRUE !== $field->check( $content ) )
			$element .=  '<ul><li>' .
				//' style="background-color:red;color:yellow;"' .
				implode( '</li><li>' , $field->errors() ) .
				'</li></ul>' .
			'';
		elseif ( isset( $_POST[ 'post' ] ) && $required )
			$element .=  '<ul><li>required</li></ul>';


		$hint  =  $field->hint();
		if ( NULL !== $hint )
			if ( is_array( $hint ) )
				$element .= '<ul class="hint"><li>' .
					implode( '</li><li>' , $hint ) . '</li></ul>'
				;
			else
				$element .=  '<p class="hint">' . $hint . '</p>';

		$element .=  '</dd>';

		return $element;
	}
}


