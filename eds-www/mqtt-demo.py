from datetime import date
import paho.mqtt.client as mqtt
import json
import dblib


# -------------------------------------------------------
# SETTINGS
# -------------------------------------------------------
# This is the IP Address (or name) or your MQTT broker
MQTT_BROKER = "nam1.cloud.thethings.network"

# User Credentials
USERNAME = "new-new-application@ttn"
PASSWORD = "NNSXS.AIIT6WQ6EZ7W3ITR5D4X4564OGNPLEHW342DETY.5JVISXTO77WYZ5XXAFEKURHBJL5AV55KHREI7YJLNVYPWL5BZULQ"

# This is a list of channels that you want to subscribe to
MQTT_TOPICS = ["v3/new-new-application@ttn/devices/eui-70b3d57ed004ce0a/up"]


# -------------------------------------------------------
# This function is called when you successfully connect
# -------------------------------------------------------
def on_connect(client, userdata, flags, rc):
    print("Connected with result code", rc)
    print("If you see code 0, then it worked.  Wait for it . . .")
    
    # Subscribes to all of the topics
    for topic in MQTT_TOPICS:
        client.subscribe(topic)
        print("Connected to Topic:", topic)

# -------------------------------------------------------
# This function is called when you receive a message
# -------------------------------------------------------
def on_message(client, userdata, msg):
    #print(msg.topic, msg.payload)
    message = str(msg.payload.decode("utf-8"))
    print("---------------------------------------")
    print("- Message received at", date.today())
    print("---------------------------------------")
    print("Raw Data:", message, "\n")
    
    # Converts the message into a JSON Object
    jsonData = json.loads(message)

    # You can access the data by using brackets
    # Use a website like https://jsonformatter.curiousconcept.com to see
    # how the data is structured
    
    try:
        time = jsonData['uplink_message']['received_at']
        altitude = jsonData['uplink_message']['decoded_payload']['altitude']
        latitude = jsonData['uplink_message']['decoded_payload']['latitude']
        longitude = jsonData['uplink_message']['decoded_payload']['longitude']

        with open(r"C:\Users\junhyung\Desktop\Location_Data.txt",'a') as locationData:
            locationData.write("Time: " + time + "\n")
            locationData.write("Altitude: " + altitude + "\n")
            locationData.write("Latitude: " + latitude + "\n")
            locationData.write("Longitude: " + longitude + "\n")
            locationData.write("\n")
        
        print("Time:", time)
        print("Altitude:", altitude)
        print("Latitude:", latitude)
        print("Longitude:", longitude)
        
        upload_data(latitude, longitude, altitude)
    
    except:
        # If something break, just do nothing
        print("A problem occurred while parsing the file")


# -------------------------------------------------------
# This is Your Main Program
# -------------------------------------------------------
client = mqtt.Client()

# Sets the Credentials
client.username_pw_set(username = USERNAME, password = PASSWORD)

# Tells the client what functions to call when events occur
client.on_connect = on_connect
client.on_message = on_message

# This attempts to connect to the MQTT broker
print("Connecting")
client.connect(MQTT_BROKER)

# This essentially tells the program to listen forever
client.loop_forever()


