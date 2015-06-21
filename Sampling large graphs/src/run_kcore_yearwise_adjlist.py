# To Run this script: python run_kcore_yearwise_adjlist.py

import os
for x in range (1975,2005+1):
	os.system('python kcore_yearwise_adjlist.py '+str(x)+'> ../data/adjlistfile_maincore_till_year_'+str(x));
