# Responders
- CircleCI Status : Last version : [![CircleCI](https://circleci.com/gh/AurelienMo/RespondersBundle/tree/master.svg?style=svg)](https://circleci.com/gh/AurelienMo/RespondersBundle/tree/master)

## Description
A library to use many responders according ADR architecture.

## Installation
- Require library
```
composer require amorvan/responders
```
- For Symfony 3.* without Flex:

Adding bundle to `app/AppKernel.php`
```
//app/AppKernel.php
$bundles = [
        ...,
        new Morvan\Bundle\RespondersBundle\MorvanRespondersBundle(),
        new AppBundle\AppBundle(),
    ];
```
- For Symfony 3.4 with Flex or Symfony 4.*:

Bundle is automatically add to `config/bundles.php`. Check the bundle is allow for all environment.
```
//config/bundles.php
<?php

return [
    ...,
    Morvan\Bundle\RespondersBundle\MorvanRespondersBundle::class => ['all' => true],
];
```

## Usage
- All responders are autowiring.
- To use one of these responders, inject responder and use the responder's with __invoke` method and pass the correct parameters.

### ViewResponder
#### Description
This responder used to return a response with a view build with twig.
#### Usage
- Example inside Symfony, consider following method for an action :
```
public function listArticles(ViewResponder $viewResponder)
{
    return $viewResponder(
        'list.html.twig',
        [
            "articles" => $articles,
        ]
    )
}
```

## Quality
Many tools used for quality.
- PHPCS : PSR 1 & 2.
- PHPStan
- All builds passed by CircleCI.
