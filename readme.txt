=== XML-RPC Memory Usage ===
Contributors: maxcutler
Tags: xmlrpc, xml-rpc
Requires at least: 3.4
Tested up to: 3.4
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Logs memory usage of WordPress at multiple points during the XML-RPC request/response process.

== Description ==

Useful for debugging memory usage of the XML-RPC server. Uses `error_log` to log without corrupting the XML response
of the server.

Be sure to set your wp-config.php to log errors:

    define('WP_DEBUG', true);
    define('WP_DEBUG_LOG', true);
    define('WP_DEBUG_DISPLAY', false);
    @ini_set('display_errors',0);

Then `tail -f path/to/wp-content/debug.log`, perform an XML-RPC request against the site, and look at the logged results.

== Changelog ==

= 1.0 =

* Initial release.