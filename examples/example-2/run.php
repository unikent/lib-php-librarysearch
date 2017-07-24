<?php
/**
 * LibrarySearch API.
 *
 * @package    LibrarySearch
 * @copyright  2014 Skylar Kelty <S.Kelty@kent.ac.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once("vendor/autoload.php");

$url = "http://pmt-eu.hosted.exlibrisgroup.com/44KEN_VU1:CSCOP_ALL:44KEN_Voyager768635";
echo $url . ' - ';
echo \unikent\LibrarySearch\Utils::map_url($url) . "\n\n";


$url = "http://pmt-eu.hosted.exlibrisgroup.com/primo_library/libweb/action/dlDisplay.do?vid=44KEN_VU1&search_scope=CSCOP_ALL&docId=44KEN_Voyager768635&fn=permalink";
echo $url . ' - ';
echo \unikent\LibrarySearch\Utils::map_url($url) . "\n\n";


$url = "http://pmt-eu.hosted.exlibrisgroup.com/primo_library/libweb/action/search.do?fn=search&ct=search&initialSearch=true&mode=Basic&tab=default_tab&indx=1&dum=true&srt=rank&vid=44KEN_VU1&frbg=&scp.scps=scope%3A%2844KEN_Voyager%29%2Cscope%3A%2844KEN_SFX_DS%29%2Cscope%3A%2844KEN_CALM_DS%29%2Cscope%3A%2844KEN_MODES_DS%29%2Cscope%3A%2844KEN_EPR_DS%29%2Cscope%3A%2844MDH_MW%29%2Cprimo_central_multiple_fe&vl%28freeText0%29=Phillips+and+Pugh";
echo $url . ' - ';
echo \unikent\LibrarySearch\Utils::map_url($url) . "\n\n";
