<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" href="forget&reset.css" />
    <link rel="icon" href="images/Logo.png" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
    <script>
        emailjs.init("numlKcOVwWkicvrZv"); // Replace with your EmailJS public key

        async function sendResetCode(event) {
            event.preventDefault();

            const email = document.getElementById('email').value;

            const response = await fetch('generate_reset_code.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'email=' + encodeURIComponent(email)
            });

            const data = await response.json();

            if (data.success) {
                // Send reset code email
                emailjs.send('service_3ec9fg1', 'template_c7whubl', {
                    user_email: data.email,
                    reset_code: data.reset_code
                }).then(() => {
                    alert('Reset code sent to your email!');
                    // Redirect to verification page with email in query string
                    window.location.href = `verify_code.php?email=${encodeURIComponent(email)}`;
                }).catch(err => {
                    alert('Failed to send email: ' + err.text);
                });
            } else {
                alert(data.message);
            }
        }
    </script>
</head>
<body>
    <main>
        <div class="container" role="main" aria-label="Forgot Password Form">
            <h2>Forgot Password</h2>
            <form id="forgotForm" onsubmit="sendResetCode(event)" aria-describedby="reset-instructions">
                <label for="email">Enter your registered Email Address</label>
                <input type="email" id="email" name="email" placeholder="your.email@example.com" required autofocus />
                <button type="submit" aria-label="Reset Password">Reset Password</button>
            </form>
        </div>
    </main>
</body>
</html>
