<?php

namespace TheCocktail\EzAwsPollyBundle\Transformer;

use eZ\Publish\API\Repository\ContentService;
use eZ\Publish\API\Repository\Values\Content\Content;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use TheCocktail\Aws\Polly\Speech;

class SSMLTransformer
{
    protected $httpKernel;

    public function __construct(HttpKernelInterface $httpKernel)
    {
        $this->httpKernel = $httpKernel;
    }

    public function extractTextFromContent(Content $content)
    {
        $request = Request::create('/view/content/' . $content->id . '/ssml');

        $response = $this->httpKernel->handle(
            $request,
            HttpKernelInterface::SUB_REQUEST
        );

        return $response->getContent();
    }
}
