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
 * Schedule task for Course deleter local plugin
 * @package local_deletecourse
 * @author  Amit Bhardwaj (amit@geduservices.com)
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_deletecourse\task;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/course/lib.php');

class delete_old_courses_task extends \core\task\scheduled_task {

    public function get_name() {
        return get_string('delete_old_courses_task', 'local_deletecourse');
    }

    public function execute() {
        global $DB;
    
        if (!get_config('local_deletecourse', 'enablescheduleddeletion')) {
            mtrace('Scheduled deletion is disabled.');
            return;
        }
    
        $days = (int)get_config('local_deletecourse', 'inactivitydays');
        $dryrun = get_config('local_deletecourse', 'dryrunmode');
        $email = get_config('local_deletecourse', 'notificationemail');
        $threshold = time() - ($days * 24 * 60 * 60);
    
        $sql = "SELECT id, fullname FROM {course}
                WHERE id != :siteid AND
                      (timemodified = 0 OR timemodified < :threshold)";
        $params = ['siteid' => SITEID, 'threshold' => $threshold];
        $courses = $DB->get_records_sql($sql, $params);
    
        if (empty($courses)) {
            mtrace("No courses found for deletion.");
            return;
        }
    
        $report = "Courses inactive > $days days:\n\n";
        foreach ($courses as $course) {
            $report .= " - {$course->fullname} (ID: {$course->id})\n";
        }
    
        if ($dryrun) {
            mtrace("Dry run enabled. No courses were deleted.");
        } else {
            foreach ($courses as $course) {
                mtrace("Deleting course ID {$course->id}");
                delete_course($DB->get_record('course', ['id' => $course->id]));
            }
            $report = get_string('deletedcoursesheader', 'local_yourplugin') . "\n\n" . $report;
        }
    
        // Email report
        if (!empty($email)) {
            $subject = get_string('pluginname', 'local_deletecourse') . ': ' . ($dryrun ? get_string('dryrunreport', 'local_yourplugin') : get_string('deletionreport', 'local_yourplugin'));
            email_to_user(\core_user::get_support_user(), \core_user::get_support_user(), $subject, $report);
            mtrace("Notification sent to $email");
        }
    }
    
    
}
