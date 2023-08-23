@extends('layouts.costom-app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header border-0 bg-dark d-flex justify-content-between align-items-center mb-3">
                        <h2 class="text-white align-middle mb-0 p-1 d-flex justify-content-between">
                            <i class="fa-solid fa-star"></i></i>宿泊プラン一覧
                        </h2>
                        <a href="{{ route('admin.plans.create') }}" class="btn btn-secondary">宿泊プランを登録する</a>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">タイトル</th>
                                    <th scope="col">説明</th>
                                    <th scope="col">予約枠設定</th>
                                    <th scope="col">削除</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach($plans as $plan)
                                        <tr>
                                            <th scope="row"></th>
                                            <td>
                                                <a href="{{ route('admin.plans.show_price', $plan)}}">{{ $plan->title}}</a>
                                            </td>
                                            <td>{{ $plan->explanation}}</td>
                                            <td>
                                                <a href="{{ route('admin.plans.create_price', $plan) }}" class="btn btn-dark">プランに予約枠・料金を設定</a>
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.plans.destroy', $plan) }}" method="POST">
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
