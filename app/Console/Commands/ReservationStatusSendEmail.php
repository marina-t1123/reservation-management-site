<?php

namespace App\Console\Commands;

use App\Models\Reservation;
use Carbon\Carbon;
use App\Mail\ReservationStatusRemindMail;
use Illuminate\Console\Command;

class ReservationStatusSendEmail extends Command
{
    /**
     * The name and signature of the console command.
     * コンソールコマンドの名前と使い方
     *
     * @var string
     */
    protected $signature = 'command:ReservationStatusSendEmail';

    /**
     * The console command description.
     * コンソールコマンドの説明
     *
     * @var string
     */
    protected $description = 'チェックイン前日に宿泊者に予約案内のメールを送信する';

    /**
     * Execute the console command.
     * consoleコマンドの実行
     *
     * @return int
     */
    public function handle()
    {
        // 今日の日付を取得
        $nextDay = Carbon::today()->addDay(1)->format('Y-m-d');
        // 予約のチェックイン日が明日の日付と一致する予約(cancel_at:0【予約中】)を取得
        $reservations = Reservation::where('cancel_at', 0)
                        ->whereRelation('planPrice.reservationSlot', 'reservation_slot_date', $nextDay)
                        ->get();
        // 繰り返し処理で、それぞれの予約に紐づく宿泊者にメールを送信
        foreach($reservations as $reservation)
        {
            // 予約者のメールアドレスを取得
            $guestEmail = $reservation->guest->email;
            // 予約状況リマインドメールを送信する
            \Mail::to('tm.274795@gmail.com')->send(new ReservationStatusRemindMail($reservation));
        }
    }
}
