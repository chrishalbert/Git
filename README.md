# Git
[![Coverage Status](https://coveralls.io/repos/github/chrishalbert/Git/badge.svg?branch=master)](https://coveralls.io/github/chrishalbert/Git?branch=master)
[![Build Status](https://travis-ci.org/chrishalbert/Git.svg?branch=master)](https://travis-ci.org/chrishalbert/Git)


## Overview
This is a simple git wrapper created for use in other php libraries.

It uses magic methods to execute commands, however it is extendable.

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
