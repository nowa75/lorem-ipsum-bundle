<?php
/**
 * Created by Michał Nowacki
 * Date: 24/11/2019
 * Time: 14:20
 * Filename: IpsumApiControllerTest.php
 */

namespace KnpU\LoremIpsumBundle\Tests\Controller;
use KnpU\LoremIpsumBundle\KnpULoremIpsumBundle;
use KnpU\LoremIpsumBundle\Tests\StubWordProvider;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Routing\RouteCollectionBuilder;

class IpsumApiControllerTest extends TestCase
{
    public function testIndex()
    {
        $kernel = new KnpULoremIpsumControllerKernel();
        $client = new Client($kernel);

        $client->request('GET','/api/');

        $this->assertSame(200,$client->getResponse()->getStatusCode());
    }
}

class KnpULoremIpsumControllerKernel extends Kernel
{
    use MicroKernelTrait;
    /**
     * @var array
     */
    private $knpUIpsumConfig;

    public function __construct()
    {
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
            new FrameworkBundle(),
        ];
    }

    protected function configureRoutes(RouteCollectionBuilder $routes)
    {
        $routes->import(__DIR__ . '/../../src/Resources/config/routes.xml', '/api');
    }

    protected function configureContainer(ContainerBuilder $c, LoaderInterface $loader)
    {
        $c->loadFromExtension('framework',[
            'secret'=>'M00',
        ]);
    }


}