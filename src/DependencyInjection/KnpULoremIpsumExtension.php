<?php
namespace KnpU\LoremIpsumBundle\DependencyInjection;

use KnpU\LoremIpsumBundle\WordProviderInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Created by Michał Nowacki
 * Date: 23/11/2019
 * Time: 15:41
 * Filename: LoremIpsumExtension.php
 */
class KnpULoremIpsumExtension extends Extension
{

    /**
     * Loads a specific configuration.
     *
     * @param array $configs
     * @param ContainerBuilder $container
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container)
    {

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');

        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);

        $definition = $container->getDefinition('knpu_lorem_ipsum.knpu_ipsum');
//        if(null!==$config['word_provider']) {
//            $container->setAlias('knpu_lorem_ipsum.word_provider', $config['word_provider']);
//        }
        $definition->setArgument(1, $config['unicorns_are_real']);
        $definition->setArgument(2, $config['min_sunshine']);

        $container->registerForAutoconfiguration(WordProviderInterface::class)
            ->addTag('knpu_ipsum_word_provider')
        ;
    }

    public function getAlias()
    {
        return 'knpu_lorem_ipsum';
    }


}