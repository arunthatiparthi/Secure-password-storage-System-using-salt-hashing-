import sys
import mysql.connector
import bcrypt
import getpass  # For secure password input

# MySQL Database Connection
# def connect_db():
#     return mysql.connector.connect(
#         host="localhost",
#         user="root",
#         password="",
#         database="secure_auth"
#     )

# Hash Password with bcrypt
def hash_password(password):
    salt = bcrypt.gensalt()
    hashed_password = bcrypt.hashpw(password.encode('utf-8'), salt)
    return hashed_password.decode('utf-8'), salt.decode('utf-8')

# db = connect_db()
# cursor = db.cursor()

username = sys.argv[1]
email = sys.argv[2]
password = sys.argv[3]
hashed_password, salt = hash_password(password)
salted=f"{salt}"
hashed=f"{hashed_password}"
print(f"{salted},{hashed}")
# try:
#     cursor.execute(
#         "INSERT INTO users (username, email, salt, hashed_password) VALUES (%s, %s, %s, %s)",
#         (username, email, salt, hashed_password)
#     )
#     db.commit()
#     print("yes")
# except mysql.connector.Error as err:
#     print(f" Error:")

# cursor.close()
# db.close()