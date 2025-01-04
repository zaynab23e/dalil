@extends('layout')

@section('main')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="card-title">Review Details</h4>

            <!-- Carousel -->
            <div class="owl-carousel owl-theme full-width owl-carousel-dash portfolio-carousel" id="owl-carousel-basic">
                <div class="item">
                    <img src="{{ $review->image }}" alt="Review Image" style="width: auto; height: auto;">
                </div>
                <div class="item">
                    <img src="{{ $review->place->cover_image }}" alt="Place Cover Image" style="width: auto; height: auto;">
                </div>
            </div>

            <!-- Reviewer Info -->
            <div class="d-flex py-4">
                <div class="preview-list w-100">
                    <div class="preview-item p-0">
                        <div class="preview-thumbnail">
                            <img src="{{ asset($review->user->image) }}" class="rounded-circle" alt="User Image">
                        </div>
                        <div class="preview-item-content d-flex flex-grow">
                            <div class="flex-grow">
                                <div class="d-flex d-md-block d-xl-flex justify-content-between">
                                    <h6 class="preview-subject">{{ $review->user->name }}</h6>
                                    <p class="text-muted text-small">{{ $review->created_at->diffForHumans() }}</p>
                                </div>
                                <p class="text-muted">{{ $review->content }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Place Info -->
            <p class="text-muted">
                <strong>Email:</strong> {{ $review->user->email }}<br>
                <strong>Phone:</strong> {{ $review->user->phone }}<br>
                <strong>Place Name:</strong> {{ $review->place->name }}<br>
                <strong>Place Category:</strong> {{ $review->place->category->name }}<br>
            </p>

           
        </div>
    </div>
</div>
@endsection
