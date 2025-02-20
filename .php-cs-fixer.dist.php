<?php

$config = new PhpCsFixer\Config();

$config->setRules(['nullable_type_declaration_for_default_null_value' => true,]);

return $config->setFinder(PhpCsFixer\Finder::create()->in(__DIR__.'/src'));

