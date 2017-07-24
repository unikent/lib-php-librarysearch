<?php
/**
 * LibrarySearch API.
 *
 * @package    LibrarySearch
 * @copyright  2014 Skylar Kelty <S.Kelty@kent.ac.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

//require_once("vendor/autoload.php");
require_once(__DIR__ . "/../../src/Core.php");
require_once(__DIR__ . "/../../src/Utils.php");

$lines = explode("\n", file_get_contents(__DIR__ . "/old.txt"));
foreach ($lines as $line) {
    $mapped = \unikent\LibrarySearch\Utils::map_url($line);
    if (!$mapped) {
        echo "Could not map {$line}\n";
    }
}
