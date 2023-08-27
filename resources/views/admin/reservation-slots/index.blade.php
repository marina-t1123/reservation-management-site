@extends('layouts.costom-app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header border-0 bg-dark d-flex justify-content-between align-items-center mb-3">
                        <h2 class="text-white align-middle mb-0 p-1 d-flex justify-content-between">
                            <i class="fa-solid fa-list"></i>予約枠一覧
                        </h2>
                        <a href="{{ route('admin.reservation_slots.create') }}" class="btn btn-secondary">予約枠を登録する</a>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">予約枠ID</th>
                                    <th scope="col">部屋タイプ</th>
                                    <th scope="col">部屋番号</th>
                                    <th scope="col">最大宿泊人数</th>
                                    <th scope="col">予約枠日時</th>
                                    <th scope="col">有効フラグ</th>
                                    <th scope="col">削除</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach($reservationSlots as $reservationSlot)
                                        <tr>
                                            <th scope="row"></th>
                                            <td>{{ $reservationSlot->id}}</td>
                                            <td>{{ App\Models\Room::ROOM_TYPE[$reservationSlot->room->type] }}</td>
                                            <td>{{ $reservationSlot->room->number}}</td>
                                            <td>{{ $reservationSlot->room->max_people}}</td>
                                            <td>{{ $reservationSlot->reservation_slot_date}}</td>
                                            <td>{{ $reservationSlot->is_enabled ? '予約可': '予約不可'}}</td>
                                            <td>
                                                @if($reservationSlot->is_enabled == 1)
                                                    <form action="{{ route('admin.reservation_slots.destroy', $reservationSlot) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-dark"><i class="fa-solid fa-trash-can"></i></button>
                                                    </form>
                                                @else
                                                    削除不可
                                                @endif
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
