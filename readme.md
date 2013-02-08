# Status Board

## Ideas

Here are the ideas behind the status board script:

1. Self hosted and open source
2. Simple and elegant code
3. Modular and easy to add new status widgets

## Current Widgets

* Authentic Jobs
* Google Analytics
* GitHub commit log
* GitHub issues
* Pingdom
* RSS
* Stocks
* Twitter
* Weather

## Widget Ideas

* Basecamp
* News Feeds
* Bus / Train / Traffic status
* Radio - Spotify, Grooveshark, etc. Would play based off api.
* BitBucket API
* Pancake Payments
* Anything that you always want to look at during the day

## Requirements

Since the application is built on Laravel, a PHP framework, the requirements are PHP 5.3+ and a compatible web server.

## Installation and Usage

Installation is very easy. Upload the files to your server and visit
http://example.com/index.php. All of the default widgets should
load. To manage widgets, edit `application/config/widgets.php`. The
application also supports the creation of multiple boards. These are
configured in `application/config/boards.php` and you'll need to
register another route in `application/routes.php`.

Widgets are being transitioned into bundles, so the files in
`widgets/` and `bundles/` will look similar if not the same. Only
changes to the files in `bundles/` will be reflected in the boards.

Remember, this is alpha code so use at your own risk.

## Help Out

If you are interested in helping out let me know. The more help the better ;) I haven't figured the best route for
project planning so if you have any ideas on the best way let me know. When I mentioned this idea over twitter I did
get a lot of positive feedback so I feel this project is worth pursuing.

Also until I get everything planned consider [subscribing to a newsletter](http://eepurl.com/hzTZE). I am planning to
use that so I can contact everyone to schedule a time and place for v1 planning.
