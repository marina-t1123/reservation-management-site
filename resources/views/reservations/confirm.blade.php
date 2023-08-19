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
                        <form action="{{ route('reservation.store', 9)}}" method="post">
                            {{-- @dd($planPriceDate) --}}
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
                                <label for="end_date" class="form-label">チェックアウト</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $guestData ? old('end_date', $guestData['end_date']) : $defaultEndDate }}" required disabled>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">お名前</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $guestData['name'] }}" required disabled>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">住所</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{ $guestData['address'] }}" required disabled>
                            </div>
                            <div class="mb-3">
                                <label for="tel" class="form-label">電話番号</label>
                                <input type="text" class="form-control" id="tel" name="tel" value="{{ $guestData['tel'] }}" required disabled>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">メールアドレス</label>
                                <input type="text" class="form-control" id="email" name="emial" value="{{ $guestData['email'] }}" required disabled>
                            </div>

                            <div class="d-flex justify-content-center align-items-center">
                                <div class="mb-3 mt-3">
                                    <a href="{{ route('reservation.back_to_create_confirm', $planPriceDate )}}" class="btn-dark">予約内容を修正する</a>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center align-items-center">
                                <div class="mb-3 mt-3">
                                    <button type="submit" class="btn btn-primary">上記の予約内容で予約をする</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
