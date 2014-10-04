Porting Data from edX to moodle
===============================

These scripts help you to transfer content from edX to moodle. Open the folders to get more information.
<br>For edX installation, please refer to our Installation Documentation at [IITB-FRG-Site](http://www.it.iitb.ac.in/frg/brainstorming/sites/default/files/P4_rajarshi14_Week_04_Report_01_2014_06_04_edX_Installation_Guide.zip).

<br>For moodle installation, refer to the [Official moodle Installation Documentation](http://docs.moodle.org/25/en/Step-by-step_Installation_Guide_for_Ubuntu).

##Course Transfer

1. Replace the username 'rajarshi' with your username in the files present in this folder. <br>
(sed -i 's/rajarshi/yourusername/g' *)
2. Install edX.
3. Install moodle and install the rebuild course cache plugin (https://moodle.org/plugins/pluginversion.php?id=2400).
4. Replace the course.py in the edx_all/edx-platform/cms/djangoapps/contentstore/views folder with the course.py available in this folder.
5. Create a course in edX and automatically it gets transferred to moodle.


##Image Transfer

1. Replace the username 'rajarshi' with your username in the files present in this folder. <br>
(sed -i 's/rajarshi/yourusername/g' *)
2. Install edX.
3. Install moodle and install the rebuild course cache plugin (https://moodle.org/plugins/pluginversion.php?id=2400).
4. Replace the index.php in the /var/www/moodle/admin/tool/rebuildcoursecache folder with the index.php available in this folder.
5. Replace the utils.py in edx_all/edx-platform/cms/djangoapps/contentstore/ with the utils.py in this folder.
6. Add an full screen image in a unit in edX.
7. The image gets transferred to the specific moodle course.

##PDF Transfer

1. Replace the username 'rajarshi' with your username in the files present in this folder. <br>
(sed -i 's/rajarshi/yourusername/g' *)
2. Install edX.
3. Install moodle and install the rebuild course cache plugin (https://moodle.org/plugins/pluginversion.php?id=2400).
4. Replace the index.php in the /var/www/moodle/admin/tool/rebuildcoursecache folder with the index.php available in this folder.
5. Replace the assets.py in edx_all/edx-platform/cms/djangoapps/contentstore/views/ with the assets.py in this folder.
6. Upload a PDF file in a course in edX.
7. The PDF gets transferred to the specific moodle course.

##Question Transfer

1. Replace the username 'rajarshi' with your username in the files present in this folder. <br>
(sed -i 's/rajarshi/yourusername/g' *)
2. Install edX.
3. Install moodle and install the rebuild course cache plugin (https://moodle.org/plugins/pluginversion.php?id=2400).
4. Replace the index.php in the /var/www/moodle/admin/tool/rebuildcoursecache folder with the index.php available in this folder.
5. Replace the utils.py in edx_all/edx-platform/cms/djangoapps/contentstore/ with the utils.py in this folder.
6. Add a multiple choice single correct question in a unit in edX.
7. The question gets transferred to the specific moodle course.

##Section Transfer

1. Replace the username 'rajarshi' with your username in the files present in this folder. <br>
(sed -i 's/rajarshi/yourusername/g' *)
2. Install edX.
3. Install moodle and install the rebuild course cache plugin (https://moodle.org/plugins/pluginversion.php?id=2400).
4. Replace the index.php in the /var/www/moodle/admin/tool/rebuildcoursecache folder with the index.php available in this folder.
5. Replace the course.py in the edx_all/edx-platform/cms/djangoapps/contentstore/views folder with the course.py available in this folder.
6. Make a section in a course in edX.
7. The section automatically gets transferred as a Topic in the specific moodle course.

##User Transfer

1. Replace the username 'rajarshi' with your username in the files present in this folder. <br>
(sed -i 's/rajarshi/yourusername/g' *)
2. Install edX.
3. Install moodle and install the rebuild course cache plugin (https://moodle.org/plugins/pluginversion.php?id=2400).
4. Replace the shortcuts.py in the edx_all/edx-platform/common/djangoapps/edxmako folder with the shortcuts.py available in this folder.
5. Create a new user in edX and automatically it gets transferred to moodle.


##Video Transfer

1. Replace the username 'rajarshi' with your username in the files present in this folder. <br>
(sed -i 's/rajarshi/yourusername/g' *)
2. Install edX.
3. Install moodle and install the rebuild course cache plugin (https://moodle.org/plugins/pluginversion.php?id=2400).
4. Replace the index.php in the /var/www/moodle/admin/tool/rebuildcoursecache folder with the index.php available in this folder.
5. Replace the utils.py in edx_all/edx-platform/cms/djangoapps/contentstore/ with the utils.py in this folder.
6. Add a video in a unit in edX.
7. The video gets transferred to the specific moodle course.
