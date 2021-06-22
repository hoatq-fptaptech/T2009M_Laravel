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
                        <li class="breadcrumb-item"><a href="{{url("products/new")}}">New product</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                   <table class="table table-striped table-bordered">
                       <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Category</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th></th>
                       </thead>
                       <tbody>
                        @foreach($products as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->image}}</td>
                                <td>{{$item->description}}</td>
                                <td>{{$item->price}}</td>
                                <td>{{$item->qty}}</td>
                                <td>{{$item->category_id}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>{{$item->updated_at}}</td>
                                <td>
                                    <a href="{{url("products/edit",["id"=>$item->id])}}" class="btn btn-outline-primary">Edit</a>
                                    <a onclick="return confirm('Chắc chắn xóa sản phẩm {{$item->name}} ?')" href="{{url("products/delete",["id"=>$item->id])}}" class="btn btn-outline-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                       </tbody>
                   </table>

                </div>
            </div>
        </div>
    </section>
@endsection
