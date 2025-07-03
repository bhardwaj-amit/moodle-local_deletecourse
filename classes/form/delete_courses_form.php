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
 * form for Course deleter local plugin
 * @package local_deletecourse
 * @author  Amit Bhardwaj (amit@geduservices.com)
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_deletecourse\form;

defined('MOODLE_INTERNAL') || die();
require_once($CFG->libdir . '/formslib.php');

class delete_courses_form extends \moodleform {
    public function definition() {
        $mform = $this->_form;

        $courses = get_courses(['sort' => 'fullname']);
        foreach ($courses as $course) {
            if ($course->id != SITEID) {
                $options[$course->id] = $course->fullname;
            }
        }

        $mform->addElement('select', 'courseids', get_string('deletecourses', 'local_deletecourse'), $options);
        $mform->getElement('courseids')->setMultiple(true);
        $mform->addElement('text', 'courseid', get_string('courseids', 'local_deletecourse'),20);
        $mform->addHelpButton('courseid', 'courseids', 'local_deletecourse');
        $mform->setType('courseid', PARAM_RAW);
        $mform->disabledIf('courseid', 'courseids', 'eq', '');
        $mform->addElement('submit', 'submitbutton', get_string('delete'));
    }
}
