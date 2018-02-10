<?php

namespace TheCocktail\EzAwsPollyBundle\Slot;

use eZ\Publish\Core\SignalSlot\Signal;
use eZ\Publish\Core\SignalSlot\Slot as BaseSlot;
use TheCocktail\Aws\Polly\Speech;
use TheCocktail\Aws\Polly\TheCocktailPollyClient;
use TheCocktail\EzAwsPollyBundle\Transformer\SSMLTransformer;

class CreatePollySpeechSlot extends BaseSlot
{
    protected $pollyClient;

    protected $ssmlTransformer;

    public function __construct(TheCocktailPollyClient $pollyClient, SSMLTransformer $ssmlConverter)
    {
        $this->pollyClient = $pollyClient;
        $this->ssmlConverter = $ssmlConverter;
    }

    public function receive(Signal $signal)
    {
        if (!$signal instanceof Signal\ContentService\UpdateContentSignal)
        {
            return;
        }

        $ssml = $this->ssmlConverter->transformToSSML($signal->contentId, $signal->versionNo);

        $speech = new Speech($ssml);

        $this->pollyClient->generateSpeechFile($speech, 'file_'. $signal->contentId . '_' . $signal->versionNo . '.mp3');
    }
}
