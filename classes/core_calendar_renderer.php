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
 * This file contains the renderers for the calendar within Moodle.
 *
 * @copyright 2016 byLazyDaisy.uk
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @package calendar
 */

require_once($CFG->dirroot . '/calendar/renderer.php');

class theme_gologo_core_calendar_renderer extends core_calendar_renderer {

    /**
     * Produces the content for the three months block (pretend block).
     *
     * This includes the previous month, the current month, and the next month.
     *
     * @param calendar_information $calendar
     * @return string
     */
    public function fake_block_threemonths(calendar_information $calendar) {
        // Get the calendar type we are using.
        $calendartype = \core_calendar\type_factory::get_calendar_instance();

        $date = $calendartype->timestamp_to_date_array($calendar->time);

        $prevmonth = calendar_sub_month($date['mon'], $date['year']);
        $prevmonthtime = $calendartype->convert_to_gregorian($prevmonth[1], $prevmonth[0], 1);
        $prevmonthtime = make_timestamp($prevmonthtime['year'], $prevmonthtime['month'], $prevmonthtime['day'],
            $prevmonthtime['hour'], $prevmonthtime['minute']);

        $nextmonth = calendar_add_month($date['mon'], $date['year']);
        $nextmonthtime = $calendartype->convert_to_gregorian($nextmonth[1], $nextmonth[0], 1);
        $nextmonthtime = make_timestamp($nextmonthtime['year'], $nextmonthtime['month'], $nextmonthtime['day'],
            $nextmonthtime['hour'], $nextmonthtime['minute']);

        $content  = html_writer::start_tag('div', array('class' => 'minicalendarblock1 span4'));
        $content .= calendar_get_mini($calendar->courses, $calendar->groups, $calendar->users,
                    false, false, 'display', $calendar->courseid, $prevmonthtime);
        $content .= html_writer::end_tag('div');
        $content .= html_writer::start_tag('div', array('class' => 'minicalendarblock2 span4'));
        $content .= calendar_get_mini($calendar->courses, $calendar->groups, $calendar->users,
                    false, false, 'display', $calendar->courseid, $calendar->time);
        $content .= html_writer::end_tag('div');
        $content .= html_writer::start_tag('div', array('class' => 'minicalendarblock3 span4'));
        $content .= calendar_get_mini($calendar->courses, $calendar->groups, $calendar->users,
                    false, false, 'display', $calendar->courseid, $nextmonthtime);
        $content .= html_writer::end_tag('div');

        return $content;
    }
}
