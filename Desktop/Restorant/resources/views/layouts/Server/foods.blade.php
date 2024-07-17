@extends('layouts.server')

@section('content')

    

<div>
    <div class="d-flex justify-content-between">
       <h3> Table Number : {{ $table->table_num }} </h3> 
        <a href="{{ route('server.home') }}" class="btn btn-primary"> Back</a>
    </div>
</div>

@if ($invoice)
    

<div>
    <br>
    <div class="d-flex justify-content-between">
        <h4>Ordered Food</h4>
        <form id="{{ $invoice->id }}" action="{{ route('server.delete', ['id' => $invoice->id]) }}" method="POST">
            @csrf
            <button class="btn btn-danger w-100" type="submit"><i class="bi bi-trash"></i></button>
        </form>
    </div>
    <br>
    <table class="table">
        <tbody>
            <tr>
                <th class="bg-dark text-light">Food</th>
                <th class="text-center bg-dark text-light">Quantity</th>
                <th class="text-center bg-dark text-light">Action</th>
            </tr>
            @foreach ($invoice->invoice_foods as $row)
                <tr>
                    <td>{{ $row->food->sub_category->name_en }} - {{ $row->food->name_en }}</td>
                    <td class="text-center">{{ $row->quantity }}</td>
                    <td class="d-flex justify-content-center">
                        <form class="text-center m-1" action="{{ route('server.foods.plus_or_minus' , ['id'=> $row->id , 'value' => 1]) }}" method="POST">
                            @csrf
                            <button class="btn btn-success text-center "><i class="bi bi-plus"></i></button>
                        </form>
                        <form class="text-center m-1" action="{{ route('server.foods.plus_or_minus' , ['id'=> $row->id , 'value' => -1]) }}" method="POST">
                            @csrf
                            <button class="btn btn-danger text-center "><i class="bi bi-dash"></i></button>
                        </form>
                        <form class="text-center m-1" action="{{ route('server.delete_orders' , ['id'=> $row->id]) }}" method="POST">
                            @csrf
                            <button class="btn btn-outline-danger text-center "><i class="bi bi-trash"></i></button>
                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endif


<hr class="mt-4">

<div class="mt-4">
    <h4 class="text-dark">Categories:</h4>
    <div class="row mt-4">
        @foreach ($categoris as $row)
            <div class="col-3 p-2 m-auto">
                <div class="card" onclick="show_sub_categoris({{ $row->id }})">
                    <div class="card-body text-center">
                        <img src="{{ asset('categoris-image/'.$row->image) }}" class="col-12 w-50 mt-2 mb-3"> <br>
                        <h4 class="text-dark">{{ $row->name_en }}</h4>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="mt-4">
    <form action="{{ route('server.foods.store') }}" method="POST">
    @csrf
    <input type="hidden" name="table_id" value="{{ $table->id }}">
    <div class="row mt-4">
        @foreach ($sub_categories as $sub_category)
        <div class="category{{ $sub_category->category_id }} foods d-none" style="margin-bottom: 70px">
            <div class="d-flex align-items-center ms-4">
                <img src="{{ asset('categoris-image/'.$sub_category->image) }}" class="col-1 w-20 mt-3">
                <h4 class="text-dark ms-3 mt-2">{{ $sub_category->name_en }}</h4>
            </div>
            <div class="row mt-4">
                @foreach ($sub_category->foods as $food)
                <div class="col-3 text-center">
                    <div class="card" style="width: 13rem">
                        <div class="card-body inputsBox">
                            <p class="text-dark mt-4">{{ $food->name_en }}</p>
                            <p class="text-dark mt-4">{{ $food->price }}</p>
                            <input type="hidden" name="food_id[]" value="{{ $food->id }}">
                            <input type="hidden" name="price[]" value="{{ $food->price }}">
                            <div class="d-flex justify-content-between">
                                <button type="button" onclick="incrment({{ $food->id }})" class="btn btn-success me-2"><i class="bi bi-plus"></i></button>
                                <div class="col-3">
                                    <input readonly id="{{ $food->id }}" type="text" name="quantity[]" class="form-control text-center" value="0">
                                </div>
                                <button type="button" onclick="decrment({{ $food->id }})" class="btn btn-danger ms-2"><i class="bi bi-dash"></i></button>

                            </div>
                        </div>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach

    </div>
    <input type="number" name="total" value="" placeholder="Total Price" id="total" class="form-control align-items-center text-center mb-4 w-50 mt-4" style="margin-left: 165px">
    <button type="submit" name="order" class="btn btn-success col-10 w-25 ms-2 mt-4"><i class="bi bi-plus">Order</i></button>
    </form>
</div>

<script>
    let show_sub_categoris=(id)=>{
        let foods=document.getElementsByClassName('foods');
        if (foods.length>0) {
            for(let i=0;i<foods.length;i++){
                foods[i].classList.add('d-none');
        }   
        }

        let sub_categoris=document.getElementsByClassName('category'+id);
        if (sub_categoris.length>0) {
                for(let i=0;i<sub_categoris.length;i++){
                    sub_categoris[i].classList.toggle('d-none');        
            }   
        }
        
    }

    function incrment(id , price){
        let input=document.getElementById(id);
        input.value=parseInt(input.value)+1;

        cauclate();
    }

    function decrment(id){
        let input=document.getElementById(id);
        if (input.value>0) {
            input.value=parseInt(input.value)-1;   
        }

        cauclate();
    }

    function cauclate(){
        let inputs = document.getElementsByClassName('inputsBox');

        total=0;
        for(let i=0;i<inputs.length;i++){
            total += inputs[i].children[3].value * inputs[i].children[4].children[1].children[0].value;
        }

        document.getElementById('total').value=total;
    }
</script>
@endsection