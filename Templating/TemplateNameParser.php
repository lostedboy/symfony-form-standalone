<?php
/**
 * @author Rocket Internet SE
 * @copyright Copyright (c) 2017 Rocket Internet SE, Charlottenstraße 4, 10969 Berlin, http://www.rocket-internet.de
 * @created 30.01.17, 14:30
 */

namespace Phalcon\Bridge\Symfony\Form\Templating;

use Symfony\Component\Templating\TemplateNameParserInterface;
use Symfony\Component\Templating\TemplateReference;
use Symfony\Component\Templating\TemplateReferenceInterface;

/**
 * Class TemplateNameParser
 * @package Intvoy\Common\Form
 */
class TemplateNameParser implements TemplateNameParserInterface
{
    /**
     * {@inheritdoc}
     *
     * @api
     */
    public function parse($name)
    {
        if ($name instanceof TemplateReferenceInterface) {
            return $name;
        }

        $formattedPath = str_replace(':', ':', $name, $count);

        if ($count >= 2) {
            $pathList = explode(':', $name);
            $formattedPath = '';

            for ($i = 0; $i < sizeof($pathList); $i++) {
                if ($i == 0) {
                    $formattedPath = $pathList[$i] . ':';
                } else {
                    if ($i !== sizeof($pathList) - 1) {
                        $formattedPath .= $pathList[$i] . '/';
                    } else {
                        $formattedPath .= $pathList[$i];
                    }
                }
            }

        } else {
            $formattedPath = str_replace(':', '/', $formattedPath);
        }

        $engine = null;

        if (false !== $pos = strrpos($formattedPath, '.')) {
            $engine = substr($formattedPath, $pos + 1);
        }

        return new TemplateReference($formattedPath, $engine);
    }
}
