@extends('layouts.costom-app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        予約詳細情報
                    </div>
                    <div class="card-body text-center">
                        <!-- 部屋番号 -->
                        <div class="mb-4">
                            <h2 class="mb-2">部屋番号</h2>
                            <p class="d-inline-block">
                                {{ $reservation->room->room_number }}
                            </p>
                        </div>

                        <!-- チェックイン日 -->
                        <div class="mb-4">
                            <h2 class="mb-2">チェックイン日</h2>
                            <p class="d-inline-block">
                                {{ $reservation->checkin_date }}
                            </p>
                        </div>

                        <!-- チャックアウト日 -->
                        <div class="mb-4">
                            <h2 class="mb-2">チェックアウト日</h2>
                            <p class="d-inline-block">
                                {{ $reservation->checkout_date }}
                            </p>
                        </div>

                        <!-- プラン名 -->
                        <div class="mb-4">
                            <h2 class="mb-2">プラン名</h2>
                            <p class="d-inline-block">
                                {{ $plan->title }}
                            </p>
                        </div>

                        <!-- プラン料金 -->
                        <div class="mb-4">
                            <h2 class="mb-2">プラン料金</h2>
                            <p class="d-inline-block">
                                {{ $planPrice->price }}
                            </p>
                        </div>

                        <!-- 宿泊者名 -->
                        <div class="mb-4">
                            <h2 class="mb-2">宿泊者名</h2>
                            <p class="d-inline-block">
                                {{ $reservation->guest->name }}
                            </p>
                        </div>

                        <!-- 宿泊者住所 -->
                        <div class="mb-4">
                            <h2 class="mb-2">住所</h2>
                            <p class="d-inline-block">
                                {{ $reservation->guest->address }}
                            </p>
                        </div>

                        <!-- 宿泊者Email -->
                        <div class="mb-4">
                            <h2 class="mb-2">Email</h2>
                            <p class="d-inline-block">
                                {{ $reservation->guest->email }}
                            </p>
                        </div>

                        <!-- 宿泊者電話番号 -->
                        <div class="mb-4">
                            <h2 class="mb-2">電話番号</h2>
                            <p class="d-inline-block">
                                {{ $reservation->guest->tel }}
                            </p>
                        </div>

                        <!-- メモ -->
                        <div class="col-md-6 mx-auto">
                            <form action="{{ route('admin.reservations.change_memo', $reservation)}}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="mb-4">
                                    <h2 class="mb-2">メモ</h2>
                                    <textarea name="memo" cols="30" rows="10">{{ $reservation->memo }}</textarea>
                                </div>
                                <div class="mb-4">
                                    <button type="submit" class="btn btn-primary">メモを変更する</button>
                                </div>
                            </form>
                        </div>

                        <!--　戻るボタン -->
                        <div class="mb-4">
                            <a href="{{ route('admin.reservations.index') }}" class="btn btn-dark">戻る</a>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
