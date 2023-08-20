@extends('layouts.costom-app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        予約枠登録
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.reservation_slots.store')}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">部屋情報</label>
                                <select name="room_id" id="room_id" class="form-control">
                                    @foreach($rooms as $room)
                                        <option value="{{ $room->id }}">{{ App\Models\Room::ROOM_TYPE[$room->type] }} : {{ $room->number }}号室</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">日付（個別作成）</label>
                                <input type="date" class="form-control" id="date" name="date">
                                <p>※個別の日付を入力された際は、一括作成での日付は登録されません。</p>
                            </div>
                            <div class="mb-3">
                                <label for="start_date" class="form-label">日付（一括作成：開始日）</label>
                                <input type="date" class="form-control" id="start_date" name="start_date">
                            </div>
                            <div class="mb-3">
                                <label for="end-date" class="form-label">日付（一括作成：終了日）</label>
                                <input type="date" class="form-control" id="end_date" name="end_date">
                            </div>
                            <div class="mb-3 text-center">
                                <button type="submit" class="btn btn-primary">予約枠を登録する</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
