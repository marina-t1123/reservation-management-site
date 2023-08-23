@extends('layouts.costom-app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <!-- 検索フォーム -->
                <div class="card mb-5">
                    <div class="card-header border-0 bg-dark d-flex justify-content-between align-items-center mb-3">
                        <h2 class="text-white align-middle mb-0 p-1 d-flex justify-content-between">
                            <i class="fa-solid fa-magnifying-glass"></i>予約検索
                        </h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.reservations.index') }}" method="GET">
                            @csrf
                            <div class="col-10 mx-auto justify-content-center">
                                <div class="form-group row">
                                    <label class="col-2 col-form-label" for="plans">プラン名</label>
                                    <div class="col">
                                        <select name="plan_id" id="plan_id" class="form-control">
                                            <option value="">選択してください</option>
                                            @foreach($plans as $plan)
                                                <option value="{{ $plan->id }}">{{ $plan->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-10 mx-auto justify-content-center">
                                <div class="form-group row">
                                    <label class="col-2 col-form-label" for="rooms">部屋タイプ</label>
                                    <div class="col">
                                        <select name="room_id" id="room_id" class="form-control">
                                            <option value="">選択してください</option>

                                            @foreach($rooms as $room => $value)
                                                <option value="{{ $room }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-10 mx-auto">
                                <div class="form-group row justify-content-center">
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary">検索</button>
                                    </div>
                                    <div class="col-auto">
                                        <a href="{{ route('admin.reservations.index') }}" class="btn btn-secondary">一覧表示</a>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <!-- 予約一覧 -->
                <div class="card">
                    <div class="card-header border-0 bg-dark d-flex justify-content-between align-items-center mb-3">
                        <h2 class="text-white align-middle mb-0 p-1 d-flex justify-content-between">
                            <i class="fa-solid fa-calendar-days"></i>予約一覧
                        </h2>
                    </div>
                    <div class="card-body">
                        {{-- @dd($reservations) --}}
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">チェックイン日</th>
                                    <th scope="col">チェックアウト日</th>
                                    <th scope="col">名前</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">宿泊状況</th>
                                    <th scope="col">宿泊ステータス変更</th>
                                    <th scope="col">詳細</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach($reservations as $reservation)
                                        <tr>
                                            <th scope="row"></th>
                                            <td>{{ $reservation->checkin_date }}</td>
                                            <td>{{ $reservation->checkout_date }}</td>
                                            <td>{{ $reservation->guest->name }}</td>
                                            <td>{{ $reservation->guest->email }}</td>
                                            <td>{{ App\Models\reservation::CANCEL_STATUS[$reservation->cancel_at] ?? '' }}</td>
                                            <td>
                                                <!-- formタグでキャンセルステータスを変更する -->
                                                @if($reservation->cancel_at == 0 )
                                                    <form action="{{ route('admin.reservations.change_status', $reservation ) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" value="$reservation">
                                                    <button type="submit" class="btn btn-dark">キャンセルに変更</button>
                                                @elseif($reservation->cancel_at == 1 )
                                                    操作不可
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.reservations.show', $reservation ) }}" class="btn btn-dark">詳細</a>
                                            </td>
                                        </tr>
                                    @endforeach
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
