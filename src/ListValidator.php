<?php

namespace ValueValidators;

use Exception;

/**
 * ValueValidator that validates a list of values.
 *
 * @since 0.1
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 * @author Thiemo Mättig
 */
class ListValidator extends ValueValidatorObject {

	/**
	 * @see ValueValidatorObject::doValidation
	 *
	 * @since 0.1
	 *
	 * @param mixed $value
	 *
	 * @throws Exception
	 */
	public function doValidation( $value ) {
		if ( !is_array( $value ) ) {
			$this->addErrorMessage( 'Not an array' );
			return;
		}

		$options = array();

		if ( array_key_exists( 'elementcount', $this->options ) ) {
			$options['range'] = $this->options['elementcount'];
		}

		if ( array_key_exists( 'minelements', $this->options ) ) {
			$options['lowerbound'] = $this->options['minelements'];
		}

		if ( array_key_exists( 'maxelements', $this->options ) ) {
			$options['upperbound'] = $this->options['maxelements'];
		}

		$validator = new RangeValidator();
		$validator->setOptions( $options );
		$this->runSubValidator( count( $value ), $validator, 'length' );
	}

	/**
	 * @see ValueValidatorObject::enableWhitelistRestrictions
	 *
	 * @since 0.1
	 *
	 * @return boolean
	 */
	protected function enableWhitelistRestrictions() {
		return false;
	}

}
