import ConfigParser
import os
from celery.task import task
from rcms.models import OfferedCourse, Universitie

def config():
	mydir = os.path.dirname(os.path.abspath(__file__))
	configFilePath = os.path.join(mydir, '', 'rcms.cfg')
	configParser = ConfigParser.RawConfigParser()
	configParser.read(configFilePath)
	return configParser

@task
def update():
	uni = Universitie.objects.all()
	for u in uni:
		courses = u.courses_taken
		courses = courses.split(';')
		for course in courses:
			c_id = str(course)
			ip = str(u.server_ip)
			if c_id != "":
				print "Updating %s of %s" %(c_id, str(u.user))
				configParser = config()
				update_path = configParser.get('Path', 'update_path')
				logs_path = configParser.get('Path', 'logs_path')

				cmd_export = "mongoexport --db xmodule --collection modulestore -q '{\"_id.course\":\"" + c_id + "\"}' --out " + update_path +"modulestore.bson"
				os.system("date " + ">> " + logs_path)
				os.system(cmd_export + ">> " + logs_path)

				cmd_export = "mongoexport --db xcontent --collection fs.chunks -q '{\"files_id.course\":\"" + c_id + "\"}' --out " + update_path + "fs.chunks.bson"
				os.system("date " + ">> " + logs_path)
				os.system(cmd_export + ">> " + logs_path)

				cmd_export = "mongoexport --db xcontent --collection fs.files -q '{\"_id.course\":\"" + c_id + "\"}' --out " + update_path + "fs.files.bson"
				os.system("date " + ">> " + logs_path)
				os.system(cmd_export + ">> " + logs_path)

				cmd_import = "mongoimport --db xcontent --collection fs.files --upsert " + update_path + "fs.files.bson" + " --host " + ip
				x=os.system(cmd_import + ">> " + logs_path)

				cmd_import = "mongoimport --db xmodule --collection modulestore --upsert " + update_path + "modulestore.bson" + " --host " + ip
				x=os.system(cmd_import + ">> " + logs_path)

				cmd_import = "mongoimport --db xcontent --collection fs.chunks --upsert " + update_path + "fs.chunks.bson" + " --host " + ip
				x=os.system(cmd_import + ">> " + logs_path)
	#c_id = "CN101"
	#ip = str(request.META['REMOTE_ADDR'])
	#ip = "10.105.14.157"