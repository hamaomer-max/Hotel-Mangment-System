@extends('layouts.chef')

@section('content')


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
                    <div class="card w-100">
                        <div class="card-body inputsBox">
                            <p class="text-dark mt-4">{{ $food->name_en }}</p>
                            <p class="text-dark mt-4">{{ $food->price }}</p>
                            <input type="hidden" name="food_id[]" value="{{ $food->id }}">
                            <input type="hidden" name="price[]" value="{{ $food->price }}">
                            <div class="d-flex justify-content-between">
                                <form action="{{ route('chef.available' , ['id' => $food->id]) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-info text-white me-2"><i class="bi bi-arrow-clockwise"></i></button>
                                </form>

                                <p class="me-4">Current Status: {!! $food->is_available ? '<span class="text-success fw-bold">Available</span>' : '<span class="text-danger fw-bold"> <br>
                                    Not Available</span>' !!}</p>
                            </div>
                        </div>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach

    </div>
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