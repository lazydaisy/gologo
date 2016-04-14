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
 * Theme gologo core renderer file.
 *
 * @package    theme_gologo
 * @copyright  2016 bylazydaisy.uk
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once($CFG->dirroot . '/theme/bootstrapbase/renderers.php');

class theme_gologo_core_renderer extends theme_bootstrapbase_core_renderer {

    /*
     * This renders the bootstrap top menu.
     *
     * This renderer is needed to enable the Bootstrap style navigation.
     */
    protected function render_custom_menu(custom_menu $menu) {
        global $CFG;

        $content = parent::render_custom_menu($menu);
        $mycourses = $this->page->navigation->get('mycourses');
        if (isloggedin() && $mycourses && $mycourses->has_children()) {
            $branchlabel = get_string('mycourses');
            $branchurl   = new moodle_url('/course/index.php');
            $branchtitle = $branchlabel;
            $branchsort  = -1;
            $branch = $menu->add($branchlabel, $branchurl, $branchtitle, $branchsort);

            foreach ($mycourses->children as $coursenode) {
                $branch->add($coursenode->get_content(),
                $coursenode->action,
                $coursenode->get_title());
            }
        }

        $content = '<ul class="nav">';
        foreach ($menu->get_children() as $item) {
            $content .= $this->render_custom_menu_item($item, 1);
        }
        $content .= '</ul>';
        $patterns = array();
        $replacements = array();

        $patterns[0] = '/<ul class="nav">/';
        $replacements[0] = '<ul class="nav"><li class="first divider"></li>';

        $patterns[1] = '/<\/ul>/';
        $replacements[1] = '<li class="last divider"></li></ul>';

        $content = preg_replace($patterns, $replacements, $content);

        return $content;
    }

    /**
     * This code renders the navbar button to control the display of the custom menu
     * on smaller screens.
     *
     * Do not display the button if the menu is empty.
     *
     * @return string HTML fragment
     */
    protected function navbar_button() {
        global $CFG;

        if (empty($CFG->custommenuitems) && $this->lang_menu() == '') {
            return '';
        }

        $iconbar = html_writer::tag('i', '', array('class' => 'icon-th-list icon-white'));
        $button = html_writer::tag('a', $iconbar , array(
            'class'       => 'btn btn-mini btn-default btn-navbar',
            'data-toggle' => 'collapse',
            'data-target' => '.nav-collapse'
        ));
        return $button;
    }

    /**
     * The standard tags (typically performance information and validation links,
     * if we are in developer debug mode) that should be output in the footer area
     * of the page. Designed to be called in theme layout.php files.
     *
     * @return string HTML fragment.
     */
    public function standard_footer_html() {
        $output = parent::standard_footer_html();
        $patterns = array();
        $replacements = array();

        $patterns[0] = '/<div class="performanceinfo pageinfo">/';
        $replacements[0] = '<div class="performanceinfo pageinfo well"><i class="fa fa-cogs"></i>';

        $patterns[1] = '/<div class="purgecaches"><a([^>]+)>([^<]+)<\/a>/';
        $replacements[1] = '<div class="purgecaches"><a class="btn btn-default" ${1}><i class="fa fa-trash"></i>&nbsp;${2}</a>';

        $patterns[2] = '/<li><a([^>]+)>([^<]+)<\/a>/';
        $replacements[2] = '<li><a class="btn btn-small btn-default" ${1}><i class="fa fa-cogs"></i>&nbsp;${2}</a>';
        $output = preg_replace($patterns, $replacements, $output);

        return $output;
    }

    /**
     * Return the 'back' link that normally appears in the footer.
     *
     * @return string HTML fragment.
     */
    public function home_link() {
        global $CFG, $SITE;

        if ($this->page->pagetype == 'site-index') {
            // Special case for site home page - please do not remove.
            return '';

        } else if (!empty($CFG->target_release) && $CFG->target_release != $CFG->release) {
            // Special case for during install/upgrade.
            return html_writer::div('sitelink',
                   html_writer::link('http://docs.moodle.org/en/Administrator_documentation
                   onclick="this.target=_blank"',
                   html_writer::tag('img',
                   array('src' => $this->pix_url('moodlelogo'), 'width' => '100px', 'height' => '30px', 'alt' => 'moodlelogo'))));
        } else if ($this->page->course->id == $SITE->id || strpos($this->page->pagetype, 'course-view') === 0) {
            return html_writer::div('homelink',
                                html_writer::link(new moodle_url('/'),
                                html_writer::tag('i', array('class' => 'fa fa-home')). ' ' . get_string('home'),
                                array('class' => 'btn btn-small')));
        } else {
            return html_writer::div('homelink',
                   html_writer::link(new moodle_url('/course/view.php', array('id' => $this->page->course->id)),
                   html_writer::tag('i', '', array('class' => 'icon-home')) . '&nbsp;' .
                   format_string($this->page->course->shortname, true, array('context' => $this->page->context)),
                   array('class' => 'btn btn-small')));
        }
    }

    /**
     * Return the standard string that says whether you are logged in (and switched
     * roles/logged in as another user).
     * @param bool $withlinks if false, then don't include any links in the HTML produced.
     * If not set, the default is the nologinlinks option from the theme config.php file,
     * and if that is not set, then links are included.
     * @return string HTML fragment.
     */
    public function login_info($withlinks = null) {
        global $USER, $CFG, $DB, $SESSION;

        if (during_initial_install()) {
            return '';
        }

        if (is_null($withlinks)) {
            $withlinks = empty($this->page->layout_options['nologinlinks']);
        }

        $loginpage = ((string)$this->page->url === get_login_url());
        $course = $this->page->course;
        if (\core\session\manager::is_loggedinas()) {
            $realuser = session_get_realuser();
            $fullname = fullname($realuser, true);
            if ($withlinks) {
                $realuserinfo = html_writer::link(new moodle_url('/course/loginas.php',
                array('id' => $course->id, 'sesskey' => sesskey())),
                $fullname);
            } else {
                $realuserinfo = $fullname;
            }
        } else {
            $realuserinfo = '';
        }

        $loginurl = get_login_url();

        if (empty($course->id)) {
            // The $course->id is not defined during installation.
            return '';
        } else if (isloggedin()) {
            $context = context_course::instance($course->id);

            $fullname = fullname($USER, true);
            // Since Moodle 2.0 this link always goes to the public profile page (not the course profile page).
            if ($withlinks) {
                $username = html_writer::link(new moodle_url('/user/profile.php',
                            array('id' => $USER->id)), $fullname);
            } else {
                $username = $fullname;
            }
            if (is_mnet_remote_user($USER) and $idprovider = $DB->get_record('mnet_host', array('id' => $USER->mnethostid))) {
                if ($withlinks) {
                    $username .= " from <a href=\"{$idprovider->wwwroot}\">{$idprovider->name}</a>";
                } else {
                    $username .= " from {$idprovider->name}";
                }
            }
            if (isguestuser()) {
                $loggedinas = $realuserinfo.get_string('loggedinasguest');
                if (!$loginpage && $withlinks) {
                    $loggedinas .= '<a class="btn btn-small btn-default" href="'
                    . $loginurl . '"><i class="fa fa-sign-in"></i> ' . get_string('login') . '</a>';
                }
            } else if (is_role_switched($course->id)) { // Has switched roles.
                $rolename = '';
                if ($role = $DB->get_record('role', array('id' => $USER->access['rsw'][$context->path]))) {
                    $rolename = ': '.format_string($role->name);
                }
                $loggedinas = get_string('loggedinas', 'moodle', $username).$rolename;
                if ($withlinks) {
                    $loggedinas .= html_writer::link(new moodle_url('/course/view.php',
                                   array('id' => $course->id, 'switchrole' => '0', 'sesskey' => sesskey())),
                                   get_string('switchrolereturn'));
                }
            } else {
                $loggedinas = $realuserinfo.get_string('loggedinas', 'moodle', $username);
                if ($withlinks) {
                    $loggedinas .= '&nbsp;&nbsp;<br>' .
                    html_writer::link(new moodle_url('/login/logout.php', array('sesskey' => sesskey())),
                    html_writer::tag('i', '', array('class' => 'fa fa-sign-out')) . ' ' . get_string('logout'),
                                 array('class' => 'btn btn-small btn-default'));
                }
            }
        } else {
            $loggedinas = get_string('loggedinnot', 'moodle');
            if (!$loginpage && $withlinks) {
                $loggedinas .= ' <a class="btn btn-small btn-default" href="'
                . $loginurl . '"><i class="fa fa-sign-in"></i> '.get_string('login').'</a>';
            }
        }

        $loggedinas = '<div class="logininfo">'.$loggedinas.'</div>';

        if (isset($SESSION->justloggedin)) {
            unset($SESSION->justloggedin);
            if (!empty($CFG->displayloginfailures)) {
                if (!isguestuser()) {
                    // Include this file only when required.
                    require_once(new moodle_url('/user/lib.php'));

                    if ($count = user_count_login_failures($USER)) {
                        $loggedinas .= '<div class="loginfailures">';
                        $a = new stdClass();
                        $a->attempts = $count;
                        $loggedinas .= get_string('failedloginattempts', '', $a);
                        if (file_exists (new moodle_url('/report/log/index.php')) and has_capability('report/log:view',
                            context_system::instance())) {
                            $loggedinas .= ' ('.html_writer::link(new moodle_url('/report/log/index.php',
                                                array('chooselog' => 1, 'id' => 0 ,
                                                      'modid' => 'site_errors')), get_string('logs')).')';
                        }
                        $loggedinas .= '</div>';
                    }
                }
            }
        }

        return $loggedinas;
    }

     /**
      * Renders the header bar.
      *
      * @param context_header $contextheader Header bar object.
      * @return string HTML for the header bar.
      */
    protected function render_context_header(context_header $contextheader) {

        // All the html stuff goes here.
        $html = html_writer::start_div('page-context-header');

        // Image data.
        if (isset($contextheader->imagedata)) {
            // Header specific image.
            $html .= html_writer::div($contextheader->imagedata, 'thumbnails page-header-image');
        }

        // Headings.
        if (!isset($contextheader->heading)) {
            $headings = $this->heading($this->page->heading, $contextheader->headinglevel);
        } else {
            $headings = $this->heading($contextheader->heading, $contextheader->headinglevel);
        }

        $html .= html_writer::tag('div', $headings, array('class' => 'page-header-headings'));

        // Buttons.
        if (isset($contextheader->additionalbuttons)) {
            $html .= html_writer::start_div('btn-group header-button-group');
            foreach ($contextheader->additionalbuttons as $button) {
                if (!isset($button->page)) {
                    // Include js for messaging.
                    if ($button['buttontype'] === 'message') {
                        message_messenger_requirejs();
                    }
                    $image = $this->pix_icon($button['formattedimage'], $button['title'], 'moodle', array(
                        'class' => 'iconsmall',
                        'role' => 'presentation'
                    ));
                    $image .= html_writer::span($button['title'], 'header-button-title');
                } else {
                    $image = html_writer::empty_tag('img', array(
                        'src' => $button['formattedimage'],
                        'role' => 'presentation'
                    ));
                }
                $html .= html_writer::link($button['url'], html_writer::tag('span', $image), $button['linkattributes']);
            }
            $html .= html_writer::end_div();
        }
        $html .= html_writer::end_div();

        return $html;
    }

    /**
     * Wrapper for header elements.
     *
     * @return string HTML to display the main header.
     */
    public function full_header() {
        $html = html_writer::start_tag('div', array('id' => 'page-header', 'class' => 'clearfix'));
        $html .= $this->context_header();
        $html .= html_writer::start_div('clearfix', array('id' => 'page-navbar'));
        $html .= html_writer::tag('nav', $this->navbar(), array('class' => 'breadcrumb-nav'));
        $html .= html_writer::start_div('clearfix', array('id' => 'bread-crumb-button'));
        $html .= html_writer::div($this->page_heading_button(), 'breadcrumb-button');
        $html .= html_writer::end_div();
        $html .= html_writer::end_div();
        $html .= html_writer::tag('div', $this->course_header(), array('id' => 'course-header'));
        $html .= html_writer::end_tag('div');
        return $html;
    }

    /**
     * Returns HTML to display a "Turn editing on/off" button in a form.
     *
     * @param moodle_url $url The URL + params to send through when clicking the button
     * @return string HTML the button
     * @copyright 2012 Tiny Bootstrap Project
     * @author Mary L.Evans
     */
    public function edit_button(moodle_url $url) {
        $content = '';
        $url->param('sesskey', sesskey());
        if ($this->page->user_is_editing()) {
            $url->param('edit', 'off');
            $btn = 'btn-danger';
            $icon = 'icon-edit';
            $alt = get_string('turneditingoff');
        } else {
            $url->param('edit', 'on');
            $btn = 'btn-success';
            $icon = 'icon-off';
            $alt = get_string('turneditingon');
        }
        $itag = html_writer::tag('i', '', array('class' => 'icon-white ' . $icon));
        $content .= html_writer::link($url,
                    $itag,
                    array('class' => 'btn btn-mini ' . $btn,
                          'title' => $alt,
                          'alt' => $alt));

                    return $content;

    }
}
