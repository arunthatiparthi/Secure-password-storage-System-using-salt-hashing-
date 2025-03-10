import mysql.connector
import bcrypt

def hash_password(password):
    # Generate a random salt
    salt = bcrypt.gensalt()
    # Hash the password with the salt
    hashed_password = bcrypt.hashpw(password.encode('utf-8'), salt)
    return hashed_password, salt

def verify_password(password, stored_hashed_password):
    # Verify the entered password against the stored hash
    return bcrypt.checkpw(password.encode('utf-8'), stored_hashed_password)

name = input("Enter username:")
user_password = input("Enter a password: ")

# Hash the password and get the hash and salt
hashed_password, salt = hash_password(user_password)

print("Original Password:", user_password)
print("Hashed Password:", hashed_password)
print("Salt:", salt)

# User input for password verification
entered_password = input("Enter the password to verify: ")
is_password_valid = verify_password(entered_password, hashed_password)

if is_password_valid:
    print("Password is valid!")
else:
    print("Password is invalid!")

config = {
    'host': "localhost",
    'database': "salthashing",
    'user': "root",
    'password': ""
}
# Establish a connection
try:
    connection = mysql.connector.connect(**config)
    if connection.is_connected():
        # print("Connected to the database")
        cursor = connection.cursor()
        # SQL query to insert the name, hashed password, and salt into a table
        insert_query = "INSERT INTO salt_hash(Name, Hash) VALUES (%s, %s)"
        # Execute the query with the name, hashed password, and salt parameters
        cursor.execute(insert_query, (name, hashed_password.decode('utf-8')))
        connection.commit()

except mysql.connector.Error as err:
    print(f"Error: {err}")

finally:
    # Close the connection
    if 'connection' in locals() and connection.is_connected():
        connection.close()