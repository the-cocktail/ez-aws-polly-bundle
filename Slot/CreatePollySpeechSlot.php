<?php

namespace TheCocktail\EzAwsPollyBundle\Slot;

use eZ\Publish\Core\SignalSlot\Signal;
use eZ\Publish\Core\SignalSlot\Slot as BaseSlot;

class CreatePollySpeechSlot extends BaseSlot
{
    public function receive(Signal $signal)
    {
        if ($signal instanceof Signal\ContentService\PublishVersionSignal)
        {
            die ('a');
        }
    }
}
