<?php
/**
 * LibrarySearch API.
 *
 * @copyright  2017 University of Kent
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace unikent\LibrarySearch;

/**
 * Extra utilities.
 *
 * @example ../examples/example-2/run.php Simple mapping Example.
 */
class Utils
{
    private static $_cache = [];

    /**
     * Map an old library search URL to a new one (as best we can).
     */
    public static function map_url($old) {
        $parts = parse_url($old);

        // Special case.
        if ($old == 'http://pmt-eu.hosted.exlibrisgroup.com/primo_library/libweb/uploaded_files/44KEN_VU1/KENLogo.png') {
            return 'http://librarysearch.kent.ac.uk';
        }

        // The most old URLs take this form: http://pmt-eu.hosted.exlibrisgroup.com/COLLECTION:SCOPE:ID.
        // We can map this easily.
        if (!isset($parts['query'])) {
            $path = explode(':', $parts['path']);
            // Ignore the scope, we can't map that.
            foreach ($path as $pathpart) {
                $oldid = self::extract_voyager_id($pathpart);
                if (!empty($oldid)) {
                    // We can map this now.
                    $newid = urlencode(self::map_voyager_id($oldid));
                    if ($newid) {
                        return "https://ulms.ent.sirsidynix.net.uk/client/en_GB/kent/search/detailnonmodal/ent:$002f$002fSD_ILS$002f0$002fSD_ILS:{$newid}/one";
                    }
                }
            }

            // No idea how to map.
            return null;
        }

        parse_str($parts['query'], $oldparams);
        $oldparams = array_map('urldecode', $oldparams);

        // Now we handle the redirected record case.
        // This takes the form: http://pmt-eu.hosted.exlibrisgroup.com/primo_library/libweb/action/dlDisplay.do?vid=44KEN_VU1&search_scope=CSCOP_ALL&docId=44KEN_Voyager768635&fn=permalink.
        if (!empty($oldparams['docId'])) {
            $oldid = self::extract_voyager_id($oldparams['docId']);
            $newid = urlencode(self::map_voyager_id($oldid));
            if ($newid) {
                return "https://ulms.ent.sirsidynix.net.uk/client/en_GB/kent/search/detailnonmodal/ent:$002f$002fSD_ILS$002f0$002fSD_ILS:{$newid}/one";
            }
        }

        // Now we very loosely handle searches.
        if (!empty($oldparams['vl(freeText0)']) && isset($oldparams['fn']) && $oldparams['fn'] == 'search') {
            $text = urlencode(urldecode($oldparams['vl(freeText0)']));
            return "https://ulms.ent.sirsidynix.net.uk/client/en_GB/kent/search/results?qu={$text}";
        }

        return null;
    }

    /**
     * Check this is a voyager ID.
     */
    private static function extract_voyager_id($id) {
        $pos = strpos($id, '44KEN_Voyager');
        if ($pos !== 0) {
            return null;
        }

        return substr($id, $pos + 13);
    }

    /**
     * Map a Voyager ID to a new ID.
     */
    public static function map_voyager_id($oldid) {
        if (empty(self::$_cache)) {
            self::$_cache = [];
            if (($handle = fopen(__DIR__ . "/map.csv", "r")) !== false) {
                while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                    self::$_cache[$data[0]] = $data[1];
                }
                fclose($handle);
            }
        }

        if (!isset(self::$_cache['KU' . $oldid])) {
            echo "No mapping available for $oldid\n";
            return null;
        }

        return self::$_cache['KU' . $oldid];
    }
}
