@extends('user_dash.dashboard')
@section('content')

<div class="iq-card">
    <div class="iq-card-header d-flex justify-content-between">
       <div class="iq-header-title">
          <h4 class="card-title">Orders</h4>
       </div>
    </div>
    <div class="iq-card-body">
        <div class="table-responsive">
            <table id="datatable" class="table table-striped table-bordered" >
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Model Name</th>
                        <th>Service Name</th>
                        <th>Additional information</th>
                        <th>Price $</th>
                        <th>Status</th>
                        <th>Created at</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($orders) == 0)
                        <tr>
                            <td class="text-center" colspan="8">No orders detected</td>
                        </tr>
                    @endif
                    @foreach ($orders as $order)    
                        <tr>
                            <td><a href="https://commerce.coinbase.com/charges/{{ $order->payment_id }}">{{ $order->payment_id }}</a></td>
                            <td>{{ $order->model_name }}</td>
                            <td>{{ $order->service_name }}</td>
                            <td>{{ $order->info }}</td>
                            <td>{{ $order->price}} + 2$ fee</td>
                            <td>
                                @if ($order->current_status=='NEW')
                                    <span class="badge badge-info">{{ $order->current_status }}</span>
                                @elseif($order->current_status=='PAYED')
                                    <span class="badge badge-secondary">{{ $order->current_status }}</span>
                                @elseif($order->current_status=='FAILED')
                                    <span class="badge badge-danger">{{ $order->current_status }}</span>
                                @elseif($order->current_status=='COMPLETED')
                                    <span class="badge badge-success">{{ $order->current_status }}</span>
                                @endif
                            </td>
                            <td>{{ $order->created_at }}</td>
                            <td>
                                @if($order->current_status == 'COMPLETED')
                                    <a href="{{ route('receiveImages', $order->payment_id) }}"><button class="btn btn-success" type="button">Receive images</button></a>
                                @else
                                    <button class="btn btn-success" type="button" disabled>Receive images</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection