@extends("layout")
@section("page_title","Categories")
@section("main")
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Categories</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url("admin/categories/new")}}">New category</a></li>
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
                        <th>Products count</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                       </thead>
                       <tbody>
                        @foreach($categories as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->products_count}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>{{$item->updated_at}}</td>
                            </tr>
                        @endforeach
                       </tbody>
                   </table>

                </div>
            </div>
        </div>
    </section>
@endsection
