@extends('layouts.master')

@section('title')
    Review Page
@endsection

@section('content')
    <!-- CONTENT OF THE PAGE -->
    <main>
        {{-- Notofication modal --}}
        <div class="modal fade" id="notificationModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Notification</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>{{ session('message') }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Item detail session --}}
        <div class="review-container">
            <div class="product-info row">
                <div class="img-container col-5">
                    <img src="{{ asset('images/' . $item->Image) }}" alt="">
                </div>
                <div class="info-details col-7">
                    <div class="rate">
                        <div class="stars">
                            <span>{{ $reviewSummary->AvgRating }}</span>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <div class="review-number">
                            <p><span>{{ $reviewSummary->Count }}</span> Reviews</p>
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
                                    <form method="post" action="{{ url("$item->Item_id/add_review") }}">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="reviewTitle">Username</label>
                                            <input type="text" class="form-control" id="reviewTitle"
                                                placeholder="Enter your username" name="username">
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
                                            <textarea name="reviewText" class="form-control" id="reviewContent" rows="5" placeholder="Enter review text"></textarea>
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

                    {{-- EDIT THE REVIEW MODAL --}}
                    <div class="modal fade" id="editReviewModal" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Review</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="{{ url("$item->Item_id/update_review") }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="review_id" id="review_id">
                                        <div class="form-group">
                                            <label for="editReviewUsername">Username</label>
                                            <input type="text" class="form-control" id="editReviewUsername"
                                                placeholder="Enter your username" name="username">
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
                                            <label for="editReviewContent">Review</label>
                                            <textarea class="form-control" id="editReviewContent" rows="5" placeholder="Enter review text"
                                                name="reviewText"></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <input type="submit" value="Save changes" class="btn btn-primary">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- REVIEW SECTION --}}
                <div class="all-reviews">
                    @forelse ($reviews as $review)
                        <div class="review-item row">
                            <div class="avatar col-2">
                                <img src="{{ asset('images/avatar.png') }}" alt="">
                            </div>
                            <div class="col-9">
                                <div>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <span>{{ $review->date }}</span>
                                </div>
                                <h6>{{ $review->Username }}</h6>
                                <p>{{ $review->reviewText }}</p>
                            </div>
                            <div class="col-1">
                                <button type="button" class="my-button" onclick="openEditModal({{ $loop->index }})"
                                    data-bs-toggle="modal" data-bs-target="#editReviewModal">
                                    <i class="fa-regular fa-pen-to-square"></i></button>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>

    </main>

    <script>
        let reviews = @json($reviews); // store $reviews var into reviews for JS
        function openEditModal(index) {
            let review = reviews[index];

            // populate the modal fields
            document.getElementById('review_id').value = review.Review_id;
            document.getElementById('editReviewUsername').value = review.Username;
            document.getElementById('editReviewContent').value = review.reviewText;

            // Set rating
            document.querySelectorAll('#star-rating-group input').forEach(input => {
                if (input.value == review.Rating) {
                    input.checked = true;
                }
            });
        }
    </script>
@endsection

@section('script')
    <script>
        // Show notification when a review added or updated
        @if (session('message'))
        var notificationModal = new bootstrap.Modal(document.getElementById('notificationModal'));
        notificationModal.show();
        @endif
    </script>
@endsection
