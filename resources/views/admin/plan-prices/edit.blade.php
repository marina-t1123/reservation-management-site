@extends('layouts.costom-app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        料金変更
                    </div>
                    <div class="card-body">
                        <p class="text-center mb-3">宿泊プランに紐づいている予約枠の料金を変更します。</p>
                        <form action="{{ route('admin.plans.update_price', $planPrice)}}" method="post">
                            @csrf
                            @method('PUT')

                            <!-- タイトル -->
                            <div class="mb-3">
                                <label for="title" class="form-label">宿泊プラン：タイトル</label><br>
                                <p>{{ $plan->title }}</p>
                            </div>
                            <!-- 説明 -->
                            <div class="mb-3">
                                <label for="explanation" class="form-label">宿泊プラン：説明</label><br>
                                <textarea cols="30" rows="10" class="form-control" disabled>{{ $plan->explanation }}</textarea>
                                {{-- <input type="text" class="form-control" id="explanation" name="explanation"> --}}
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">予約枠選択</label><br>
                                <p>{{ $planPrice->reservationSlot->room->type }} : {{ $planPrice->reservationSlot->room->number }}号室</p>
                            </div>
                            <!-- プラン設定日 -->
                            <div class="mb-3">
                                <label for="date" class="form-label">宿泊プラン設定日</label><br>
                                <p>{{ $planPrice->reservationSlot->reservation_slot_date }}</p>
                            </div>
                            <!-- 料金 -->
                            <div class="mb-3">
                                <label for="price" class="form-label">料金</label>
                                <input type="number" class="form-control" id="price" name="price" value="{{ $planPrice->price }}">
                                @include('components.error', ['name' => 'price'])
                            </div>

                            <div class="mb-3 text-center">
                                <button type="submit" class="btn btn-dark">予約枠・料金を登録する</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
