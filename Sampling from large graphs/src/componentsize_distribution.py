# To Run this script: python componentsize_distribution.py

import networkx as nx
import matplotlib.pyplot as plt
import sys
from matplotlib.legend_handler import HandlerLine2D
from matplotlib.font_manager import FontProperties

year = []

for z in range(1975, 1980+1):
	componentsizes = []
	componentsizescount = []
	uniquecomponentssizes = []
	fh=open("../data/adjlistfile_till_year_"+str(z))
	G = nx.read_adjlist(fh, create_using=nx.DiGraph())
	G = G.to_undirected()
	print "Year "+str(z)+":"
	G.remove_nodes_from(nx.isolates(G))
	print "Number of nodes after removing isolates:", G.number_of_nodes()
	components = sorted(nx.connected_components(G), key = len, reverse=True)
	for x in range(0, len(components)):
		componentsizes.append(len(components[x]))
	componentsizesset = set(componentsizes)
	uniquecomponentssizes = list(componentsizesset)
	for x in componentsizesset:
		componentsizescount.append(componentsizes.count(x))
	summation = 0
	for x in range(0, len(uniquecomponentssizes)):
		print uniquecomponentssizes[x],":",componentsizescount[x] # values stored here
		summation += uniquecomponentssizes[x]*componentsizescount[x]
	print "Number of nodes after removing isolates:", summation
	print
	year.append(z)
	
	plt.figure()
	plt.xlim(-50,max(uniquecomponentssizes)+50)
	plt.plot(uniquecomponentssizes,componentsizescount,'r^')

	plt.title('Component size distribution till year '+str(z))
	plt.xlabel('Component Size')
	plt.ylabel('Number of components')
	plt.savefig('../graphs/Component size distribution till year '+str(z)+'.png')
	plt.close()
