import pymysql

def dbConnect():
    connection = pymysql.connect(host='localhost',
                                 user='tflg',
                                 password='123',
                                 database='vpn2',
                                 charset='utf8mb4',
                                 cursorclass=pymysql.cursors.DictCursor)
    return connection
