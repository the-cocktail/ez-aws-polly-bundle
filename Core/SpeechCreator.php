<?php

namespace TheCocktail\EzAwsPollyBundle\Core;

use eZ\Publish\API\Repository\ContentService;
use eZ\Publish\Core\Repository\Values\Content\ContentUpdateStruct;
use TheCocktail\EzAwsPollyBundle\Core\FieldType\AwsPollyBinaryFile\Value;
use TheCocktail\EzAwsPollyBundle\Transformer\SSMLTransformer;

class SpeechCreator
{
    protected $contentService;

    protected $ssmlTransformer;

    public function __construct(ContentService $contentService, SSMLTransformer $ssmlTransformer)
    {
        $this->contentService = $contentService;
        $this->ssmlTransformer = $ssmlTransformer;
    }

    public function createPollyFileForVersion($contentId, $versionNo)
    {
        $version = $this->contentService->loadVersionInfoById($contentId, $versionNo);

        $contentUpdateStruct = new ContentUpdateStruct();
        $contentUpdateStruct->setField('polly', new Value());

        $content = $this->contentService->publishVersion($version);
    }
}
