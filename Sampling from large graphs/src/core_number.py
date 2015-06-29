# To Run this script: python core_number.py

import networkx as nx
import matplotlib.pyplot as plt
import sys
from matplotlib.legend_handler import HandlerLine2D
from matplotlib.font_manager import FontProperties
import random
import math
from scipy.stats import ks_2samp
import numpy as np

year = []
normalisedkcoresize = []
curyear = 2005
endyear = 2005

for x in range(curyear, endyear+1):
	print "Year", x,":"
	fh1 = open("../data/adjlistfile_till_year_"+str(x))
	G1 = nx.read_adjlist(fh1, create_using=nx.DiGraph())
	G1.remove_edges_from(G1.selfloop_edges())
	core_numbers = nx.core_number(G1)
	print core_numbers
