#Modification-to-edX-Platform

For edX installation, please refer to our Installation Documentation at [IITB-FRG-Site](http://www.it.iitb.ac.in/frg/brainstorming/sites/default/files/P4_rajarshi14_Week_04_Report_01_2014_06_04_edX_Installation_Guide.zip).

For moodle installation, refer to the [Official moodle Installation Documentation](http://docs.moodle.org/25/en/Step-by-step_Installation_Guide_for_Ubuntu).

##edX Distributed Platform for Course Synchronisation

###Up and Running with RCMS

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
##edX to moodle Synchronisation

These scripts help you to transfer content from edX to moodle. Keep the 'edx_to_moodle_synchronisation' folder at your home directory.
