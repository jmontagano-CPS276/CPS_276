<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body style="background-image: url('/~jmontagano/cps276/recipe_website/images/login-image.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; min-height: 100vh;">
  <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="col-md-4">
      <div class="card shadow border border-dark text-white p-4" style="background-color: rgba(0,0,0,0.6);">
        <div class="card-body">
          <h4 class="card-title text-center mb-4">Login</h4>
          <form>
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="email" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
