f = open('/home/rajarshi/edx_to_moodle_synchronisation/image_transfer/dump/xmodule/modulestore.bson')
decode = ''.join(f.readlines())
start = decode.find('img src="data:;base64,') + 22
end = decode.find('" alt="" />', start)
print decode[start:end].decode('base64','strict')
f.close()