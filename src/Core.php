<?php
/**
 * LibrarySearch API.
 *
 * @copyright  2017 University of Kent
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace unikent\LibrarySearch;

/**
 * Represents a Library Search URL.
 *
 * @example ../examples/example-1/run.php Simple URL Example.
 */
class Core
{
    /**
     * Returns the base URL.
     *
     * @see get_url()
     */
    public static function get_base_url() {
        return 'https://librarysearch.kent.ac.uk/client/en_GB/kent';
    }

    /**
     * Returns a URL to library search.
     */
    public static function get_search_url($searchterm) {
        return self::get_base_url() . '/search/results?qu=' . urlencode($searchterm);
    }
}
