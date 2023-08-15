@extends('layouts.costom-app')

@section('content')
<div class="container">
        <div class="text-center">
            <h1>空室状況</h1>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="d-flex flex-column justify-content-center align-items-center mt-2">
                    <div class="card-body">
                        <p class="card-text">--プラン名--<br>{{ $plan->title }}</p>
                        <p class="card-text">--プラン内容--<br>{{ $plan->explanation }}</p>
                    </div>
                </div>
            </div>
        </div>

    <!-- 部屋タイプを選択 -->
    <div class="d-flex justify-content-center align-items-center mt-2">
        <div class="col-md-6">
            <div class="card my-4 mx-auto">
                <div class="card-header">
                    部屋タイプを選択
                </div>
                {{-- @dd($rooms); --}}
                <div class="card-body">
                    <form action="{{ route('guest.plans.show_calender', $plan) }}" method="GET">
                        @csrf
                        <div class="mb-3">
                            <select name="room_type_id" class="form-control">
                                <option value="">部屋タイプを選択してください</option>
                                @foreach ($rooms as $room => $type)
                                    <option value="{{ $room }}">{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-dark">検索</button><br>
                        </div>
                    </form>
                </div>
                {{-- <div class="card-body">
                    <div class="form-group">
                        <div class="mb-3">
                            <select id="room-type-select" class="form-control" onChange="changeRoomType(this.value)">
                                <option value="">部屋タイプを選択してください</option>
                                @foreach ($rooms as $room => $type)
                                    <option value="{{ $room }}">{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

    {{-- <div id="app">
        <div class="mx-auto w-50 m-5 p-5">
            <div id='calendar'></div>
        </div>
    </div> --}}

    {{-- 各空室状況での表示色 --}}
    <div id="color-legend">
        <div class="legend-item">
            <span class="legend-label">×：予約不可</span>
        </div>
        <div class="legend-item">
            <span class="legend-label">△：残りわずか（残り1室）</span>
        </div>
        <div class="legend-item">
            <span class="legend-label">○：予約可能</span>
        </div>
    </div>

    {{-- カレンダーの表示 --}}
    <div id="app">
        <div class="mx-auto w-50 m-5 p-5">
            <div id='calendar'></div>
        </div>
    </div>

    <div class="text-center mt-5">
        <a href="{{ route('guest.plans.show', $plan->id) }}" class="btn btn-secondary">{{ __('プラン詳細へ戻る') }}</a>
    </div>
</div>

<script src="
https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js
"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const planPrices = @json($calenderData); // この変数がカレンダーに表示する予約情報。この変数をControllerからbladeに渡すことでカレンダーに表示する予約情報を表示ことができる
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'ja',
            height: 'auto',
            firstDay: 1,
            headerToolbar: {
                left: "dayGridMonth,listMonth",
                center: "title",
                right: "today prev,next"
            },
            buttonText: {
                today: '今月',
                month: '月',
                list: 'リスト'
            },
            noEventsContent: 'スケジュールはありません',
            events: planPrices,
            // eventSources: [ // ←★追記
            //     {
            //         url: "{{ route('guest.plans.show_calender', $plan) }}",
            //     },
            // ], // これはajaxの指定方法で今回は使わない
            // eventSourceFailure () { // ←★追記
            //     console.error('エラーが発生しました。');
            // },
            eventMouseEnter (info) { // ←★追記
                $(info.el).popover({
                    title: info.event.title,
                    content: info.event.extendedProps.description,
                    trigger: 'hover',
                    placement: 'top',
                    container: 'body',
                    html: true
                });
            }
        });
        calendar.render();
    });
</script>

{{-- <script>
    // 部屋タイプを切り替えた際の処理
    function changeRoomType(roomTypeId) {
        // 部屋タイプに応じて、空室カレンダーのデータを取得
        fetch(`/plans/{plan}/calender/?plan_id={{ $plan->id }}&room_type_id=${roomTypeId}`)
            .then(response => response.json())
            .then(data => {
                // カレンダーを再描画
                const calendar = document.getElementById('availability-calendar');
                calendar.innerHTML = ''; // カレンダーをクリア
                const fullCalendar = new FullCalendar.Calendar(calendar, {
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay',
                    },
                    events: data,
                    eventColor: 'red',
                    eventTextColor: 'white',
                    eventClick: function(info) {
                        onCellClick(info.event);
                    }
                });
                fullCalendar.render();
            })
            .catch(error => {
                console.error(error);
                alert('カレンダーデータの取得に失敗しました。');
            });
    }

    // DOMContentLoaded イベントリスナー
    document.addEventListener('DOMContentLoaded', function() {
        // カレンダーと部屋タイプセレクタの要素を取得
        const availabilityCalendar = document.getElementById('availability-calendar');
        const roomTypeSelector = document.getElementById('room-type-selector');

        // カレンダーの設定
        const availabilityFullCalendar = new FullCalendar.Calendar(availabilityCalendar, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek',
            },
            initialView: 'dayGridMonth',
            events: '/availability/calendar-data?plan_id={{ $plan->id }}&room_type_id={{ $rooms[0]->id }}',
            eventColor: 'red',
            eventTextColor: 'white',
            eventClick: function(info) {
                onCellClick(info.event);
            }
        });
        // カレンダーを描画
        availabilityFullCalendar.render();

        // 部屋タイプを切り替えたときのイベントリスナーを設定
        roomTypeSelector.addEventListener('change', (event) => {
            const selectedRoomTypeId = event.target.value;
            changeRoomType(selectedRoomTypeId);
        });
    });

    // 予約フォームに遷移する関数
    function onCellClick(event) {
        // イベントが予約不可でない場合のみ、リダイレクトを行う
        if (!event.title.includes('×')) {
            const plan_id = {{ $plan->id }};
            const room_type_id = document.getElementById('room-type-selector').value;
            window.location.href = `/reservations/create/${plan_id}/${room_type_id}?date=${event.startStr}`;
        }
    }

</script> --}}
@endsection
