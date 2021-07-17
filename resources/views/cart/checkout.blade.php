@extends("layout")
@section("page_title","Cart")
@section("main")
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <h1 class="m-0">Checkout</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <form action="{{url("create-order")}}" method="POST">
                @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Customer Name</label>
                        <input type="text" name="customer_name" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Customer Telephone</label>
                        <input type="tel" name="customer_tel" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Customer Address</label>
                        <textarea name="customer_address" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <select name="city" class="form-control">
                            <option value="hn">Hà Nội</option>
                            <option value="sg">Tp HCM</option>
                            <option value="dn">Đà Nẵng</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-outline-danger" type="submit">Checkout</button>
                    </div>
                </div>
                <div class="col-6">
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
                        @foreach($cart as $item)
                            <tr>
                                <td>{{$loop->index +1}}</td>
                                <td>{{$item->name}}</td>
                                <td><img height="50px" width="50px" src="{{$item->getImage()}}" /> </td>
                                <td>{{$item->price}}</td>
                                <td>{{$item->cart_qty}}</td>
                                <td>{{$item->cart_qty * $item->price}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5">Grand Total</td>
                                <td>{{$grandTotal}}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            </form>
        </div>
    </section>
@endsection
