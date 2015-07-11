<?php

use Sami\Parser\Filter\TrueFilter;
use Sami\Sami;
use Sami\RemoteRepository\GitHubRemoteRepository;
use Sami\Version\GitVersionCollection;
use Symfony\Component\Finder\Finder;

ini_set('xdebug.scream', 0);

$dir = __DIR__ . '/../qa-tools/library';
$versions = GitVersionCollection::create($dir)
    ->add('master', 'master branch')
    ->add('develop', 'develop branch')
;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->in($dir)
;

$sami = new Sami($iterator, array(
    'title'                => 'QA-Tools API',
    'build_dir'            => __DIR__.'/%version%',
    'cache_dir'            => __DIR__.'/cache/%version%',
    'remote_repository'    => new GitHubRemoteRepository('qa-tools/qa-tools', dirname($dir)),
    'default_opened_level' => 3,
    'versions' => $versions,
));

// document all methods and properties
$sami['filter'] = function () {
    return new TrueFilter();
};

return $sami;
