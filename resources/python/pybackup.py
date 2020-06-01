#!/usr/bin/python
# Import required python libraries
 
import os
import time
from datetime import datetime
import argparse
import zipfile
import hashlib
import mysql.connector
 
# MySQL database details to which backup to be done. Make sure below user having enough privileges to take databases backup. 
parser = argparse.ArgumentParser(description='Backup de database')
parser.add_argument('host', type=str, help='Database Host')
parser.add_argument('user', type=str, help='Database User')
parser.add_argument('password', type=str, help='Database User Password')
parser.add_argument('database', type=str, help='Database Name')
args = parser.parse_args()

DB_HOST = args.host
DB_USER = args.user
DB_USER_PASSWORD = args.password
DB_NAME = args.database
BACKUP_PATH = '../../storage/app/backups/'
#Create backup directory if it doesn't exists
if not os.path.exists(BACKUP_PATH):
    os.makedirs(BACKUP_PATH)

# Getting current DateTime to create the separate backup folder like "20180817-123433".

TIME_NOW = datetime.now()
CREATED_AT = TIME_NOW.strftime("%Y-%m-%d %H:%M:%S")
FILE_NAME = TIME_NOW.strftime('%Y%m%d-%H%M%S')
 
# Checking if backup folder already exists or not. If not exists will create it.
dumpcmd = f"mysqldump -h{DB_HOST} -u{DB_USER} -p{DB_USER_PASSWORD} {DB_NAME} > {BACKUP_PATH}{FILE_NAME}.sql"
os.system(dumpcmd)

zip = zipfile.ZipFile(f"{BACKUP_PATH}{FILE_NAME}.zip", 'w')
zip.write(f"{BACKUP_PATH}{FILE_NAME}.sql",f"{FILE_NAME}.sql", compress_type=zipfile.ZIP_BZIP2)
zip.close()

#Remove original .sql dump
if os.path.exists(f"{BACKUP_PATH}{FILE_NAME}.sql"):
    os.remove(f"{BACKUP_PATH}{FILE_NAME}.sql")

#Get a md5 hash of the file for checksum
md5_hash = hashlib.md5()
a_file = open(f"{BACKUP_PATH}{FILE_NAME}.zip", "rb")
md5_hash.update(a_file.read())
md5_digest = md5_hash.hexdigest()

#Conect to the Database
db = mysql.connector.connect(
    host=DB_HOST,
    user=DB_USER,
    passwd=DB_USER_PASSWORD,
    database=DB_NAME
)
cursor = db.cursor()

#Prepare the query and register the backup on the database
query = "INSERT backups(name,created_at,md5,file) VALUES(%s,%s,%s,%s)"
val = (FILE_NAME,CREATED_AT, md5_digest,'backups/'+FILE_NAME+".zip")
cursor.execute(query, val)
db.commit()
db.close()