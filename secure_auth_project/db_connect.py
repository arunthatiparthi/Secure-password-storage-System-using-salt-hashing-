import mysql.connector

# Function to establish database connection
def connect_db():
    try:
        conn = mysql.connector.connect(
            host="localhost",
            user="root",      # Default XAMPP MySQL user
            password="",      # Leave empty if no password
            database="secure_auth"
        )
        print(" Database Connected Successfully!")
        return conn
    except mysql.connector.Error as err:
        print(f" Database Connection Error: {err}")
        return None

# Test connection
if __name__ == "__main__":
    db = connect_db()
    if db:
        db.close()

def register_user(username, email, password, salt):
    db = connect_db()
    if db:
        cursor = db.cursor()
        query = "INSERT INTO users (username, email, salt, hashed_password) VALUES (%s, %s, %s, %s)"
        values = (username, email, salt, password)
        try:
            cursor.execute(query, values)
            db.commit()
            print(" User Registered Successfully!")
        except mysql.connector.Error as err:
            print(f" Error: {err}")
        cursor.close()
        db.close()
def get_user_by_email(email):
    db = connect_db()
    if db:
        cursor = db.cursor()
        query = "SELECT salt, hashed_password FROM users WHERE email = %s"
        cursor.execute(query, (email,))
        user = cursor.fetchone()
        cursor.close()
        db.close()
        return user

