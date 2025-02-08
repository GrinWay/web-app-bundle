<?php

namespace GrinWay\WebApp\Tests\Functional;

use GrinWay\Service\Test\Trait\HasBufferTest;
use PHPUnit\Framework\Attributes\CoversNothing;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpKernel\Profiler\Profile;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\RouterInterface;
use Zenstruck\Browser\Test\HasBrowser;

/**
 * Test case intended to get extended in client's test class
 *
 * To know what tests are available out-of-the-box see all "API" sections of all methods right below
 *
 * @author Grigory Koblitskiy <grin180898@outlook.com>
 */
#[CoversNothing]
abstract class AbstractWebAppTestCase extends WebTestCase
{
    use HasBrowser, HasBufferTest;

    protected static RouteCollection $routeCollection;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        self::setUpBeforeClassProperties();
    }

    protected function setUp(): void
    {
        parent::setUp();
        self::bootKernel();
        $this->setUpProperties();
    }

    /**
     * API
     *
     * Visits all explicitly set with 'GET' method routes without parameters available in your app
     *
     * When visit MUST:
     *     return 2xx status code
     *     not dump into the php output
     */
    public function testExplicitlyDescribedGetMethodRoutesWithoutParametersRequestedSuccessfullyAndNoOutput()
    {
        \ob_start();
        foreach (self::$routeCollection as $router) {
            /** @var Route $router */
            $path = $router->getPath();

            $routeDoesNotContainParameters = false === \str_contains($path, '{') && false === \str_contains($path, '}');
            if ($routeDoesNotContainParameters) {
                $methods = $router->getMethods();

                $anyMethod = [] === $methods;
                if ($anyMethod) {
                    continue;
                }

                \array_walk($methods, static fn($path) => \strtoupper($path));
                if (!\in_array('GET', $methods)) {
                    continue;
                }

                $uri = $router->getPath();

                $profile = $this->browser()
                    ->withProfiling() // $this->withProfiling() is called!
                    ->visit($uri)
                    ->assertSuccessful()
                    ->profile()// Don't know why but: RuntimeException: Profiler not enabled for this request. Try calling ->withProfiling() before the request.
                ;

                $message = \sprintf(
                    '%sBy the uri: "%s" there was at least one php output',
                    \PHP_EOL,
                    $path,
                );
                self::assertOutputBufferWasNotUsed($message);
                if ($profile instanceof Profile && $profile->hasCollector($key = 'dump')) {
                    $dumpsCount = $profile
                        ->getCollector($key)
                        ->getDumpsCount()//
                    ;
                    $message = \sprintf(
                        'Dumps were supposed not to be used%sBy the uri: "%s" there was at least one dump',
                        \PHP_EOL,
                        $path,
                    );
                    $this->assertSame(
                        0,
                        $dumpsCount,
                        message: $message,
                    );
                }
            }
        }
        \ob_end_clean();
    }

    /**
     * @internal
     */
    protected static function setUpBeforeClassProperties()
    {
        self::$routeCollection = self::getContainer()->get('router')->getRouteCollection();
    }

    /**
     * @internal
     */
    protected function setUpProperties()
    {
    }
}
