<?php
use Bitrix\Main\Loader;
use Bitrix\Main\EventManager;

Loader::registerAutoLoadClasses('m.mymd', array(
    // no thanks, bitrix, we better will use psr-4 than your class names convention
    'M\Mymd\HlpClass' => 'lib/HlpClass.php',
));