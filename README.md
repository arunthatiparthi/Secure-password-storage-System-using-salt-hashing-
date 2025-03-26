# Secure Password Storage System using Salt Hashing 🔐

## Overview
This project implements a **secure authentication system** using **bcrypt hashing with salt**. User passwords are **hashed and stored in a MySQL database** with added security layers to prevent **rainbow table attacks, brute-force attacks, and SQL injection.**  

---

## 📌 Features
👉 **Salted Hashing** – Uses `bcrypt` to securely hash passwords.  
👉 **MySQL Database** – Stores hashed passwords securely.  
👉 **User Authentication** – Allows users to **register, login, logout, and sign up**.  
👉 **SQL Injection Prevention** – Uses **parameterized queries**.  
👉 **Secure Login Handling** – Compares hashed passwords for authentication.  

---

## 🔹 Installation & Setup

### **1️⃣ Clone the Repository**
```sh
git clone https://github.com/arunthatiparthi/Secure-password-storage-System-using-salt-hashing.git
cd Secure-password-storage-System-using-salt-hashing
```

### **2️⃣ Install Required Dependencies**
```sh
pip install mysql-connector-python bcrypt
```

### **3️⃣ Set up the MySQL Database**
```sql
CREATE DATABASE secure_auth;
USE secure_auth;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    salt VARCHAR(255) NOT NULL,
    hashed_password VARCHAR(255) NOT NULL
);
```

### **4️⃣ Configure Database in `db_connect.py`**
Edit `db_connect.py` and set your **MySQL credentials**:
```python
conn = mysql.connector.connect(
    host="localhost",
    user="your_mysql_username",
    password="your_mysql_password",
    database="secure_auth"
)
```

### **5️⃣ Run the Python Authentication System**
```sh
python salt.py
```
- You can **register** users and **log in** via this Python script.

---

## 💻 Usage

### **Register a User (Python)**
1. **Run** `salt.py`  
2. Enter a username, email, and password.  
3. The password will be **salted, hashed, and stored in MySQL**.  

### **Signup a New User (Web - PHP)**
1. Open `signup.html` in a browser.  
2. Fill in the **username, email, and password** fields.  
3. Submit the form, and your details will be stored securely.  
4. The password will be **salted and hashed before storage**.  

### **Login a User (Python)**
1. **Run** `salt.py` again.  
2. Enter email and password.  
3. If credentials match, the login is **successful**.  

### **Web-Based Login (PHP)**
- Open `index.html`, click **Login**, and use `login.php` to authenticate.  
- After successful login, users are redirected to **dashboard.html**.  

---

## 🛠 Technologies Used
- **Frontend**: HTML, CSS  
- **Backend**: Python, PHP  
- **Database**: MySQL  
- **Security**: `bcrypt` for hashing

---  

## 🔗 Additional Notes
- Ensure **MySQL is running** before starting the system.  
- You can add **error handling and logging** to enhance security.  

---

🚀 **Your project is now fully documented!**  
To add this `README.md` to your GitHub repository, run:  
```sh
touch README.md
nano README.md  # (or open in VS Code)
```
Copy-paste the content above, then save and push:  
```sh
git add README.md
git commit -m "Updated README file"
git push origin main
```

💪 **Your GitHub repository will now display this updated README!**  


