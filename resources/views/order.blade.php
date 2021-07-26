<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>Pizza Order</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body>
        <form class="form" action="{{ url('/post-order') }}" method="POST" enctype='multipart/form-data' accept-charset="UTF-8" role="form">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label text-right">Pizza:</label>
                    <div class="col-lg-6">
                        <select class="form-control" name="pizza_id" required>
                            @foreach($pizzas as $row)
                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label text-right">Pizza Ingredient:</label>
                    <div class="col-lg-6">
                        <select class="form-control" name="pizza_ingredient_id" required>
                            @foreach($pizza_ingredients as $row)
                            <option value="{{ $row->id }}">{{ $row->item_name }} {{ $row->extra_cost }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label text-right">Delivery Method:</label>
                    <div class="col-lg-6">
                        <select class="form-control" name="delivery_method_id" required>
                            @foreach($delivery_methods as $row)
                            <option value="{{ $row->id }}">{{ $row->method_name }} {{ $row->type }} {{ $row->cost }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label text-right">Address:</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="address" placeholder="Enter delivery address" required />
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-dark" id="submit">Submit</button>
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </div>
        </form>
    </body>
</html>
