# To Run this script: python create_adjlistfile.py > ../data/adjlistfile

def modifyandprintstring(s):
    s = s.replace('\n', '')
    s = s.replace('\r', '')
    n = s.find('#!')
    if n == -1:
        n = len(s)
    if s and int(s[s.find('#t')+2:s.find('#t') + 6]) != 2009:
        s = s[s.find('#index')+6:n]
        s = s.replace('#%',' ')
        print s
    # 711810 - 8836 = 702974 papers in year [1960, 2008]

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
    #print s
