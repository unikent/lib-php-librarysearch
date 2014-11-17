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
}