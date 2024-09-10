@extends('layouts.master')

@section('title')
    Home Page
@endsection

@section('content')
    {{-- {{dd($items)}} --}}
    <!-- CONTENT OF THE PAGE -->
    <main>
        {{-- Notification modal --}}
        <div class="modal fade" id="notificationModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Notification</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>{{ session('message') }}</p>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-container">
            <!-- ADD ITEM SECTION -->
            <div class="add-item-container">
                <button type="button" class="my-button" data-bs-toggle="modal" data-bs-target="#addItemModal">Add
                    item</button>

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
                                <form method="post" action="{{ url('add_item') }}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="reviewTitle">Product name</label>
                                        <input type="text" name="item_name" class="form-control" id="reviewTitle"
                                            placeholder="Enter product name">
                                        @if (session('item_name_error'))
                                            <p class="alert">{{ session('item_name_error') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="reviewTitle">Manufacturer</label>
                                        <input type="text" name="manufacturer" class="form-control" id="reviewTitle"
                                            placeholder="Enter manufacturer">
                                        @if (session('manufacturer_name_error'))
                                            <p class="alert">{{ session('manufacturer_name_error') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="reviewContent">Description</label>
                                        <textarea class="form-control" name="description" id="reviewContent" rows="5"
                                            placeholder="Enter product description"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="imageUpload" class="btn btn-primary">Upload image</label>
                                        <input type="file" name="image" id="imageUpload" accept="image/*">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <input type="submit" value="Save" class="btn btn-primary">
                                    </div>
                                </form>
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
                    <li><a class="dropdown-item" href="{{ url('sort/high-to-low-review') }}">Review Count: High to Low</a>
                    </li>
                    <li><a class="dropdown-item" href="{{ url('sort/low-to-high-review') }}">Review Count: Low to High</a>
                    </li>
                    <li><a class="dropdown-item" href="{{ url('sort/high-to-low-rating') }}">Rating: High to Low</a></li>
                    <li><a class="dropdown-item" href="{{ url('sort/low-to-high-rating') }}">Rating: Low to High</a></li>
                </ul>
            </div>

            <!-- CARD CONTAINER -->
            <div class="card-container">
                @forelse ($items as $item)
                    <div class="card">
                        <div>
                            <button class="btn btn-secondary dropdown-toggle" id="deleteButton" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{url($item->Item_id)}}/delete"><i class="fa-solid fa-trash"></i>Delete item</a></li>
                            </ul>
                        </div>
                        <a href="{{ url("item_detail/ $item->Item_id") }}">
                            <img src="{{ asset('images/' . $item->Image) }}" class="card-img">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->Name }}</h5>
                                <h6>{{ $item->Manufacturer }}</h6>
                                <p class="card-text">{{ $item->Description }}</p>
                            </div>
                            <div class="rating">
                                <div class="stars">
                                    <span>{{ $item->Rating }}</span>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                                <div class="review-total">
                                    <p>({{ $item->Total }})</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                <p> There are no items.</p>
                @endforelse
            </div>
        </div>
    </main>
@endsection

{{-- Show notification when a review added or updated --}}
@if (session('message'))
    @section('script')
        <script>
            var notificationModal = new bootstrap.Modal(document.getElementById('notificationModal'));
            notificationModal.show();
        </script>
    @endsection
@endif

{{-- Show the modal to display error --}}
@if (session('item_name_error') || session('manufacturer_name_error'))
    @section('script')
        <script>
            var modal = new bootstrap.Modal(document.getElementById('addItemModal'));
            modal.show();
        </script>
    @endsection
@endif
