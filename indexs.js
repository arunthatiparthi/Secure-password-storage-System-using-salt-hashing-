
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault();

            // Get input values
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            // Perform client-side validation (you should also validate on the server)
            if (username.trim() === '' || password.trim() === '') {
                alert('Please fill out all fields.');
                return;
            }

            // Assuming there's a login API endpoint on the server
            fetch('/api/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ username, password })
            })
            .then(response => response.json())
            .then(data => {
                // Handle the response from the server (success or error)
                console.log(data);
                if (data.success) {
                    alert('Login successful!');
                } else {
                    alert('Login failed. Please check your credentials.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    