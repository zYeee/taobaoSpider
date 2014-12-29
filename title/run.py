#!/usr/bin/python
# coding=utf-8
from conn import *
import urllib2,json,sys,re,hashlib,time
reload(sys);
sys.setdefaultencoding('utf-8')

def dfs(index,num,max):
	global list
	global result
	global total,values
	ans=""
	if(num==max):
		for j in list:
			ans+=(j+" ")
		if ans.find('靴')!=-1 or ans.find('鞋')!=-1:
			hash=hashlib.md5(ans).hexdigest()
			values.append((ans,hash))
		ans=""
		return
	for i in range (index,ll):
		list.append(result[i])
		dfs(i+1,num+1,max)
		list.pop()

cur=conn.cursor()
cur.execute("select keyword from keyword")
a=cur.fetchall()
for i in a:
	print i[0],
	print "\r\n"
exit()
cur=conn.cursor()
cur.execute("select title from `50012028`  limit 20000")
a=cur.fetchall()
count=0
for i in a:
	values=[]
	name= i[0]
	name=name.replace(" ","")
	url="http://list.taobao.com/itemlist/default.htm?_input_charset=utf-8&json=on&q="
	ret=urllib2.urlopen(url+name)
	code=ret.getcode()
	ret_data=ret.read()
	result=json.loads(ret_data,encoding="gbk")
	if(result['keyword']['value']==""):
		continue
	if(result['itemList'] is None):
		continue
	result=result['itemList'][0]['title']
	result=re.findall(r'<span class="h">(.*?)</span>',result)
	
	ans=""
	for i in result:
		ans+=(i+" ")
	print ans
	count+=1
	if(count==100):
		count=0
		time.sleep(300)
	#cur.execute('insert into keywords (keyword) values(%s)',ans)
	#ll=len(result)
	#list=[]
	#total=0
	#for i in range (4,7):
	#	dfs(0,0,i)
	#cur.executemany('insert ignore into keywords values(%s,%s)',values)
	#conn.commit()
	#values=[]

cur.close()
conn.close()

