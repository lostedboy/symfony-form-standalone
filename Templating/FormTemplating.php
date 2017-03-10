<?php

/*
 * This file is part of the SymfonyFormStandalone package.
 *
 * (c) Alexander Egurtsov <https://github.com/lostedboy/symfony-form-standalone/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Form\Standalone\Templating;

use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\Loader\FilesystemLoader;
use Symfony\Component\Form\Extension\Templating\TemplatingRendererEngine;
use Symfony\Component\Form\FormRenderer;
use Symfony\Form\Standalone\Templating\Helper\FormHelper;
use Symfony\Form\Standalone\Templating\Helper\TranslatorHelper;
use Symfony\Form\Standalone\Translation\DefaultTranslator;
use Symfony\Form\Standalone\Translation\TranslatorInterface;

/**
 * Class FormTemplating
 *
 * @author Alexander Egurtsov <egurtsov@gmail.com>
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

    protected $translator;

    /**
     * FormTemplating constructor.
     * @param array $loadPaths
     * @param array $themePaths
     * @param TranslatorInterface $translator
     */
    public function __construct(
        array $loadPaths = [],
        array $themePaths = [],
        TranslatorInterface $translator = null
    ) {
        $this->themePaths = array_merge($this->themePaths, $themePaths);
        $this->loadPaths = array_merge($this->loadPaths, $loadPaths);

        $this->setTranslator($translator);
        $this->createTranslatorHelper();
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
     * @return TranslatorHelper
     */
    protected function createTranslatorHelper()
    {
        $this->translationHelper = new TranslatorHelper($this->getTranslator());
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

    /**
     * @return mixed
     */
    public function getTranslator()
    {
        if (!$this->translator) {
            return new DefaultTranslator();
        }

        return $this->translator;
    }

    /**
     * @param mixed $translator
     */
    public function setTranslator($translator)
    {
        $this->translator = $translator;
    }
}
