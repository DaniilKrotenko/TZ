@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-sm-9"></div>
        <div class="col-sm-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Filter
            </button>
        </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Filter</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form name="add-blog-post-form" id="add-blog-post-form" method="get" action="{{url('/')}}">
                            <div class="modal-body">
                                <select class="form-select m-2" name="id_categorie" aria-label="Category">
                                    <option value="">All Category</option>
                                    @foreach ($categories as $c)
                                    <option  value="{{$c->id}}">{{$c->categories}}</option>
                                    @endforeach
                                </select>
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Search:</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                           value="">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">

        @foreach ($info as $i)
        @foreach ($uniqueCategory as $uniq)
        @foreach ($title as $t)
        @if( $t->name == $i->name)
        @if($i->id == $uniq->id_product)
        <div class="col-sm-3 m-3">
            <div class="card h-100 d-inline-block" style="width: 18rem; height: 95%">
                <img class="card-img-top" src="{{'storage/img/'.$i->image}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{$i->name}}</h5>
                        <p class="card-text text-price">
                            Price:
                            @foreach ($cate as $c)
                            @if ($i->id == $c->id_product)
                                <p name="price" class="price m-2">{{$c->price}}</p>
                            @endif
                            @endforeach
                        </p>
                    <a href="{{ route('productPage', ['id' => $i->id])}}" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        @endif
        @endif
        @endforeach
        @endforeach
        @endforeach


    </div>
</div>
@endsection
