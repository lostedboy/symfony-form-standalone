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

use Symfony\Component\Templating\TemplateNameParserInterface;
use Symfony\Component\Templating\TemplateReference;
use Symfony\Component\Templating\TemplateReferenceInterface;

/**
 * Class TemplateNameParser
 *
 * @author Alexander Egurtsov <egurtsov@gmail.com>
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
