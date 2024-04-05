@extends('admin.layouts.main')

@section('title')
    Orders
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Orders</strong>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">S/N</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Reference ID</th>
                            <th scope="col">Sales Total</th>
                            <th scope="col">Discount</th>
                            <th scope="col">Total</th>
                            <th scope="col">Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->reference_id }}</td>
                                <td>Rs. {{ $order->sales_total ? number_format($order->sales_total) : '0' }}</td>
                                <td>Rs. {{ $order->discount ? number_format($order->discount) : '0' }}</td>
                                <td>Rs. {{ $order->grand_total ? number_format($order->grand_total) : '0' }}</td>
                                <td>{{ $order->status }}</td>
                                </td>
                                <td>
                                    <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-sm btn-primary"><i
                                            class="bx bx-edit"></i></a>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#delete{{ $order->id }}">
                                        <i class="bx bx-trash"></i>
                                    </button>

                                    <div class="modal fade" id="delete{{ $order->id }}" tabindex="-1"
                                        aria-labelledby="deleteLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteLabel">Delete Order</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this Order?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <form action="{{ route('admin.orders.destroy', $order->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No Orders found...</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="my-3">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
    </div>
@endsection
