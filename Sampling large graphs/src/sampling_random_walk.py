# To Run this script: python sampling_random_walk.py <year>

import networkx as nx
import matplotlib.pyplot as plt
import sys
from matplotlib.legend_handler import HandlerLine2D
from matplotlib.font_manager import FontProperties
import random
import math
from scipy.stats import ks_2samp
import numpy as np

samplepercents = [.10,.20,.30,.40,.50]
samplepercents100 = [10,20,30,40,50]
biases = []
avgdvalues = []
n = 5

curyear = int(sys.argv[1])
for samplepercent in samplepercents:
	avgdvalue = 0
	avgbiasforsample = 0
	for iteration in range(0,n):
		year = []
		largestcomponent = []
		randomnodes = []
		print "Year", curyear,":"
		for x in range(curyear, curyear+1):
			fh1 = open("../data/adjlistfile_till_year_"+str(x))
			fh2 = open("../data/adjlistfile_largestcomponent_till_year_"+str(x))
			G1 = nx.read_adjlist(fh1)
			avgclusteringcoefofnetwork = nx.average_clustering(G1)
			G2 = nx.read_adjlist(fh2)
			samplesize = int(samplepercent*G2.number_of_nodes())
			'''
			source = random.choice(G2.nodes()) # sources
			randomnodes.append(source) 
			i = 0
			while len(randomnodes)<=samplesize:
				randomnodes.append(random.choice(G2.neighbors(randomnodes[i]))) # append neighbors randomly
				i = i+1
			
			'''
			source = random.choice(G2.nodes()) # sources
			randomnodes.append(source) 
			randomwalknode = source
			while len(randomnodes)<=samplesize:
				randomwalknode = random.choice(G2.neighbors(randomwalknode))
				if randomnodes.count(randomwalknode) == 0:
					randomnodes.append(randomwalknode) # append neighbors randomly
			
			print "Number of nodes in",int(samplepercent*100),"% random sample:",len(randomnodes)
			G3 = G2.subgraph(randomnodes)
			print "Number of components in",int(samplepercent*100),"% random sample:", nx.number_connected_components(G3)
			components = sorted(nx.connected_components(G3), key = len, reverse=True)
			print "Largest component size in",int(samplepercent*100),"% random sample:", len(components[0])
			avgclusteringcoefofsample = nx.average_clustering(G3)
			#avgavgclusteringcoefofsample += avgclusteringcoefofsample
			avgbiasforsample += (avgclusteringcoefofsample-avgclusteringcoefofnetwork)
			print "Average clustering coefficient of",int(samplepercent*100),"% random sample:", avgclusteringcoefofsample
			print "Bias of sample:", (avgclusteringcoefofsample-avgclusteringcoefofnetwork)
			
			degrees1 = G1.degree() # dictionary node:degree
			values1 = sorted(set(degrees1.values()))
			hist1 = [degrees1.values().count(x) for x in values1]
			nodes1 = G1.number_of_nodes()
			newhist1 = [float(x)/nodes1 for x in hist1]

			degrees2 = G3.degree() # dictionary node:degree
			values2 = sorted(set(degrees2.values()))
			hist2 = [degrees2.values().count(x) for x in values2]
			nodes2 = G3.number_of_nodes()
			newhist2 = [float(x)/nodes2 for x in hist2]
			dvalue = ks_2samp(newhist1, newhist2)[0]
			avgdvalue += dvalue
			print "D value:", dvalue
			
	print
	print "Average clustering coefficient of the network:", avgclusteringcoefofnetwork
	#print "Average of average clustering coefficient of",int(samplepercent*100),"% random sample:", avgavgclusteringcoefofsample/n
	avgbiasforsample = avgbiasforsample/n
	avgdvalue = avgdvalue/n
	print "Average D value:", avgdvalue
	print "Average Bias:", avgbiasforsample
	biases.append(avgbiasforsample)
	avgdvalues.append(avgdvalue)
	print

print
baisbyavgclusteringcoefofnetwork = []
for u in biases:
	baisbyavgclusteringcoefofnetwork.append(u/avgclusteringcoefofnetwork)
print samplepercents100
print biases
print baisbyavgclusteringcoefofnetwork
print avgdvalues
	
plt.figure()
plt.xlim(0,60)
plt.plot(samplepercents100,biases,'b^-')
plt.suptitle('Average Clustering Coefficient Bias vs Random node sample (via random walk) % plot till year '+str(curyear), fontsize=11)
plt.xlabel('Random node sample (via random walk) %')
plt.ylabel('Average Clustering Coefficient Bias')
plt.savefig('../graphs/Average Clustering Coefficient Bias vs Random node sample (via random walk) % plot till year '+str(curyear)+'.png')
plt.close()

plt.figure()
plt.xlim(0,60)
plt.plot(samplepercents100,baisbyavgclusteringcoefofnetwork,'r^-')
plt.suptitle('Average Bias/Average Clustering Coefficient vs Random node sample (via random walk) % plot till year '+str(curyear), fontsize=11)
plt.xlabel('Random node sample (via random walk) %')
plt.ylabel('Average Bias/Average Clustering Coefficient')
plt.savefig('../graphs/Average Bias by Average Clustering Coefficient vs Random node sample (via random walk) % plot till year '+str(curyear)+'.png')
plt.close()

plt.figure()
plt.xlim(0,60)
plt.plot(samplepercents100,avgdvalues,'r^-')
plt.suptitle('K-S statistic value for degree distribution vs Random node sample (via random walk) % plot till year '+str(curyear), fontsize=11)
plt.xlabel('Random node sample (via random walk) %')
plt.ylabel('K-S statistic value for degree distribution')
plt.savefig('../graphs/K-S statistic value for degree distribution vs Random node sample (via random walk) % plot till year '+str(curyear)+'.png')
plt.close()
