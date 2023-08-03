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
                        <form action="/contact" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">お名前</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">メールアドレス</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">メッセージ</label>
                                <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">送信</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection































