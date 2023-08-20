@extends('layouts.costom-app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        予約枠・料金登録
                    </div>
                    <div class="card-body">
                        <p class="text-center mb-3">宿泊プランに対して予約枠・料金を作成します。</p>
                        <form action="{{ route('admin.plans.store_price', $plan)}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <!-- タイトル -->
                            <div class="mb-3">
                                <label for="title" class="form-label">宿泊プラン：タイトル</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ $plan->title }}" disabled>
                            </div>
                            <!-- 説明 -->
                            <div class="mb-3">
                                <label for="explanation" class="form-label">宿泊プラン：説明</label>
                                <textarea name="explanation" id="explanation" cols="30" rows="10" class="form-control" disabled>{{ $plan->explanation }}</textarea>
                                {{-- <input type="text" class="form-control" id="explanation" name="explanation"> --}}
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">予約枠選択</label>
                                <select name="reservation_slot_id" id="reservation_slot_id" class="form-control">
                                    @foreach($reservationSlots as $reservationSlot)
                                        <option value="{{ $reservationSlot->id }}">{{ App\Models\Room::ROOM_TYPE[$reservationSlot->room->type] }} : {{ $reservationSlot->room->number }}号室</option>
                                        @include('components.error', ['name' => 'reservation_slot_id'])
                                    @endforeach
                                </select>
                            </div>
                            <!-- プラン設定日 -->
                            <div class="mb-3">
                                <label for="date" class="form-label">宿泊プラン設定日</label>
                                <input type="date" class="form-control" id="date" name="date">
                                @include('components.error', ['name' => 'date'])
                            </div>
                            <!-- 料金 -->
                            <div class="mb-3">
                                <label for="price" class="form-label">料金</label>
                                <input type="number" class="form-control" id="price" name="price">
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
