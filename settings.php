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
 * Settings for Course deleter local plugin
 * @package local_deletecourse
 * @author  Amit Bhardwaj (amit@geduservices.com)
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

 defined('MOODLE_INTERNAL') || die();

 if ($hassiteconfig) {
     // 1. Create a subcategory under 'courses' for the plugin.
     $ADMIN->add('courses', new admin_category('local_deletecourse_category', get_string('pluginname', 'local_deletecourse')));
 
     // 2. Create the settings page.
     $settings = new admin_settingpage('local_deletecourse_settings', get_string('settings', 'local_deletecourse'));
 
     $settings->add(new admin_setting_configcheckbox(
         'local_deletecourse/enablescheduleddeletion',
         get_string('enablescheduleddeletion', 'local_deletecourse'),
         get_string('enablescheduleddeletion_desc', 'local_deletecourse'),
         0
     ));
 
     $settings->add(new admin_setting_configtext(
         'local_deletecourse/inactivitydays',
         get_string('inactivitydays', 'local_deletecourse'),
         get_string('inactivitydays_desc', 'local_deletecourse'),
         365,
         PARAM_INT
     ));
 
     $settings->add(new admin_setting_configcheckbox(
         'local_deletecourse/dryrunmode',
         get_string('dryrunmode', 'local_deletecourse'),
         get_string('dryrunmode_desc', 'local_deletecourse'),
         1
     ));
 
     $settings->add(new admin_setting_configtext(
         'local_deletecourse/notificationemail',
         get_string('notificationemail', 'local_deletecourse'),
         get_string('notificationemail_desc', 'local_deletecourse'),
         '',
         PARAM_EMAIL
     ));
 
     // 3. Add the settings page to the custom subcategory.
     $ADMIN->add('local_deletecourse_category', $settings);
 
     // 4. Add an external page under the same custom subcategory.
     $ADMIN->add('local_deletecourse_category', new admin_externalpage(
         'local_deletecourse',
         get_string('deletecourses','local_deletecourse'),
         new moodle_url('/local/deletecourse/index.php'),
         'moodle/course:delete'
     ));
 }
 