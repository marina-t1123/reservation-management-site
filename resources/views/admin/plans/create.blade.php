@extends('layouts.costom-app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        宿泊プラン登録
                    </div>
                    <div class="card-body">
                        <p class="text-center mb-3">宿泊プランを作成します。</p>
                        <form action="{{ route('admin.plans.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <!-- タイトル -->
                            <div class="mb-3">
                                <label for="title" class="form-label">宿泊プラン：タイトル</label>
                                <input type="text" class="form-control" @error('title') is-invalid @enderror id="title" name="title">
                                @include('components.error', ['name' => 'title'])
                            </div>
                            <!-- 説明 -->
                            <div class="mb-3">
                                <label for="explanation" class="form-label">宿泊プラン：説明</label>
                                <input type="text" class="form-control" @error('explanation') is-invalid @enderror id="explanation" name="explanation">
                                @include('components.error', ['name' => 'explanation'])
                            </div>
                            <!-- 画像１ -->
                            <div class="mb-3">
                                <label for="images" class="form-label">画像1</label>
                                <input type="file" class="form-control-file" @error('images.*') is-invalid @enderror id="images" name="images[]" multiple>
                                @include('components.error', ['name' => 'images.*'])
                            </div>

                            <!-- 画像２ -->
                            <div class="mb-3">
                                <label for="images" class="form-label">画像2</label>
                                <input type="file" class="form-control-file" @error('images.*') is-invalid @enderror id="images" name="images[]" multiple>
                                @include('components.error', ['name' => 'images.*'])
                            </div>

                            <div class="mb-3 text-center">
                                <button type="submit" class="btn btn-primary">宿泊プランを登録する</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
