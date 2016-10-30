#
Git

## Overview
This is a simple git wrapper created for use in other php libraries.

It uses magic methods to execute commands, however it is extendable.

## Usage
```
> $git = new Git();
> $diff1 = $git->diff('example.php');
> $diff2 = $git->diff(['-L' => '20,20', 'example.php'];
> var_dump($diff1 == $diff2);
bool(true)
```
