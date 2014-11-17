<?php
/**
 * LibrarySearch API.
 *
 * @package    LibrarySearch
 * @copyright  2014 Skylar Kelty <S.Kelty@kent.ac.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace unikent\LibrarySearch;

/**
 * Represents a Library Search URL.
 */
class URL
{
    /** Search term */
    private $_search_term;

    /** Campus */
    private $_campus;

    /**
     * Constructor.
     */
    public function __construct() {
        $this->set_campus('canterbury');
        $this->set_search_term('');
    }

    /**
     * Set the campus of the URL.
     *
     * @param string $campus The name of the campus (canterbury/medway).
     */
    public function set_campus($campus) {
        if (!in_array($campus, array('canterbury', 'medway'))) {
            throw new \Exception("Invalid campus '{$campus}'.");
        }

        $this->_campus = $campus;
    }

    /**
     * Set the search term.
     *
     * @param string $searchterm Search term
     */
    public function set_search_term($searchterm) {
        $this->_search_term = $searchterm;
    }

    /**
     * Returns the base URL.
     * 
     * @see get_url()
     */
    public function get_base_url() {
        return 'http://primo-direct-eu-sb.hosted.exlibrisgroup.com/primo_library/libweb/action/search.do';
    }

    /**
     * Returns the URL params.
     */
    public function get_url_params() {
        return array(
            'fn' => 'search',
            'ct' => 'search',
            'initialSearch' => true,
            'mode' => 'Basic',
            'tab' => 'default_tab',
            'indx' => 1,
            'dum' => true,
            'srt' => 'rank',
            'vid' => '44KEN_VU1',
            'frbg' => '',
            'vl%28freeText0%29' => urlencode($this->_search_term)
        );
    }

    /**
     * Returns a URL to library search.
     */
    public function get_search_url() {
        $baseurl = $this->get_base_url();

        $params = $this->get_url_params();
        $params = array_map(function($param, $value) {
            return "{$param}={$value}";
        }, $params);
        $params = implode('&', $params);

        return "{$baseurl}?{$params}";
    }

    /**
     * To String!
     */
    public function __toString() {
        return $this->get_url();
    }
}