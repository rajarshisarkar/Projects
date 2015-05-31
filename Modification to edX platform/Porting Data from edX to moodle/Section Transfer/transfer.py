import subprocess
import os

# Runs the JDBC program to populate the MySQL tables and Rebuild Course Cache of all Courses
os.chdir("/home/rajarshi/edx_to_moodle_synchronisation/section_transfer")

proc = subprocess.Popen("javac -classpath /home/rajarshi/edx_to_moodle_synchronisation/section_transfer/mongo-2.10.1.jar:/home/rajarshi/edx_to_moodle_synchronisation/section_transfer/mysql-connector-java-5.0.8-bin.jar:/home/rajarshi/edx_to_moodle_synchronisation/section_transfer/sqlite-jdbc-3.7.2.jar edx_to_moodle_section.java", shell=True, stdout=subprocess.PIPE)
proc = subprocess.Popen("java -classpath '.:/home/rajarshi/edx_to_moodle_synchronisation/section_transfer/mongo-2.10.1.jar:/home/rajarshi/edx_to_moodle_synchronisation/section_transfer/mysql-connector-java-5.0.8-bin.jar:/home/rajarshi/edx_to_moodle_synchronisation/section_transfer/sqlite-jdbc-3.7.2.jar' edx_to_moodle_section", shell=True, stdout=subprocess.PIPE)
script_response_a = proc.stdout.read()
script_response_a = script_response_a.rstrip()
print script_response_a.count("\n")

#Rebuilds Course Cache
if script_response_a.count("\n")>1 and 'Exception' not in script_response_a:
	roc = subprocess.Popen("javac -classpath /home/rajarshi/edx_to_moodle_synchronisation/section_transfer/mongo-2.10.1.jar:/home/rajarshi/edx_to_moodle_synchronisation/section_transfer/mysql-connector-java-5.0.8-bin.jar:/home/rajarshi/edx_to_moodle_synchronisation/section_transfer/sqlite-jdbc-3.7.2.jar edx_to_moodle_section_moodle_courseid.java", shell=True, stdout=subprocess.PIPE)
	proc = subprocess.Popen("java -classpath '.:/home/rajarshi/edx_to_moodle_synchronisation/section_transfer/mongo-2.10.1.jar:/home/rajarshi/edx_to_moodle_synchronisation/section_transfer/mysql-connector-java-5.0.8-bin.jar:/home/rajarshi/edx_to_moodle_synchronisation/section_transfer/sqlite-jdbc-3.7.2.jar' edx_to_moodle_section_moodle_courseid", shell=True, stdout=subprocess.PIPE)
	script_response_b = proc.stdout.read()
	script_response_b = script_response_b.rstrip()
	print script_response_b
	os.chdir('/var/www/moodle/admin/tool/rebuildcoursecache')
	os.system('php index.php '+script_response_b)
