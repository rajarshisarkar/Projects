Projects
========

This repository contains some projects that I have worked on.

##Android: demo applications

Some demo android applications I created while learning android application development.

Technologies used: Java.

##Decipher: Online Treasure Hunt

Decipher: an Online Treasure Hunt is a game in which players or treasure hunters search for answers to the questions given online. The answers or clues can be hidden anywhere on the Internet. Players use clues and hints given along with the question to get the answer. Once they enter the correct answer they are presented with the next question until they have finished all the questions.

Technologies Used: HTML, PHP, JavaScript, JQuery, CSS, MySQL, WampServer.


##Graphical Password Authentication System

Graphical passwords provide a promising alternative to traditional alphanumeric passwords. They are attractive since people usually remember pictures better than words. It is an authentication system that works by having the user select from images, in a specific order, presented in a graphical user interface . For this reason, the graphical-password approach is sometimes called graphical user authentication (GUA). Graphical passwords may offer better security than text-based passwords because many people, in an attempt to memorize text-based passwords, The system combines graphical and text-based passwords trying to achieve the best of both worlds. It also provides multi-factor authentication in a friendly intuitive system.

Technologies Used: HTML, PHP, JavaScript, JQuery, CSS, MySQL, WampServer.

##Modification to edX platform

For edX installation, please refer to our Installation Documentation at [IITB-FRG-Site](http://www.it.iitb.ac.in/frg/brainstorming/sites/default/files/P4_rajarshi14_Week_04_Report_01_2014_06_04_edX_Installation_Guide.zip).

For moodle installation, refer to the [Official moodle Installation Documentation](http://docs.moodle.org/25/en/Step-by-step_Installation_Guide_for_Ubuntu).

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

##Online Complaint Lodging System

An Online Complaint Lodging System lets you easily lodge complaints.
A user can lodge, view status and print receipt of electrical and civil complaints while an admin can update status of complaints, add/edit locations, contractors and suppliers.

Technologies Used: HTML, PHP, JavaScript, JQuery, CSS, Oracle Database 11g, TCPDF, WampServer.


##Online Quiz Application

An Online Quiz Application lets you easily build quizzes. The administrator can build quizzes while the students can attempt those quizzes. Marks are shown instantly when a quiz is over.

Technologies Used: HTML, PHP, JavaScript, CSS, MySQL, WampServer.

##Sampling large citation graphs
To derive a representative sample of a large citation network.

Technologies used: Ubuntu 14.10, Python, Java, Git.

##Scheduled delivery in e-commerce

E-commerce has, undeniably, ushered in a new era, where all the hassles that a shopaholic (or anybody else for that matter) faces have been eliminated. From searching stuff, to adding them to the cart, to actually buying them have all turned into a cakewalk. But there is something that still bothers the customer. TIME!

Imagine you broke the frame of your spectacles and ordered one online. You went to work and returned with sore eyes and a terrible headache in the evening only to read this SMS while scanning your message inbox:

"The product could not be delivered as the addressee was not available."

Right product. Right price. Then what went wrong?

Irrespective of how amazing a product is, or the enormous discount at which it is available, the purchase either does not take place or becomes troublesome if the customer is not available; hence the importance of this app. It ensures smooth delivery and receipt of products. All a customer intending to buy a product has to do is fill up two extra blanks - DATE on which they want their product delivered,and a TIME SLOT of 30 minutes within which they want their product delivered. And bingo! The product is at their doorstep on that very day within the time frame provided by them. The customer is no longer uncertain about the delivery of the product, receives it on time, and is happy with the overall experience. The delivery associate who happens to be a company employee, is just as happy, since he does not have to go to the same place again and again owing to customer unavailability. And ofcourse, the company earns more because of the higher level of customer satisfaction. As a future prospect, the company can even charge the customers who wish to avail this service of delivering things on convenient dates and time slots; resort to peak pricing based on a set of criteria including the selected dates and time slots, the existing delivery traffic and the availability of delivery associates; thereby enabling generation of greater revenue for the company.

In a nutshell, the customer is benefited. And so is the company!

A win win situation, no?

Techologies used: HTML, PHP, JavaScript, JQuery, CSS, MySQL, XAMPP

### To run the web app online:

01. Open the web browser and type 'tinyurl.com/scheduleddeliveryinecommerce' in the URL box. Press enter to go to the online version of the app.
02. To login use the following credentials:
	* Customer (username: a, password: b)
	* Admin (username: admin, password: admin)
03. Login as a customer to place your order by selecting your delivery date and time slot.
04. Login as an admin to see the comprehensive list of scheduled deliveries arranged according to date, timeslots and pincodes.

### To run the web app locally on your system:

01. Install XAMPP.
02. Run XAMPP and start the Apache server and MySQL server.
03. Make sure that your system is connected to the internet as the app fetches data using Walmart's Open API. Without internet the app will not run.
04. Copy the 'src' folder to '~/xampp/htdocs' where ~ denotes the installation directory of XAMPP.
05. Open the web browser and type 'localhost/phpmyadmin/' in the URL box.
06. Create a database named 'preferred_delivery_time_db' and import the 'preferred_delivery_time_db.sql' file from 'src' folder.
07. Go to '~/xampp/htdocs/src' and modify the values of $username and $password variable of connect.php file if the username and password of your MySQL server varies from the one given in connect.php.
08. Open the web browser and type 'localhost/src/index.php' in the URL box to run the app.
09. To login use the following credentials:
	* Customer (username: a, password: b)
	* Admin (username: admin, password: admin)
10. Login as a customer to place your order by selecting your delivery date and time slot.
11. Login as an admin to see the comprehensive list of scheduled deliveries arranged according to date, timeslots and pincodes.

##Sentiment analysis in Twitter

For the purpose of research, we define sentiment to be "a personal positive or negative feeling" and when there is an absence of this, we treat it as a neutral sentiment.Eg: Considering tweets, "Dammmmm we Love Football" is a positive tweet, "phone going on airplane mode" is a neutral tweet and "Pep Guardiola to resign as Barcelona boss" is a negative tweet.

Technologies Used: Python.

###Sentiment Dictionary Approach

A file having 2482 words and their sentiment value (ranging from -5 to 5) is maintained. We call this file Sentiment Dictionary. A word and its sentiment in the Sentiment Dictionary is seperated by a tab character, i.e., "\t". A very positive word like "happy" is given a sentiment value of 5. A neutral word like "aeroplane" is given a sentiment value close to 0. A very negative word like "hate" is given a sentiment value of -5.

####Algorithm
The algorithm for Sentiment Dictionary Approach is as follows:<br>
1. Get all the words present in the tweet.<br>
2. Add the sentiment value of all words while referring to the Sentiment Dictionary. If the word is not present in the Sentiment Dictionary then add 0.<br>
3. If the cumulative sentiment value is positive then the tweet is positive.<br>
4. If the cumulative sentiment value is zero then the tweet is neutral.<br>
5. If the cumulative sentiment value is negative then the tweet is negative.

###Naive Bayes' Approach

In machine learning, naive Bayes classifiers are a family of simple probabilistic classifiers based on applying Bayes' theorem with strong (naive) independence assumptions between the features. Naive Bayes classifiers are highly scalable, requiring a number of parameters linear in the number of variables (features/predictors) in a learning problem. Maximum-likelihood training can be doneby evaluating a closed-form expression, which takes linear time, rather than by expensive iterative approximation as used for many other types of classifiers In the statistics and computer science literature, Naive Bayes models are known under a variety of names, including simple Bayesand independence Bayes. All these names reference the use of Bayes‟ theorem in the classifier's decision rule, but naive Bayes is not (necessarily) a Bayesian method;Russell and Norvig note that naive Bayes is sometimes called a Bayesian classifier, a somewhat careless usage that has prompted true Bayesians to call it the idiot Bayes model.

####Algorithm
The algorithm for Naive Bayes Approach is as follows:<br>
1. Preprocess the testing tweets.<br>
2. Remove all the stopwords (this, we, etc.) from the training and testing set.<br>
3. Estimate the probability P(c) of each class c by dividing the number of words in tweets in c by the total number of words in the training data set.<br>
4. Estimate the probability distribution P(w|c) for all words w and classes c. This can be done by dividing the number of occurences of w in tweets in c by the total number of words in c.<br>
5. To find the score of a tweet t for class c, calculate: score(t, c) = P(c)P(w1|c)P(w2|c).....P(wn|c).<br>
6. To predict the most likely class label, just pick the c with the highest score value.


###Support Vector Machine Approach

In machine learning, support vector machines (SVMs, also support vector networks) are supervised learning models with associated learning algorithms that analyze data and recognize patterns, used for classification and regression analysis. Given a set of training examples, each marked as belonging to one of two categories, an SVM training algorithm builds a model that assigns new examples into one category or the other, making it a non-probabilistic binary linear classifier. An SVM model is a representation of the examples as points in space, mapped so that the examples of the separate categories are divided by a clear gap that is as wide as possible. New examples are then mapped into that same space and predicted to belong to a category based on which side of the gap they fall on. In addition to performing linear classification, SVMs can efficiently perform a non-linear classification using what is called the kernel trick, implicitly mapping their inputs into high-dimensional feature spaces.

####Algorithm
The algorithm for Support Vector Machine Approach is as follows:<br>
1. Train the linear multiclass SVM classifier based on training tweet data set. Each training tweet is mapped into the hyperplane with help of its feature list.<br>
2. Preprocess the testing tweets and build a feature list for each tweet.<br>
3. Map each testing tweet into the hyperplane with help of its feature list to know the class of the tweet.