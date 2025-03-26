# Secure Password Storage System using Salt Hashing

## Overview
This project implements a **secure password storage system** using **salted hashing** to protect against brute-force and rainbow table attacks. The system uses **MySQL** as the database and Python for backend logic.

## Features
- **User Registration:** Generates a unique salt and securely hashes passwords before storing them.
- **User Authentication:** Verifies password integrity by retrieving stored salt and comparing hashes.
- **SQL Injection Prevention:** Uses parameterized queries to enhance security.
- **Strong Hashing Algorithms:** Supports **PBKDF2, bcrypt, or Argon2**.

## Technologies Used
- **Python (Flask/Django)**
- **MySQL (Database Management)**
- **Hashlib / bcrypt / Argon2 (Password Hashing)**

---

## Database Setup
### Step 1: Create MySQL Database
Execute the following SQL script to set up the database:

```sql
CREATE DATABASE secure_auth;
USE secure_auth;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) UNIQUE NOT NULL,
    salt VARCHAR(64) NOT NULL,
    hashed_password VARCHAR(255) NOT NULL
);
```

### Step 2: Configure MySQL Connection in Python
Update `app.py` to connect with MySQL:

```python
import mysql.connector

db = mysql.connector.connect(
    host="localhost",
    user="your_user",
    password="your_password",
    database="secure_auth"
)
cursor = db.cursor()
```
Replace `your_user` and `your_password` with your actual MySQL credentials.

---

## Installation and Setup
1. **Clone the Repository:**
   ```sh
   git clone https://github.com/arunthatiparthi/Secure-password-storage-System-using-salt-hashing-.git
   cd Secure-password-storage-System-using-salt-hashing-
   ```
2. **Install Dependencies:**
   ```sh
   pip install -r requirements.txt
   ```
3. **Run the Application:**
   ```sh
   python app.py
   ```

---

## Usage
- **Register a User:** The system generates a salt, hashes the password, and stores it securely.
- **Login Authentication:** Compares the stored hash with the user-provided password.
- **Security Enhancements:** Supports rate limiting and automatic account locking.

---

## Future Improvements
- Implement **Multi-Factor Authentication (MFA)**
- Use **Argon2** for more advanced password hashing security.
- Deploy the system on **AWS or Heroku** for real-world usage.

---
