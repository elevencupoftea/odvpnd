import pymysql


def dbConnect():
    connection = pymysql.connect(host='localhost',
                                 user='Username',
                                 password='Password',
                                 database='DB_name',
                                 charset='utf8mb4',
                                 cursorclass=pymysql.cursors.DictCursor)
    return connection
