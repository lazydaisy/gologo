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
$homemain = 'span7 desktop-first-colomn';
$homecontent = 'span5 pull-right';
// Reset layout mark-up for RTL languages.
if (right_to_left()) {
    $regionmain = 'span9 desktop-first-column';
    $sidepre = 'span3 pull-right';
    $homemain = 'span7 pull-right';
    $homecontent = 'span5 desktop-first-column';
}

echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes(); ?>>
<head>
    <title><?php echo $OUTPUT->page_title(); ?></title>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->favicon(); ?>" />
    <?php echo $OUTPUT->standard_head_html() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body <?php echo $OUTPUT->body_attributes($html->brandlogo); ?>>

<?php echo $OUTPUT->standard_top_of_body_html() ?>

<header role="banner" class="navbar navbar-fixed-top<?php echo $html->navbarclass ?> moodle-has-zindex">
    <nav role="navigation" class="navbar-inner">
        <div class="container-fluid">
            <?php echo $html->brandicon; ?>
            <?php echo $OUTPUT->navbar_button(); ?>
            <?php echo $OUTPUT->user_menu(); ?>
            <div class="nav-collapse collapse">
                <?php echo $OUTPUT->custom_menu(); ?>
                <ul class="nav pull-right">
                    <li><?php echo $OUTPUT->page_heading_menu(); ?></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<div id="page" class="container-fluid">

    <?php echo $OUTPUT->full_header(); ?>

    <div class="row-fluid">

    <?php echo $OUTPUT->blocks('home-header', 'span-12'); ?>

    </div>
    <div id="page-content" class="row-fluid">

        <div id="region-main" class="<?php echo $regionmain ?>">

            <div id="home-main" class="<?php echo $homemain ?>">

                <?php
                    echo $OUTPUT->blocks('home-main', 'span12');
                    echo $OUTPUT->main_content();

                ?>

            </div>

            <div id="home-content" class="<?php echo $homecontent ?>">
                <?php echo $OUTPUT->blocks('home-content', 'span12'); ?>
            </div>

        </div>

        <?php echo $OUTPUT->blocks('side-pre', $sidepre); ?>

    </div>

    <div id="page-footer">

        <div class="row-fluid">
            <?php echo $OUTPUT->blocks('home-footer', 'span-12'); ?>
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
