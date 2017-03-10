<?php

/*
 * This file is part of the SymfonyFormStandalone package.
 *
 * (c) Alexander Egurtsov <https://github.com/lostedboy/symfony-form-standalone/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Form\Standalone\Templating\Helper;

use Symfony\Component\Templating\Helper\Helper;
use Symfony\Form\Standalone\Translation\TranslatorInterface;

/**
 * Class FormTemplating
 *
 * @author Alexander Egurtsov <egurtsov@gmail.com>
 */
class TranslatorHelper extends Helper
{
    /**
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * Constructor.
     *
     * @param TranslatorInterface $translator A TranslatorInterface instance
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @see TranslatorInterface::trans()
     */
    public function trans($id, array $parameters = array(), $domain = 'messages', $locale = null)
    {
        return $this->translator->trans($id, $parameters, $domain, $locale);
    }

    /**
     * @see TranslatorInterface::transChoice()
     */
    public function transChoice($id, $number, array $parameters = array(), $domain = 'messages', $locale = null)
    {
        return $this->translator->transChoice($id, $number, $parameters, $domain, $locale);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'translator';
    }
}
