# To Run this script: python yearwise_largestcomponentsize.py

import networkx as nx
import matplotlib.pyplot as plt
import sys
from matplotlib.legend_handler import HandlerLine2D
from matplotlib.font_manager import FontProperties

year = []
largestcomponentsize = []

for x in range(1975, 2005+1):
	fh=open("../data/adjlistfile_till_year_"+str(x))
	G = nx.read_adjlist(fh, create_using=nx.DiGraph())
	G = G.to_undirected()
	print "Year "+str(x)+":"
	#print "Number of nodes:", G.number_of_nodes()
	#print "Number of isolates:", len(nx.isolates(G))
	G.remove_nodes_from(nx.isolates(G))
	print "Number of nodes after removing isolates:", G.number_of_nodes()
	#print "Graph connected?:", nx.is_connected(G)
	#print "Number of connected components:", nx.number_connected_components(G)
	components = sorted(nx.connected_components(G), key = len, reverse=True)
	#print "Number of connected components:", len(components)
	largestcomponent = G.subgraph(components[0])
	print "Largest Component Size:", len(largestcomponent)
	largestcomponentsize.append(len(largestcomponent))
	year.append(x)

plt.figure()
plt.xlim(1974,2006)
fontP = FontProperties()
plt.plot(year,largestcomponentsize,'r^-')

plt.title('Largest Component Size vs Year plot')
plt.xlabel('Year')
plt.ylabel('Largest Component Size')
plt.savefig('../graphs/Largest Component Size vs Year plot.png')
plt.close()
