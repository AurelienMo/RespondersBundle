# Responders
- CircleCI Status : Last version :

## Description
A library to use many responders according ADR architecture.

## Installation
- Require library
```
composer require amorvan/responders
```

## Usage
To use one of these responders, you only need to use the responder's with __invoke` method and pass the correct parameters.

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
