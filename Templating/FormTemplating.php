<?php
/**
 * @author Rocket Internet SE
 * @copyright Copyright (c) 2017 Rocket Internet SE, Charlottenstraße 4, 10969 Berlin, http://www.rocket-internet.de
 * @created 08.03.17, 17:31
 */

namespace Phalcon\Bridge\Symfony\Form\Templating;

use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\Loader\FilesystemLoader;
use Phalcon\Bridge\Symfony\Form\Templating\Helper\FormHelper;
use Phalcon\Bridge\Symfony\Form\Templating\Helper\TranslatorHelper;
use Symfony\Component\Translation\Loader\XliffFileLoader;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Form\Extension\Templating\TemplatingRendererEngine;
use Symfony\Component\Form\FormRenderer;

/**
 * Class FromTemplating
 * @package Phalcon\Bridge\Symfony\Form\Templating
 */
class FormTemplating
{
    /**
     * @var array
     */
    protected $themePaths = [
        __DIR__ . '/../Resources/views/Form'
    ];

    protected $loadPaths = [
        __DIR__ . '/../Resources/views/Form'
    ];

    /**
     * @var TranslatorHelper
     */
    protected $translationHelper;

    /**
     * @var PhpEngine
     */
    protected $templating;

    /**
     * FormTemplating constructor.
     * @param array $loadPaths
     * @param array $themePaths
     * @param string $defaultLanguage
     */
    public function __construct(array $loadPaths = [], array $themePaths = [], $defaultLanguage = 'en')
    {
        $this->themePaths = array_merge($this->themePaths, $themePaths);
        $this->loadPaths = array_merge($this->loadPaths, $loadPaths);

        $this->createTranslatorHelper($defaultLanguage);
        $this->createTemplating();
    }

    protected function createTemplating()
    {
        $templating = new PhpEngine(new TemplateNameParser(), $this->getLoader());

        $templating->setHelpers([
            $this->getFormHelper($templating),
            $this->getTranslationHelper()
        ]);

        $this->templating = $templating;
    }

    /**
     * @param string $defaultLanguage
     * @return TranslatorHelper
     */
    protected function createTranslatorHelper($defaultLanguage = 'en')
    {
        $translator = new Translator($defaultLanguage);
        $translator->setFallbackLocales(array($defaultLanguage));
        $translator->addLoader('xlf', new XliffFileLoader());

        $this->translationHelper = new TranslatorHelper($translator);
    }

    /**
     * @param PhpEngine $templating
     * @return FormHelper
     */
    protected function getFormHelper(PhpEngine $templating)
    {
        return new FormHelper(new FormRenderer($this->getRendererEngine($templating)));
    }

    /**
     * @return FilesystemLoader
     */
    protected function getLoader()
    {
        return new FilesystemLoader(array_map(function ($path) {
            return $path . '/%name%';
        }, $this->loadPaths));
    }

    /**
     * @param PhpEngine $templating
     * @return TemplatingRendererEngine
     */
    protected function getRendererEngine(PhpEngine $templating)
    {
        return new TemplatingRendererEngine($templating, $this->themePaths);
    }

    /**
     * @return TranslatorHelper
     */
    protected function getTranslationHelper()
    {
        return $this->translationHelper;
    }

    /**
     * @return PhpEngine
     */
    public function getTemplating()
    {
        return $this->templating;
    }
}
