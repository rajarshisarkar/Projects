# To Run this script: python randomwalk.py <year>

import networkx as nx
import matplotlib.pyplot as plt
import sys
from matplotlib.legend_handler import HandlerLine2D
from matplotlib.font_manager import FontProperties
import random
import math
from scipy.stats import ks_2samp
import numpy as np

pathlen = 5
curyear = int(sys.argv[1])
randomnodes = []
i = 0

fh2 = open("../data/adjlistfile_largestcomponent_till_year_"+str(curyear))
G2 = nx.read_adjlist(fh2)
source = random.choice(G2.nodes()) # source

randomnodes.append(source) 
'''
for x in range(0, pathlen):
	randomnodes.append(random.choice(G2.neighbors(randomnodes[i]))) # append neighbors randomly
	i = i+1
'''
while 1:
	randomnodes.append(random.choice(G2.neighbors(randomnodes[i]))) # append neighbors randomly
	i = i+1
	if randomnodes[i] == source: # if target=source
		break
print randomnodes	
print "Length:", len(randomnodes)	
