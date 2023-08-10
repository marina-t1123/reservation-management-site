@extends('layouts.costom-app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header border-0 bg-dark d-flex justify-content-between align-items-center mb-3">
                        <h2 class="text-white align-middle mb-0 p-1 d-flex justify-content-between">
                            <i class="fa-solid fa-envelope"></i>お問い合わせ一覧
                        </h2>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">名前</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">対応ステータス</th>
                                    <th scope="col">対応ステータス変更</th>
                                    <th scope="col">詳細</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach($inquiries as $inquiry)
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>{{ $inquiry->name }}</td>
                                            <td>{{ $inquiry->email }}</td>
                                            <td>{{ App\Models\Inquiry::SUPPORT_STATUS[$inquiry->support_status] }}</td>
                                            <td>
                                                <a href="{{ route('admin.inquiry.change_status', $inquiry ) }}" class="btn btn-dark">ステータス変更</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.inquiry.show', $inquiry ) }}" class="btn btn-dark">詳細</a>
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
