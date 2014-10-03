from django.db import models
from django.contrib import admin
from django.contrib.auth.models import User
# Create your models here.


class OfferedCourse(models.Model):
	name = models.CharField(max_length=30)
	course_id = models.CharField(max_length=10, unique= True)
	org = models.CharField(max_length=50)
	start_date = models.DateField(blank = True)
	course_url = models.URLField(blank = True)

	def __unicode__(self):
		return u'%s %s %s' %(self.name, self.course_id, self.org)

	def getName(self):
		return self.name

	def getCourseId(self):
		return self.course_id

	def getStartDate(self):
		return self.start_date

	def getCourseUrl(self):
		return self.course_url

	def getOrg(self):
		return self.org

class Universitie(models.Model):
	user = models.OneToOneField(User, unique=True)
	name = models.CharField(max_length = 100,unique= True)
	city = models.CharField(max_length = 30)
	state = models.CharField(max_length = 30)
	courses_taken = models.CharField(max_length = 1000, blank = True)
	server_ip = models.CharField(max_length=30, blank = True)

	def __unicode__(self):
		return self.name

	def getName(self):
		return self.name

	def getCoursesTaken(self):
		return self.courses_taken

	def getServerIp(self):
		return self.server_ip



class courseAdmin(admin.ModelAdmin):
    list_display = ('name', 'course_id', 'org')
    search_fields = ('course_id', 'name')
    list_filter = ('course_id','org',)

class universityAdmin(admin.ModelAdmin):
    list_display = ('user', 'name', 'courses_taken')
    search_fields = ('name', 'user')


admin.site.register(Universitie,universityAdmin)
admin.site.register(OfferedCourse,courseAdmin)
