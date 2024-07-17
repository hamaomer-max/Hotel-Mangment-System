@extends('layouts.server')

@section('content')
<div class="container mt-3 w-100 ms-5 justify-content-center row">
    @foreach ($data as $row)
        @php
            $hasOrders = false;
            foreach ($orders as $order) {
                if ($order->table_id == $row->id) {
                    $hasOrders = true;
                    break;
                }
            }
            $cardClass = $hasOrders ? 'card bg-success text-white ms-2' : 'card text-dark ms-2';
        @endphp
        <a href="{{ route('server.food', ['id' => $row->id]) }}" class="{{ $cardClass }}" style="width: 18rem;">
            <img src="../images/chair.png" class="card-img-top w-50 mx-auto" alt="...">
            <div class="card-body">
                <h4 class="text-center mt-3">{{ $row->table_num }}</h4>
            </div>
        </a>
    @endforeach
</div>
@endsection
