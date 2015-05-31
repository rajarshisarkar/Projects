# python find_new_terms.py Sentiment-Dictionary.txt tweets.txt
# script that computes the sentiment for the terms that do not appear in the file Sentiment-Dictionary.txt.

import sys
import json
scores = {} # initialize an empty dictionary

def dictionary(file):
    global scores
    sentimentdictionaryfile = file
    for line in sentimentdictionaryfile:
        term, score  = line.split("\t")  # The file is tab-delimited. "\t" means "tab character"
        scores[term] = int(score)  # Convert the score to an integer.

def tweets(file):    
    for line in file.readlines():    
        tweet = json.loads(line)
        if 'text' in tweet and ('lang' in tweet and tweet['lang']=="en"):
            spectweet = tweet['text'].encode('utf-8')
            for word in spectweet.lower().split():
                if word not in scores.keys():
                    print word
    
def main():
    sent_file = open(sys.argv[1])
    tweet_file = open(sys.argv[2])
    dictionary(sent_file)
    tweets(tweet_file)

if __name__ == '__main__':
    main()
