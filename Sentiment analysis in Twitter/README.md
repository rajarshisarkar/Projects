#Sentiment analysis in Twitter

For the purpose of research, we define sentiment to be "a personal positive or negative feeling" and when there is an absence of this, we treat it as a neutral sentiment.Eg: Considering tweets, "Dammmmm we Love Football" is a positive tweet, "phone going on airplane mode" is a neutral tweet and "Pep Guardiola to resign as Barcelona boss" is a negative tweet.

Technologies Used: Python.

##Sentiment Dictionary Approach

A file having 2482 words and their sentiment value (ranging from -5 to 5) is maintained. We call this file Sentiment Dictionary. A word and its sentiment in the Sentiment Dictionary is seperated by a tab character, i.e., "\t". A very positive word like "happy" is given a sentiment value of 5. A neutral word like "aeroplane" is given a sentiment value close to 0. A very negative word like "hate" is given a sentiment value of -5.

###Algorithm
The algorithm for Sentiment Dictionary Approach is as follows:<br>
1. Get all the words present in the tweet.<br>
2. Add the sentiment value of all words while referring to the Sentiment Dictionary. If the word is not present in the Sentiment Dictionary then add 0.<br>
3. If the cumulative sentiment value is positive then the tweet is positive.<br>
4. If the cumulative sentiment value is zero then the tweet is neutral.<br>
5. If the cumulative sentiment value is negative then the tweet is negative.

##Naive Bayes' Approach

In machine learning, naive Bayes classifiers are a family of simple probabilistic classifiers based on applying Bayes' theorem with strong (naive) independence assumptions between the features. Naive Bayes classifiers are highly scalable, requiring a number of parameters linear in the number of variables (features/predictors) in a learning problem. Maximum-likelihood training can be doneby evaluating a closed-form expression, which takes linear time, rather than by expensive iterative approximation as used for many other types of classifiers In the statistics and computer science literature, Naive Bayes models are known under a variety of names, including simple Bayesand independence Bayes. All these names reference the use of Bayes‟ theorem in the classifier's decision rule, but naive Bayes is not (necessarily) a Bayesian method;Russell and Norvig note that naive Bayes is sometimes called a Bayesian classifier, a somewhat careless usage that has prompted true Bayesians to call it the idiot Bayes model.

###Algorithm
The algorithm for Naive Bayes Approach is as follows:<br>
1. Preprocess the testing tweets.<br>
2. Remove all the stopwords (this, we, etc.) from the training and testing set.<br>
3. Estimate the probability P(c) of each class c by dividing the number of words in tweets in c by the total number of words in the training data set.<br>
4. Estimate the probability distribution P(w|c) for all words w and classes c. This can be done by dividing the number of occurences of w in tweets in c by the total number of words in c.<br>
5. To find the score of a tweet t for class c, calculate: score(t, c) = P(c)P(w1|c)P(w2|c).....P(wn|c).<br>
6. To predict the most likely class label, just pick the c with the highest score value.


##Support Vector Machine Approach

In machine learning, support vector machines (SVMs, also support vector networks) are supervised learning models with associated learning algorithms that analyze data and recognize patterns, used for classification and regression analysis. Given a set of training examples, each marked as belonging to one of two categories, an SVM training algorithm builds a model that assigns new examples into one category or the other, making it a non-probabilistic binary linear classifier. An SVM model is a representation of the examples as points in space, mapped so that the examples of the separate categories are divided by a clear gap that is as wide as possible. New examples are then mapped into that same space and predicted to belong to a category based on which side of the gap they fall on. In addition to performing linear classification, SVMs can efficiently perform a non-linear classification using what is called the kernel trick, implicitly mapping their inputs into high-dimensional feature spaces.

###Algorithm
The algorithm for Support Vector Machine Approach is as follows:<br>
1. Train the linear multiclass SVM classifier based on training tweet data set. Each training tweet is mapped into the hyperplane with help of its feature list.<br>
2. Preprocess the testing tweets and build a feature list for each tweet.<br>
3. Map each testing tweet into the hyperplane with help of its feature list to know the class of the tweet.
