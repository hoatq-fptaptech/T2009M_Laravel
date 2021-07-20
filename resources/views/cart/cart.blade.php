@extends("layout")
@section("page_title","Cart")
@section("main")
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <h1 class="m-0">Cart</h1>
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
                        <th>STT</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Cart Qty</th>
                        <th>Total</th>
                        </thead>
                        <tbody>
                        @forelse($cart as $item)
                            <tr>
                                <td>{{$loop->index +1}}</td>
                                <td>{{$item->name}}</td>
                                <td><img height="50px" width="50px" src="{{$item->getImage()}}" /> </td>
                                <td>{{$item->price}}</td>
                                <td>
                                    <form action="{{url("update-qty",["id"=>$item->id])}}" method="get">
                                        <input type="text" name="cart_qty" value="{{$item->cart_qty}}"/>
                                        <button class="btn btn-outline-primary" type="submit">Update</button>
                                    </form>
                                </td>
                                <td>{{$item->cart_qty * $item->price}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">Không có san phẩm nào</td>
                            </tr>
                        @endforelse
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="5"><a href="{{url("checkout")}}" class="btn btn-outline-danger">Checkout</a> </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
