# To Run this script: python yearwise_averageclusteringcoefficient.py

import networkx as nx
import matplotlib.pyplot as plt
import sys

avgclusteringcoef = []
year = []

for x in range(1975, 2005+1):
	fh=open("../data/adjlistfile_till_year_"+str(x))
	G = nx.read_adjlist(fh, create_using=nx.DiGraph())
	avgclusteringcoef.append(nx.average_clustering(G.to_undirected()))
	year.append(x)

print avgclusteringcoef
print year

plt.figure()
plt.plot(year,avgclusteringcoef,'b^')
plt.xlim(1974,2006)
plt.title('Average Clustering Coefficient vs Year plot')
plt.xlabel('Year')
plt.ylabel('Average Clustering Coefficient')
plt.savefig('../graphs/Average Clustering Coefficient vs Year plot.png')
plt.close()
