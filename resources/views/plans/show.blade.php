@extends('layouts.costom-app')

@section('content')
    <div class="container">
        <div class="d-flex flex-column justify-content-center align-items-center mt-2">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($plan->PlanImages as $image)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <img src="{{ asset('img/' . $image->filename) }}" class="d-block w-100" alt="...">
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="card col-8">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $plan->title }}</h5>
                    <p class="card-text">{{ $plan->explanation }}</p>
                    <a href="{{ route('guest.plans.show_calender', $plan)}}" class="card-link">このプランで予約をする</a>
                </div>
            </div>
        </div>
    </div>
@endsection












