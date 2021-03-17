# Responders
- CircleCI Status : Last version : [![CircleCI](https://circleci.com/gh/AurelienMo/RespondersBundle/tree/master.svg?style=svg)](https://circleci.com/gh/AurelienMo/RespondersBundle/tree/master)

## Description
A library to use many responders according to ADR architecture.

## Installation
- Require library
```
composer require amorvan/responders
```
- For Symfony 3.* without Flex:

Adding bundle to `app/AppKernel.php`
```php
//app/AppKernel.php
$bundles = [
        // ...
        new AppBundle\AppBundle(),
        new Morvan\Bundle\RespondersBundle\MorvanRespondersBundle(),
    ];
```
- For Symfony 3.4 with Flex, Symfony 4.* or Symfony 5:

Bundle is automatically add to `config/bundles.php`. Check the bundle is allow for all environment.
```php
//config/bundles.php
<?php

return [
    // ...
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
```php
use Morvan\Bundle\RespondersBundle\Responders\ViewResponder;

public function listArticles(ViewResponder $viewResponder)
{
    return $viewResponder(
        'list.html.twig',
        [
            'articles' => $articles,
        ]
    );
}
```
### RedirectResponder
#### Description
This responder used to return a redirect response with route parameters
#### Usage
- Example inside Symfony, consider following method for an action :
```php
use Morvan\Bundle\RespondersBundle\Responders\RedirectResponder;

public function addArticle(RedirectResponder $redirectResponder)
{
    return $redirectResponder(
       'show_article',
       [
            'id' => $article->getId(),
       ]
    );
}
```
### JsonResponder
#### Description
This responder used to return a json response according many parameters
#### Usage
- Example inside Symfony, consider following method for an action :
```php
use Morvan\Bundle\RespondersBundle\Responders\JsonResponder;

public function getArticle(JsonResponder $jsonResponder)
{
    return $jsonResponder(
       $data
    );
}
```

## Quality
Many tools used for quality.
- PHPCS : PSR 1 & 12.
- PHPStan
- All builds passed by CircleCI.
