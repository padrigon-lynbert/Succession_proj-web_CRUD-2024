
import mysql.connector

def get_connection():
    connection = mysql.connector.connect(
        host="localhost",
        user="root",
        password="pdjdde5i5njkea8",
        database="succession"
    )
    return connection
