import subprocess
import os

# Gets the file from MongoDB
os.chdir("/home/rajarshi/edx_to_moodle_synchronisation/image_transfer")

proc = subprocess.Popen("javac -classpath /home/rajarshi/edx_to_moodle_synchronisation/image_transfer/mongo-2.10.1.jar:/home/rajarshi/edx_to_moodle_synchronisation/image_transfer/mysql-connector-java-5.0.8-bin.jar:/home/rajarshi/edx_to_moodle_synchronisation/image_transfer/sqlite-jdbc-3.7.2.jar edx_to_moodle_imageid_return.java", shell=True, stdout=subprocess.PIPE)
proc = subprocess.Popen("java -classpath '.:/home/rajarshi/edx_to_moodle_synchronisation/image_transfer/mongo-2.10.1.jar:/home/rajarshi/edx_to_moodle_synchronisation/image_transfer/mysql-connector-java-5.0.8-bin.jar:/home/rajarshi/edx_to_moodle_synchronisation/image_transfer/sqlite-jdbc-3.7.2.jar' edx_to_moodle_imageid_return", shell=True, stdout=subprocess.PIPE)
script_response_a = proc.stdout.read()
script_response_a = script_response_a.rstrip()
print script_response_a

mongocommand="mongodump --collection modulestore --db xmodule -q \'{ $and: [{\"_id.name\":\""+script_response_a+"\"}, {\"metadata.display_name\": \"Full Screen Image\"} ]}\'"
b=""
print mongocommand+b
os.system(""+mongocommand+"")

# Gets the image from dump
os.system('python /home/rajarshi/edx_to_moodle_synchronisation/image_transfer/dump.py > image')

# Gets Contenthash
proc = subprocess.Popen("php /home/rajarshi/edx_to_moodle_synchronisation/image_transfer/contenthash.php", shell=True, stdout=subprocess.PIPE)
script_response = proc.stdout.read()
print script_response

# Copies the file to moodledata/filedir directory
ab = script_response[0:2]
cd = script_response[2:4]
os.chdir("/var/moodledata/filedir")
os.system("mkdir -p "+ab+"/"+cd+"")
os.system("cp /home/rajarshi/edx_to_moodle_synchronisation/image_transfer/image /var/moodledata/filedir/"+ab+"/"+cd+"/"+script_response+"")

# Runs the JDBC program to populate the MySQL tables
os.chdir('/home/rajarshi/edx_to_moodle_synchronisation/image_transfer')
proc = subprocess.Popen("javac -classpath /home/rajarshi/edx_to_moodle_synchronisation/image_transfer/mongo-2.10.1.jar:/home/rajarshi/edx_to_moodle_synchronisation/image_transfer/mysql-connector-java-5.0.8-bin.jar:/home/rajarshi/edx_to_moodle_synchronisation/image_transfer/sqlite-jdbc-3.7.2.jar /home/rajarshi/edx_to_moodle_synchronisation/image_transfer/edx_to_moodle_image_transfer.java", shell=True, stdout=subprocess.PIPE)
proc = subprocess.Popen("java -classpath '.:/home/rajarshi/edx_to_moodle_synchronisation/image_transfer/mongo-2.10.1.jar:/home/rajarshi/edx_to_moodle_synchronisation/image_transfer/mysql-connector-java-5.0.8-bin.jar:/home/rajarshi/edx_to_moodle_synchronisation/image_transfer/sqlite-jdbc-3.7.2.jar' edx_to_moodle_image_transfer", shell=True, stdout=subprocess.PIPE)
script_response_a = proc.stdout.read()
script_response_a = script_response_a.rstrip()
print script_response_a.count("\n")

# Rebuilds Course Cache
if script_response_a.count("\n")>3 and 'Exception' not in script_response_a:
	roc = subprocess.Popen("javac -classpath /home/rajarshi/edx_to_moodle_synchronisation/image_transfer/mongo-2.10.1.jar:/home/rajarshi/edx_to_moodle_synchronisation/image_transfer/mysql-connector-java-5.0.8-bin.jar:/home/rajarshi/edx_to_moodle_synchronisation/image_transfer/sqlite-jdbc-3.7.2.jar edx_to_moodle_image_transfer_moodle_courseid.java", shell=True, stdout=subprocess.PIPE)
	proc = subprocess.Popen("java -classpath '.:/home/rajarshi/edx_to_moodle_synchronisation/image_transfer/mongo-2.10.1.jar:/home/rajarshi/edx_to_moodle_synchronisation/image_transfer/mysql-connector-java-5.0.8-bin.jar:/home/rajarshi/edx_to_moodle_synchronisation/image_transfer/sqlite-jdbc-3.7.2.jar' edx_to_moodle_image_transfer_moodle_courseid", shell=True, stdout=subprocess.PIPE)
	script_response_b = proc.stdout.read()
	script_response_b = script_response_b.rstrip()
	print script_response_b
	os.chdir('/var/www/moodle/admin/tool/rebuildcoursecache')
	os.system('php index.php '+script_response_b)