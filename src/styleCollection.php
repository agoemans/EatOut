<?php
namespace Shrubbery;

use Assetic\Asset\AssetCollection;
use Assetic\Asset\FileAsset;
use Assetic\Asset\GlobAsset;

$styles = new AssetCollection(array(
    new FileAsset('/vendor/twitter/bootstrap/dist/css/bootstrap.css'),
    new GlobAsset('/vendor/twitter/bootstrap/dist/css/')
));

print $styles->dump();
return $styles;