<?php

/*
 * This file is part of the SymfonyFormStandalone package.
 *
 * (c) Alexander Egurtsov <https://github.com/lostedboy/symfony-form-standalone/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Form\Standalone\Translation;

/**
 * Class DefaultTranslator
 *
 * @author Alexander Egurtsov <egurtsov@gmail.com>
 */
class DefaultTranslator implements TranslatorInterface
{
    protected $locale;

    /**
     * @inheritdoc
     */
    public function trans($id, array $parameters = array(), $domain = null, $locale = null)
    {
        return $id;
    }

    /**
     * @inheritdoc
     */
    public function transChoice($id, $number, array $parameters = array(), $domain = null, $locale = null)
    {
        return $id;
    }

    /**
     * @inheritdoc
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * @inheritdoc
     */
    public function getLocale()
    {
        return $this->locale;
    }
}
