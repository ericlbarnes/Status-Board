Auto Bundle removes the need to manually add each bundle to the application/bundles.php file. Just drop a new bundle in to the bundles directory and it will be registered and started.

If your bundle contains a routes.php file it will register a handler for you of your bundles name. If you want your bundle to use an alternate handle (ex: your bundle is named "pizza" but you want it to respond to "admin") then you should still manually add your bundle to application/bundles.php.

Bundles registered with application/bundles.php will not be auto loaded.

## Installation

Install it just like any Laravel bundle. Drop it in your bundles folder in *bundles/userscape/autobundle*

After that add this line in the array of *application/bundles.php*

	return array(
		'autobundle' => array('location'=>'userscape/autobundle', 'auto' => true),
	);