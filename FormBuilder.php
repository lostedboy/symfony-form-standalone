<?php

/*
 * This file is part of the SymfonyFormStandalone package.
 *
 * (c) Alexander Egurtsov <https://github.com/lostedboy/symfony-form-standalone/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Form\Standalone;

use Symfony\Component\Form\FormExtensionInterface;
use Symfony\Component\Form\FormTypeExtensionInterface;
use Symfony\Component\Form\Forms;

/**
 * Class FormTemplating
 *
 * @author Alexander Egurtsov <egurtsov@gmail.com>
 */
class FormBuilder
{
    /**
     * @var \Symfony\Component\Form\FormFactoryBuilderInterface
     */
    protected $formFactoryBuilder;

    /**
     * @param $className
     * @param null $data
     * @param array $options
     * @return \Symfony\Component\Form\FormInterface
     */
    public function create($className, $data = null, $options = [])
    {
        return $this->getFormFactory()->create($className, $data, $options);
    }

    /**
     * @return \Symfony\Component\Form\FormFactoryInterface
     */
    public function getFormFactory()
    {
        return $this->getFormFactoryBuilder()->getFormFactory();
    }

    /**
     * @return \Symfony\Component\Form\FormFactoryBuilderInterface
     */
    public function getFormFactoryBuilder()
    {
        if (!$this->formFactoryBuilder) {
            $this->formFactoryBuilder = Forms::createFormFactoryBuilder();
        }

        return $this->formFactoryBuilder;
    }

    /**
     * @param FormExtensionInterface $extension
     * @return $this
     */
    public function addExtension(FormExtensionInterface $extension)
    {
        $this->getFormFactoryBuilder()->addExtension($extension);

        return $this;
    }
    
    /**
     * @param FormTypeExtensionInterface $typeExtension
     * @return $this
     */
    public function addTypeExtension(FormTypeExtensionInterface $typeExtension)
    {
        $this->getFormFactoryBuilder()->addTypeExtension($typeExtension);
        return $this;
    }
}
