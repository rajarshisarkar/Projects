Projects
========

This repository contains some projects that I have worked on.

##Decipher - Online Treasure Hunt

Decipher - an Online Treasure Hunt is a game in which players or treasure hunters search for answers to the questions given online. The answers or clues can be hidden anywhere on the Internet. Players use clues and hints given along with the question to get the answer. Once they enter the correct answer they are presented with the next question until they have finished all the questions.

Tech Used: HTML, PHP, JavaScript, JQuery, CSS, MySQL, WampServer.


##Graphical Password Authentication System

Graphical passwords provide a promising alternative to traditional alphanumeric passwords. They are attractive since people usually remember pictures better than words. It is an authentication system that works by having the user select from images, in a specific order, presented in a graphical user interface . For this reason, the graphical-password approach is sometimes called graphical user authentication (GUA). Graphical passwords may offer better security than text-based passwords because many people, in an attempt to memorize text-based passwords, The system combines graphical and text-based passwords trying to achieve the best of both worlds. It also provides multi-factor authentication in a friendly intuitive system.

Tech Used: HTML, PHP, JavaScript, JQuery, CSS, MySQL, WampServer.

##Modification-to-edX-Platform

For edX installation, please refer to our Installation Documentation at [IITB-FRG-Site](http://www.it.iitb.ac.in/frg/brainstorming/sites/default/files/P4_rajarshi14_Week_04_Report_01_2014_06_04_edX_Installation_Guide.zip).

For moodle installation, refer to the [Official moodle Installation Documentation](http://docs.moodle.org/25/en/Step-by-step_Installation_Guide_for_Ubuntu).

###edX Distributed Platform for Course Synchronisation

####Up and Running with RCMS

Your edX Installation folder should have this structure.
* cms
  * envs
    * common.py
  * urls.py
* common
  * djangoapps
    * rcms
      * dump
      * logs
        * rcms.log
      * update
      * admin.py
      * \_\_init\_\_.py
      * models.py
      * rcms.cfg
      * tasks.py
      * views.py
  * static
    * rcms
      * dibu_server.css
  * templates
    * remote_sync
      * not_authorized.html
      * server_interface.html
      * user_interface.html

Change the **dump\_path**, **update\_path**, **log\_path** in **rcms.cfg** to **rcms** folder in your edX Installation directory.
See the **rcms.cfg** file for more information.   
Copy all the files present in **Remote_Course_Management_System** folder to your edx-Installation directory according to the folder structure.
Create a Virtual Environment using these commands:   
`export WORKON_HOME=$HOME/.virtualenvs`   
`source /etc/bash_completion.d/virtualenvwrapper`   
`workon edx-platform`  
Change your current directory to **edx-platform** having **manage.py** file.   
Make **manage.py** executable by:   
`sudo chmod +x manage.py`   
Then sync db using:   
`./manage.py cms syncdb`   
`./manage.py cms syncdb --migrate`   
Automatic Update has been implemented using **__celery beat__**, which is pre-installed in edX.
For automatic update, you need to install rabbitmq-server for ubuntu:   
Download Link: [rabbitmq](http://www.rabbitmq.com/download.html)   
`sudo dpkg -i install rabbitmq-server*.deb`   
`sudo apt-get -f install`    
First make a periodic task by going to **django-admin**, then **djcelery** tab, then **periodic task**, **add periodic task**
Select **rcms.tasks.update** from registered tasks. select an interval, and save the task.
Now create a Virtual Environment by these commands:   
`export WORKON_HOME=$HOME/.virtualenvs`   
`source /etc/bash_completion.d/virtualenvwrapper`   
`workon edx-platform`   
Change your current directory to **edx-platform** directory having a **manage.py** file.   
Make **manage.py** executable by:   
`sudo chmod +x manage.py`   
Now Run **celery beat** using manage.py:   
`./manage.py cms celery beat`

Access RCMS-Admin Panel using **http://localhost:8001/rcms** and signin using admin/superuser account which you created earlier during 
installation process.   
To Access University Panel on Remote-Machine: **http://(Your Public IP):8001/rcms** and signin with University Account.   
The University Account is a user-account verified by Django-admin of edX. Just go to Django-admin by visiting **http://localhost:8001/admin**
log in with your superuser credentials, then go to 'rcms' panel, then 'universities', add the user from the dropdown list and enter other details manually.

###Porting data from edX to moodle

These scripts help you to transfer content from edX to moodle. Keep the 'Porting Data from edX to moodle' folder at your home directory.

####Course Transfer

1. Replace the username 'rajarshi' with your username in the files present in this folder. <br>
(sed -i 's/rajarshi/yourusername/g' *)
2. Install edX.
3. Install moodle and install the rebuild course cache plugin (https://moodle.org/plugins/pluginversion.php?id=2400).
4. Replace the course.py in the edx_all/edx-platform/cms/djangoapps/contentstore/views folder with the course.py available in this folder.
5. Create a course in edX and automatically it gets transferred to moodle.


####Image Transfer

1. Replace the username 'rajarshi' with your username in the files present in this folder. <br>
(sed -i 's/rajarshi/yourusername/g' *)
2. Install edX.
3. Install moodle and install the rebuild course cache plugin (https://moodle.org/plugins/pluginversion.php?id=2400).
4. Replace the index.php in the /var/www/moodle/admin/tool/rebuildcoursecache folder with the index.php available in this folder.
5. Replace the utils.py in edx_all/edx-platform/cms/djangoapps/contentstore/ with the utils.py in this folder.
6. Add an full screen image in a unit in edX.
7. The image gets transferred to the specific moodle course.

####PDF Transfer

1. Replace the username 'rajarshi' with your username in the files present in this folder. <br>
(sed -i 's/rajarshi/yourusername/g' *)
2. Install edX.
3. Install moodle and install the rebuild course cache plugin (https://moodle.org/plugins/pluginversion.php?id=2400).
4. Replace the index.php in the /var/www/moodle/admin/tool/rebuildcoursecache folder with the index.php available in this folder.
5. Replace the assets.py in edx_all/edx-platform/cms/djangoapps/contentstore/views/ with the assets.py in this folder.
6. Upload a PDF file in a course in edX.
7. The PDF gets transferred to the specific moodle course.

####Question Transfer

1. Replace the username 'rajarshi' with your username in the files present in this folder. <br>
(sed -i 's/rajarshi/yourusername/g' *)
2. Install edX.
3. Install moodle and install the rebuild course cache plugin (https://moodle.org/plugins/pluginversion.php?id=2400).
4. Replace the index.php in the /var/www/moodle/admin/tool/rebuildcoursecache folder with the index.php available in this folder.
5. Replace the utils.py in edx_all/edx-platform/cms/djangoapps/contentstore/ with the utils.py in this folder.
6. Add a multiple choice single correct question in a unit in edX.
7. The question gets transferred to the specific moodle course.

####Section Transfer

1. Replace the username 'rajarshi' with your username in the files present in this folder. <br>
(sed -i 's/rajarshi/yourusername/g' *)
2. Install edX.
3. Install moodle and install the rebuild course cache plugin (https://moodle.org/plugins/pluginversion.php?id=2400).
4. Replace the index.php in the /var/www/moodle/admin/tool/rebuildcoursecache folder with the index.php available in this folder.
5. Replace the course.py in the edx_all/edx-platform/cms/djangoapps/contentstore/views folder with the course.py available in this folder.
6. Make a section in a course in edX.
7. The section automatically gets transferred as a Topic in the specific moodle course.

####User Transfer

1. Replace the username 'rajarshi' with your username in the files present in this folder. <br>
(sed -i 's/rajarshi/yourusername/g' *)
2. Install edX.
3. Install moodle and install the rebuild course cache plugin (https://moodle.org/plugins/pluginversion.php?id=2400).
4. Replace the shortcuts.py in the edx_all/edx-platform/common/djangoapps/edxmako folder with the shortcuts.py available in this folder.
5. Create a new user in edX and automatically it gets transferred to moodle.

####Video Transfer

1. Replace the username 'rajarshi' with your username in the files present in this folder. <br>
(sed -i 's/rajarshi/yourusername/g' *)
2. Install edX.
3. Install moodle and install the rebuild course cache plugin (https://moodle.org/plugins/pluginversion.php?id=2400).
4. Replace the index.php in the /var/www/moodle/admin/tool/rebuildcoursecache folder with the index.php available in this folder.
5. Replace the utils.py in edx_all/edx-platform/cms/djangoapps/contentstore/ with the utils.py in this folder.
6. Add a video in a unit in edX.
7. The video gets transferred to the specific moodle course.

##Online Complaint Lodging System

An Online Complaint Lodging System lets you easily lodge complaints.
A user can lodge, view status and print receipt of electrical and civil complaints while an admin can update status of complaints, add/edit locations, contractors and suppliers.

Tech Used: HTML, PHP, JavaScript, JQuery, CSS, Oracle Database 11g, TCPDF, WampServer.


##Online Quiz Application

An Online Quiz Application lets you easily build quizzes. The administrator can build quizzes while the students can attempt those quizzes. Marks are shown instantly when a quiz is over.

Tech Used: HTML, PHP, JavaScript, CSS, MySQL, WampServer.
