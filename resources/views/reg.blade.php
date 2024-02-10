@if (session("success"))
  <div class="alert alert-success">
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
  <h2>Registration Forms</h2>
  <form action="{{ route('/add') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
    <div class="col-md-6 mt-4">
        <input type="text" class="form-control" placeholder="Enter name" name="name">
      </div>
      <div class="col-md-6 mt-4">
        <input type="number" class="form-control" placeholder="Enter phone" name="phone">
      </div>
      <div class="col-md-6 mt-4">
        <input type="email" class="form-control" placeholder="Enter email" name="email">
      </div>
      <div class="col-md-6 mt-4">
        <input type="password" class="form-control" placeholder="Enter password" name="password">
      </div>
      <div class="col-md-6 mt-4">
        <input type="file" class="form-control" placeholder="Enter image" name="image">
      </div>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Submit</button>
    <a type="submit" href="/" class="btn btn-warning mt-3">Home</a>
  </form>
</div>

</body>
</html>
