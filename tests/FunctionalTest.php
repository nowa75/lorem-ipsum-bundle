<?php
/**
 * Created by Michał Nowacki
 * Date: 24/11/2019
 * Time: 12:22
 * Filename: FunctionalTest.php
 */

namespace KnpU\LoremIpsumBundle\Tests;

use Exception;
use KnpU\LoremIpsumBundle\KnpUIpsum;
use KnpU\LoremIpsumBundle\KnpULoremIpsumBundle;
use KnpU\LoremIpsumBundle\WordProviderInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;
use Symfony\Component\HttpKernel\Kernel;

class FunctionalTest extends TestCase
{
    public function testServiceWiring()
    {
        $kernel = new KnpULoremIpsumTestingKernel();
        $kernel->boot();
        $container = $kernel->getContainer();

        $ipsum = $container->get('knpu_lorem_ipsum.knpu_ipsum');

        $this->assertInstanceOf(KnpUIpsum::class, $ipsum);
        $this->assertIsString($ipsum->getParagraphs());
    }

    public function testServiceWiringWithConfiguration()
    {
        $kernel = new KnpULoremIpsumTestingKernel([
            'word_provider' => 'stub_word_list'
        ]);
        $kernel->boot();
        $container = $kernel->getContainer();

        $ipsum = $container->get('knpu_lorem_ipsum.knpu_ipsum');

        $this->assertStringContainsString('stub',$ipsum->getWords(2));
    }
}

class KnpULoremIpsumTestingKernel extends Kernel
{
    /**
     * @var array
     */
    private $knpUIpsumConfig;

    public function __construct(array $knpUIpsumConfig = [])
    {
        $this->knpUIpsumConfig = $knpUIpsumConfig;
        parent::__construct('test', true);
    }

    /**
     * Returns an array of bundles to register.
     *
     * @return iterable|BundleInterface[] An iterable of bundle instances
     */
    public function registerBundles()
    {
        return [
            new KnpULoremIpsumBundle(),
        ];
    }

    /**
     * Loads the container configuration.
     * @param LoaderInterface $loader
     * @throws Exception
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(function (ContainerBuilder $containerBuilder) {
            $containerBuilder->register('stub_word_list', StubWordProvider::class);

            $containerBuilder->loadFromExtension('knpu_lorem_ipsum', $this->knpUIpsumConfig);
        });
    }
}

class StubWordProvider implements WordProviderInterface
{

    /**
     * Return an array of words to use for the fake text.
     *
     * @return array
     */
    public function getWordList(): array
    {
        return ['stub', 'stub2'];
    }
}