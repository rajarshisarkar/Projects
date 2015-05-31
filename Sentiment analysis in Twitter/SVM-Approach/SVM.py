# python SVM.py > output.txt; sed -i '1d' output.txt;

import svm
from svmutil import *
import re, pickle, csv, os
import json

def getFeatureVector(tweet, stopWords):
    featureVector = []  
    words = tweet.split()
    for w in words:
        #replace two or more with two occurrences 
        w = replaceTwoOrMore(w) 
        #strip punctuation
        w = w.strip('\'"?,.')
        #check if it consists of only words
        val = re.search(r"^[a-zA-Z][a-zA-Z0-9]*[a-zA-Z]+[a-zA-Z0-9]*$", w)
        #ignore if it is a stopWord
        if(w in stopWords or val is None):
            continue
        else:
            featureVector.append(w.lower())
    return featureVector    

def replaceTwoOrMore(s):
    #look for 2 or more repetitions of character
    pattern = re.compile(r"(.)\1{1,}", re.DOTALL) 
    return pattern.sub(r"\1\1", s)

def processTweet(tweet):
    #Convert to lower case
    tweet = tweet.lower()
    #Convert www.* or https?://* to URL
    tweet = re.sub('((www\.[^\s]+)|(https?://[^\s]+))','URL',tweet)
    #Convert @username to AT_USER
    tweet = re.sub('@[^\s]+','AT_USER',tweet)    
    #Remove additional white spaces
    tweet = re.sub('[\s]+', ' ', tweet)
    #Replace #word with word
    tweet = re.sub(r'#([^\s]+)', r'\1', tweet)
    #trim
    tweet = tweet.strip('\'"')
    return tweet

def getStopWordList(stopWordListFileName):
    #read the stopwords
    stopWords = []
    stopWords.append('AT_USER')
    stopWords.append('URL')

    fp = open(stopWordListFileName, 'r')
    line = fp.readline()
    while line:
        word = line.strip()
        stopWords.append(word)
        line = fp.readline()
    fp.close()
    return stopWords

featureList = [line.strip() for line in open('feature_list.txt')]

#Read the training tweets one by one and process it
inpTweets = csv.reader(open('training_dataset.csv'), delimiter=',', quotechar='|')
tweets = []
for row in inpTweets:
    sentiment = row[0]
    tweet = row[1]
    stopWords = getStopWordList('stopwords.txt')
    processedTweet = processTweet(tweet)
    featureVector = getFeatureVector(processedTweet, stopWords)
    tweets.append((featureVector, sentiment));

#Read the testing tweets one by one and process it
opTweets = csv.reader(open('testing_dataset.csv'), delimiter=',', quotechar='|')
test_tweets = []
for row in opTweets:
    sentiment = row[0]
    tweet = row[1]
    stopWords = getStopWordList('stopwords.txt')
    processedTweet = processTweet(tweet)
    featureVector = getFeatureVector(processedTweet, stopWords)
    test_tweets.append((featureVector));

def getSVMFeatureVectorandLabels(tweets, featureList):
    sortedFeatures = sorted(featureList)
    map = {}
    feature_vector = []
    labels = []
    for t in tweets:
        label = 0
        map = {}
        #Initialize empty map
        for w in sortedFeatures:
            map[w] = 0

        tweet_words = t[0]
        tweet_opinion = t[1]
        #Fill the map
        for word in tweet_words:
            #process the word (remove repetitions and punctuations)
            word = replaceTwoOrMore(word)
            word = word.strip('\'"?,.')
            #set map[word] to 1 if word exists
            if word in map:
                map[word] = 1
        values = map.values()
        feature_vector.append(values)
        if(tweet_opinion == 'positive'):
            label = 0
        elif(tweet_opinion == 'negative'):
            label = 1
        elif(tweet_opinion == 'neutral'):
            label = 2
        labels.append(label)
    #return the list of feature_vector and labels
    return {'feature_vector' : feature_vector, 'labels': labels}

def getSVMFeatureVector(test_tweets, featureList):
	sortedFeatures = sorted(featureList)
	map = {}
	feature_vector = []
	for t in test_tweets:
		label = 0
		map = {}
		#Initialize empty map
		for w in sortedFeatures:
			map[w] = 0
		#Fill the map
		for word in t:
			if word in map:
				map[word] = 1
		values = map.values()
		feature_vector.append(values)                    
	return feature_vector

#Train the classifier
result = getSVMFeatureVectorandLabels(tweets, featureList)
problem = svm_problem(result['labels'], result['feature_vector'])
#'-q' option suppress console output
param = svm_parameter('-q')
param.kernel_type = LINEAR
classifier = svm_train(problem, param)

#Test the classifier
test_feature_vector = getSVMFeatureVector(test_tweets, featureList)
#p_labels contains the final labeling result
p_labels, p_accs, p_vals = svm_predict([0] * len(test_feature_vector),test_feature_vector, classifier)

count = 0
testing_tweets = []
for line in open('tweets.txt').readlines():
	tweet = json.loads(line)
	if 'text' in tweet and 'lang' in tweet and tweet['lang'] == 'en':
		spectweet = tweet['text'].encode('utf-8')
		spectweet = spectweet.replace('\n', '.')
		spectweet = spectweet.replace('\r', '.')
		testing_tweets.append(spectweet)

for i in p_labels:
    count = count + 1
    print 'Tweet No.',
    print count,
    print ':',
    print testing_tweets[count-1]
    print 'Sentiment',
    print count,
    print ':',
    if int(i) == 0:
        print 'We think that the sentiment was positive in that sentence.'
    if int(i) == 1:
        print 'We think that the sentiment was negative in that sentence.'
    if int(i) == 2:
        print 'We think that the sentiment was neutral in that sentence.'
