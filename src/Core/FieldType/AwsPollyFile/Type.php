<?php

namespace TheCocktail\EzAwsPollyBundle\Core\FieldType\AwsPollyFile;

use eZ\Publish\Core\FieldType\BinaryFile\Type as BinaryFileType;

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
}
