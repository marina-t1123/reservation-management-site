@extends('layouts.costom-app')

@section('content')
<x-parts.admin-basic-card-layout>
    <x-slot name="cardHeader">
        <div class="h4 my-2 d-flex align-items-center font-weight-bold">
            <i class="fas fa-list mr-2"></i> 予約一覧
            <small class="d-inline-block ml-3" style="font-size: 18px">
                ・予約の詳細確認/キャンセル処理
            </small>
        </div>
    </x-slot>

    <x-slot name="cardBody">
        <div class="d-flex justify-content-end mr-5">
            <p class="font-weight-bold mr-3 text-left">
                予約詳細<br>
                キャンセル処理
            </p>
            <p class="text-left">
                詳細ボタンをクリック<br>
                キャンセルボタンsをクリック
            </p>
        </div>
    </x-slot>

</x-parts.admin-basic-card-layout>
@endsection
