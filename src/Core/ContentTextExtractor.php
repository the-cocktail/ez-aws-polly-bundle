<?php

namespace TheCocktail\EzAwsPollyBundle\Core;

use eZ\Publish\API\Repository\ContentTypeService;
use eZ\Publish\API\Repository\Values\Content\Content;
use eZ\Publish\Core\MVC\Symfony\Controller\Content\ViewController;
use eZ\Publish\Core\MVC\Symfony\View\ContentView;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class ContentTextExtractor
{
    protected $httpKernel;

    public function __construct(HttpKernelInterface $httpKernel)
    {
        $this->httpKernel = $httpKernel;
    }

    public function extractTextFromContent(Content $content)
    {
        $request =  Request::create('/view/content/' . $content->id . '/ssml');

        $response = $this->httpKernel->handle(
            $request,
            HttpKernelInterface::SUB_REQUEST
        );


        print_r($response->getContent());
        die;
    }
}
