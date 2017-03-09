<?php
/**
 * @author Rocket Internet SE
 * @copyright Copyright (c) 2017 Rocket Internet SE, Charlottenstraße 4, 10969 Berlin, http://www.rocket-internet.de
 * @created 09.03.17, 14:58
 */

namespace Phalcon\Bridge\Symfony\Form\Translation;

/**
 * Class DefaultTranslator
 * @package Phalcon\Bridge\Symfony\Form\Translation
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
