@extends('layouts.master')

@section('title')
    Manufacturers
@endsection

@section('content')
    <!-- CONTENT OF THE PAGE -->
    <main>
        <div class="review-container">
            <h3 class="manufacturer-heading">Manufacturer List</h3>
            @forelse ($manufacturers as $manufacturer)
                <div class="list-group">
                    <a href="{{url("$manufacturer->Manufacturer")}}" class="list-group-item list-group-item-action">
                        <div class="manufacturer">
                            {{ $manufacturer->Manufacturer }}
                            <div class="stars">
                                <span>{{ $manufacturer->ManufacturerAvgRating }}</span>
                                <i class="fa-solid fa-star"></i>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
            @endforelse
        </div>
    </main>
@endsection
