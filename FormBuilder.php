<?php
/**
 * @author Rocket Internet SE
 * @copyright Copyright (c) 2017 Rocket Internet SE, Charlottenstraße 4, 10969 Berlin, http://www.rocket-internet.de
 * @created 08.03.17, 18:07
 */
namespace Phalcon\Bridge\Symfony\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Forms;

/**
 * Class FormBuilder
 */
class FormBuilder
{
    /**
     * @param $className
     * @param null $data
     * @return AbstractType
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
        return Forms::createFormFactoryBuilder();
    }
}
