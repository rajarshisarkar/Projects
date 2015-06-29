# To Run this script: python randomsampling_diameter.py <year> >> ../data/randomsampling_diameter

import networkx as nx
import matplotlib.pyplot as plt
import sys
from matplotlib.legend_handler import HandlerLine2D
from matplotlib.font_manager import FontProperties
import random
import math

avgdiameter = 0
n = 5
curyear = int(sys.argv[1])
print "Year "+str(curyear)+":"
for iteration in range(0,n):
	year = []
	largestcomponent = []
	randomnodes = []
	for x in range(curyear, curyear+1):
		fh2 = open("../data/adjlistfile_largestcomponent_till_year_"+str(x))
		G2 = nx.read_adjlist(fh2)

		samplesize = int(0.01*G2.number_of_nodes())
		'''
		seen = set(randomnodes)
		for x in randomnodes:
			neighbors_list = [tt for tt in G2.neighbors(x) if tt not in seen]
			if len(randomnodes) + len(neighbors_list) < samplesize:
				randomnodes.extend(neighbors_list)
				seen.update(neighbors_list)
			else:
				randomnodes.extend(neighbors_list[:samplesize-len(randomnodes)])
				break

		randomconnectednodes = set(randomnodes)
		print "Number of nodes in the random sample #",iteration+1,":", len(randomconnectednodes)
		#print randomconnectednodes
		
		maxeccentricity = 0
		for x in randomconnectednodes:
			#print nx.eccentricity(G2, x)
			if nx.eccentricity(G2, x) > maxeccentricity:
				maxeccentricity = nx.eccentricity(G2, x)
		#print maxeccentricity
		'''
		
		while len(randomnodes)<=samplesize:
				if randomnodes.count(random.choice(G2.nodes())) == 0:
					randomnodes.append(random.choice(G2.nodes()))
		
		maxeccentricity = 0
		for x in randomnodes:
			#print nx.eccentricity(G2, x)
			if nx.eccentricity(G2, x) > maxeccentricity:
				maxeccentricity = nx.eccentricity(G2, x)
		#print maxeccentricity
					
		diameter = maxeccentricity
		#randomconnectedsubgraph = G2.subgraph(randomnodes)
		#diameter = nx.diameter(randomconnectedsubgraph)
		print "Number of nodes in the random sample #",iteration+1,":", len(randomnodes)
		print "Diameter of the random sample:", diameter
		avgdiameter += diameter
#print avgdiameter
print "Average Diameter till year",curyear,"(ceil value) :", int(math.ceil(float(float(avgdiameter)/float(n))))
print
