<?php
// This file is part of the CampusConnect plugin for Moodle - http://moodle.org/
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
 * Handles the importing of membership lists from the ECS
 *
 * @package   core_course
 * @copyright  2024 Jacob Viertel
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core_course;

/**
 * Class to handle the importing of membership lists from the ECS
 *
 * @package   core_course
 * @copyright  2024 Jacob Viertel
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class hook_callbacks {
    /**
     * Handle the before_course_viewed hook.
     *
     * @param \core_course\hook\before_course_viewed $hook The hook object containing course data.
     */
    public static function handle_before_course_viewed(\core_course\hook\before_course_viewed $hook): void {
        global $CFG;
        if (file_exists($CFG->dirroot . '/course/externservercourse.php')) {
            include($CFG->dirroot . '/course/externservercourse.php');
            if (function_exists('extern_server_course')) {
                if ($externurl = extern_server_course($hook->course)) {
                    redirect($externurl);
                }
            }
        }
    }
}
