<?php
/**
 * @author Rocket Internet SE
 * @copyright Copyright (c) 2017 Rocket Internet SE, Charlottenstraße 4, 10969 Berlin, http://www.rocket-internet.de
 * @created 09.03.17, 14:53
 */
namespace Phalcon\Bridge\Symfony\Form\Translation;

/**
 * TranslatorInterface.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
interface TranslatorInterface
{
    /**
     * Translates the given message.
     *
     * @param string      $id         The message id (may also be an object that can be cast to string)
     * @param array       $parameters An array of parameters for the message
     * @param string|null $domain     The domain for the message or null to use the default
     * @param string|null $locale     The locale or null to use the default
     *
     * @return string The translated string
     *
     */
    public function trans($id, array $parameters = array(), $domain = null, $locale = null);

    /**
     * Translates the given choice message by choosing a translation according to a number.
     *
     * @param string      $id         The message id (may also be an object that can be cast to string)
     * @param int         $number     The number to use to find the indice of the message
     * @param array       $parameters An array of parameters for the message
     * @param string|null $domain     The domain for the message or null to use the default
     * @param string|null $locale     The locale or null to use the default
     *
     * @return string The translated string
     *
     */
    public function transChoice($id, $number, array $parameters = array(), $domain = null, $locale = null);

    /**
     * Sets the current locale.
     *
     * @param string $locale The locale
     *
     */
    public function setLocale($locale);

    /**
     * Returns the current locale.
     *
     * @return string The locale
     */
    public function getLocale();
}
