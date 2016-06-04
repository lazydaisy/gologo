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
$homemain = 'span7 desktop-first-column';
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

<body <?php echo $OUTPUT->body_attributes($html->bodyclasses); ?>>

<?php echo $OUTPUT->standard_top_of_body_html() ?>

<!-- NAVBAR
================================================== -->
<div class="navbar-wrapper">
    <!-- Wrap the .navbar in .container to center it within the absolutely positioned parent. -->
    <div class="container">

    <div class="navbar navbar-inverse">
        <div class="navbar-inner">
        <!-- Responsive Navbar Part 1:
            Button for triggering responsive navbar (not covered in tutorial).
            Include responsive CSS to utilize. -->
        <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <?php echo $html->brandicon; ?>
        <!-- Responsive Navbar Part 2:
        Place all navbar contents you want collapsed within
        .navbar-collapse.collapse. -->
            <div class="nav-collapse collapse"><?php
                echo $OUTPUT->custom_menu();
                echo $OUTPUT->user_menu(); ?>
            </div><!--/.nav-collapse -->
        </div><!-- /.navbar-inner -->
    </div><!-- /.navbar -->

    </div> <!-- /.container -->
</div><!-- /.navbar-wrapper -->



<!-- Carousel
================================================== -->
<div id="myCarousel" class="carousel slide">
    <ol class="carousel-indicators">
        <li class="active" data-slide-to="0" data-target="#myCarousel"></li>
        <li data-slide-to="1" data-target="#myCarousel"></li>
        <li data-slide-to="2" data-target="#myCarousel"></li>
    </ol>
    <div class="carousel-inner">
        <div class="item active">
            <img src="<?php echo $OUTPUT->pix_url('carousel/slide-01', 'theme'); ?>" alt="">
            <div class="container">
                <div class="carousel-caption">
                <h1>Example headline.</h1>
                <p class="lead">
                    Cras justo odio, dapibus ac facilisis in, egestas eget quam.
                    Donec id elit non mi porta gravida at eget metus.
                    Nullam id dolor id nibh ultricies vehicula ut id elit.
                </p>
                <a class="btn btn-large btn-primary" href="#">Sign up today</a>
                </div>
            </div>
        </div>
        <div class="item">
            <img src="<?php echo $OUTPUT->pix_url('carousel/slide-02', 'theme'); ?>" alt="">
            <div class="container">
                <div class="carousel-caption">
                <h1>Another example headline.</h1>
                <p class="lead">
                    Cras justo odio, dapibus ac facilisis in, egestas eget quam.
                    Donec id elit non mi porta gravida at eget metus.
                    Nullam id dolor id nibh ultricies vehicula ut id elit.
                </p>
                <a class="btn btn-large btn-primary" href="#">Learn more</a>
                </div>
            </div>
        </div>
        <div class="item">
            <img src="<?php echo $OUTPUT->pix_url('carousel/slide-03', 'theme'); ?>" alt="">
            <div class="container">
                <div class="carousel-caption">
                <h1>One more for good measure.</h1>
                <p class="lead">
                    Cras justo odio, dapibus ac facilisis in, egestas eget quam.
                    Donec id elit non mi porta gravida at eget metus.
                    Nullam id dolor id nibh ultricies vehicula ut id elit.
                </p>
                <a class="btn btn-large btn-primary" href="#">Browse gallery</a>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.carousel -->

<!-- Marketing messaging and featurettes
================================================== -->
<!-- Wrap the rest of the page in another container to center all the content. -->

<div class="container marketing">

    <!-- Three columns of text below the carousel -->
    <div class="row">
        <div class="span4">
            <i class="fa fa-cab fa-5x"></i>
            <h2>Heading</h2>

            <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod.
                Nullam id dolor id nibh ultricies vehicula ut id elit.
                Morbi leo risus, porta ac consectetur ac, vestibulum at eros.
                Praesent commodo cursus magna, vel scelerisque nisl consectetur et.
            </p>

            <p><a class="btn" href="#">View details &raquo;</a></p>
        </div><!-- /.span4 -->
        <div class="span4">
            <i class="fa fa-car fa-5x"></i>
            <h2>Heading</h2>
            <p>
                Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.
                Cras mattis consectetur purus sit amet fermentum.
                Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
            </p>

            <p><a class="btn" href="#">View details &raquo;</a></p>
        </div><!-- /.span4 -->
        <div class="span4">
            <i class="fa fa-bus fa-5x"></i>
            <h2>Heading</h2>
            <p>
                Donec sed odio dui.
                Cras justo odio, dapibus ac facilisis in, egestas eget quam.
                Vestibulum id ligula porta felis euismod semper.
                Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh,
                ut fermentum massa justo sit amet risus.
            </p>

            <p><a class="btn" href="#">View details &raquo;</a></p>
        </div><!-- /.span4 -->
    </div><!-- /.row -->


    <!-- START THE FEATURETTES -->

    <hr class="featurette-divider">

    <div class="featurette">
        <i class="pull-right fa fa-500px fa-5x"></i>
        <h2 class="featurette-heading">First featurette headling.
        <span class="muted">It'll blow your mind.</span></h2>
        <p class="lead">
            Donec ullamcorper nulla non metus auctor fringilla.
            Vestibulum id ligula porta felis euismod semper.
            Praesent commodo cursus magna, vel scelerisque nisl consectetur.
            Fusce dapibus, tellus ac cursus commodo.
        </p>
    </div>

    <hr class="featurette-divider">

    <div class="featurette">
        <i class="pull-left fa fa-500px fa-5x"></i>
        <h2 class="featurette-heading">Oh yeah, it's that good. <span class="muted">See for yourself.</span></h2>
        <p class="lead">
            Donec ullamcorper nulla non metus auctor fringilla.
            Vestibulum id ligula porta felis euismod semper.
            Praesent commodo cursus magna, vel scelerisque nisl consectetur.
            Fusce dapibus, tellus ac cursus commodo.
        </p>
    </div>

    <hr class="featurette-divider">

    <div class="featurette">
        <i class="pull-right fa fa-500px fa-5x"></i>
        <h2 class="featurette-heading">And lastly, this one. <span class="muted">Checkmate.</span></h2>
        <p class="lead">
            Donec ullamcorper nulla non metus auctor fringilla.
            Vestibulum id ligula porta felis euismod semper.
            Praesent commodo cursus magna, vel scelerisque nisl consectetur.
            Fusce dapibus, tellus ac cursus commodo.
        </p>
    </div>

    <hr class="featurette-divider">

    <!-- /END THE FEATURETTES -->

    <div id="page">

    <div class="row-fluid">
        <?php echo $OUTPUT->blocks('home-header', 'span-12'); ?>
    </div>

    <div id="page-content" class="row-fluid">

        <div id="page-home-content" class="<?php echo $regionmain ?>">

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
</div><!-- /.container (marketing) -->
</body>
</html>
