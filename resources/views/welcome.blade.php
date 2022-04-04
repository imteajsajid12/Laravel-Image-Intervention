<!DOCTYPE html>
<html lang="en">
<head>
    <title>Laravel Image Intervention</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>

    <div class="container">
        <h3 class="jumbotron">Laravel Image Manipulation </h3>
        <form method="post" action="{{url('products')}}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Name">
                </div>
                <div class="form-group">
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Upload Image</button>
                </div>
            </div>
            @csrf
        </form>
    </div>
</body>
</html>

