<?php
/**
 * @author Rocket Internet SE
 * @copyright Copyright (c) 2017 Rocket Internet SE, Charlottenstraße 4, 10969 Berlin, http://www.rocket-internet.de
 * @created 08.03.17, 18:07
 */
namespace Phalcon\Bridge\Symfony\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormExtensionInterface;
use Symfony\Component\Form\Forms;

/**
 * Class FormBuilder
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
     * @return \Symfony\Component\Form\FormInterface
     */
    public function create($className, $data = null)
    {
        return $this->getFormFactory()->create($className, $data);
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
}
