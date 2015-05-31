# python tweet_sentiment.py Sentiment-Dictionary.txt tweets.txt > output.txt
# python tweet_sentiment.py Sentiment-Dictionary.txt tweets.txt

import sys
import json
scores = {}  # initialize an empty dictionary

def dictionary(file):
    global scores
    sentimentdictionaryfile = file
    for line in sentimentdictionaryfile:
        (term, score) = line.split('\t')  # The file is tab-delimited. "\t" means "tab character"
        scores[term] = int(score)  # Convert the score to an integer.

def tweets(file):
    i = 0
    for line in file.readlines():
        tweet = json.loads(line)
        tweet_score = 0
        if 'text' in tweet and 'lang' in tweet and tweet['lang'] == 'en':
            spectweet = tweet['text'].encode('utf-8')
            for word in spectweet.lower().split():
                if word in scores.keys():
                    tweet_score += scores[word]
            i = i + 1
            print 'Tweet No.',
            print i,
            print ':',
            spectweet = spectweet.replace('\n', '.')
            spectweet = spectweet.replace('\r', '.')
            print spectweet
            print 'Sentiment',
            print i,
            print ':',
            if float(tweet_score) > 0:
				print "We think that the sentiment was positive in that sentence."
            if float(tweet_score) < 0:
				print "We think that the sentiment was negative in that sentence."
            if float(tweet_score) == 0:
				print "We think that the sentiment was neutral in that sentence."
            #print float(tweet_score)

def main():
    sent_file = open(sys.argv[1])
    tweet_file = open(sys.argv[2])
    dictionary(sent_file)
    tweets(tweet_file)

if __name__ == '__main__':
    main()
