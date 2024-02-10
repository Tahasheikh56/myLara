@if (session("success"))
  <div class="alert alert-danger">
    {{ session("success") }}
  </div>
@endif
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-3">
  <h2>Login Form</h2>
  <form action="{{ route('/userLogin') }}" method="post">
    @csrf
    <div class="row">
      <div class="col mt-4">
        <input type="email" class="form-control" placeholder="Enter email" name="email">
      </div>
      <div class="col mt-4">
        <input type="password" class="form-control" placeholder="Enter password" name="password">
      </div>
    </div>
    <button type="submit" class="btn btn-success mt-3">Login</button>
    <a type="submit" href="/" class="btn btn-warning mt-3">Home</a>
  </form>
</div>

</body>
</html>
