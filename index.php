<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
  <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
  <header>
    <h1>Online Voting System</h1>
  </header>
  
  <div class="login-container">
    <h2>Login</h2>
    <form action= "api/login.php" method="post">
      <input type="text" placeholder="Username" name="email" required>
      <input type="password" placeholder="Password" name="password" required>
      <select id="dropdown" name="role">
        <option value="1">Voter</option>
        <option value="2">Group</option>
      </select>
      <button type="submit">Login</button>
    </form>
    <p>New User? <a href="views/registration.html">Registration here</a></p>
  </div>
</body>
</html>
