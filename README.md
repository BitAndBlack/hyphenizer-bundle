[![PHP from Packagist](https://img.shields.io/packagist/php-v/bitandblack/hyphenizer-bundle)](http://www.php.net)
[![Latest Stable Version](https://poser.pugx.org/bitandblack/hyphenizer-bundle/v/stable)](https://packagist.org/packages/bitandblack/hyphenizer-bundle)
[![Total Downloads](https://poser.pugx.org/bitandblack/hyphenizer-bundle/downloads)](https://packagist.org/packages/bitandblack/hyphenizer-bundle)
[![License](https://poser.pugx.org/bitandblack/hyphenizer-bundle/license)](https://packagist.org/packages/bitandblack/hyphenizer-bundle)

<p align="center">
    <a href="https://www.bitandblack.com" target="_blank">
        <img src="https://www.bitandblack.com/build/images/BitAndBlack-Logo-Full.png" alt="Bit&Black Logo" width="400">
    </a>
</p>

# Bit&Black Hyphenizer Bundle

Perfect hyphenation for your Website. This library integrates the [Hyphenizer](https://www.hyphenizer.com) into your [Symfony](https://symfony.com) project.

If you don't run your website with Symfony, you can integrate the [Hyphenizer SDK for PHP](https://packagist.org/packages/bitandblack/hyphenizer-sdk-php) by your own.

__Please note:__ The Hyphenizer API requires you to have a valid API token.

## Installation

This library is made for the use with [Composer](https://packagist.org/packages/bitandblack/hyphenizer-bundle). Add it to your project by running `$ composer require bitandblack/hyphenizer-bundle`.

## Usage

### Basic setup and usage of the Bit&Black Hyphenizer Bundle

The **Bit&Black Hyphenizer** bundle offers a smooth way to extract and hyphenate long words automatically. It implements the [Hyphenizer SDK for PHP](https://packagist.org/packages/bitandblack/hyphenizer-sdk-php) and allows to update the extracted words.

To use this library in your project, wrap your texts with the [`AutoHyphenation`](./src/AutoHyphenation.php) class. This will add soft hyphens to all words, that are long enough to be hyphenated:

```php
<?php

use Kiwa\Hyphenizer\AutoHyphenation;

echo new AutoHyphenation('Wir suchen nach Bodenseefelchen.');
```

It's also possible to hyphenate using a [Twig](https://twig.symfony.com) filter:

```html
<p>{{ 'Wir suchen nach Bodenseefelchen.'|hyphenate }}</p>
```

Inside, the class extracts all words having more than `12` characters, and searches for a previously defined hyphenation.
You can change this value when initialising the class.

The hyphenations themselves are stored inside a JSON file using a pipe, for example

```json
{
    "Bodenseefelchen": "Bodensee|felchen"
}
```

whereas the pipe is getting replaced afterwards by the defined hyphenation character. This is a soft hyphen per default.
You can change the hyphenation character when initialising the class.

The JSON file is getting stored under `/hyphenation/words-hyphenated.json`.

The list of extracted words will grow over time. You can add hyphenations by yourself, by modifying the JSON file, but it's also possibly to do this via script:

```php
<?php

use BitAndBlack\HyphenizerBundle\HyphenationLibraryFactory;

HyphenationLibraryFactory::create()->setHyphenationWords([
    'Bodenseefelchen' => 'Bodensee|felchen',
]);
```

This is the manual approach. The approach that you’ll really enjoy is:

### Using the Hyphenation API for automatic hyphenation

This library provides a command, to contact the Hyphenation API and ask for validated hyphenations:

```shell
$ bin/console hyphenation:list:hyphenate 
```

The response will contain more information about every hyphenated word, for example a score and if the hyphenation has been approved.
The response will also be stored in the `words-hyphenated.json` file.

### Extracting words manually

If you don't want to wait, until your hyphenation list contains all words from your project, you can manually scan your files and extract the words from there:

```shell
$ vendor/bin/kiwa-hyphenizer hyphenation:list:create 
```

### Using the hyphenations with JavaScript

If you want to use the hyphenations in JavaScript, you can use the [Hyphenation library written in JavaScript](https://www.npmjs.com/package/kiwa-hyphenizer) to do that. In this case, you need to import your `words-hyphenated.json` before initialising the class:

```javascript
import Hyphenation from "kiwa-hyphenizer";
import hyphenatedWords from "hyphenation/words-hyphenated.json";

const hyphenation = new Hyphenation(hyphenatedWords.words);
```

## Help

If you have any questions, feel free to contact us under `hello@bitandblack.com`.

Further information about Bit&Black can be found under [www.bitandblack.com](https://www.bitandblack.com).
