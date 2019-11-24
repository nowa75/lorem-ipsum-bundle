<?php
/**
 * Created by Michał Nowacki
 * Date: 24/11/2019
 * Time: 19:05
 * Filename: WordProviderCompilerPass.php
 */

namespace KnpU\LoremIpsumBundle\DependencyInjection\Compiler;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class WordProviderCompilerPass implements CompilerPassInterface
{

    /**
     * You can modify the container here before it is dumped to PHP code.
     */
    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition('knpu_lorem_ipsum.knpu_ipsum');
        $references = [];
        foreach ($container->findTaggedServiceIds('knpu_ipsum_word_provider') as $id => $tags) {
            $references[] = new Reference($id);
        }

        $definition->setArgument(0, $references);
    }
}