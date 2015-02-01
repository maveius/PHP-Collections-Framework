<?php

function __autoload($class) {
	$stack = explode('\\', $class);
	$class = array_pop($stack);
	$namespace = array_pop($stack);
	$file = strtolower("../{$namespace}/{$class}.php");
    if(file_exists($file)) include($file);
	else throw new \Mysidia\Resource\Exception\ClassNotFoundException("Cannot load class {$class}");		
}
    
?>
