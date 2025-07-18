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
 * Language String for Course deleter local plugin
 * @package local_deletecourse
 * @author  Amit Bhardwaj (amit@geduservices.com)
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['pluginname'] = 'Course Deleter';
$string['courseids'] = 'Delete Courses via ID';
$string['courseids_help'] = 'Comma separated Course ID';
$string['courseids_desc'] = 'Comma seperated course ids.';
$string['deletecourses'] = 'Delete Courses';
$string['confirmdelete'] = 'Are you sure you want to delete the selected courses?';
$string['nocourses'] = 'No courses found matching your criteria.';
$string['successdelete'] = 'Courses deleted successfully.';
$string['delete_old_courses_task'] = 'Scheduled deletion of old/inactive courses';
$string['enablescheduleddeletion'] = 'Enable scheduled course deletion';
$string['enablescheduleddeletion_desc'] = 'If enabled, a scheduled task will run daily to delete courses inactive for a specified number of days.';
$string['inactivitydays'] = 'Days of inactivity before deletion';
$string['inactivitydays_desc'] = 'Courses not accessed in this number of days will be considered for deletion.';
$string['dryrunmode'] = 'Enable dry-run mode';
$string['dryrunmode_desc'] = 'When enabled, no courses are deleted. A preview list will be emailed to the specified address.';
$string['notificationemail'] = 'Notification email address';
$string['notificationemail_desc'] = 'Email address to send the dry-run or deletion reports.';
$string['settings'] = 'Delete course settings';
$string['deletedcoursesheader'] = 'The following courses were deleted:';
$string['dryrunreport'] = 'Dry Run Report';
$string['deletionreport'] = 'Deletion Report';
$string['deletecourse:delete'] = 'Delete courses';
//Privacy Api 
$string['privacy:metadata'] = 'The Delete Course plugin does not store any personal data.';
