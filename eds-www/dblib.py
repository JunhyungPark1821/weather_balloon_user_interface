import mysql.connector

def upload_data(latitude, longitude, altitude):
    db = mysql.connector.connect(host = "localhost", user="root", password="", database="weatherballoon")
    cursor = db.cursor()
    query = "INSERT INTO status(latitude, longitude, altitude) VALUES (" + str(latitude) + "," + str(longitude) + "," + str(altitude) + ")"
    print(query)
    cursor.execute(query)
    db.close()
    
