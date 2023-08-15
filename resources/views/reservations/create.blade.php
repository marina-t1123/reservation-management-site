@extends('layouts.costom-app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        予約フォーム
                    </div>
                    <div class="card-body">
                        <form action="{{ route('reservation.create_confirm', $planPriceDate)}}" method="post">
                            @csrf
                            {{-- @dd($planPrices); --}}
                            {{-- <div class="mb-3">
                                <select name="room_type_id" class="form-control">
                                    <option value="">部屋番号を選択してください</option>
                                    @foreach ($rooms as $room => $type)
                                        <option value="{{ $room }}">{{ $type['number'] }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
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
                                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $defaultEndDate }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">お名前</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">住所</label>
                                <input type="text" class="form-control" id="address" name="address" required>
                            </div>
                            <div class="mb-3">
                                <label for="tel" class="form-label">電話番号</label>
                                <input type="text" class="form-control" id="tel" name="tel" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">メールアドレス</label>
                                <input type="text" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">送信</button>
                            </div>
                        </form>
                        <!-- 空室カレンダーのページへ戻る -->
                        {{-- <div class="mb-3">
                            <a href="{{ route('guest.plans.show_calender', $planPriceDate->plan) }}" class="btn btn-secondary">戻る</a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection































