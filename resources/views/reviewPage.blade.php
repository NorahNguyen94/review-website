@extends('layouts.master')

@section('title')
    Review Page
@endsection

@section('content')
    <!-- CONTENT OF THE PAGE -->
    <main>
        <div class="review-container">
            <div class="product-info row">
                <div class="img-container col-5">
                    <img src="images/sunglasses.jpg" alt="">
                </div>
                <div class="info-details col-7">
                    <div class="rate">
                        <div class="stars">
                            <span>4.5</span>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <div class="review-number">
                            <p><span>12</span> Reviews</p>
                        </div>
                    </div>
                    <h4>{{ $item->Name }}</h4>
                    <h5>{{ $item->Manufacturer }}</h5>
                    <p>{{ $item->Description }}</p>
                </div>
            </div>
            <div class="review-content">
                <div class="review-heading">
                    <h5>Review</h5>
                    <button type="button" class="my-button" data-bs-toggle="modal" data-bs-target="#addReviewModal">Write a
                        review</button>

                    <!-- Add Review Modal -->
                    <div class="modal fade" id="addReviewModal" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Review</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group">
                                            <label for="reviewTitle">Username</label>
                                            <input type="text" class="form-control" id="reviewTitle"
                                                placeholder="Enter your username">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-4" for="star-rating-group">Rating</label>
                                            <div class="star-rating col-8" id="star-rating-group">
                                                <input type="radio" id="star5" name="rating" value="5">
                                                <label for="star5" class="star">&#9733;</label>
                                                <input type="radio" id="star4" name="rating" value="4">
                                                <label for="star4" class="star">&#9733;</label>
                                                <input type="radio" id="star3" name="rating" value="3">
                                                <label for="star3" class="star">&#9733;</label>
                                                <input type="radio" id="star2" name="rating" value="2">
                                                <label for="star2" class="star">&#9733;</label>
                                                <input type="radio" id="star1" name="rating" value="1">
                                                <label for="star1" class="star">&#9733;</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="reviewContent">Review</label>
                                            <textarea class="form-control" id="reviewContent" rows="5" placeholder="Enter review text"></textarea>
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
                <div class="all-reviews">
                    <div class="review-item row">
                        <div class="avatar col-2">
                            <img src="images/avatar.png" alt="">
                        </div>
                        <div class="col-9">
                            <div>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <span>03/03/2023</span>
                            </div>
                            <h6>Name of user reviewing</h6>
                            <p>Content of their review</p>
                        </div>
                        <div class="col-1">
                            <button type="button" class="my-button" data-bs-toggle="modal"
                                data-bs-target="#addReviewModal"><i class="fa-regular fa-pen-to-square"></i></button>
                        </div>
                    </div>
                    <div class="review-item row">
                        <div class="avatar col-2">
                            <img src="images/avatar.png" alt="">
                        </div>
                        <div class="col-9">
                            <div>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <span>03/03/2023</span>
                            </div>
                            <h6>Name of user reviewing</h6>
                            <p>Content of their review</p>
                        </div>
                        <div class="col-1">
                            <button type="button" class="my-button" data-bs-toggle="modal"
                                data-bs-target="#addReviewModal"><i class="fa-regular fa-pen-to-square"></i></button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </main>
@endsection
