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
 * Main page for Course deleter local plugin
 * @package local_deletecourse
 * @author  Amit Bhardwaj (amit@geduservices.com)
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../config.php');
require_login();
require_capability('local/deletecourse:delete', context_system::instance());

$PAGE->set_url(new moodle_url('/local/deletecourse/index.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('deletecourses', 'local_deletecourse'));
$PAGE->set_heading(get_string('deletecourses', 'local_deletecourse'));

echo $OUTPUT->header();

$mform = new \local_deletecourse\form\delete_courses_form();

if ($mform->is_cancelled()) {
    redirect(new moodle_url('/admin/index.php'));
} else if ($data = $mform->get_data()) {
    // Convert comma-separated string to array, trim whitespace
    $courseid_array = array_map('trim', explode(',', $data->courseid));

    // Merge arrays and remove duplicates
    $merged_courseids = array_unique(array_merge($data->courseids, $courseid_array));

    // Optionally re-index the array
    $merged_courseids = array_values($merged_courseids);
    if (empty($data->courseid)) {
        $merged_courseids = $data->courseids;
    }
    \local_deletecourse\manager::delete_selected_courses($merged_courseids);
    echo $OUTPUT->notification(get_string('successdelete', 'local_deletecourse'), 'notifysuccess');
}

$mform->display();
echo $OUTPUT->footer();
