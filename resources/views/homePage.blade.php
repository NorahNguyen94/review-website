@extends('layouts.master')

@section('title')
    Home Page
@endsection

@section('content')
{{-- {{dd($items)}} --}}
    <!-- CONTENT OF THE PAGE -->
    <main>
        <div class="content-container">
            <!-- ADD ITEM SECTION -->
            <div class="add-item-container">
                <button type="button" class="my-button" data-bs-toggle="modal" data-bs-target="#addItemModal">Add item</button>

                <!-- ADD ITEM MODAL -->
                <div class="modal fade" id="addItemModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Item</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <label for="reviewTitle">Product name</label>
                                        <input type="text" class="form-control" id="reviewTitle"
                                            placeholder="Enter product name">
                                    </div>
                                    <div class="form-group">
                                        <label for="reviewTitle">Manufacturer</label>
                                        <input type="text" class="form-control" id="reviewTitle"
                                            placeholder="Enter manufacturer">
                                    </div>
                                    <div class="form-group">
                                        <label for="reviewContent">Description</label>
                                        <textarea class="form-control" id="reviewContent" rows="5" placeholder="Enter product description"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="imageUpload" class="btn btn-primary">Upload image</label>
                                        <input type="file" name="" id="imageUpload" accept="image/*">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CARD FILTER -->
            <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <span id="filter-icon"><i class="fa-solid fa-filter"></i></span>Sort by</button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{url("sort/high-to-low-review")}}">Review Count: High to Low</a></li>
                    <li><a class="dropdown-item" href="{{url("sort/low-to-high-review")}}">Review Count: Low to High</a></li>
                    <li><a class="dropdown-item" href="{{url("sort/high-to-low-rating")}}">Rating: High to Low</a></li>
                    <li><a class="dropdown-item" href="{{url("sort/low-to-high-rating")}}">Rating: Low to High</a></li>
                </ul>
            </div>

            <!-- CARD CONTAINER -->
            <div class="card-container">
                @forelse ($items as $item)
                    <a href="{{ url("item_detail/ $item->Item_id") }}">
                        <div class="card">
                            <img src="{{asset('images/'.$item->Image)}}" class="card-img">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->Name }}</h5>
                                <h6>{{ $item->Manufacturer}}</h6>
                                <p class="card-text">{{ $item->Description }}</p>
                            </div>
                            <div class="rating">
                                <div class="stars">
                                    <span>{{ $item->Rating }}</span>
                                    <i class="fa-solid fa-star"></i>
                                    {{-- <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i> --}}
                                </div>
                                <div class="review-total">
                                    <p>({{$item->Total}})</p>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                @endforelse
            </div>
        </div>
    </main>
@endsection
