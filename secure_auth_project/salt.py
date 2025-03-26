# import mysql.connector
# import bcrypt
# import getpass  # For secure password input

# # MySQL Database Connection
# def connect_db():
#     return mysql.connector.connect(
#         host="localhost",
#         user="root",
#         password="",
#         database="secure_auth"
#     )

# # Hash Password with bcrypt
# def hash_password(password):
#     salt = bcrypt.gensalt()
#     hashed_password = bcrypt.hashpw(password.encode('utf-8'), salt)
#     return hashed_password.decode('utf-8'), salt.decode('utf-8')

# # Verify Password
# def verify_password(password, stored_hashed_password):
#     return bcrypt.checkpw(password.encode('utf-8'), stored_hashed_password.encode('utf-8'))

# # Register User
# def register_user():
#     db = connect_db()
#     cursor = db.cursor()

#     username = input("Enter username: ")
#     email = input("Enter email: ")
#     password = getpass.getpass("Enter a secure password: ")

#     hashed_password, salt = hash_password(password)

#     try:
#         cursor.execute(
#             "INSERT INTO users (username, email, salt, hashed_password) VALUES (%s, %s, %s, %s)",
#             (username, email, salt, hashed_password)
#         )
#         db.commit()
#         print("User registered successfully!")
#     except mysql.connector.Error as err:
#         print(f" Error: {err}")
    
#     cursor.close()
#     db.close()

# # Login User
# def login_user():
#     db = connect_db()
#     cursor = db.cursor()

#     email = input("Enter email: ")
#     password = getpass.getpass("Enter your password: ")

#     cursor.execute("SELECT salt, hashed_password FROM users WHERE email = %s", (email,))
#     result = cursor.fetchone()

#     if result:
#         stored_salt, stored_hashed_password = result
#         if verify_password(password, stored_hashed_password):
#             print("Login successful!")
#         else:
#             print("Invalid password!")
#     else:
#         print("User not found!")

#     cursor.close()
#     db.close()

# # Menu for User Actions
# def main():
#     while True:
#         print("\n🔹 1. Register\n🔹 2. Login\n🔹 3. Exit")
#         choice = input("Select an option: ")

#         if choice == "1":
#             register_user()
#         elif choice == "2":
#             login_user()
#         elif choice == "3":
#             print("Exiting...")
#             break
#         else:
#             print(" Invalid choice, try again!")

# if __name__ == "__main__":
#     main()
import mysql.connector
import bcrypt
import getpass  # Secure password input

# MySQL Database Connection with Error Handling
def connect_db():
    try:
        return mysql.connector.connect(
            host="localhost",
            user="root",
            password="",
            database="secure_auth"
        )
    except mysql.connector.Error as err:
        print(f"❌ Database Connection Error: {err}")
        exit()

# Hash Password with bcrypt (Salt is automatically included)
def hash_password(password):
    hashed_password = bcrypt.hashpw(password.encode('utf-8'), bcrypt.gensalt())  # Generates a unique salt automatically
    return hashed_password.decode('utf-8')  # Store only the hashed password (bcrypt includes salt internally)

# Verify Password
def verify_password(password, stored_hashed_password):
    return bcrypt.checkpw(password.encode('utf-8'), stored_hashed_password.encode('utf-8'))

# Register User
def register_user():
    db = connect_db()
    cursor = db.cursor()

    username = input("Enter username: ").strip()
    email = input("Enter email: ").strip()
    password = getpass.getpass("Enter a secure password: ").strip()

    if not username or not email or not password:
        print("❌ Fields cannot be empty!")
        return

    hashed_password = hash_password(password)  # No need to store separate salt

    try:
        cursor.execute(
            "INSERT INTO users (username, email, hashed_password) VALUES (%s, %s, %s)",
            (username, email, hashed_password)
        )
        db.commit()
        print("✅ User registered successfully!")
    except mysql.connector.IntegrityError:
        print("❌ Email already exists! Please use another email.")
    except mysql.connector.Error as err:
        print(f"❌ Database Error: {err}")

    cursor.close()
    db.close()

# Login User
def login_user():
    db = connect_db()
    cursor = db.cursor()

    email = input("Enter email: ").strip()
    password = getpass.getpass("Enter your password: ").strip()

    cursor.execute("SELECT hashed_password FROM users WHERE email = %s", (email,))
    result = cursor.fetchone()

    if result:
        stored_hashed_password = result[0]  # Fetch only the stored hashed password
        if verify_password(password, stored_hashed_password):
            print("✅ Login successful!")
        else:
            print("❌ Invalid password!")
    else:
        print("❌ User not found!")

    cursor.close()
    db.close()

# Menu for User Actions
def main():
    while True:
        print("\n🔹 1. Register\n🔹 2. Login\n🔹 3. Exit")
        choice = input("Select an option: ").strip()

        if choice == "1":
            register_user()
        elif choice == "2":
            login_user()
        elif choice == "3":
            print("🚀 Exiting...")
            break
        else:
            print("❌ Invalid choice, try again!")

if __name__ == "__main__":
    main()
