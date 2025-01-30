<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="login-container">
    <div class="login-box">
      <h1>Login</h1>
      <form action="<?php echo url('submit_login') ; ?> " method="post">
        <input type="hidden" name="_method" value="post" />
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>
        
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>
        
        <button type="submit" class="login-btn">Login</button>
      </form>
      <p class="signup-link">Don't have an account? <a href="#">Sign up</a></p>
    </div>
  </div>
</body>
</html>
<style>
    /* General Reset */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: Arial, sans-serif;
  background-color: #f4f4f9;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

.login-container {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 100%;
}

.login-box {
  background-color: #ffffff;
  padding: 20px 30px;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  text-align: center;
  width: 300px;
}

.login-box h1 {
  font-size: 24px;
  margin-bottom: 20px;
  color: #333333;
}

.login-box label {
  display: block;
  text-align: left;
  margin-bottom: 5px;
  font-size: 14px;
  color: #555555;
}

.login-box input {
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  border: 1px solid #cccccc;
  border-radius: 4px;
  font-size: 14px;
}

.login-box input:focus {
  border-color: #007bff;
  outline: none;
}

.login-btn {
  width: 100%;
  padding: 10px;
  background-color: #007bff;
  color: #ffffff;
  font-size: 16px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.login-btn:hover {
  background-color: #0056b3;
}

.signup-link {
  margin-top: 10px;
  font-size: 14px;
}

.signup-link a {
  color: #007bff;
  text-decoration: none;
}

.signup-link a:hover {
  text-decoration: underline;
}

</style>