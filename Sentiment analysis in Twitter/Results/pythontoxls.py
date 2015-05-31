# python pythontoxls.py
import xlwt
from xlwt import Workbook,XFStyle,Borders, Pattern, Font, easyxf

book = xlwt.Workbook(encoding="utf-8") 
sheet1 = book.add_sheet("Sentiment Analysis Results")  
first_col = sheet1.col(0)
second_col = sheet1.col(1)
third_col = sheet1.col(2)
fourth_col = sheet1.col(3)
fifth_col = sheet1.col(4)
first_col.width = 256 * 15
second_col.width = 256 * 19
third_col.width = 256 * 29
fourth_col.width = 256 * 21
fifth_col.width = 256 * 15

font = Font()
font.bold = True
boldfont = XFStyle()
boldfont.font = font

f = open(r'../Sentiment-Dictionary-Approach/output.txt') 
contents = f.read().split('\n') 
tweet1 = [] 
sentiment1 = [] 
i = 0 
while i<len(contents)-1: 
      tweet1.append (contents[i]) 
      sentiment1.append (contents[i+1]) 
      i+=2 
f.close() 

f = open(r'../Naive-Bayes-Approach/output.txt') 
contents = f.read().split('\n') 
tweet2 = [] 
sentiment2 = [] 
i = 0 
while i<len(contents)-1: 
      tweet2.append (contents[i]) 
      sentiment2.append (contents[i+1]) 
      i+=2 
f.close() 

f = open(r'../SVM-Approach/output.txt') 
contents = f.read().split('\n') 
tweet3 = [] 
sentiment3 = [] 
i = 0 
while i<len(contents)-1: 
      tweet3.append (contents[i]) 
      sentiment3.append (contents[i+1]) 
      i+=2 
f.close() 

f = open(r'Manually-Classified.txt') 
contents = f.read().split('\n') 
tweet4 = [] 
sentiment4 = [] 
i = 0 
while i<len(contents)-1: 
      tweet4.append (contents[i]) 
      sentiment4.append (contents[i+1]) 
      i+=2 
f.close() 

sheet1.write(0, 0, 'Tweet No.', boldfont)
sheet1.write(0, 1, 'Manually Classified', boldfont)
sheet1.write(0, 2, 'Sentiment Dictionary Approach', boldfont)
sheet1.write(0, 3, 'Naive Bayes Approach', boldfont)
sheet1.write(0, 4, 'SVM Approach', boldfont)



for i in range(0, 1000):
	sheet1.write(1+i, 0, "Tweet No: "+str(i+1))
	
for i in range(0, 1000):
	sheet1.write(1+i, 1, sentiment4[i].split(': ', 1)[1][32:-18])
	
for i in range(0, 1000):
	sheet1.write(1+i, 2, sentiment1[i].split(': ', 1)[1][32:-18])

for i in range(0, 1000):
	sheet1.write(1+i, 3, sentiment2[i].split(': ', 1)[1][32:-18])

for i in range(0, 1000):
	sheet1.write(1+i, 4, sentiment3[i].split(': ', 1)[1][32:-18])
	
book.save("Sentiment Analysis Results.xls")
