# Symfony Form Standalone

This library allows to use [symfony forms](http://symfony.com/doc/current/forms.html) standalone without symfony framework and without pulling its dependencies.

Current dependencies list:
- symfony/form
- symfony/templating
 
Installation
-----------
```bash
composer require lostedboy/symfony-form-standalone
```
Basic Usage
-----------
Create form:
```php
<?php
// index.php
use Symfony\Form\Standalone\FormBuilder;
use Symfony\Form\Standalone\Templating\FormTemplating;

// create form builder
$formBuilder = new FormBuilder();

// create form
$form = $formBuilder->create($formType, $mappedEntity);

...

// create templating handler
$formTemplating = new FormTemplating();

// get templating engine
$templating = $formTemplating->getTemplating();

// create form view
$formView = $form->createView();

// render form partial
echo $templating->render('form.html.php', array('form' => $formView));
```
Render form (see: [Symfony Form Rendering](http://symfony.com/doc/current/form/form_customization.html))
```php
// form.html.php 
<?php echo $view['form']->form($form) ?>
```
Render customization
------
```php
<?php
// index.php
use Symfony\Form\Standalone\Templating\FormTemplating;

$formTemplating = new FormTemplating(
    // register directories with forms usages here
    [
        __DIR__.'/directory/with/form/usages'
    ],
    // put form theme templates in some directory
    // register this directory in FormTemplating
    [
        __DIR__.'/directory/with/form/themes'
    ]
);
```
Follow [Symfony Guide](http://symfony.com/doc/current/form/form_customization.html)

Translation
===========
Any custom translator can be used. 
It should implement `Symfony\Form\Standalone\Translation\TranslatorInterface`
```php
<?php
// index.php
use Symfony\Form\Standalone\Templating\FormTemplating;

$formTemplating = new FormTemplating([], [], new CustomFormTranslator());
```

Validation
==========
[Symfony Validator Component](https://symfony.com/doc/current/components/validator.html) can be used

Install `composer require symfony/validator`
Register validator extension:
```php
<?php
// index.php
use Symfony\Form\Standalone\FormBuilder;
use Symfony\Component\Validator\Validation;

// create form builder
$formBuilder = new FormBuilder();

// configure validator
$validator = Validation::createValidatorBuilder()
    ->addYamlMappings([
        // paths to validation files (optional) 
        __DIR__ . '/config/validation/some_entity.yml'
    ])
    ->getValidator();

// register extension
$formBuilder->addExtension(new ValidatorExtension($validator);
```

License
=======

This bundle is under MIT license
