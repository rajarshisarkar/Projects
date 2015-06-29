# To Run this script: python yearwise_nodes_vs_edges.py

import networkx as nx
import matplotlib.pyplot as plt
import sys

nodes = []
edges = []
labels = []

for x in range(1975, 2005+1):
	fh=open("../data/adjlistfile_till_year_"+str(x))
	G = nx.read_adjlist(fh, create_using=nx.DiGraph())
	#print "Number of nodes:", G.number_of_nodes(), "in year", str(x)
	#print "Number of edges:", G.number_of_edges(), "in year", str(x)
	nodes.append(G.number_of_nodes())
	edges.append(G.number_of_edges())
	labels.append(str(x))

print edges
print nodes

plt.figure()
plt.plot(edges,nodes,'b^')
plt.title('Number of nodes vs Number of edges plot for year [1975, 2005]')
plt.xlabel('Number of edges')
plt.ylabel('Number of nodes')
'''
for labels, x, y in zip(labels, edges, nodes):
    plt.annotate(
        labels, size=8, 
        xy = (x, y), xytext = (-8, 3),
        textcoords = 'offset points')
'''
plt.savefig('../graphs/Number of nodes vs Number of edges plot for year [1975, 2005].png')
plt.close()
