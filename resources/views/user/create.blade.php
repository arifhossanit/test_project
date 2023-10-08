<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
</head>
<body>
  <nav class="navbar navbar-transparent navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll="100" id="sectionsNav">
    <div class="container">
      <div class="card">
        <div class="card-header">
          <h2>Create User</h2>
        </div>
        <div class="card-body">
          <form  action="{{ route('users_create') }}" method="POST">
            @csrf
            <input type="hidden" name="create_new_user" value="yes">
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
              <label for="account_type">Account Type</label>
              <select name="account_type" id="account_type" required>
                <option value="">--select--</option>
                <option value="Individual">Individual</option>
                <option value="Business">Business</option>
              </select>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" id="email" name="email" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Create</button>
          </form>
        </div>
      </div>
    </div>
  </nav>
</body>
</html>

<style>
    body {
  background: linear-gradient(45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
  background-size: 400% 400%;
}

.container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

.card {
  width: 300px;
  border: 1px solid #ddd;
  border-radius: 5px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  margin: auto;
  padding: 20px;
  background-color: #fff;

  .card-body {
    padding: 20px;
  }

  .form-group {
    margin-bottom: 25px;
    
    input,
    select {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      border-radius: 4px;
      border: 1px solid #ccc;
    }

    label {
      display: block;
      font-weight: bold;
    }
  }

  button:hover {
    background-color: #0056b3;
    transform: scale(1.05);
  }

  button[type="submit"] {
    width: 100%;
    padding: 10px;
    background-color: #3f51b5;
    color: white;
    border-radius: 4px;
    border: 0;
    cursor: pointer;
  }
}
</style>