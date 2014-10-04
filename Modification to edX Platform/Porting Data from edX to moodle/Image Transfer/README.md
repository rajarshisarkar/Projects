1. Replace the username 'rajarshi' with your username in the files present in this folder. 
(sed -i 's/rajarshi/yourusername/g' *)
2. Install edX.
3. Install moodle and install the rebuild course cache plugin (https://moodle.org/plugins/pluginversion.php?id=2400).
4. Replace the index.php in the /var/www/moodle/admin/tool/rebuildcoursecache folder with the index.php available in this folder.
5. Replace the utils.py in edx_all/edx-platform/cms/djangoapps/contentstore/ with the utils.py in this folder.
6. Add an full screen image in a unit in edX.
7. The image gets transferred to the specific moodle course.
