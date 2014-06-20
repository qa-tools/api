<?php

use Sami\Sami;
use Sami\Version\GitVersionCollection;
use Symfony\Component\Finder\Finder;

ini_set('xdebug.scream', 0);

$dir = __DIR__ . '/../qa-tools/library';
$versions = GitVersionCollection::create($dir)
    ->add('master', 'master branch')
;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->in($dir)
;

return new Sami($iterator, array(
	'theme'                => 'enhanced',
	'title'                => 'QA-Tools',
	'build_dir'            => __DIR__.'/api/%version%',
	'default_opened_level' => 3,
	'versions' => $versions,
));
