@extends('layouts.costom-app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        予約内容最終確認
                    </div>
                    <div class="card-body">
                        <p class="text-center">下記の予約内容でお間違いないかご確認下さい。</p>
                        <form action="{{ route('reservation.store', $planPriceDate)}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <p>プラン名：{{ $planPriceDate->plan->title }}</p>
                            </div>
                            <div class="mb-3">
                                <p>プラン料金：{{ $planPriceDate->price }}</p>
                            </div>
                            <div class="mb-3">
                                <p>チェックイン：{{ $planPriceDate->reservationSlot->reservation_slot_date }}</p>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">お名前</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $guestDate['name'] }}" required disabled>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">住所</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{ $guestDate['address'] }}" required disabled>
                            </div>
                            <div class="mb-3">
                                <label for="tel" class="form-label">電話番号</label>
                                <input type="text" class="form-control" id="tel" name="tel" value="{{ $guestDate['tel'] }}" required disabled>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">メールアドレス</label>
                                <input type="text" class="form-control" id="email" name="emial" value="{{ $guestDate['email'] }}" required disabled>
                            </div>


                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">上記の予約内容で予約をする</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
