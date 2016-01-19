<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Theme GoLogo upgrade.
 *
 * @package    theme_gologo
 * @copyright  2016 LazyDaisy.uk
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Theme_more upgrade function.
 *
 * @param  int $oldversion The version we upgrade from.
 * @return bool
 */
function xmldb_theme_gologo_upgrade($oldversion) {
    global $CFG, $DB, $OUTPUT;

    $dbman = $DB->get_manager();

    if ($oldversion < 2016011600) {
        // Migrate logo URL.
        $logo = get_config('theme_gologo', 'brandlogo');
        if ($logo === '') {
            // No logo means nothing to do.

        } else if ($logo = clean_param($brandlogo, PARAM_URL)) {
            require_once("$CFG->libdir/filelib.php");
            if ($content = download_file_content($brandlogo)) {
                $filename = preg_replace('/^.*\//', '', $brandlogo);
                if (!$filename = clean_param($filename, PARAM_FILE)) {
                    // Some name is better than no name...
                    $filename = 'brandlogo.jpg';
                }
                $fs = get_file_storage();
                $record = array(
                    'contextid' => context_system::instance()->id, 'component' => 'theme_gologo',
                    'filearea' => 'brandlogo', 'itemid'=>0, 'filepath'=>'/', 'filename'=>$filename);
                $fs->create_file_from_string($record, $content);
                set_config('brandlogo', '/'.$filename, 'theme_gologo');
                unset($content);

            } else {
                unset_config('theme_gologo', 'brandlogo');
            }
        } else {
            // Prompt for new logo, the old setting was invalid.
            unset_config('theme_gologo', 'brandlogo');
        }

        upgrade_plugin_savepoint(true, 2016011601, 'theme', 'gologo');
    }


    // Moodle v3.1.0 release upgrade line.
    // Put any upgrade step following this.

    return true;
}
