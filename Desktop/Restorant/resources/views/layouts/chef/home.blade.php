@extends('layouts.chef')

@section('content')
<table class="table">
    <tbody>
        <tr>
            <th class="bg-dark text-light">Food</th>
            <th class="text-center bg-dark text-light">Quantity</th>
            <th class="text-center bg-dark text-light">Action</th>
        </tr>
        @foreach ($food_invoice as $row)
            <tr>
                <td>{{ $row->food->sub_category->name_en }} - {{ $row->food->name_en }}</td>
                <td class="text-center">{{ $row->quantity }}</td>
                <td class="d-flex justify-content-center">
                    <form class="text-center m-1" action="{{ route('chef.update_status' , ['id'=> $row->id , 'status' => ($row->status == 1 ? 2 : 1)]) }}" method="POST">
                        @csrf
                        <button class="btn btn-{{ ($row->status == 1 ? 'success' : 'warning') }} text-center ">
                            {{ ($row->status == 1 ? 'Ready' : 'Not Ready') }}
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection