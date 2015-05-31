<?php
define('CLI_SCRIPT', true);
define('NO_OUTPUT_BUFFERING', true);
require_once('../../../config.php');
require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->libdir.'/adminlib.php');
$sure = optional_param('sure', 0, PARAM_BOOL);
//$specifyids = optional_param('specifyids', '', PARAM_NOTAGS);
$specifyids = $argv[1];
echo $specifyids."\n";

/// Rebuilds course cache
echo $OUTPUT->notification(get_string('notifyrebuilding', 'tool_rebuildcoursecache'), 'notifysuccess');
if (empty($specifyids)) {
    rebuild_course_cache();
} else {
    echo $OUTPUT->box_start();
    $courseids = preg_split("/[\s,]+/", $specifyids);
    foreach ($courseids as $courseid) {
        if ($DB->record_exists('course', array('id'=>$courseid))) {
            rebuild_course_cache($courseid);
            echo get_string('success', 'tool_rebuildcoursecache', $courseid);
        } else {
            echo get_string('fail', 'tool_rebuildcoursecache', $courseid);
        }
    }
    echo $OUTPUT->box_end();
}
echo $OUTPUT->notification(get_string('notifyfinished', 'tool_rebuildcoursecache'), 'notifysuccess');