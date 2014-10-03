# Create your views here.
from rcms.models import *
from django.shortcuts import render, redirect
from django.http import HttpResponse
import datetime
import time
from django.conf import settings
from django.contrib.auth import logout, authenticate, login
from django.contrib.auth.models import User, AnonymousUser
from django.contrib.auth.decorators import login_required
from django.contrib.auth.views import password_reset_confirm
from django.contrib import messages
from django.core.context_processors import csrf
import os
from student.models import (
	Registration, UserProfile, PendingNameChange,
	PendingEmailChange, CourseEnrollment, unique_id_for_user,
	CourseEnrollmentAllowed, UserStanding, LoginFailures,
	create_comments_service_user, PasswordHistory,CourseAccessRole
)
from xmodule.modulestore.django import modulestore
from contentstore import views
from contentstore.utils import (
    get_lms_link_for_item,
    )
import socket
import ConfigParser

def config():
	mydir = os.path.dirname(os.path.abspath(__file__))
	configFilePath = os.path.join(mydir, '', 'rcms.cfg')
	configParser = ConfigParser.RawConfigParser()
	configParser.read(configFilePath)
	return configParser

@login_required
def rcms(request,success):
	#success = int(success)
	user = request.user
	#course_data = []
	#all_courses = views.course._accessible_courses_list(request)
	#for course in all_courses :
	#	course_data.append(course.id)
	#return HttpResponse(course_data)
	#uni = Universitie.objects.get(user = user)
	id_list = []
	offered_list = []
	errors_main= []
	colour = []
	links = []
	if user.is_staff:
		course_list = modulestore('direct').get_courses()
		#course_list = CourseAccessRole.objects.all()
		final_list = []
		offered_list = OfferedCourse.objects.all()
		for course in offered_list : 
			id_list.append(course.course_id)
		#return HttpResponse(id_list)
		for course in course_list :
			
		
			#return HttpResponse(course.course_id)
			if str(course.id).split('+')[1] not in id_list:
				final_list.append(course)


		
		colleges_reg = Universitie.objects.all()
		if success == '3':
			errors_main.append("No options selected")
			colour.append("blue")
		if success == '2' :
			errors_main.append("Course already offerd")
			colour.append("red")
		return render(request, 'remote_sync/server_interface.html', {'error':True,'colour': colour, 'error_main_list': errors_main, 'course_list': final_list, 'offer_list' : offered_list, 'college_list': colleges_reg})
			

	else:
		try :
			uni = Universitie.objects.get(user=user)
		except :
			return render(request, 'remote_sync/not_authorized.html', {'request' : request})

		ip = str(request.META['REMOTE_ADDR'])
		uni.server_ip = ip
		uni.save()

		course_taken=uni.courses_taken
		list_course = course_taken.split(';')
		course_list = []
		opted_list= []

		#return HttpResponse(len(list_crs))
		course_offered_list = OfferedCourse.objects.all()
		#return HttpResponse(len(course_offered_list))
		for course in course_offered_list:
			if course.course_id not in list_course :
				course_list.append(course)
			else:
				opted_list.append(course)

		if success == '1':
			errors_main.append("Course Transfer Successful!")
			colour.append("green")

		elif success == '0' :
			errors_main.append("Course Transfer Failed!")
			colour.append("red")

		elif success == '3' :
			errors_main.append("No Option selected")
			colour.append("blue")
		elif success == '4' :
			errors_main.append("Error.Unable to Process Request")
			colour.append("red")

		return render(request, 'remote_sync/user_interface.html',{'error_main_list': errors_main, 'colour':colour,'course_list': course_list, 'opted_list': opted_list})   

		   




	#return render_to_response('course_list.html',dict(csr = csr,))
@login_required
def offercourse(request):
	if 'course' in request.GET:
		allcourse = request.GET.getlist('course')
		#return HttpResponse(allcourse)
		for selcourse in allcourse :
			

			selcourse = str(selcourse)
			organization = (selcourse.split(":")[1]).split('+')[0]
			id_req = selcourse.split("+")[1]
			course_run = selcourse.split("+")[2]
			#id_modifier= organization+"/"+id_req+"/"+course_run
			courses = modulestore('direct').get_courses()
			for course in courses:
				#return  HttpResponse(course.id)
				if str(course.id) == selcourse :
					#return HttpResponse(course.id)
					req_course = course
					break
			#return HttpResponse(course)
			url = get_lms_link_for_item(req_course.location)
			b = OfferedCourse(course_url = url, name = req_course.display_name, course_id = id_req, org = organization, start_date = time.strftime("%Y-%m-%d"))
			b.save()


		return redirect('/rcms/')

	else :
		return redirect('/rcms/3')
@login_required
def unoffercourse(request):
	if 'course' in request.GET :
		allcourse = request.GET.getlist('course')
		for selcourse in allcourse :


			selcourse = str(selcourse)
			csr = OfferedCourse.objects.get(course_id = selcourse)
			csr.delete()
		return redirect('/rcms/')
	else :
		return redirect('/rcms/1')

@login_required
def commitcourse(request):
	if 'course' in request.GET:
		success = transfer(request)
		if success == 0:
			user = request.user
			uni = Universitie.objects.get(user=user)
			c_id = request.GET['course']
			str_temp = str(uni.courses_taken)
			str_temp+=";"+c_id
			uni.courses_taken = str_temp
			uni.save()
			#return HttpResponse(request.get_host())
			#return HttpResponse("DONE")
			return redirect('/rcms/1',)

		else:
			return redirect('/rcms/0',)
	else :
		return redirect('/rcms/3',)


@login_required
def uncommitcourse(request):
	if 'course' in request.GET:
		user = request.user
		uni = Universitie.objects.get(user=user)

		c_id = str(request.GET['course']).split('+')[0]
		org = str(request.GET['course']).split('+')[1]
		ip = str(request.META['REMOTE_ADDR'])

		configParser = config()
		logs_path = configParser.get('Path', 'logs_path')

		#file1 =  open("/home/dibu/edx_all/edx-platform/common/djangoapps/rcms/uncommit_request.js","w")
		#query_uncommit = "db.modulestore.remove({\"_id.course\":\""+c_id+"\"})"
		#file1.write(query_uncommit)
		#cmd = "mongo \"" + ip + ":27017/xmodule\" /home/dibu/edx_all/edx-platform/common/djangoapps/rcms/uncommit_request.js"
		#return HttpResponse(cmd)
		try:
			query_uncommit = " 'db.modulestore.remove({$and: [{\"_id.course\":\"" +c_id+"\"},{\"_id.org\":\""+ org +"\"}]})'"
			cmd = "mongo \""+ip+":27017/xmodule\" --eval "+ query_uncommit
			#return HttpResponse(cmd)
			os.system("date " + ">> " + logs_path)
			x = os.system(cmd + ">> " + logs_path) 
			
			if x != 0 :
				return redirect('/rcms/4')

			query_uncommit = " 'db.fs.files.remove({$and: [{\"_id.course\":\"" +c_id+"\"},{\"_id.org\":\""+ org +"\"}]})'"
			cmd = "mongo \""+ip+":27017/xcontent\" --eval "+ query_uncommit
			os.system("date " + ">> " + logs_path)
			x = os.system(cmd + ">> " + logs_path)
			#return HttpResponse(cmd)

			if x != 0 :
				return redirect('/rcms/4')

			query_uncommit = " 'db.fs.chunks.remove({$and: [{\"files_id.course\":\"" +c_id+"\"},{\"files_id.org\":\""+ org +"\"}]})'"
			cmd = "mongo \""+ip+":27017/xcontent\" --eval "+ query_uncommit
			os.system("date " + ">> " + logs_path)
			x = os.system(cmd + ">> " + logs_path)

			if x != 0 :
				return redirect('/rcms/4')

		except:
			return redirect('/rcms/4')


		str_temp = str(uni.courses_taken)
		str_temp = str_temp.split(';')
		str_temp.remove(c_id)
		str_temp = ";".join(str_temp)
		uni.courses_taken = str_temp
		uni.save()

		return redirect('/rcms/')

	else :
		return redirect('/rcms/3')
@login_required
def update_course(request,courseid):
	user = request.user
	c_id = courseid
	ip = str(request.META['REMOTE_ADDR'])

	try:

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

		if x != 0 :
			return HttpResponse(x)
			return redirect('/rcms/4')

		cmd_import = "mongoimport --db xmodule --collection modulestore --upsert " + update_path + "modulestore.bson" + " --host " + ip
		x=os.system(cmd_import + ">> " + logs_path)

		if x != 0 :
			return HttpResponse(x)
			return redirect('/rcms/4')

		cmd_import = "mongoimport --db xcontent --collection fs.chunks --upsert " + update_path + "fs.chunks.bson" + " --host " + ip
		x=os.system(cmd_import + ">> " + logs_path)

		if x != 0 :
			return HttpResponse(x)
			return redirect('/rcms/4')

	except:
		return redirect('/rcms/4')



	return redirect('/rcms/1')
@login_required
def transfer(request):
	course_selected = request.GET['course']
	#course_selected = csr_data.split(' ')[1]
	ip = str(request.META['REMOTE_ADDR'])

	configParser = config()
	dump_path = configParser.get('Path', 'dump_path')
	logs_path = configParser.get('Path', 'logs_path')

	#modulestore
	cmd = "mongodump --collection modulestore --db xmodule --query \'{\"_id.course\":\"" + course_selected + "\"}\'" + " --out " + dump_path# --host " + ip + " --port 27017"
	x = os.system(cmd + ">> " + logs_path)

	cmd_restore = "mongorestore --collection modulestore --db xmodule " + dump_path + "xmodule/modulestore.bson" +" --host " + ip + " --port 27017"
	x = os.system(cmd_restore + ">> " + logs_path)


	#fs.files
	cmd = "mongodump --collection fs.files --db xcontent --query \'{\"_id.course\":\"" + course_selected + "\"}\'" + " --out " + dump_path # --host " + ip + " --port 27017"
	x = os.system(cmd + ">> " + logs_path)

	cmd_restore = "mongorestore --collection fs.files --db xcontent " + dump_path +"xcontent/fs.files.bson --host " + ip + " --port 27017"
	x = os.system(cmd_restore + ">> " + logs_path)

	#fs.chunks
	cmd = "mongodump --collection fs.chunks --db xcontent --query \'{\"files_id.course\":\"" + course_selected + "\"}\'" + " --out " + dump_path# --host " + ip + " --port 27017"
	x = os.system(cmd + ">> " + logs_path)

	
	cmd_restore = "mongorestore --collection fs.chunks --db xcontent " + dump_path +"/xcontent/fs.chunks.bson --host " + ip + " --port 27017"
	x = os.system(cmd_restore + ">> " + logs_path)
	return x
