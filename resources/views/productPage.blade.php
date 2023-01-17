@extends('layouts.app')

@section('content')
@foreach ($info as $i)
<div class="container px-4 px-lg-5 my-5">
    <div class="row gx-4 gx-lg-5 align-items-center">
        <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{'storage/img/'.$i->image}}" alt="..."/></div>
        <div class="col-md-6">
            <div class="small mb-1">{{$nameCategory}}</div>
            <h1 class="display-5 fw-bolder">{{$i->name}}</h1>
            <p>{{$i->opis}}</p>
            <div class="fs-5 mb-5">
                <p class="text-price">Price: </p>
                @foreach ($products as $p)
                @if ($p->id_product == $i->id)
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                    <label class="form-check-label" for="flexRadioDefault1">
                        {{$p->price}}
                    </label>
                </div>
                @endif
                @endforeach

            </div>
            <p class="lead"></p>
        </div>
    </div>
</div>
@endforeach
@endsection
