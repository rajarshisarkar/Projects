import os

os.chdir('/home/rajarshi/edx_to_moodle_synchronisation/user_transfer/')
os.system('javac -classpath /home/rajarshi/edx_to_moodle_synchronisation/user_transfer/mongo-2.10.1.jar:/home/rajarshi/edx_to_moodle_synchronisation/user_transfer/mysql-connector-java-5.0.8-bin.jar:/home/rajarshi/edx_to_moodle_synchronisation/user_transfer/sqlite-jdbc-3.7.2.jar /home/rajarshi/edx_to_moodle_synchronisation/user_transfer/edx_to_mdl_user_sync.java')
os.system('java -classpath ".:/home/rajarshi/edx_to_moodle_synchronisation/user_transfer/mongo-2.10.1.jar:/home/rajarshi/edx_to_moodle_synchronisation/user_transfer/mysql-connector-java-5.0.8-bin.jar:/home/rajarshi/edx_to_moodle_synchronisation/user_transfer/sqlite-jdbc-3.7.2.jar" edx_to_mdl_user_sync')