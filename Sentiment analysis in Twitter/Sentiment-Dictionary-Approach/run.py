# python run.py > output.txt

import os
os.system('python twitterstream.py > tweets.txt')
os.system('python tweet_sentiment.py Sentiment-Dictionary.txt tweets.txt')
