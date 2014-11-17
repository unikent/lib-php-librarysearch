<?php
/**
 * LibrarySearch API.
 *
 * @package    LibrarySearch
 * @copyright  2014 Skylar Kelty <S.Kelty@kent.ac.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once("vendor/autoload.php");

$url = new \unikent\LibrarySearch\URL();
$url->set_search_term("Example");
echo $url->get_search_url();
