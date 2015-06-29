# To Run this script: python maincore_intersection.py

import networkx as nx
import matplotlib.pyplot as plt
import sys
from matplotlib.legend_handler import HandlerLine2D
from matplotlib.font_manager import FontProperties
import random
import math
from scipy.stats import ks_2samp
import numpy as np

years = [1975,1980,1985,1990,1995,2000,2005]
year = [1980,1985,1990,1995,2000,2005]
intersection_graph = []
only_in_prev_yr_graph = []
only_in_cur_yr_graph = []

for x in years:
	if x==2005:
		break
	prevyr = x
	curyr = x+5
	fh1 = open("../data/adjlistfile_maincore_till_year_"+str(prevyr))
	fh2 = open("../data/adjlistfile_maincore_till_year_"+str(curyr))
	G1 = nx.read_adjlist(fh1)
	G2 = nx.read_adjlist(fh2)	
	
	prev_yr_tuple = G1.nodes()
	cur_yr_tuple = G2.nodes()
	prev_yr_set = set(prev_yr_tuple)
	cur_yr_set = set(cur_yr_tuple)
	intersection = len(prev_yr_set.intersection(cur_yr_set))
	only_in_prev_yr = len(prev_yr_tuple) - intersection
	only_in_cur_yr = len(cur_yr_tuple) - intersection
	union = only_in_prev_yr + only_in_cur_yr + intersection
	
	intersection_graph.append(intersection/float(union))
	only_in_prev_yr_graph.append(only_in_prev_yr/float(union))
	only_in_cur_yr_graph.append(only_in_cur_yr/float(union))
	
	print
	print prevyr,"-",curyr
	print 'Number of nodes in intersection:', intersection/float(union)
	print 'Number of nodes only in previous year:', only_in_prev_yr/float(union)
	print 'Number of nodes only in current year:', only_in_cur_yr/float(union)

print
print intersection_graph
print only_in_prev_yr_graph
print only_in_cur_yr_graph

plt.figure()
ax = plt.subplot(111)
box = ax.get_position()
ax.set_position([box.x0, box.y0 + box.height * 0.20, box.width, box.height * .80])
fontP = FontProperties()
fontP.set_size('small')
plt.xlim(1978,2007)
line1, = plt.plot(year,intersection_graph,'bo-', label='Normalised number of nodes in the intersection of main cores of current and current-5 year')
line2, = plt.plot(year,only_in_prev_yr_graph,'rs-', label='Normalised number of nodes only in the main core of current-5 year')
line3, = plt.plot(year,only_in_cur_yr_graph,'c^-', label='Normalised number of nodes only in the main core of current year')
plt.legend(loc='upper center', bbox_to_anchor=(0.5, -0.12), fancybox=True, shadow=True, ncol=1, handler_map={line1: HandlerLine2D(numpoints=2)}, prop = fontP)
plt.legend(loc='upper center', bbox_to_anchor=(0.5, -0.12), fancybox=True, shadow=True, ncol=1, handler_map={line2: HandlerLine2D(numpoints=2)}, prop = fontP)
plt.legend(loc='upper center', bbox_to_anchor=(0.5, -0.12), fancybox=True, shadow=True, ncol=1, handler_map={line3: HandlerLine2D(numpoints=2)}, prop = fontP)
plt.suptitle('Comparison of main cores', fontsize=14)
plt.xlabel('Year')
plt.ylabel('Normalised number of nodes')
plt.savefig('../graphs/Comparison of main cores.png')
plt.close()
