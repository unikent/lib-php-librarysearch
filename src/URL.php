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
    /** Search term. */
    private $_search_term;

    /** Campus. */
    private $_campus;

    /** Scopes  */
    private $_scopes;

    /**
     * Constructor.
     * 
     * @param string $campus The name of the campus (canterbury/medway).
     */
    public function __construct($campus = 'canterbury') {
        $this->set_search_term('');
        $this->set_campus($campus);

        $this->_scopes = array();
        $this->set_default_scopes();
    }

    /**
     * Set the campus of the URL.
     * This must be done at class instantiation time.
     *
     * @param string $campus The name of the campus (canterbury/medway).
     */
    protected function set_campus($campus) {
        if (!in_array($campus, array('canterbury', 'medway'))) {
            throw new \Exception("Invalid campus '{$campus}'.");
        }

        $this->_campus = $campus;

        return $this;
    }

    /**
     * Sets default scopes.
     */
    protected function set_default_scopes() {
        switch ($this->_campus) {
            case 'canterbury':
                $this->add_scope('44KEN_Voyager');
                $this->add_scope('44KEN_CALM_DS');
                $this->add_scope('44KEN_MODES_DS');
                $this->add_scope('44KEN_EPR_DS');
                $this->add_scope('44MDH_MW');
            break;

            case 'medway':
                $this->add_scope('44MDH_MW_CLONE');
                $this->add_scope('44KEN_SFX_DS_CLONE');
                $this->add_scope('44KEN_CALM_DS_CLONE');
                $this->add_scope('44KEN_SPECIAL_COLL_LMS_CLONE');
                $this->add_scope('44KEN_Voyager_CLONE');
                $this->add_scope('44KEN_EPR_DS_CLONE');
            break;
        }

        $this->add_raw_scope('primo_central_multiple_fe');

        return $this;
    }

    /**
     * Set the search term.
     *
     * @param string $searchterm Search term
     */
    public function set_search_term($searchterm) {
        $this->_search_term = $searchterm;

        return $this;
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
     * Add a raw scope.
     *
     * @param string $scope A valid library search scope.
     */
    public function add_raw_scope($scope) {
        if (!in_array($scope, $this->_scopes)) {
            $this->_scopes[] = $scope;
        }

        return $this;
    }

    /**
     * Add a standard scope.
     *
     * @param string $scope A valid library search scope.
     * 
     * @see add_raw_scope()
     */
    public function add_scope($scope) {
        $this->add_raw_scope("scope:({$scope})");

        return $this;
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
            'vid' => $this->_campus == 'medway' ? '44MDH_VU1' : '44KEN_VU1',
            'frbg' => '',
            'vl%28freeText0%29' => urlencode($this->_search_term),
            'scp.scps' => urlencode(implode(',', $this->_scopes))
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
        }, array_keys($params), array_values($params));
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