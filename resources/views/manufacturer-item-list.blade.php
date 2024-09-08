@extends('layouts.master')

@section('title')
    Home Page
@endsection

@section('content')
    <!-- CONTENT OF THE PAGE -->
    <main>
        <div class="content-container">
            <h3 id="manufacturer-heading"> {{ $manufacturer }} </h3>
            <!-- CARD CONTAINER -->
            <div class="card-container">
                @forelse ($items as $item)
                    <div class="card">
                        <div>
                            <button class="btn btn-secondary dropdown-toggle" id="deleteButton" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ url("$item->Item_id/delete") }}"><i
                                            class="fa-solid fa-trash"></i>Delete item</a></li>
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
                @endforelse
            </div>
        </div>
    </main>
@endsection
