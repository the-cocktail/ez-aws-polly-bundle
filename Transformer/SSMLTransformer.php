<?php

namespace TheCocktail\EzAwsPollyBundle\Transformer;

use eZ\Publish\API\Repository\ContentService;
use MaxBeckers\AmazonAlexa\Helper\SsmlGenerator;
use TheCocktail\Aws\Polly\Speech;

class SSMLTransformer
{
    protected $contentService;

    protected $ssmlGenerator;

    public function __construct(ContentService $contentService, SsmlGenerator $ssmlGenerator)
    {
        $this->contentService = $contentService;
        $this->ssmlGenerator = $ssmlGenerator;
    }

    public function transformToSSML($contentId, $versionNo)
    {
        $versionToTransform = $this->contentService->loadVersionInfoById($contentId, $versionNo);

        $content = $this->contentService->loadContentByContentInfo($versionToTransform->getContentInfo());

        foreach ($content->getFields() as $field)
        {
            if ($field->fieldDefIdentifier == 'name') {
                $this->ssmlGenerator->say($content->getFieldValue($field->fieldDefIdentifier)->text);
            }
        }

        return $this->ssmlGenerator->getSsml();
    }
}
