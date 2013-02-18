<h1>PHP Namespaces</h1><?php

// Include our files
require_once __DIR__ . '/ikdoeict/demobase.php';
require_once __DIR__ . '/ikdoeict/demo/foo.php';
require_once __DIR__ . '/ikdoeict/demo/bar.php';
require_once __DIR__ . '/ikdoeict/demo/baz.php';

// Create a few instances, using the Fully-Qualified Name
$foo = new \Ikdoeict\Demo\Foo('hello-foo');
$bar = new \Ikdoeict\Demo\Bar('hello-bar');

// Import the Baz class from the `\Ikdoeict\Demo\` namespace
// Whenever you reference `Baz`, it'll use `\Ikdoeict\Demo\Baz`
use \Ikdoeict\Demo\Baz;
$baz = new Baz('hello-baz');

// Must know: the global namespace is just `\`
$di = new \DirectoryIterator(__DIR__);

// Output our stuff
echo $foo->go() . '<br />' . PHP_EOL;
echo $bar->go() . '<br />' . PHP_EOL;
echo $baz->go();