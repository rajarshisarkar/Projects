Course Transfer
===============
For edX installation, please refer to our Installation Documentation at [IITB-FRG-Site](http://www.it.iitb.ac.in/frg/brainstorming/sites/default/files/P4_rajarshi14_Week_04_Report_01_2014_06_04_edX_Installation_Guide.zip).

<br>For moodle installation, refer to the [Official moodle Installation Documentation](http://docs.moodle.org/25/en/Step-by-step_Installation_Guide_for_Ubuntu).

1. Replace the username 'rajarshi' with your username in the files present in this folder. <br>
(sed -i 's/rajarshi/yourusername/g' *)
2. Install edX.
3. Install moodle and install the rebuild course cache plugin (https://moodle.org/plugins/pluginversion.php?id=2400).
4. Replace the course.py in the edx_all/edx-platform/cms/djangoapps/contentstore/views folder with the course.py available in this folder.
5. Create a course in edX and automatically it gets transferred to moodle.
