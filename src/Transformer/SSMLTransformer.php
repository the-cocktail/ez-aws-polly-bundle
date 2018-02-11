<?php

namespace TheCocktail\EzAwsPollyBundle\Transformer;

use eZ\Publish\API\Repository\ContentService;
use eZ\Publish\API\Repository\Values\Content\Content;
use MaxBeckers\AmazonAlexa\Helper\SsmlGenerator;
use TheCocktail\Aws\Polly\Speech;

class SSMLTransformer
{
    protected $ssmlGenerator;

    public function __construct(SsmlGenerator $ssmlGenerator)
    {
        $this->ssmlGenerator = $ssmlGenerator;
    }

    public function transformToSSML(Content $content)
    {
        foreach ($content->getFields() as $field)
        {
            if ($field->fieldDefIdentifier == 'name') {
                $this->ssmlGenerator->say($content->getFieldValue($field->fieldDefIdentifier)->text);
            }
        }

        return $this->ssmlGenerator->getSsml();
    }
}
