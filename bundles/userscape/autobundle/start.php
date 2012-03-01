<?php
/**
 *
 * @license     http://www.opensource.org/licenses/mit MIT License
 * @copyright   UserScape, Inc. (http://userscape.com)
 * @author      UserScape Dev Team
 * @package     Auto Bundle
 */

array_map(function($path)
{

    // Only treat paths with start.php as proper bundle paths as all bundles must have start.php
    if(strpos($path, 'start.php') !== false)
    {
        // Set the base path to the bundle
        $path = dirname($path);

        // Find the last directory name in path to use as bundle name
        $name = basename($path);

        // If the bundle is not already registered then register it
        if ( ! Bundle::exists($name))
        {
            // Load the bundle
            // If a routes file exists then we'll assume it handles routes of it's own name.
            // Remember, if you need it to handle a custom route you should manually add
            // the bundle in application/bundles.php.
            Bundle::register($name, array(
                    'handles'   => $name,
                    'location'  => str_replace(path('bundle'), '', $path),
                    'auto'      => true)
            );
            Route::controller(array($name.'::home', 'home::index'));

            // autobundle is already in the loop that's starting bundles so we
            // can't let the normal mechanism start it. We'll start it here.
            Bundle::start($name);
        }
    }
}, iterator_to_array(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(path('bundle')))));