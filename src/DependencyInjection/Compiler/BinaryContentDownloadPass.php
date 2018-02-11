<?php

namespace TheCocktail\EzAwsPollyBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class BinaryContentDownloadPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('ezpublish.fieldType.ezbinarybase.download_url_generator')) {
            return;
        }

        $downloadUrlReference = new Reference('ezpublish.fieldType.ezbinarybase.download_url_generator');

        $this->addCall($container, $downloadUrlReference, 'thecocktail_aws_polly.fieldtype.ezawspollyfile.externalstorage');
    }

    private function addCall(ContainerBuilder $container, Reference $reference, $targetServiceName)
    {
        if (!$container->has($targetServiceName)) {
            return;
        }

        $definition = $container->findDefinition($targetServiceName);
        $definition->addMethodCall('setDownloadUrlGenerator', array($reference));
    }
}
