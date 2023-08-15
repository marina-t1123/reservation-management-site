@extends('layouts.costom-app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        お問い合わせフォーム
                    </div>
                    <div class="card-body">
                        <form action="{{ route('inquiry.store')}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">お名前</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $inquiry->name }}" required disabled>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">メールアドレス</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $inquiry->email }}" required disabled>
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label"></label></label>
                                <textarea class="form-control" id="subject" name="subject" rows="3" required>{{ $inquiry->subject }}</textarea>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection































