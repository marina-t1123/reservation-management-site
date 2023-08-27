@extends('layouts.costom-app')

@section('content')
    <div class="container">
        <div class="d-flex flex-column justify-content-center align-items-center mt-2">
            <h2>宿泊プラン詳細</h2>
            <div class="card col-8 mt-4">
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
        <!-- プラン一覧に戻るボタン -->
        <div class="d-flex justify-content-center mt-4">
            <a href="{{ route('guest.plans.index') }}" class="btn btn-outline-dark">プラン一覧に戻る</a>
        </div>
    </div>
@endsection












