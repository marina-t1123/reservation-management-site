@extends('layouts.costom-app')

@section('content')
    <!-- フラッシュメッセージ -->
    @if (session('flash_message'))
        <div class="flash_message bg-success text-center py-3 my-0">
            {{ session('flash_message') }}
        </div>
    @endif
    <div class="container">
        <h1 clas="text-center">TOPページ</h1>
        <p clas="text-center">現在、TOPページ作成中。</p>
    </div>
@endsection
