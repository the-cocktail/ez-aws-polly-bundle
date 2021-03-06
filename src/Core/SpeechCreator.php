<?php

namespace TheCocktail\EzAwsPollyBundle\Core;

use eZ\Publish\API\Repository\ContentService;
use eZ\Publish\Core\Repository\Values\Content\ContentUpdateStruct;
use TheCocktail\Aws\Polly\Speech;
use TheCocktail\Aws\Polly\TheCocktailPollyClient;
use TheCocktail\EzAwsPollyBundle\Core\FieldType\AwsPollyBinaryFile\Value;
use TheCocktail\EzAwsPollyBundle\Transformer\SSMLTransformer;

class SpeechCreator
{
    protected $contentService;

    protected $contentTextExtractor;

    protected $ssmlTransformer;

    protected $pollyClient;

    public function __construct(
        ContentService $contentService,
        SSMLTransformer $ssmlTransformer,
        TheCocktailPollyClient $pollyClient
    )
    {
        $this->contentService = $contentService;
        $this->ssmlTransformer = $ssmlTransformer;
        $this->pollyClient = $pollyClient;
    }

    public function createPollyFileForContent($contentId, $destinationPath)
    {
        $content = $this->contentService->loadContent($contentId);

        $contentText = $this->ssmlTransformer->extractTextFromContent($content);

        $speech = new Speech(['text' => $contentText, 'textType' => 'ssml']);

        $this->pollyClient->generateSpeechFile($speech, $destinationPath);
    }
}
