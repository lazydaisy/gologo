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

/**
 * This function adds a new LESS veriable based
 * on the colour added via the theme settings.
 */
function theme_gologo_less_variables($theme) {
    $variables = array();
    if (!empty($theme->settings->gologocolor)) {
        $variables['gologoColor'] = $theme->settings->gologocolor;
    }
    return $variables;
}

/**
 * Parses CSS before it is cached.
 *
 * This function can make alterations and replace patterns within the CSS.
 *
 * @param string $css The CSS
 * @param theme_config $theme The theme config object.
 * @return string The parsed CSS.
 */
function theme_gologo_process_css($css, $theme) {

    // Set the background image for the 'Brand' icon.
    $brandicon = $theme->setting_file_url('brandicon', 'brandicon');
    $css = theme_gologo_set_brandicon($css, $brandicon);

    // Set the background image for the 'Brand' logo.
    $brandlogo = $theme->setting_file_url('brandlogo', 'brandlogo');
    $css = theme_gologo_set_brandlogo($css, $brandlogo);

    // Set the background image for the posters.
    $poster1image = $theme->setting_file_url('poster1image', 'poster1image');
    $css = theme_gologo_set_poster1image($css, $poster1image);

    $poster2image = $theme->setting_file_url('poster2image', 'poster2image');
    $css = theme_gologo_set_poster2image($css, $poster2image);

    // Set custom CSS.
    if (!empty($theme->settings->customcss)) {
        $customcss = $theme->settings->customcss;
    } else {
        $customcss = null;
    }
    $css = theme_gologo_set_customcss($css, $customcss);

    return $css;
}

/**
 * Adds the 'Brand' icon to CSS as a background-image.
 *
 * @param string $css The CSS.
 * @param string $brandicon The URL of the navbar 'Brand' icon.
 * @return string The parsed CSS
 */
function theme_gologo_set_brandicon($css, $brandicon) {
    $tag = '[[setting:brandicon]]';
    $replacement = $brandicon;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}

/**
 * Adds the 'Brand' logo to CSS as a background-image.
 *
 * @param string $css The CSS.
 * @param string $logo The URL of the 'Brand' logo.
 * @return string The parsed CSS
 */
function theme_gologo_set_brandlogo($css, $brandlogo) {
    $tag = '[[setting:brandlogo]]';
    $replacement = $brandlogo;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}

/**
 * Adds the first 'Poster' image to CSS as a background-image.
 *
 * @param string $css The CSS.
 * @param string $poster1 The URL of the first 'Poster' image.
 * @return string The parsed CSS
 */
function theme_gologo_set_poster1image($css, $poster1image) {
    $tag = '[[setting:poster1image]]';
    $replacement = $poster1image;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}

/**
 * Adds the second 'Poster' image to CSS as a background-image.
 *
 * @param string $css The CSS.
 * @param string $poster1 The URL of the second 'Poster' image.
 * @return string The parsed CSS
 */
function theme_gologo_set_poster2image($css, $poster2image) {
    $tag = '[[setting:poster2image]]';
    $replacement = $poster2image;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}

/**
 * Serves any files associated with the theme settings.
 *
 * @param stdClass $course
 * @param stdClass $cm
 * @param context $context
 * @param string $filearea
 * @param array $args
 * @param bool $forcedownload
 * @param array $options
 * @return bool
 */
function theme_gologo_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = array()) {
    if ($context->contextlevel == CONTEXT_SYSTEM && ($filearea === 'brandicon' || $filearea === 'brandlogo' ||
                                                     $filearea === 'poster1image' || $filearea === 'poster2image')) {
        $theme = theme_config::load('gologo');
        // By default, theme files must be cache-able by both browsers and proxies.
        if (!array_key_exists('cacheability', $options)) {
            $options['cacheability'] = 'public';
        }
        return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
    } else {
        send_file_not_found();
    }
}


/**
 * Adds any custom CSS to the CSS before it is cached.
 *
 * @param string $css The original CSS.
 * @param string $customcss The custom CSS to add.
 * @return string The CSS which now contains our custom CSS.
 */
function theme_gologo_set_customcss($css, $customcss) {
    $tag = '[[setting:customcss]]';
    $replacement = $customcss;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}

/**
 * Returns an object containing HTML for the areas affected by settings.
 *
 * Do not add Clean specific logic in here, child themes should be able to
 * rely on that function just by declaring settings with similar names.
 *
 * @param renderer_base $output Pass in $OUTPUT.
 * @param moodle_page $page Pass in $PAGE.
 * @return stdClass An object with the following properties:
 *      - navbarclass A CSS class to use on the navbar. By default ''.
 *      - heading HTML to use for the heading. A logo if one is selected or the default heading.
 *      - footnote HTML to use as a footnote. By default ''.
 */
function theme_gologo_get_html_for_settings(renderer_base $output, moodle_page $page) {
    global $CFG;
    $return = new stdClass;

    $return->brandlogo = '';
    if (!empty($page->theme->settings->brandlogo)) {
        $return->brandlogo .= '<div id="brand-logo"></div>';
    }

    $return->navbarclass = '';
    if (!empty($page->theme->settings->invert)) {
        $return->navbarclass .= ' navbar-inverse';
    }

    $return->bodyclasses = '';
    if (!empty($page->theme->settings->defaultuserpicturestyles) && !empty($page->theme->settings->brandlogo)) {
        $return->bodyclasses .= ' has-brand-logo ';
    }

    if (empty($page->theme->settings->defaultuserpicturestyles) && empty($page->theme->settings->brandlogo)) {
        $return->bodyclasses .= ' has-user-picture-styles ';
    }

    $return->brandicon = html_writer::link($CFG->wwwroot, '<i class="fa fa-home"></i>', array('class' => 'brand'));
    if (!empty($page->theme->settings->brandicon)) {
        $return->brandicon = html_writer::link($CFG->wwwroot, '', array('class' => 'brand'));
    }

    $return->poster1image = '';
    if (!empty($page->theme->settings->poster1image)) {
        $return->poster1image = html_writer::tag('div', '', array('id' => 'poster1image-thumbnail'));
    }

    $return->poster1heading = '';
    if (!empty($page->theme->settings->poster1heading)) {
        $return->poster1heading = html_writer::tag('h3', format_text($page->theme->settings->poster1heading));
    }

    $return->poster1caption = '';
    if (!empty($page->theme->settings->poster1caption)) {
        $return->poster1caption = html_writer::tag('p', format_text($page->theme->settings->poster1caption));
    }

    $return->poster2image = '';
    if (!empty($page->theme->settings->poster2image)) {
        $return->poster2image = html_writer::tag('div', '', array('id' => 'poster2image-thumbnail'));
    }

    $return->poster2heading = '';
    if (!empty($page->theme->settings->poster2heading)) {
        $return->poster2heading = html_writer::tag('h3', format_text($page->theme->settings->poster2heading));
    }

    $return->poster2caption = '';
    if (!empty($page->theme->settings->poster2caption)) {
        $return->poster2caption = html_writer::tag('p', format_text($page->theme->settings->poster2caption));
    }

     $return->footnote = '';
    if (!empty($page->theme->settings->footnote)) {
        $return->footnote = html_writer::tag('div',
                                         format_text($page->theme->settings->footnote),
                                         array('class' => 'footnote'));
    }

    return $return;
}
