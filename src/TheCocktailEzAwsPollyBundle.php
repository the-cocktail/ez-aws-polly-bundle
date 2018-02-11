<?php 

namespace TheCocktail\EzAwsPollyBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use TheCocktail\EzAwsPollyBundle\DependencyInjection\Compiler\BinaryContentDownloadPass;

class TheCocktailEzAwsPollyBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new BinaryContentDownloadPass());
    }
}
