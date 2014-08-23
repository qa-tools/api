<?php

use Sami\Parser\Filter\TrueFilter;
use Sami\Sami;
use Sami\Version\GitVersionCollection;
use Symfony\Component\Finder\Finder;

ini_set('xdebug.scream', 0);

$dir = __DIR__ . '/../qa-tools/library';
$versions = GitVersionCollection::create($dir)
    ->addFromTags('v1.0.*')
    ->add('master', 'master branch')
;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->in($dir)
;

$sami = new Sami($iterator, array(
	'theme'                => 'enhanced',
	'title'                => 'QA-Tools API',
	'build_dir'            => __DIR__.'/%version%',
	'cache_dir'            => __DIR__.'/cache/%version%',
	'default_opened_level' => 3,
	'versions' => $versions,
));

// document all methods and properties
$sami['filter'] = function () {
    return new TrueFilter();
};

return $sami;
