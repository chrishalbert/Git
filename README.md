# Git
[![Build Status](https://travis-ci.org/chrishalbert/Git.svg?branch=master)](https://travis-ci.org/chrishalbert/Git)
[![Coverage Status](https://coveralls.io/repos/github/chrishalbert/Git/badge.svg?branch=master)](https://coveralls.io/github/chrishalbert/Git?branch=master)
[![Latest Stable Version](https://poser.pugx.org/chrishalbert/git/version)](https://packagist.org/packages/chrishalbert/git)
[![License](https://poser.pugx.org/chrishalbert/git/license)](https://packagist.org/packages/chrishalbert/git)

## Overview
This is a simple git wrapper created for use in other php libraries.

It uses magic methods to execute commands, however it is extendable.

## Installation

Add this to your composer file:
```
{
    "require": {
        "chrishalbert/git": "1.*"
    }
} 
```

Or simply on the command line:
```
composer require chrishalbert/git
```


## Usage
```php
$git = new Git();
$branches = $git->branch();

// Fix a file for all branches
foreach ($branches as $branch) {
    $git->checkout($branch);
    // Do stuff
    $git->add('.');
    $git->commit(['--message' => 'Fixed a bug']);
}

$git->checkout('master');
```
