# To Run this script: python run_generate_adjlist_largestcomponent.py

import os
for x in range (1999,2005+1):
	os.system('python generate_adjlist_largestcomponent.py '+str(x)+'> ../data/adjlistfile_largestcomponent_till_year_'+str(x));
