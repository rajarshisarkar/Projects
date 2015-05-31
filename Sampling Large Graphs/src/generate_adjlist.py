# To Run this script: python generate_adjlist.py

import networkx as nx

fh=open("../data/adjlistfile", 'rb')
G = nx.read_adjlist(fh, create_using=nx.DiGraph())
'''
for line in nx.generate_adjlist(G):
	print(line)
'''
print "Number of nodes:", G.number_of_nodes() # 771850
print "Number of edges:", G.number_of_edges() # 1197113
print "Number of isolated nodes:", len(nx.isolates(G)) # 466312
