# To Run this script: python sampling_compareall.py <year>

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
biases1 = []
biases2 = []
biases3 = []
avgdvalues1 = []
avgdvalues2 = []
avgdvalues3 = []
n = 1

curyear = int(sys.argv[1])
for samplepercent in samplepercents:
	avgdvalue1 = 0
	avgdvalue2 = 0
	avgdvalue3 = 0
	avgbiasforsample1 = 0
	avgbiasforsample2 = 0
	avgbiasforsample3 = 0
	for iteration in range(0,n):
		year = []
		largestcomponent = []
		randomnodes1 = []
		randomnodes2 = []
		randomnodes3 = []
		print "Year", curyear,":"
		for xyz in range(curyear, curyear+1):
			fh1 = open("../data/adjlistfile_till_year_"+str(xyz))
			fh2 = open("../data/adjlistfile_largestcomponent_till_year_"+str(xyz))
			G1 = nx.read_adjlist(fh1)
			avgclusteringcoefofnetwork = nx.average_clustering(G1)
			G2 = nx.read_adjlist(fh2)
			samplesize = int(samplepercent*G2.number_of_nodes())
			
			# Random node sampling
			while len(randomnodes1)<=samplesize:
				if randomnodes1.count(random.choice(G2.nodes())) == 0:
					randomnodes1.append(random.choice(G2.nodes()))		
			G3 = G2.subgraph(randomnodes1)
			components = sorted(nx.connected_components(G3), key = len, reverse=True)
			avgclusteringcoefofsample1 = nx.average_clustering(G3)
			avgbiasforsample1 += (avgclusteringcoefofsample1-avgclusteringcoefofnetwork)
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
			dvalue1 = ks_2samp(newhist1, newhist2)[0]
			avgdvalue1 += dvalue1
			print "D value of",int(samplepercent*100),"% sample (via random node sampling):", dvalue1
			
			# Random node sampling (via modified random node sampling)
			fh2 = open("../data/adjlistfile_largestcomponent_till_year_"+str(xyz))
			G2 = nx.read_adjlist(fh2, create_using=nx.DiGraph())
			source = random.choice(G2.nodes()) # sources
			randomnodes2.append(source)
			i = 0
			while len(randomnodes2)<=samplesize:
				for inn in range(0, int(len(G2.predecessors(randomnodes2[i]))*1)):
					indegreenode = random.choice(G2.predecessors(randomnodes2[i]))
					if (randomnodes2.count(indegreenode)==0):
						randomnodes2.append(indegreenode) # append indegree neighbors randomly
				for outt in range(0, int(len(G2.neighbors(randomnodes2[i]))*1)):
					outdegreenode = random.choice(G2.neighbors(randomnodes2[i]))
					if (randomnodes2.count(outdegreenode)==0):
						randomnodes2.append(outdegreenode) # append outdegree neighbors randomly
				i = i+1
			G4 = G2.subgraph(randomnodes2)
			G4 = G4.to_undirected()
			components = sorted(nx.connected_components(G4), key = len, reverse=True)
			avgclusteringcoefofsample2 = nx.average_clustering(G4)
			avgbiasforsample2 += (avgclusteringcoefofsample2-avgclusteringcoefofnetwork)
			degrees3 = G1.degree() # dictionary node:degree
			values3 = sorted(set(degrees3.values()))
			hist3 = [degrees3.values().count(x) for x in values3]
			nodes3 = G1.number_of_nodes()
			newhist3 = [float(x)/nodes3 for x in hist3]
			degrees4 = G4.degree() # dictionary node:degree
			values4 = sorted(set(degrees4.values()))
			hist4 = [degrees4.values().count(x) for x in values4]
			nodes4 = G4.number_of_nodes()
			newhist4 = [float(x)/nodes4 for x in hist4]
			dvalue2 = ks_2samp(newhist3, newhist4)[0]
			avgdvalue2 += dvalue2
			print "D value of",int(samplepercent*100),"% sample (via modified random node sampling):", dvalue2
			G2 = G2.to_undirected()
			
			# Sampling (via random walk)
			source = random.choice(G2.nodes()) # sources
			randomnodes3.append(source) 
			randomwalknode = source
			while len(randomnodes3)<=samplesize:
				randomwalknode = random.choice(G2.neighbors(randomwalknode))
				if randomnodes3.count(randomwalknode) == 0:
					randomnodes3.append(randomwalknode) # append neighbors randomly
			G5 = G2.subgraph(randomnodes3)
			components = sorted(nx.connected_components(G5), key = len, reverse=True)
			avgclusteringcoefofsample3 = nx.average_clustering(G5)
			avgbiasforsample3 += (avgclusteringcoefofsample3-avgclusteringcoefofnetwork)
			degrees5 = G1.degree() # dictionary node:degree
			values5 = sorted(set(degrees5.values()))
			hist5 = [degrees5.values().count(x) for x in values5]
			nodes5 = G1.number_of_nodes()
			newhist5 = [float(x)/nodes5 for x in hist5]
			degrees6 = G5.degree() # dictionary node:degree
			values6 = sorted(set(degrees6.values()))
			hist6 = [degrees6.values().count(x) for x in values6]
			nodes6 = G5.number_of_nodes()
			newhist6 = [float(x)/nodes6 for x in hist6]
			dvalue3 = ks_2samp(newhist5, newhist6)[0]
			avgdvalue3 += dvalue3
			print "D value of",int(samplepercent*100),"% sample (via random walk):", dvalue3
			
	avgbiasforsample1 = avgbiasforsample1/n
	avgdvalue1 = avgdvalue1/n
	biases1.append(avgbiasforsample1)
	avgdvalues1.append(avgdvalue1)
	avgbiasforsample2 = avgbiasforsample2/n
	avgdvalue2 = avgdvalue2/n
	biases2.append(avgbiasforsample2)
	avgdvalues2.append(avgdvalue2)
	avgbiasforsample3 = avgbiasforsample3/n
	avgdvalue3 = avgdvalue3/n
	biases3.append(avgbiasforsample3)
	avgdvalues3.append(avgdvalue3)

print
print 'Year '+str(curyear)+':'
print "biases1 =", biases1
print "biases2 =", biases2
print "biases3 =", biases3
print "avgdvalues1 =", avgdvalues1
print "avgdvalues2 =", avgdvalues2
print "avgdvalues3 =", avgdvalues3
	
plt.figure()
ax = plt.subplot(111)
box = ax.get_position()
ax.set_position([box.x0, box.y0 + box.height * 0.10, box.width, box.height * .90])
fontP = FontProperties()
fontP.set_size('small')
plt.xlim(0,60)
line1, = plt.plot(samplepercents100,biases1,'bo-', label='Random node sampling')
line2, = plt.plot(samplepercents100,biases2,'rs-', label='Modified random node sampling')
line3, = plt.plot(samplepercents100,biases3,'c^-', label='Node sampling via random walk')
plt.legend(loc='upper center', bbox_to_anchor=(0.5, -0.12), fancybox=True, shadow=True, ncol=2, handler_map={line1: HandlerLine2D(numpoints=2)}, prop = fontP)
plt.legend(loc='upper center', bbox_to_anchor=(0.5, -0.12), fancybox=True, shadow=True, ncol=2, handler_map={line2: HandlerLine2D(numpoints=2)}, prop = fontP)
plt.legend(loc='upper center', bbox_to_anchor=(0.5, -0.12), fancybox=True, shadow=True, ncol=2, handler_map={line3: HandlerLine2D(numpoints=2)}, prop = fontP)
plt.suptitle('Comparison of Average Clustering Coefficient Bias vs Random node sample % plot till year '+str(curyear), fontsize=12)
plt.xlabel('Random node sample %')
plt.ylabel('Average Clustering Coefficient Bias')
plt.savefig('../graphs/Comparison of Average Clustering Coefficient Bias vs Random node sample % plot till year '+str(curyear)+'.png')
plt.close()

plt.figure()
plt.xlim(0,60)
ax = plt.subplot(111)
box = ax.get_position()
ax.set_position([box.x0, box.y0 + box.height * 0.10, box.width, box.height * .90])
fontP = FontProperties()
fontP.set_size('small')
line1, = plt.plot(samplepercents100,avgdvalues1,'bo-', label='Random node sampling')
line2, = plt.plot(samplepercents100,avgdvalues2,'rs-', label='Modified random node sampling')
line3, = plt.plot(samplepercents100,avgdvalues3,'c^-', label='Node sampling via random walk')
plt.legend(loc='upper center', bbox_to_anchor=(0.5, -0.12), fancybox=True, shadow=True, ncol=2, handler_map={line1: HandlerLine2D(numpoints=2)}, prop = fontP)
plt.legend(loc='upper center', bbox_to_anchor=(0.5, -0.12), fancybox=True, shadow=True, ncol=2, handler_map={line2: HandlerLine2D(numpoints=2)}, prop = fontP)
plt.legend(loc='upper center', bbox_to_anchor=(0.5, -0.12), fancybox=True, shadow=True, ncol=2, handler_map={line3: HandlerLine2D(numpoints=2)}, prop = fontP)
plt.suptitle('Comparison of K-S statistic value for degree distribution vs Random node sample % plot till year '+str(curyear), fontsize=12)
plt.xlabel('Random node sample %')
plt.ylabel('K-S statistic value for degree distribution')
plt.savefig('../graphs/Comparison of K-S statistic value for degree distribution vs Random node sample % plot till year '+str(curyear)+'.png')
plt.close()
