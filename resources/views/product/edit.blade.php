@extends("layout")
@section("page_title","Products")
@section("main")
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Products</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-6">
                    <form action="{{url("admin/products/update",["id"=>$product->id])}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" value="{{$product->name}}" class="form-control"/>
                            @error("name")
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="text-capitalize">Image</label>
                            <input type="text" name="image"  value="{{$product->image}}" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label class="text-capitalize">price</label>
                            <input type="number" name="price" value="{{$product->price}}" class="form-control"/>
                            @error("price")
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="text-capitalize">qty</label>
                            <input type="number" name="qty" value="{{$product->qty}}" class="form-control"/>
                            @error("qty")
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="text-capitalize">category</label>
                            <select name="category_id" class="form-control">
                                <option value="0">Select a category</option>
                                @foreach($categories as $item)
                                    <option @if($product->category_id == $item->id) selected @endif value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            @error("category_id")
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="text-capitalize">description</label>
                            <textarea name="description" class="form-control">{{$product->decription}}</textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-primary">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection
