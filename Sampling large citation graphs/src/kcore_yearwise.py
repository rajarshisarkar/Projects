# To Run this script: python kcore_yearwise.py

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
curyear = 1975

for x in range(curyear, 2005+1):
	print "Year", x,":"
	fh1 = open("../data/adjlistfile_till_year_"+str(x))
	G1 = nx.read_adjlist(fh1, create_using=nx.DiGraph())
	G1.remove_edges_from(G1.selfloop_edges())
	G2 = nx.k_core(G1)
	normalisedkcoresize.append(float(G2.number_of_nodes())/float(G1.number_of_nodes()))
	year.append(x)
	#print G2.number_of_nodes()
	'''
	for line in nx.generate_adjlist(G2):
		print(line)
	'''
	
plt.figure()
plt.xlim(1974,2006)
plt.plot(year,normalisedkcoresize,'m^-')
plt.suptitle('Normalised size of main core vs Year plot', fontsize=14)
plt.xlabel('Year')
plt.ylabel('Normalised size of main core')
plt.savefig('../graphs/Normalised size of main core vs Year plot.png')
plt.close()
