<?php

namespace App\Console\Commands;

use App\Models\PushNotification;
use App\Models\User;
use App\Services\Api\PushNotificationServices;
use Illuminate\Console\Command;

class SendNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send_notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
//        $fcmTokens = User::whereNotNull('fcm_token')->pluck('fcm_token')->toArray();
//        $users = User::whereNotNull('fcm_token')->get();

        $notes = PushNotification::where('status', PushNotification::PAYMENT)->get();

        foreach ($notes as $note) {

            $fcmTokens = User::whereNotNull('fcm_token')->pluck('fcm_token')->toArray();

            $pushNote = PushNotificationServices::sendNotification($note->title, $note->message, $fcmTokens);
            if ($pushNote == 200) {
                $note->status = PushNotification::SUCCESS;
                $note->save();
            } else {
                $note->status = PushNotification::CANCELED;
                $note->save();
            }
        }
    }
}
