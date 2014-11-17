<?php
/**
 * Reading Lists API for is-dev applications.
 *
 * @package    ReadingLists
 * @copyright  2014 Skylar Kelty <S.Kelty@kent.ac.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace unikent\LibrarySearch;

/**
 * Represents a Library Search URL.
 */
class URL
{
    /** Campus */
    private $_campus;

    /**
     * Constructor.
     */
    public function __construct() {
        $this->set_campus('canterbury');
    }

    /**
     * Set the campus of the URL.
     */
    public function set_campus($campus) {
        if (!in_array($campus, array('canterbury', 'medway'))) {
            throw new \Exception("Invalid campus '{$campus}'.");
        }

        $this->_campus = $campus;
    }
}