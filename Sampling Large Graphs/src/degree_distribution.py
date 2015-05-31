# To Run this script: python degree_distribution.py

import networkx as nx
import matplotlib.pyplot as plt

fh=open("../data/adjlistfile", 'rb')
G = nx.read_adjlist(fh, create_using=nx.DiGraph())

degrees = G.degree() # dictionary node:degree
values = sorted(set(degrees.values()))
hist = [degrees.values().count(x) for x in values]
nodes = G.number_of_nodes()
newhist = [float(x)/nodes for x in hist]

plt.figure()
plt.yscale('log')
plt.xscale('log')
plt.xlim(0.8,10000)
plt.plot(values,newhist,'ro')
plt.title('Degree Distribution')
plt.xlabel('Degree, k')
plt.ylabel('Fraction of nodes, P(k)')
plt.savefig('../graphs/Degree Distribution.png')
plt.close()
