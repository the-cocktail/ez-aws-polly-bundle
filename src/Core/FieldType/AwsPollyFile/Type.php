<?php

namespace TheCocktail\EzAwsPollyBundle\Core\FieldType\AwsPollyFile;

use eZ\Publish\Core\FieldType\BinaryFile\Type as BinaryFileType;
use eZ\Publish\SPI\FieldType\Value as SPIValue;

class Type extends BinaryFileType
{
    public function getFieldTypeIdentifier()
    {
        return 'ezawspollyfile';
    }

    public function createValue(array $inputValue)
    {
        return new Value($inputValue);
    }

    public function getEmptyValue()
    {
        return new Value();
    }

    /**
     * Converts a $Value to a hash.
     *
     * @param \eZ\Publish\Core\FieldType\BinaryFile\Value $value
     *
     * @return mixed
     */
    public function toHash(SPIValue $value)
    {
        if ($this->isEmptyValue($value)) {
            return null;
        }

        $hash = parent::toHash($value);

        $hash['downloadCount'] = $value->downloadCount;

        return $hash;
    }
}
