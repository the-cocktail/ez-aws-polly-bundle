<?php

namespace TheCocktail\EzAwsPollyBundle\Converter;

use eZ\Publish\API\Repository\ContentService;
use TheCocktail\Aws\Polly\Speech;

class Content
{
    protected $contentService;

    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }

    public function transformToSpeech($contentId, $versionNo)
    {
        $versionToTransform = $this->contentService->loadVersionInfoById($contentId, $versionNo);

        $content = $this->contentService->loadContentByContentInfo($versionToTransform->getContentInfo());

        $output = '';

        foreach ($content->getFields() as $field)
        {
            if ($field->fieldDefIdentifier == 'name') {
                $output .= $content->getFieldValue($field->fieldDefIdentifier)->text;
            }
        }

        return new Speech([
            'text' => $output
        ]);
    }
}
