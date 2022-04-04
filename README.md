<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

# Laravel Image Intervention

## Create Model & Migration

```
php artisan make:migration create_products_table
```
```
/**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('image');           
            $table->timestamps();
        });
    }

```
## create the view file
```
<html lang="en">
<head>
    <title>Laravel  Image Intervention</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h3 class="jumbotron">Laravel  Image Manipulation </h3>
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
```
## Create the controller & Route
```
Route::resource('products', ProductController::class);
```
```
/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }
```
## Install Intervention Image Package
```
composer require intervention/image
```
### Find the providers in config >> app.php file and register the ImageServiceProvider.
```
'providers' => [
        // ...
        Intervention\Image\ImageServiceProvider::class,
    ]
	
	Locate the aliases in config >> app.php file and register the aliases.
	
	'aliases' => [
        // ...
       'Image' => Intervention\Image\Facades\Image::class,
    ]
```
## Submit the form and upload the image
```
//ProductController.php

use App\Product;
use Image;

public function store(Request $request)
    {
        $image       = $request->file('image');
        $filename    = $image->getClientOriginalName();

        //Fullsize
        $image->move(public_path().'/full/',$filename);

        $image_resize = Image::make(public_path().'/full/'.$filename);
        $image_resize->fit(300, 300);
        $image_resize->save(public_path('thumbnail/' .$filename));

        $product= new Product();
        $product->name = $request->name;
        $product->image = $filename;
        $product->save();

        return back()->with('success', 'Your product saved with image!!!');
    }
```
### IMTEAJ SAJID
