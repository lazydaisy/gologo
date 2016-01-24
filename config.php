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
 * @package   theme_gologo
 * @copyright 2016 byLazyDaisy.uk
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$THEME->name = 'gologo';

/* Configuration settings for the GoLogo theme
----------------------------------------------*/

$THEME->csspostprocess = 'theme_gologo_process_css';

$THEME->doctype = 'html5';

$THEME->editor_sheets = array('editor');

$THEME->enable_dock = true;

$THEME->parents = array('bootstrapbase');

$THEME->rendererfactory = 'theme_overridden_renderer_factory';

$THEME->sheets = array('font-awesome', 'glyphicon-font', 'gologo', 'settings');

$THEME->supportscssoptimisation = false;

$THEME->yuicssmodules = array();

$THEME->layouts = array(
    // Most backwards compatible layout without the blocks - this is the layout used by default.
    'base' => array(
        'file' => 'default.php',
        'regions' => array(),
    ),
    // Standard layout with blocks, this is recommended for most pages with general information.
    'standard' => array(
        'file' => 'default.php',
        'regions' => array('side-pre', 'upper-level'),
        'defaultregion' => 'upper-level',
    ),
    // Main course page.
    'course' => array(
        'file' => 'default.php',
        'regions' => array('side-pre', 'upper-level', 'lower-level'),
        'defaultregion' => 'lower-level',
        'options' => array('langmenu' => true),
    ),
    'coursecategory' => array(
        'file' => 'default.php',
        'regions' => array('side-pre', 'upper-level', 'lower-level'),
        'defaultregion' => 'lower-level',
    ),
    // Part of course, typical for modules - default page layout if $cm specified in require_login().
    'incourse' => array(
        'file' => 'default.php',
        'regions' => array('side-pre', 'lower-level'),
        'defaultregion' => 'lower-level',
    ),
    // The site home page.
    'frontpage' => array(
        'file' => 'default.php',
        'regions' => array('side-pre', 'upper-level', 'footer-first', 'footer-last', 'lower-level'),
        'defaultregion' => 'lower-level',
        'options' => array('nonavbar' => true),
    ),
    // Server administration scripts.
    'admin' => array(
        'file' => 'default.php',
        'regions' => array('side-pre', 'lower-level'),
        'defaultregion' => 'lower-level',
    ),
    // My dashboard page.
    'mydashboard' => array(
        'file' => 'default.php',
        'regions' => array('side-pre', 'lower-level'),
        'defaultregion' => 'lower-level',
        'options' => array('langmenu' => true),
    ),
    // My public page.
    'mypublic' => array(
        'file' => 'default.php',
        'regions' => array('side-pre'),
        'defaultregion' => 'side-pre',
    ),
    'login' => array(
        'file' => 'default.php',
        'regions' => array(),
        'options' => array('langmenu' => true),
    ),

    // Pages that appear in pop-up windows - no navigation, no blocks, no header.
    'popup' => array(
        'file' => 'embedded.php',
        'regions' => array(),
        'options' => array('nofooter' => true, 'nonavbar' => true),
    ),
    // Embeded pages, like iframe/object embeded in moodleform - it needs as much space as possible.
    'embedded' => array(
        'file' => 'embedded.php',
        'regions' => array()
    ),
    // Used during upgrade and install, and for the 'This site is undergoing maintenance' message.
    // This must not have any blocks, links, or API calls that would lead to database or cache interaction.
    // Please be extremely careful if you are modifying this layout.
    'maintenance' => array(
        'file' => 'maintenance.php',
        'regions' => array(),
    ),
    // The pagelayout used when a redirection is occuring.
    'redirect' => array(
        'file' => 'redirect.php',
        'regions' => array(),
    ),
    // The pagelayout used for reports.
    'report' => array(
        'file' => 'default.php',
        'regions' => array('side-pre', 'lower-level'),
        'defaultregion' => 'lower-leval',
    ),
    // The pagelayout used for safebrowser and securewindow.
    'secure' => array(
        'file' => 'secure.php',
        'regions' => array('side-pre'),
        'defaultregion' => 'side-pre'
    ),
);

