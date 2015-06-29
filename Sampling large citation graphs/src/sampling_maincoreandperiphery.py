# To Run this script: python sampling_maincoreandperiphery.py <year>

import networkx as nx
import matplotlib.pyplot as plt
import sys
from matplotlib.legend_handler import HandlerLine2D
from matplotlib.font_manager import FontProperties
import random
import math
from scipy.stats import ks_2samp
import numpy as np

samplepercent = .50
samplepercents = [.10,.20,.30,.40,.50]
samplepercents100 = [10,20,30,40,50]
biases = []
avgdvalues = []
n = 1

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
			fh3 = open("../data/adjlistfile_maincore_till_year_"+str(x))
			G1 = nx.read_adjlist(fh1)
			avgclusteringcoefofnetwork = nx.average_clustering(G1)
			G2 = nx.read_adjlist(fh2)
			samplesize = int(samplepercent*G2.number_of_nodes())
			G3 = nx.read_adjlist(fh3)
			
			# Logic
			G4 = G1.subgraph(G3)
			randomnodes = G4.nodes()
			while len(randomnodes)<=samplesize:
				randnode = random.choice(G1.nodes())
				if randomnodes.count(randnode) == 0:
					randomnodes.append(randnode)
					
			print "Number of nodes in",int(samplepercent*100),"% random sample:",len(randomnodes)
			G5 = G1.subgraph(randomnodes)
			print "Number of components in",int(samplepercent*100),"% random sample:", nx.number_connected_components(G5)
			components = sorted(nx.connected_components(G5), key = len, reverse=True)
			print "Largest component size in",int(samplepercent*100),"% random sample:", len(components[0])
			avgclusteringcoefofsample = nx.average_clustering(G5)
			#avgavgclusteringcoefofsample += avgclusteringcoefofsample
			avgbiasforsample += (avgclusteringcoefofsample-avgclusteringcoefofnetwork)
			print "Average clustering coefficient of",int(samplepercent*100),"% random sample:", avgclusteringcoefofsample
			print "Bias of sample:", (avgclusteringcoefofsample-avgclusteringcoefofnetwork)
			
			degrees1 = G1.degree() # dictionary node:degree
			values1 = sorted(set(degrees1.values()))
			hist1 = [degrees1.values().count(x) for x in values1]
			nodes1 = G1.number_of_nodes()
			newhist1 = [float(x)/nodes1 for x in hist1]

			degrees2 = G5.degree() # dictionary node:degree
			values2 = sorted(set(degrees2.values()))
			hist2 = [degrees2.values().count(x) for x in values2]
			nodes2 = G5.number_of_nodes()
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
print samplepercents100
print 'biases4 =',biases
print 'avgdvalues4 =',avgdvalues
baisbyavgclusteringcoefofnetwork = []
for u in biases:
	baisbyavgclusteringcoefofnetwork.append(u/avgclusteringcoefofnetwork)
	
plt.figure()
plt.xlim(0,60)
plt.plot(samplepercents100,biases,'b^-')
plt.suptitle('Average Clustering Coefficient Bias vs Node sample % (main core and random periphery nodes) plot till year '+str(curyear), fontsize=10)
plt.xlabel('Node sample % (main core and random periphery nodes)')
plt.ylabel('Average Clustering Coefficient Bias')
plt.savefig('../graphs/Average Clustering Coefficient Bias vs Node sample % (main core and random periphery nodes) plot till year '+str(curyear)+'.png')
plt.close()

plt.figure()
plt.xlim(0,60)
plt.plot(samplepercents100,baisbyavgclusteringcoefofnetwork,'r^-')
plt.suptitle('Average Bias/Average Clustering Coefficient vs Node sample % (main core and random periphery nodes) plot till year '+str(curyear), fontsize=10)
plt.xlabel('Node sample % (main core and random periphery nodes)')
plt.ylabel('Average Bias/Average Clustering Coefficient')
plt.savefig('../graphs/Average Bias by Average Clustering Coefficient vs Node sample % (main core and random periphery nodes) plot till year '+str(curyear)+'.png')
plt.close()

plt.figure()
plt.xlim(0,60)
plt.plot(samplepercents100,avgdvalues,'m^-')
plt.suptitle('K-S statistic value for degree distribution vs Node sample % (main core and random periphery nodes) plot till year '+str(curyear), fontsize=10)
plt.xlabel('Node sample % (main core and random periphery nodes)')
plt.ylabel('K-S statistic value for degree distribution')
plt.savefig('../graphs/K-S statistic value for degree distribution vs Node sample % (main core and random periphery nodes) plot till year '+str(curyear)+'.png')
plt.close()
