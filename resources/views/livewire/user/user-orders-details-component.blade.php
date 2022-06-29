<div>
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-12">
                @if (Session::has('order_message'))
                    <div class="alert alert-success" role="alert">{{Session::get('order_message')}}</div>
                @endif
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Ordered Details
                            </div>
                            <div class="col-md-6">
                                <a href="{{route('user.orders')}}" class="btn btn-success pull-right">My Orders</a>
                                @if ($orders->status == "ordered")
                                    <a href="#" wire:click.prevent="cancelOrder" style="margin-right: 20px;" class="btn btn-warning pull-right">Cancel Orders</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                                <th>Order Id</th>
                                <td>{{$orders->id}}</td>
                                <th>Order Date</th>
                                <td>{{$orders->created_at}}</td>
                                <th>Status</th>
                                <td>{{$orders->status}}</td>
                                @if ($orders->status == "delivered")
                                <th>Delivery Date</th>
                                <td>{{$orders->delivered_date}}</td>
                                @elseif ($orders->status == "canceled")
                                <th>Canceled Date</th>
                                <td>{{$orders->canceled_date}}</td>
                                @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                                Ordered Items
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="wrap-iten-in-cart">
                                <h3 class="box-title">Products Name</h3>
                                <ul class="products-cart">
                                    @foreach ($orders->orderItems as $item)
                                        <li class="pr-cart-item">
                                            <div class="product-image">
                                                <figure><img src="{{ asset('assets/images/products')}}/{{ $item->product->image }}" alt="{{ $item->product->name }}"></figure>
                                            </div>
                                            <div class="product-name">
                                                <a class="link-to-product" href="{{route ('product.details',['slug'=>$item->product->slug]) }}">{{ $item->product->name }}</a>
                                            </div>
                                            <div class="price-field produtc-price"><p class="price">${{ $item->price }}</p></div>
                                            <div class="quantity">
                                                <h5>{{$item->quantity}}</h5>
                                            </div>
                                            <div class="price-field sub-total"><p class="price">${{ $item->price * $item->quantity }}</p></div>
                                            @if ($orders->status == 'delivered' && $item->rstatus == false)
                                                <div class="price-field sub-total"><p class="price"><a href="{{route('user.reviews',['order_item_id'=>$item->id])}}">Write Review</a></p></div>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            <div class="summary">
                                <div class="order-summary">
                                    <h4 class="title-box">Order Summary</h4>
							        <p class="summary-info"><span class="title">Subtotal</span><b class="index">${{$orders->subtotal }}</b></p>
							        <p class="summary-info"><span class="title">Tax</span><b class="index">${{$orders->tax }}</b></p>
							        <p class="summary-info"><span class="title">Free Shipping</span><b class="index">Free Shipping</b></p>
							        <p class="summary-info"><span class="title">Total</span><b class="index">${{$orders->total }}</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Billing Details
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <th>First Name</th>
                                <td>{{$orders->firstname}}</td>
                                <th>Last Name</th>
                                <td>{{$orders->lastname}}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{$orders->mobile}}</td>
                                <th>Email</th>
                                <td>{{$orders->email}}</td>
                            </tr>
                            <tr>
                                <th>Line1</th>
                                <td>{{$orders->line1}}</td>
                                <th>Line2</th>
                                <td>{{$orders->line2}}</td>
                            </tr>
                            <tr>
                                <th>City</th>
                                <td>{{$orders->city}}</td>
                                <th>Province</th>
                                <td>{{$orders->province}}</td>
                            </tr>
                            <tr>
                                <th>Country</th>
                                <td>{{$orders->country}}</td>
                                <th>Zipcode</th>
                                <td>{{$orders->zipcode}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if ($orders->is_shipping_different)
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Shipping Details
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <th>First Name</th>
                                <td>{{$orders->shipping->firstname}}</td>
                                <th>Last Name</th>
                                <td>{{$orders->shipping->lastname}}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{$orders->shipping->mobile}}</td>
                                <th>Email</th>
                                <td>{{$orders->shipping->email}}</td>
                            </tr>
                            <tr>
                                <th>Line1</th>
                                <td>{{$orders->shipping->line1}}</td>
                                <th>Line2</th>
                                <td>{{$orders->shipping->line2}}</td>
                            </tr>
                            <tr>
                                <th>City</th>
                                <td>{{$orders->shipping->city}}</td>
                                <th>Province</th>
                                <td>{{$orders->shipping->province}}</td>
                            </tr>
                            <tr>
                                <th>Country</th>
                                <td>{{$orders->shipping->country}}</td>
                                <th>Zipcode</th>
                                <td>{{$orders->shipping->zipcode}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Transaction
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <th>Transaction Mode</th>
                                <td>{{$orders->transaction->mode}}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{{$orders->transaction->status}}</td>
                            </tr>
                            <tr>
                                <th>Transaction Date</th>
                                <td>{{$orders->transaction->created_at}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
