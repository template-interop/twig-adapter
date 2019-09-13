<?php

namespace Interop\Tests\Template\Twig;

use Interop\Template\Twig\TwigEngine;
use PHPUnit\Framework\TestCase;

final class TwigEngineTest extends TestCase
{
    public function testRender()
    {
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/templates/');
        $twig = new \Twig\Environment($loader);

        $engine = new TwigEngine($twig, '.twig.html');
        $html = $engine->render('hello', ['name' => 'John']);

        $this->assertStringEqualsFile(__DIR__ . '/templates/expected.html', $html);
    }
}
