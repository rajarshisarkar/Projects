# To Run this script: python python run_indegree_outdegree_distribution_yearwise.py

import networkx as nx
import matplotlib.pyplot as plt
import sys
from matplotlib.legend_handler import HandlerLine2D

year = int(sys.argv[1])

def plotdegreedistribution():
	fh=open("../data/adjlistfile_till_year_"+str(year), 'rb')
	G = nx.read_adjlist(fh, create_using=nx.DiGraph())

	indegrees = G.in_degree() # dictionary node:degree
	invalues = sorted(set(indegrees.values()))
	inhist = [indegrees.values().count(x) for x in invalues]
	nodes = G.number_of_nodes()
	innewhist = [float(x)/nodes for x in inhist]
	
	outdegrees = G.out_degree() # dictionary node:degree
	outvalues = sorted(set(outdegrees.values()))
	outhist = [outdegrees.values().count(x) for x in outvalues]
	nodes = G.number_of_nodes()
	outnewhist = [float(x)/nodes for x in outhist]

	plt.figure()
	plt.yscale('log')
	plt.xscale('log')
	plt.xlim(0.8,10000)
	line1, = plt.plot(invalues,innewhist,'r^', label='Indegree')
	plt.legend(handler_map={line1: HandlerLine2D(numpoints=2)})
	line2, = plt.plot(outvalues,outnewhist,'bo', label='Outdegree')
	plt.legend(handler_map={line2: HandlerLine2D(numpoints=2)})
	plt.title('Indegree and Outdegree Distribution till year '+str(year))
	plt.xlabel('Degree, k')
	plt.ylabel('Fraction of nodes, P(k)')
	plt.savefig('../graphs/Indegree and Outdegree Distribution till year '+str(year)+'.png')
	plt.close()

s = ''
with open('../data/taggeddataset') as f:
    for line in f:
        if line not in ['\n', '\r\n']:
            s += line
        if line in ['\n', '\r\n']:
            #modifyandprintstring(s)
            #print s
            s = ''
    #modifyandprintstring(s)
    plotdegreedistribution()
    #print s
