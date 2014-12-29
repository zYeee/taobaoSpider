#encoding=utf-8
import MySQLdb,sys
reload(sys);
sys.setdefaultencoding('utf-8') 

conn=MySQLdb.connect(host='127.0.0.1',user='taobao',passwd='xinxizhuaqu',db='taobao',port=3306,use_unicode=0,charset='utf8')
