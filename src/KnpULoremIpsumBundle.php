<?php
/**
 * Created by Michał Nowacki
 * Date: 23/11/2019
 * Time: 15:37
 * Filename: KnpULoremIpsumBundle.php
 */

namespace KnpU\LoremIpsumBundle;
use KnpU\LoremIpsumBundle\DependencyInjection\Compiler\WordProviderCompilerPass;
use KnpU\LoremIpsumBundle\DependencyInjection\KnpULoremIpsumExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class KnpULoremIpsumBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new WordProviderCompilerPass());
    }

    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new KnpULoremIpsumExtension();
        }

        return $this->extension;
    }

}