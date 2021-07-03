@extends("layout")
@section("page_title","Products")
@section("main")
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <h1 class="m-0">Products</h1>
                </div><!-- /.col -->
                <div class="col-sm-5">
                    <form action="{{url("admin/products")}}" method="get">
                        <input type="text" name="search" class="form-control-sm" placeholder="search"/>
                        <select name="category_id" class="form-control-sm">
                            <option value="0">Select category</option>
                            @foreach($categories as $item)
                                <option @if(app("request")->input("category_id")== $item->id) selected @endif value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>

                        <button class="btn btn-primary btn-sm" type="submit">Search</button>
                    </form>
                </div>
                <div class="col-sm-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url("admin/products/new")}}">New product</a></li>
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
                                <td>{{$loop->index +1}}</td>
                                <td>{{$item->name}}</td>
                                <td><img height="50px" width="50px" src="{{$item->getImage()}}" /> </td>
                                <td>{{$item->description}}</td>
                                <td>{{$item->price}}</td>
                                <td>{{$item->qty}}</td>
{{--                                <td>{{$item->category_name}} (Su dung Join table)</td>--}}
                                <td>{{$item->Category->name}}</td>
                                <td>{{formatDate($item->created_at)}}</td>
                                <td>{{formatDate($item->updated_at)}}</td>
                                <td>
                                    <a href="{{url("admin/products/edit",["id"=>$item->id])}}" class="btn btn-outline-primary">Edit</a>
                                    <a onclick="return confirm('Chắc chắn xóa sản phẩm {{$item->name}} ?')" href="{{url("admin/products/delete",["id"=>$item->id])}}" class="btn btn-outline-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                       </tbody>
                   </table>
                    {!! $products->appends(request()->input())->links("vendor.pagination.default") !!}
                </div>
            </div>
        </div>
    </section>
@endsection
