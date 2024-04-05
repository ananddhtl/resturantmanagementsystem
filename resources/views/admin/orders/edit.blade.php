@extends('admin.layouts.main')

@section('title')
    Edit Order
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Edit Order</strong>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-primary float-end"><i class="bx bx-list-ul"></i>
                Back</a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Customer Name <b>*</b></label>
                        <input type="text" class="form-control" id="customer_name" name=""
                            placeholder="Enter the name..." value="{{ $order->user->name }}" disabled
                            style="background-color: white;">
                    </div>
                    <div class="col-md-6">
                        <label for="status" class="form-label">Status <b>*</b></label>
                        <select name="status" id="" class="form-select" role="button">
                            <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Processing" {{ $order->status == 'Processing' ? 'selected' : '' }}>Processing
                            </option>
                            <option value="Completed" {{ $order->status == 'Completed' ? 'selected' : '' }}>Completed
                            </option>
                            <option value="Cancelled" {{ $order->status == 'Cancelled' ? 'selected' : '' }}>Cancelled
                            </option>
                        </select>
                    </div>
                </div>

                <div class="form-group row mt-5">
                    <div class="container-fluid">
                        <label for="">Order Items</label>
                        <div class="table-responsive mt-4">
                            <table class="table w-100 table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Product</th>
                                        <th>Image</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($order_items as $order_item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $order_item->product->name ?? '--' }}</td>
                                            <td>
                                                @isset($order_item->product->image)
                                                    <a target="_blank"
                                                        href="{{ url('uploads/' . $order_item->product->image->file_name) }}"><img
                                                            src="{{ asset('uploads/' . $order_item->product->image->file_name) }}"
                                                            alt="{{ $order_item->product->image->file_name }}" width="50"
                                                            height="50" alt="product image"></a>
                                                @endisset
                                            </td>
                                            <td>{{ $order_item->quantity }}</td>
                                            <td>Rs. {{ $order_item->product ? number_format($order_item->product->price) : '--' }}
                                            </td>
                                            <td>Rs. {{ $order_item->product ? $order_item->product->price * $order_item->quantity : '--' }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">No Data Available.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end mr-3 mt-4">
                                <div class="col-md-3">
                                    <table class="w-100">
                                        <tr>
                                            <td>Sales Total</td>
                                            <td>: Rs. {{ number_format($order->sales_total) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Discount</td>
                                            <td>: Rs. {{ number_format($order->discount) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Grand Total</td>
                                            <td>: Rs. {{ number_format($order->grand_total) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update Order Status</button>
            </form>
        </div>
    </div>
@endsection
