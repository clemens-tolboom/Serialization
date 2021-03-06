<?php

namespace DataValues\Serializers;

use DataValues\DataValue;
use Serializers\DispatchableSerializer;
use Serializers\Exceptions\UnsupportedObjectException;

/**
 * @since 0.1
 *
 * @license GPL-2.0+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class DataValueSerializer implements DispatchableSerializer {

	/**
	 * @see Serializer::serialize
	 *
	 * @param DataValue $object
	 *
	 * @throws UnsupportedObjectException
	 * @return array|int|string|bool|float
	 */
	public function serialize( $object ) {
		if ( $this->isSerializerFor( $object ) ) {
			return $this->getSerializedDataValue( $object );
		}

		throw new UnsupportedObjectException(
			$object,
			'DataValueSerializer can only serialize DataValue objects'
		);
	}

	protected function getSerializedDataValue( DataValue $dataValue ) {
		return $dataValue->toArray();
	}

	/**
	 * @see DispatchableSerializer::isSerializerFor
	 */
	public function isSerializerFor( $object ) {
		return is_object( $object ) && $object instanceof DataValue;
	}

}
