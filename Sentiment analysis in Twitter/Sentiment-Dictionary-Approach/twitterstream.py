# python twitterstream.py > tweets.txt

import oauth2 as oauth
import urllib2 as urllib

access_token_key = "288801977-8tPnj2yukfZedG9AD281VM8W6Ny58etWRHeNUSfN"
access_token_secret = "cpSCLTOWcWOQypy1r9qy1ckwhSaEpEiRvm4WJCEwrvgnt"
consumer_key = "dACKtQhEYVSUmrt9amAehPZTS"
consumer_secret = "jeM514YDEuI0EppABKKl0WWYlGTtKtrxLaEs9jY0vojPw7Dzah"
oauth_token    = oauth.Token(key=access_token_key, secret=access_token_secret)
oauth_consumer = oauth.Consumer(key=consumer_key, secret=consumer_secret)
signature_method_hmac_sha1 = oauth.SignatureMethod_HMAC_SHA1()
http_method = "GET"
http_handler  = urllib.HTTPHandler(debuglevel=0)
https_handler = urllib.HTTPSHandler(debuglevel=0)

def twitterreq(url, method, parameters): # Construct, sign, and open a twitter request using the credentials above.
  req = oauth.Request.from_consumer_and_token(oauth_consumer, token=oauth_token, http_method=http_method, http_url=url, parameters=parameters)
  
  req.sign_request(signature_method_hmac_sha1, oauth_consumer, oauth_token)
  headers = req.to_header()
  if http_method == "POST":
    encoded_post_data = req.to_postdata()
  else:
    encoded_post_data = None
    url = req.to_url()

  opener = urllib.OpenerDirector()
  opener.add_handler(http_handler)
  opener.add_handler(https_handler)
  response = opener.open(url, encoded_post_data)

  return response

def fetchsamples():
  url = "https://stream.twitter.com/1/statuses/sample.json"
  parameters = []
  response = twitterreq(url, "GET", parameters)
  for line in response:
    print line.strip()

if __name__ == '__main__':
  fetchsamples()
