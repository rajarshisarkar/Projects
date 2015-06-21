# To Run this script: python strongly_and_weakly_connected_components.py

import networkx as nx
import matplotlib.pyplot as plt
import sys
from matplotlib.legend_handler import HandlerLine2D
from matplotlib.font_manager import FontProperties
import random
import math

year = []
numberofstronglyconnectedcomponents = []
largeststronglyconnectedcomponent = []
numberofweaklyconnectedcomponents = []
largestweaklyconnectedcomponent = []

for x in range(1975, 2005+1):
	print "Year "+str(x)+":"
	fh1 = open("../data/adjlistfile_till_year_"+str(x))
	G1 = nx.read_adjlist(fh1, create_using=nx.DiGraph())
	G1.remove_nodes_from(nx.isolates(G1))

	stronglyconnectedcomponents = sorted(nx.strongly_connected_components(G1), key = len, reverse=True)
	print "Number of strongly connected components after removing isolates:", len(stronglyconnectedcomponents)
	print "Number of nodes in the largest strongly connected component:", len(stronglyconnectedcomponents[0])

	weaklyconnectedcomponents = sorted(nx.weakly_connected_components(G1), key = len, reverse=True)
	print "Number of weakly connected components after removing isolates:", len(weaklyconnectedcomponents)
	print "Number of nodes in the largest weakly connected component:", len(weaklyconnectedcomponents[0])
	year.append(x)
	numberofstronglyconnectedcomponents.append(len(stronglyconnectedcomponents))
	largeststronglyconnectedcomponent.append(len(stronglyconnectedcomponents[0]))
	numberofweaklyconnectedcomponents.append(len(weaklyconnectedcomponents))
	largestweaklyconnectedcomponent.append(len(weaklyconnectedcomponents[0]))
	print

plt.figure()
plt.xlim(1974,2006)
plt.plot(year,numberofstronglyconnectedcomponents,'bs-')
plt.title('Number of strongly connected components vs Year plot')
plt.xlabel('Year')
plt.ylabel('Number of strongly connected components')
plt.savefig('../graphs/Number of strongly connected components vs Year plot.png')
plt.close()

plt.figure()
plt.xlim(1974,2006)
plt.plot(year,largeststronglyconnectedcomponent,'bs-')
plt.title('Largest strongly connected component size vs Year plot')
plt.xlabel('Year')
plt.ylabel('Largest strongly connected component size')
plt.savefig('../graphs/Largest strongly connected component size vs Year plot.png')
plt.close()

plt.figure()
plt.xlim(1974,2006)
plt.plot(year,numberofweaklyconnectedcomponents,'bs-')
plt.title('Number of weakly connected components vs Year plot')
plt.xlabel('Year')
plt.ylabel('Number of weakly connected components')
plt.savefig('../graphs/Number of weakly connected components vs Year plot.png')
plt.close()

plt.figure()
plt.xlim(1974,2006)
plt.plot(year,largestweaklyconnectedcomponent,'bs-')
plt.title('Largest weakly connected component size vs Year plot')
plt.xlabel('Year')
plt.ylabel('Largest weakly connected component size')
plt.savefig('../graphs/Largest weakly connected component size vs Year plot.png')
plt.close()
