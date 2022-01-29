<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Order - Search</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid mt-5">

        <div class="mx-auto" style="width: 350px;">
            <form action="/" method="GET">
                <input class="form-control form-control-lg" type="query" name="query" value="{{ $query_str ?? '' }}" placeholder="What do you want to eat?">
                <div class="d-grid mx-auto mt-2">
                    <button type="submit" class="btn btn-primary btn-lg">Search</button>
                </div>
            </form>

            <div class="mt-3">
                @foreach ($items as $item)
                <div class="card mb-3 overflow-hidden" style="max-width: 540px; max-height: 145px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ $item->image }}" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title m-0 p-0">{{ $item->name }}</h5>
                                <span>${{ $item->cost }}</span>

                                <div class="mt-2">
                                    <form action="/cart" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>

        </div>

    </div>

</body>
</html>
