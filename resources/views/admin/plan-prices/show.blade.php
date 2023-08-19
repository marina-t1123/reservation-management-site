@extends('layouts.costom-app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        宿泊プラン情報
                    </div>
                    <div class="card-body text-center">

                        <!-- プラン名 -->
                        <div class="mb-4">
                            <h2 class="mb-2">プラン名：</h2>
                            <p class="d-inline-block">
                                {{ $plan->title }}
                            </p>
                        </div>

                        <!-- プラン内容 -->
                        <div class="mb-4">
                            <h2 class="mb-2">プラン内容：</h2>
                            <p class="d-inline-block">
                                {{ $plan->explanation }}
                            </p>
                        </div>

                        <div class="row justify-content-center">
                            {{-- @dd($plan->planImages); --}}
                            @if ($plan->planImages->isEmpty())
                                <div class="col-md-6 d-flex justify-content-center align-items-center">
                                    <img src="{{ asset('img/noimage.png') }}" alt="No Image" class="img-fluid" style="width:150px; height:auto;">
                                </div>
                            @else
                                @foreach ($plan->planImages as $planImage)
                                    <div class="col-md-6 d-flex justify-content-center align-items-center mt-2">
                                        <img src="{{ Storage::url($planImage->path) }}" class="img-fluid" style="width:120px; height:auto;">
                                    </div>
                                @endforeach
                            @endif
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        宿泊プランに紐づく予約枠・料金一覧
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">部屋種別</th>
                                    <th scope="col">部屋番号</th>
                                    <th scope="col">日時</th>
                                    <th scope="col">料金</th>
                                    <th scope="col">編集</th>
                                    <th scope="col">削除</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach($plan->planPrices as $planPrice)
                                        <tr>
                                            <th scope="row"></th>
                                            <td>
                                                {{ $planPrice->reservationSlot->room->type }}
                                            </td>
                                            <td>
                                                {{ $planPrice->reservationSlot->room->number }}
                                            </td>
                                            <td>{{ $planPrice->reservationSlot->reservation_slot_date }}</td>
                                            <td>{{ $planPrice->price }}</td>
                                            <td>
                                                <a href="{{ route('admin.plans.edit_price', $planPrice) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.plans.delete_price', $planPrice) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"><i class="fa-solid fa-trash-can"></i></button>
                                                </form>
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



