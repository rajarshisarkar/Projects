# To Run this script: python run_degree_distribution_yearwise.py

import os
for x in range (1975,2005+1):
	os.system('python degree_distribution_yearwise.py '+str(x)+' > ../data/adjlistfile_till_year_'+str(x));
