import subprocess
import time
from datetime import datetime, timedelta
import db

wguard_dir = '/home/core/wguard/'


def runSh(command):
    proc = subprocess.call(command, shell=True)


if __name__ == '__main__':
    while 1:
        connection = db.dbConnect()
        with connection:
            with connection.cursor() as cursor:
                cursor.execute("SELECT * FROM profiles WHERE status=99")
                for row in cursor:
                    name = row['name']
                    local_id = row['local_id']
                    cursor.execute('UPDATE profiles SET status=1 WHERE name=%s', name)
                    connection.commit()
                    print(f"New profile created with name {name}")
                    runSh(f"{wguard_dir}create.sh {name} {local_id}")

            with connection.cursor() as cursor:
                cursor.execute('SELECT * FROM profiles WHERE status=1')
                for row in cursor:
                    days = row['days']
                    expired = row['expired']
                    if expired < datetime.now():
                        name = row['name']
                        row_id = row['id']
                        local_id = row['local_id']
                        cursor.execute('UPDATE profiles SET status=0 WHERE id=%s', row_id)
                        connection.commit()
                        runSh(f"{wguard_dir}delete.sh {name}")
                        con = db.dbConnect()
                        with con:
                            with con.cursor() as cur:
                                sql = "UPDATE ip_address SET active=%s WHERE `index`=%s"
                                data = (0, int(local_id))
                                cur.execute(sql, data)
                                con.commit()
        time.sleep(3)
