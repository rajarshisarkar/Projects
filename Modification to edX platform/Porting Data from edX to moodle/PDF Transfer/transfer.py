import subprocess
import os

# Combines the mongodb chunks to make the file
os.chdir("/home/rajarshi/edx_to_moodle_synchronisation/pdf_transfer")

proc = subprocess.Popen("javac -classpath /home/rajarshi/edx_to_moodle_synchronisation/pdf_transfer/mongo-2.10.1.jar:/home/rajarshi/edx_to_moodle_synchronisation/pdf_transfer/mysql-connector-java-5.0.8-bin.jar:/home/rajarshi/edx_to_moodle_synchronisation/pdf_transfer/sqlite-jdbc-3.7.2.jar edx_to_moodle_send_pdf_get_courseid.java", shell=True, stdout=subprocess.PIPE)
proc = subprocess.Popen("java -classpath '.:/home/rajarshi/edx_to_moodle_synchronisation/pdf_transfer/mongo-2.10.1.jar:/home/rajarshi/edx_to_moodle_synchronisation/pdf_transfer/mysql-connector-java-5.0.8-bin.jar:/home/rajarshi/edx_to_moodle_synchronisation/pdf_transfer/sqlite-jdbc-3.7.2.jar' edx_to_moodle_send_pdf_get_courseid", shell=True, stdout=subprocess.PIPE)
script_response_a = proc.stdout.read()
script_response_a = script_response_a.rstrip()
print script_response_a

roc = subprocess.Popen("javac -classpath /home/rajarshi/edx_to_moodle_synchronisation/pdf_transfer/mongo-2.10.1.jar:/home/rajarshi/edx_to_moodle_synchronisation/pdf_transfer/mysql-connector-java-5.0.8-bin.jar:/home/rajarshi/edx_to_moodle_synchronisation/pdf_transfer/sqlite-jdbc-3.7.2.jar edx_to_moodle_send_pdf_get_filename.java", shell=True, stdout=subprocess.PIPE)
proc = subprocess.Popen("java -classpath '.:/home/rajarshi/edx_to_moodle_synchronisation/pdf_transfer/mongo-2.10.1.jar:/home/rajarshi/edx_to_moodle_synchronisation/pdf_transfer/mysql-connector-java-5.0.8-bin.jar:/home/rajarshi/edx_to_moodle_synchronisation/pdf_transfer/sqlite-jdbc-3.7.2.jar' edx_to_moodle_send_pdf_get_filename", shell=True, stdout=subprocess.PIPE)
script_response_b = proc.stdout.read()
script_response_b = script_response_b.rstrip()
print script_response_b

mongocommand="mongodump --collection fs.chunks --db xcontent -q \'{ $and: [{\"files_id.name\":\""+script_response_b+"\"}, {\"files_id.course\": \""+script_response_a+"\"} ]}\'"
b=""
print mongocommand+b
os.system(""+mongocommand+"")


# Gets Contenthash
proc = subprocess.Popen("php /home/rajarshi/edx_to_moodle_synchronisation/pdf_transfer/contenthash.php", shell=True, stdout=subprocess.PIPE)
script_response = proc.stdout.read()

# Copies the file to moodledata/filedir directory
ab = script_response[0:2]
cd = script_response[2:4]
os.chdir("/var/moodledata/filedir")
os.system("mkdir -p "+ab+"/"+cd+"")
os.system("cp /home/rajarshi/edx_to_moodle_synchronisation/pdf_transfer/dump/xcontent/fs.chunks.bson /var/moodledata/filedir/"+ab+"/"+cd+"/"+script_response+"")

# Change Permission of moodledata/filedir/ab/cd directory
#os.system('chmod 777 -R *')
#os.system('chown www-data -R *')
#os.system('chgrp www-data -R *')

# Runs the JDBC program to populate the MySQL tables
os.chdir('/home/rajarshi/edx_to_moodle_synchronisation/pdf_transfer')
proc = subprocess.Popen("javac -classpath /home/rajarshi/edx_to_moodle_synchronisation/pdf_transfer/mongo-2.10.1.jar:/home/rajarshi/edx_to_moodle_synchronisation/pdf_transfer/mysql-connector-java-5.0.8-bin.jar:/home/rajarshi/edx_to_moodle_synchronisation/pdf_transfer/sqlite-jdbc-3.7.2.jar /home/rajarshi/edx_to_moodle_synchronisation/pdf_transfer/edx_to_moodle_send_pdf.java", shell=True, stdout=subprocess.PIPE)
proc = subprocess.Popen("java -classpath '.:/home/rajarshi/edx_to_moodle_synchronisation/pdf_transfer/mongo-2.10.1.jar:/home/rajarshi/edx_to_moodle_synchronisation/pdf_transfer/mysql-connector-java-5.0.8-bin.jar:/home/rajarshi/edx_to_moodle_synchronisation/pdf_transfer/sqlite-jdbc-3.7.2.jar' edx_to_moodle_send_pdf", shell=True, stdout=subprocess.PIPE)
script_response_a = proc.stdout.read()
script_response_a = script_response_a.rstrip()
print script_response_a.count("\n")

# Rebuilds Course Cache
if script_response_a.count("\n")>5 and 'Exception' not in script_response_a:
	roc = subprocess.Popen("javac -classpath /home/rajarshi/edx_to_moodle_synchronisation/pdf_transfer/mongo-2.10.1.jar:/home/rajarshi/edx_to_moodle_synchronisation/pdf_transfer/mysql-connector-java-5.0.8-bin.jar:/home/rajarshi/edx_to_moodle_synchronisation/pdf_transfer/sqlite-jdbc-3.7.2.jar edx_to_moodle_send_pdf_get_moodle_courseid.java", shell=True, stdout=subprocess.PIPE)
	proc = subprocess.Popen("java -classpath '.:/home/rajarshi/edx_to_moodle_synchronisation/pdf_transfer/mongo-2.10.1.jar:/home/rajarshi/edx_to_moodle_synchronisation/pdf_transfer/mysql-connector-java-5.0.8-bin.jar:/home/rajarshi/edx_to_moodle_synchronisation/pdf_transfer/sqlite-jdbc-3.7.2.jar' edx_to_moodle_send_pdf_get_moodle_courseid", shell=True, stdout=subprocess.PIPE)
	script_response_b = proc.stdout.read()
	script_response_b = script_response_b.rstrip()
	print script_response_b
	os.chdir('/var/www/moodle/admin/tool/rebuildcoursecache')
	os.system('php index.php '+script_response_b)