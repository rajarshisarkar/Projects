# To Run this script: python generate_edgelist.py

import networkx as nx

textline = ['1 2 3', '7 11 9', '7 10', '13']
G = nx.read_edgelist(textline, create_using=nx.DiGraph(), nodetype=int, data=(('weight',float),))
print G.nodes()
print "Number of nodes:", G.number_of_nodes()
print G.edges(data = True)
