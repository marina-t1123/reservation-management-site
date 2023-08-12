@extends('layouts.costom-app')

@section('content')
    <div class="container">
        <div class="text-center">
            <h1>プラン一覧</h1>
        </div>
        <div class="d-flex flex-column justify-content-center align-items-center mt-2">
            <div class="col-md-6">
                <div class="card my-4 mx-auto">
                    <div class="card-header">
                        プラン検索
                    </div>
                    <div class="card-body">
                        <form action="{{ route('guest.plans.index') }}" method="GET">
                            <p class="text-center mb-3">プラン名で検索をします</p>
                            <div class="mb-3">
                                <input type="text" name="plan_name" class="form-control" placeholder="プラン名を入力">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-dark">検索</button><br>
                                <a href="{{ route('guest.plans.index') }}" class="btn btn-dark mt-2">一覧表示</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @if ($plans->isEmpty())
            <p>プランがありません。</p>
        @else
            <div class="d-flex flex-column justify-content-center align-items-center mt-2">
                @foreach ($plans as $plan)
                    <div class="card mb-3 col-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $plan->title }}</h5>
                            <p class="card-text">{{ $plan->explanation }}</p>
                            <div class="text-center">
                                <a href="{{ route('guest.plans.show', $plan) }}" class="card-link">プラン詳細</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
