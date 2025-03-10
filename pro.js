async function hashWithSalt() {
    // Get the password from the input field
    const password = document.getElementById("password").value;

    // Generate a random salt (for demonstration purposes)
    const salt = Math.random().toString(36).substring(2, 15);

    // Combine password and salt
    const saltedPassword = password + salt;

    // Hash the combined password and salt
    const hashedPassword = await sha256(saltedPassword);

    // Display the results
    document.getElementById("result").innerHTML = `Original Password: ${password}<br> 
                                                    Salt: ${salt}<br> 
                                                    Salted and Hashed Password: ${hashedPassword}`;
}

// A simple SHA-256 hashing function (for demonstration purposes)
async function sha256(input) {
    const encoder = new TextEncoder();
    const data = encoder.encode(input);
    const hashBuffer = await crypto.subtle.digest('SHA-256', data);

    const hashArray = Array.from(new Uint8Array(hashBuffer));
    return hashArray.map(byte => byte.toString(16).padStart(2, '0')).join('');
}