# To Run this script: python run_generate_adjlist_largestcomponent.py

import networkx as nx
import matplotlib.pyplot as plt
import sys
from matplotlib.legend_handler import HandlerLine2D
from matplotlib.font_manager import FontProperties

x = int(sys.argv[1])
year = []
largestcomponent = []

fh=open("../data/adjlistfile_till_year_"+str(x))
G = nx.read_adjlist(fh, create_using=nx.DiGraph())
G = G.to_undirected()
#print "Year "+str(x)+":"
#print "Number of nodes:", G.number_of_nodes()
#print "Number of isolates:", len(nx.isolates(G))
G.remove_nodes_from(nx.isolates(G))
#print "Number of nodes after removing isolates:", G.number_of_nodes()
components = sorted(nx.connected_components(G), key = len, reverse=True)
largestcomponent = G.subgraph(components[0])
year.append(x)

for line in nx.generate_adjlist(largestcomponent):
	print(line)
