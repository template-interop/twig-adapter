<?php

namespace Interop\Template\Twig;

use Interop\Template\TemplateEngineInterface;
use Interop\Template\Exception\TemplateNotFound;
use Twig\Environment as Twig;
use Twig\Error\LoaderError;

final class TwigEngine implements TemplateEngineInterface
{
    /** @var Twig */
    private $twig;

    /** @var string */
    private $suffix;

    public function __construct(Twig $twig, string $suffix = '')
    {
        $this->twig   = $twig;
        $this->suffix = $suffix;
    }

    /**
     * @param string $templateName
     * @param array $parameters
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     * @throws TemplateNotFound
     */
    public function render(string $templateName, array $parameters = []): string
    {
        try {
            return $this->twig->render($templateName . $this->suffix, $parameters);
        } catch (LoaderError $e) {
            throw TemplateNotFound::fromName($templateName, 0, $e);
        }
    }
}
