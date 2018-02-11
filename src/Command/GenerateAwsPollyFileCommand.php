<?php

namespace TheCocktail\EzAwsPollyBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateAwsPollyFileCommand extends ContainerAwareCommand
{
    public function configure()
    {
        $this->setName('the-cocktail:aws-polly:generate-file')
            ->addArgument('contentId', InputArgument::REQUIRED)
            ->addArgument('destinationPath', InputArgument::REQUIRED);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $contentId = $input->getArgument('contentId');
        $destinationPath = $input->getArgument('destinationPath');

        $speechCreator = $this->getContainer()->get('ez_aws_polly.core.speech_creator');

        $speechCreator->createPollyFileForContent($contentId, $destinationPath);
    }
}
