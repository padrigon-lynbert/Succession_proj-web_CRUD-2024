import pandas as pd
from connection import get_connection
from sqlalchemy import create_engine
import mysql.connector

try:
    # Establishing using the imported function  
    connection = get_connection()

    if connection.is_connected():

        print("Connected successfully")
        engine = create_engine('mysql+mysqlconnector://root:pdjdde5i5njkea8@localhost/succession')
        query = "SELECT * FROM employee"
        df = pd.read_sql(query, engine)

except mysql.connector.Error as err:
    print(f"Error: {err}")

finally:
    if connection.is_connected():
        connection.close()
        print("Connection closed")

print(df.describe)

