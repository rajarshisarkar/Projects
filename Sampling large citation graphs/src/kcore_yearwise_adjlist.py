# To Run this script: python kcore_yearwise_adjlist.py <year>

import networkx as nx
import matplotlib.pyplot as plt
import sys
from matplotlib.legend_handler import HandlerLine2D
from matplotlib.font_manager import FontProperties
import random
import math
from scipy.stats import ks_2samp
import numpy as np

year = []
normalisedkcoresize = []
curyear = int(sys.argv[1])
#print "Year", curyear,":"
for x in range(curyear, curyear+1):
	fh1 = open("../data/adjlistfile_till_year_"+str(x))
	G1 = nx.read_adjlist(fh1)
	G1.remove_edges_from(G1.selfloop_edges())
	G2 = nx.k_core(G1)
	#print G2.number_of_nodes()
	
	for line in nx.generate_adjlist(G2):
		print(line)
	
'''	
plt.figure()
plt.xlim(0,60)
plt.plot(samplepercents100,biases,'b^-')
plt.suptitle('Average Clustering Coefficient Bias vs Random node sample % plot till year '+str(curyear), fontsize=14)
plt.xlabel('Random node sample %')
plt.ylabel('Average Clustering Coefficient Bias')
plt.savefig('../graphs/Average Clustering Coefficient Bias vs Random node sample % plot till year '+str(curyear)+'.png')
plt.close()
'''
