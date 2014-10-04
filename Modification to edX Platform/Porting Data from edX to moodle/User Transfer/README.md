User Transfer
=============

1. Replace the username 'rajarshi' with your username in the files present in this folder. <br>
(sed -i 's/rajarshi/yourusername/g' *)
2. Install edX.
3. Install moodle and install the rebuild course cache plugin (https://moodle.org/plugins/pluginversion.php?id=2400).
4. Replace the shortcuts.py in the edx_all/edx-platform/common/djangoapps/edxmako folder with the shortcuts.py available in this folder.
5. Create a new user in edX and automatically it gets transferred to moodle.
