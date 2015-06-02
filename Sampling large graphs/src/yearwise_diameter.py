# To Run this script: python yearwise_diameter.py

import networkx as nx
import matplotlib.pyplot as plt
import sys
from matplotlib.legend_handler import HandlerLine2D
from matplotlib.font_manager import FontProperties

year = []
component1diameter = []
component2diameter = []
component3diameter = []
component4diameter = []
component5diameter = []

for x in range(1975, 1998+1):
	fh=open("../data/adjlistfile_till_year_"+str(x))
	G = nx.read_adjlist(fh, create_using=nx.DiGraph())
	G = G.to_undirected()
	print "Year "+str(x)+":"
	print "Number of nodes:", G.number_of_nodes()
	print "Number of isolates:", len(nx.isolates(G))
	G.remove_nodes_from(nx.isolates(G))
	print "Number of nodes after removing isolates:", G.number_of_nodes()
	#print "Graph connected?:", nx.is_connected(G)
	#print "Number of connected components:", nx.number_connected_components(G)
	components = sorted(nx.connected_components(G), key = len, reverse=True)
	#print "Number of connected components:", len(components)
	component1 = G.subgraph(components[0])
	component2 = G.subgraph(components[1])
	component3 = G.subgraph(components[2])
	component4 = G.subgraph(components[3])
	component5 = G.subgraph(components[4])
	component1diameter.append(nx.diameter(component1))
	component2diameter.append(nx.diameter(component2))
	component3diameter.append(nx.diameter(component3))
	component4diameter.append(nx.diameter(component4))
	component5diameter.append(nx.diameter(component5))
	year.append(x)
print component1diameter
print component2diameter
print component3diameter
print component4diameter
print component5diameter
print

plt.figure()
plt.ylim(0,50)
plt.xlim(1974,2006)
fontP = FontProperties()
fontP.set_size('small')
line1, = plt.plot(year,component1diameter,'r^-', label='Diameter of largest component')
plt.legend(loc='upper center', bbox_to_anchor=(0.5, -0.12), fancybox=True, shadow=True, ncol=2, handler_map={line1: HandlerLine2D(numpoints=2)}, prop = fontP)
line2, = plt.plot(year,component2diameter,'b^-', label='Diameter of second largest component')
plt.legend(loc='upper center', bbox_to_anchor=(0.5, -0.12), fancybox=True, shadow=True, ncol=2, handler_map={line2: HandlerLine2D(numpoints=2)}, prop = fontP)
line3, = plt.plot(year,component3diameter,'g^-', label='Diameter of third largest component')
plt.legend(loc='upper center', bbox_to_anchor=(0.5, -0.12), fancybox=True, shadow=True, ncol=2, handler_map={line3: HandlerLine2D(numpoints=2)}, prop = fontP)
line4, = plt.plot(year,component4diameter,'y^-', label='Diameter of fourth largest component')
plt.legend(loc='upper center', bbox_to_anchor=(0.5, -0.12), fancybox=True, shadow=True, ncol=2, handler_map={line4: HandlerLine2D(numpoints=2)}, prop = fontP)
line5, = plt.plot(year,component5diameter,'k^-', label='Diameter of fifth largest component')
plt.legend(loc='upper center', bbox_to_anchor=(0.5, -0.12), fancybox=True, shadow=True, ncol=2, handler_map={line5: HandlerLine2D(numpoints=2)}, prop = fontP)

ax = plt.subplot(111)
box = ax.get_position()
ax.set_position([box.x0, box.y0 + box.height * 0.15, box.width, box.height * .85])

plt.title('Diameter vs Year plot')
plt.xlabel('Year')
plt.ylabel('Diameter')
plt.savefig('../graphs/Diameter vs Year plot.png')
plt.close()
