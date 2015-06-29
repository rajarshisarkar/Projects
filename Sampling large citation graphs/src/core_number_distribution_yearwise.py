# To Run this script: python core_number_distribution_yearwise.py

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
endyear = 2005

for xyz in range(curyear, endyear+1):
	print "Year", xyz,":"
	fh1 = open("../data/adjlistfile_till_year_"+str(xyz))
	G1 = nx.read_adjlist(fh1, create_using=nx.DiGraph())
	G1.remove_edges_from(G1.selfloop_edges())
	core_numbers = nx.core_number(G1) # dictionary node:core number
	values = sorted(set(core_numbers.values()))
	hist = [core_numbers.values().count(x) for x in values]
	#nodes = G.number_of_nodes()
	#newhist = [float(x)/nodes for x in hist]

	plt.figure()
	plt.xlim(min(values)-.5, max(values)+.5)
	plt.plot(values,hist,'mo-')
	plt.title('Core number distribution plot till year '+str(xyz))
	plt.xlabel('Core Number')
	plt.ylabel('Number of nodes')
	plt.savefig('../graphs/Core number Distribution till year '+str(xyz)+'.png')
	plt.close()
