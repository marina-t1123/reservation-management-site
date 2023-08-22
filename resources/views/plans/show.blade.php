@extends('layouts.costom-app')

@section('content')
    <div class="container">
        <div class="d-flex flex-column justify-content-center align-items-center mt-2">
            {{-- <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($plan->PlanImages as $image)
                        @if(empty($image))
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <img src="{{ asset('img/noimage.png') }}" class="d-block w-100" alt="...">
                            </div>
                        @else
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . '$image->path') }}" class="d-block w-100" alt="...">
                            </div>
                        @endif
                    @endforeach
                </div>
            </div> --}}
            <div class="card col-8">
                {{-- @dd($plan->planImages) --}}
                @if($plan->planImages->isEmpty())
                    <img src="{{ asset('img/noimage.png') }}" class="d-block w-100" alt="...">
                @else
                    @foreach ($plan->planImages as $image)
                        <img src="{{ Storage::url($image->path ) }}" class="d-block w-100" alt="...">
                    @endforeach
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $plan->title }}</h5>
                    <p class="card-text">{{ $plan->explanation }}</p>
                    <a href="{{ route('guest.plans.show_calender', $plan)}}" class="card-link">このプランで予約をする</a>
                </div>
            </div>
        </div>
    </div>
@endsection












