@if (session("success"))
  <div class="alert alert-success">
    {{ session("success") }}
  </div>
@endif

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Lara Crude</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center mb-4">My Lara Crude</h1>

    <!-- Crude Section -->
    <div class="card">
        <div class="card-header">
           <h5> Crude Operations </h5>
        </div>
        <div class="card-body">
            <table class="table mt-3 table-hover table-bordered text-center">
                <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <!-- Sample data, replace this with actual data from your Laravel application -->
				@if (isset($data) && count($data) > 0)
                @foreach ($data as $new)
                <tr>
                    <td>{{ $new->id }}</td>
                    <td>{{ $new->name }}</td>
                    <td>{{ $new->phone }}</td>
                    <td>{{ $new->email }}</td>
                    <td>{{ $new->password }}</td>
                    <td><img src="{{ $new->image }}" width="45px" alt="" srcset=""></td>
                    <td>
                        <a href="{{ route('/editForm',['id'=>$new->id]) }}" class="btn btn-sm btn-info">Edit</a>
                        <a href="{{ route('/deleteData',['id'=>$new->id]) }}" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
                @endforeach
                @endif
                <!-- End of sample data -->
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Include Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
