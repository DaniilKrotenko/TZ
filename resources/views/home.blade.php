@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>


                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                aria-selected="true">Products
                        </button>
                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                                type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Categories
                        </button>
                        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact"
                                type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Ads
                        </button>
                    </div>
                </nav>


                <form action="{{ url('/add-product') }}" enctype="multipart/form-data" method="Post">
                    @csrf
                    <div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Name:</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                               value="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="message-text"
                                               class="col-form-label">Description:</label>
                                        <input type="text" class="form-control" name="opis" id="opis"
                                               value="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="message-text" class="col-form-label">Image:</label>
                                        <input type="file" class="form-control-file" name="image"
                                               id="exampleFormControlFile1" value="">
                                    </div>
                                    <div class="mb-3">

                                        <label for="message-text" class="col-form-label">price:</label>
                                        <input type="text" class="form-control m-2"
                                               style="width: 15%;  display: inline-block" name="price[]"
                                               id="exampleFormControlFile1" value="">
                                        <div style="display: inline-block">
                                            <button type="button" class="addPrice btn btn-secondary"
                                                    style="font-size: 18px">+
                                            </button>
                                        </div>

                                    </div>
                                    <div class="mb-3">
                                        <label for="message-text" class="col-form-label">Category:</label>
                                        <select class="form-control" name="category" required>
                                            <option selected disabled
                                                    value="">Categories
                                            </option>
                                            @foreach($categories as $c)
                                            <option value="{{$c->id}}">{{$c->categories}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Close
                                    </button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>


                <form action="{{ url('/add-category') }}" enctype="multipart/form-data" method="Post">
                    @csrf
                    <div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Name of Category:</label>
                                        <input type="text" class="form-control" name="categories" id="name"
                                               value="">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Close
                                    </button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <button type="button" class="btn btn-primary position-absolute end-0" data-bs-toggle="modal"
                                data-bs-target="#addProduct">
                            Add
                        </button>
                        <div id="tabs-1">
                            <div class="row p-2" style="align-items: center">
                                <div class="col-sm-1 col-md-1">ID</div>
                                <div class="col-md-1">Name</div>
                                <div class="col-md-2">Description</div>
                                <div class="col-md-2">Image</div>
                                <div class="col-md-2">Category</div>
                                <div class="btn btn-save col-sm-2 col-md-3"></div>
                            </div>
                            @foreach($info as $i)
                            <div class="row p-2">
                                <div class="col-9">
                                    <form action="{{ url('/edit-product') }}" enctype="multipart/form-data" method="Post">
                                        @csrf
                                        <input name="id" value="{{$i->id}}" hidden>
                                        <div class="row p-2" style="align-items: center">
                                            <div class="col-sm-1">{{$i->id}}</div>
                                            <div name="name" class="col-sm-2 ">{{$i->name}}</div>
                                            <div name="opis" class="col-sm-3">{{$i->opis}}</div>
                                            <div name="image" class="col-sm-2">{{$i->image}}</div>
                                            @foreach($categories as $c)
                                            @foreach($uniq as $u)
                                            @if($u->id_product == $i->id)
                                            @if($u->id_categorie == $c->id)
                                            <div name="category" class="col-sm-2">{{$c->categories}}</div>
                                            @endif
                                            @endif
                                            @endforeach
                                            @endforeach
                                            <button type="button" class="btn btn-primary col-1 m-2" data-bs-toggle="modal" data-bs-target="#exampleModal{{$i->id}}"><p>Edit</p></button>
                                        </div>

                                        <div class="modal fade" id="exampleModal{{$i->id}}" tabindex="-1"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="recipient-name" class="col-form-label">Name:</label>
                                                            <input type="text" class="form-control" name="name" id="name"
                                                                   value="{{$i->name}}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="message-text"
                                                                   class="col-form-label">Description:</label>
                                                            <input type="text" class="form-control" name="opis" id="opis"
                                                                   value="{{$i->opis}}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="message-text" class="col-form-label">Image:</label>
                                                            <input type="file" class="form-control-file" name="image"
                                                                   id="exampleFormControlFile1" value="{{$i->image}}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="message-text" class="col-form-label">Category:</label>
                                                            <select class="form-control" name="category">
                                                                <option selected disabled
                                                                        value="{{old('category', 'selected')}}">Categories
                                                                </option>
                                                                @foreach($categories as $c)
                                                                <option value="{{$c->id}}">{{$c->categories}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                            Close
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-3">
                                    <form action="{{ url('/delete-product') }}" method="Post">
                                        @csrf
                                        <input hidden name="id" value="{{$i->id}}">
                                        <button type="submit" class="btn btn-primary col-4 m-3"><p>Delete</p></button>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>


                    <!--      Categories    -->
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <button type="button" class="btn btn-primary position-absolute end-0" data-bs-toggle="modal"
                                data-bs-target="#addCategory">
                            Add
                        </button>
                        <div id="tabs-1">
                            <div class="row p-2" style="align-items: center">
                                <div class="col-sm-1 col-md-1">ID</div>
                                <div class="col-sm-2 col-md-2">Category</div>
                                <div class="btn btn-save col-sm-2 col-md-3"></div>
                            </div>
                            @foreach($categories as $c)
                            <div class="row">
                                <div class="col-5">

                                    <div class="row p-2" style="align-items: center">
                                        <div class="col-sm-1">{{$c->id}}</div>
                                        <div name="category" class="col-sm-4 m-3">{{$c->categories}}</div>
                                        <button type="button" class="btn btn-primary col-2 m-2" data-bs-toggle="modal"
                                                data-bs-target="#editCategory{{$c->id}}">
                                            Edit
                                        </button>
                                        <form action="{{ url('/edit-category') }}" method="Post">
                                            @csrf
                                            <div class="modal fade" id="editCategory{{$c->id}}" tabindex="-1"
                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <input name="id" value="{{$c->id}}" hidden>
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit
                                                                Product</h5>
                                                            <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="recipient-name"
                                                                       class="col-form-label">Name:</label>
                                                                <input type="text" class="form-control"
                                                                       name="categories" id="name"
                                                                       value="{{$c->categories}}">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">
                                                                Close
                                                            </button>
                                                            <button type="submit" class="btn btn-primary">Save changes
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>


                                    </div>
                                </div>
                                <div class="col-3">
                                    <form action="{{ url('/delete-category') }}" method="Post">
                                        @csrf
                                        <input name="id_category" value="{{$c->id}}" hidden>
                                        <button type="submit" class="btn btn-primary col-lg-5 m-2">
                                            <p>Delete</p>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>


                    <!--  Products View  -->
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <div id="tabs-1">
                            <div class="row p-2" style="align-items: center">
                                <div class="col-sm-1 col-md-1">ID</div>
                                <div class="col-md-2">ID Product</div>
                                <div class="col-md-2">ID Category</div>
                                <div class="col-md-2">Price</div>
                                <div class="btn btn-save col-sm-2 col-md-3"></div>
                            </div>
                            @foreach($products as $p)
                            <div class="row p-2" style="align-items: center">
                                <div class="col-9">
                                    <input name="id" value="{{$i->id}}" hidden>
                                    <div class="row pl-2" style="align-items: center">
                                        <div class="col-sm-1">{{$p->id}}</div>
                                        @foreach($info as $i)
                                        @if ($i->id == $p->id_product)
                                        <div name="name" class="col-sm-2 m-4">{{$p->id_product}} ({{$i->name}})</div>
                                        @endif
                                        @endforeach
                                        @foreach($categories as $c)
                                        @if ($c->id == $p->id_categorie)
                                        <div name="opis" class="col-sm-2 m-4">{{$p->id_categorie}}
                                            ({{$c->categories}})
                                        </div>
                                        @endif
                                        @endforeach
                                        <div name="category" class="col-sm-2 m-4">{{$p->price}}</div>
                                        <button type="button" class="btn btn-primary col-2 m-2" data-bs-toggle="modal"
                                                data-bs-target="#editProduct{{$p->id}}">
                                            Edit
                                        </button>


                                        <form action="{{ url('/edit-product-view') }}" method="Post">
                                            @csrf
                                            <div class="modal fade" id="editProduct{{$p->id}}" tabindex="-1"
                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <input name="id" value="{{$p->id}}" hidden>
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit
                                                                Product Ads</h5>
                                                            <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="message-text" class="col-form-label">Product:</label>
                                                                <select class="form-control" value="{{$p->id_product}}" name="id_product">
                                                                    <option selected disabled>Categories</option>
                                                                    @foreach($info as $i)
                                                                    <option value="{{$i->id}}">{{$i->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="message-text" class="col-form-label">Category:</label>
                                                                <select class="form-control" value="{{$p->id_categorie}}" name="category">
                                                                    <option selected disabled>Categories</option>
                                                                    @foreach($categories as $c)
                                                                    <option value="{{$c->id}}">{{$c->categories}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="recipient-name" class="col-form-label">Price:</label>
                                                                <input type="text" class="form-control" name="price" id="price"
                                                                       value="{{$p->price}}">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">
                                                                Close
                                                            </button>
                                                            <button type="submit" class="btn btn-primary">Save changes
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>


                                    </div>
                                </div>

                                    <div class="col-3">
                                        <form action="{{ url('/delete-product-view') }}" method="Post">
                                            @csrf
                                            <input name="id" value="{{$p->id}}" hidden>
                                        <button type="submit" class="btn btn-primary col-4 m-2">
                                            <p>Delete</p>
                                        </button>
                                        </form>
                                    </div>

                            </div>

                            @endforeach
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        $(".addPrice").click(function () {
            $('.addPrice').parent().prepend('<input type="text" class="form-control m-2" style="display: inline-block; width: 15%" name="price[]" id="price" value="">');
        });
    });
</script>

@endsection
