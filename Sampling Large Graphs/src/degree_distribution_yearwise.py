# To Run this script: python run_degree_distribution_yearwise.py

import networkx as nx
import matplotlib.pyplot as plt
import sys

year = int(sys.argv[1])

def modifyandprintstring(s):
    s = s.replace('\n', '')
    s = s.replace('\r', '')
    n = s.find('#!')
    if n == -1:
        n = len(s)
    if s and int(s[s.find('#t')+2:s.find('#t') + 6]) <= year: # specific year of which adjlist is to be created
        s = s[s.find('#index')+6:n]
        s = s.replace('#%',' ')
        print s

def plotdegreedistribution():
	fh=open("../data/adjlistfile_till_year_"+str(year), 'rb')
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
	plt.title('Degree Distribution till year '+str(year))
	plt.xlabel('Degree, k')
	plt.ylabel('Fraction of nodes, P(k)')
	plt.savefig('../graphs/Degree Distribution till year '+str(year)+'.png')
	plt.close()

s = ''
with open('../data/taggeddataset') as f:
    for line in f:
        if line not in ['\n', '\r\n']:
            s += line
        if line in ['\n', '\r\n']:
            modifyandprintstring(s)
            #print s
            s = ''
    modifyandprintstring(s)
    plotdegreedistribution()
    #print s
