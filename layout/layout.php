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
 * Moodle's Clean theme, an example of how to make a Bootstrap theme
 *
 * DO NOT MODIFY THIS THEME!
 * COPY IT FIRST, THEN RENAME THE COPY AND MODIFY IT INSTEAD.
 *
 * For full information about creating Moodle themes, see:
 * http://docs.moodle.org/dev/Themes_2.0
 *
 * @package   theme_gologo
 * @copyright 2016 byLazyDaisy.uk
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// Get the HTML for the settings bits.
$html = theme_gologo_get_html_for_settings($OUTPUT, $PAGE);

// Set default (LTR) layout mark-up for a three column page.
$regionmain = 'span9 pull-right';
$sidepre = 'span3 desktop-first-column';
$footerfirst = 'span6 desktop-first-column';
$footerlast = 'span6 pull-right';
// Reset layout mark-up for RTL languages.
if (right_to_left()) {
    $regionmain = 'span9';
    $sidepre = 'span3 pull-right';
    $footerfirst = 'span6 pull-right';
    $footerlast = 'span6 desktop-first-column';

}

echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes(); ?>>
<head>
    <title><?php echo $OUTPUT->page_title(); ?></title>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->favicon(); ?>" />
    <?php echo $OUTPUT->standard_head_html() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<style type="text/css">
body {
    padding-top: 40px;
}
#upper-level #block-region-upper-level,
#upper-level.container-fluid {
    padding: 0;
    margin: 0;
}
#upper-level .block .content {
    padding: 0;
}
.page-context-header .page-header-headings {
    margin: 10px auto;
}
.dir-ltr .page-context-header .page-header-image { margin: 0 0 1em;}

</style>

</head>

<body <?php echo $OUTPUT->body_attributes($html->bodyclasses); ?>>

<?php echo $OUTPUT->standard_top_of_body_html() ?>

<div role="banner" class="navbar navbar-fixed-top<?php echo $html->navbarclass ?> moodle-has-zindex">
<div role="navigation" class="navbar-inner">
<div class="container-fluid">
    <?php {
    echo $html->brandicon;
    echo $OUTPUT->navbar_button();
    echo $OUTPUT->user_menu();
} ?>

    <div class="nav-collapse collapse">
    <?php {
    echo $OUTPUT->custom_menu();
}?>
        <ul class="nav pull-right">
            <li><?php echo $OUTPUT->page_heading_menu(); ?></li>
        </ul>
    </div>
</div>
</div>
</div>
<div id="upper-level" class="container-fluid">
<div class="row-fluid">
    <?php {
    echo $OUTPUT->blocks('upper-level', 'span-12');
} ?>
</div>
</div>

<div id="page" class="container-fluid">

<div id="page-content" class="row-fluid">
<div id="region-main" class="<?php echo $regionmain; ?>">
    <?php
    echo $OUTPUT->full_header();
    echo $OUTPUT->course_content_header();
    echo $OUTPUT->main_content();
    echo $OUTPUT->course_content_footer();
    ?>
</div>
    <?php {
    echo $html->brandlogo;
    echo $OUTPUT->blocks('side-pre', $sidepre);
} ?>
</div>

<div id="page-footer" class="row-fluid">

<div id="course-footer"><?php echo $OUTPUT->course_footer(); ?></div>

    <?php echo $OUTPUT->blocks('footer-first', $footerfirst); ?>
    <?php echo $OUTPUT->blocks('footer-last', $footerlast); ?>

<div class="row-fluid">
    <?php echo $OUTPUT->blocks('lower-level', 'span-12'); ?>
</div>

<?php {
    echo $OUTPUT->page_doc_link();
    echo $OUTPUT->login_info();
    echo $html->footnote;
} ?>

<?php echo $OUTPUT->standard_footer_html() ?>
</div>

<?php echo $OUTPUT->standard_end_of_body_html() ?>

</div>
</body>
</html>
