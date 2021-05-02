<?php

namespace App\Console\Commands;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Event;
use App\Models\Pa;
use App\Models\Microphone;
use App\Models\Genre;
use App\Models\SavedQuery;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Classes\CalcDistance;

class SendNewResults extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:results';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends a weekly mail to artists informing them about new events that pop up in their neighbourhood';

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
        // get all queries
        $queries = SavedQuery::all();

        // set date 1 week back
        $date_one_week_ago = Carbon::now()->subWeek();
        $date_now = Carbon::now();


        foreach ($queries as $querie) {
            // get user info
            $user = User::where('id', $querie->user_id)->first();


            // Get all events from past week
            $events = Event::whereBetween('created_at', [$date_one_week_ago, $date_now])
            ->get();

            // Get all microphones, genres, pas
            $microphones = Microphone::all();
            $genres = Genre::orderBy('name')->get();
            $pas = Pa::all();



            // convert time and date
            $from = Carbon::parse($querie->date_from)->toDatetimeString();
            $to = Carbon::parse($querie->date_to)->toDatetimeString();

            // filter distance
            if($querie->distance > 0) {
                foreach ($events as $key => $event) {
                    $distanceInKM = CalcDistance::vincentyGreatCircleDistance($querie->latitude, $querie->longitude, $event->user->latitude, $event->user->longitude) / 1000;
                    if($distanceInKM > $querie->distance) {
                        unset($events[$key]);
                    }
                }
            }

            /* Filter the genres
            ***
            */
            $genres = unserialize($querie->genres);

            $genres > 0 ? $events = $events->whereIn('genre_id', $genres) : '';
            // Set start date
            $querie->date_from !== null ? $events = $events->where('date', '>=', $from) : '';
            // Set end date
            $querie->date_to !== null ? $events = $events->where('date', '<=', $to) : '';

            /*
            *** Filter microphones
            */
            foreach ($events as $key => $event) {
                // make array with all the mics for one event
                $event_mics =[];
                foreach($event->user->microphones as $microphone) {
                    array_push($event_mics, $microphone->microphone_id);
                }
                // delete events if it doesn't have the requested microphone
                if(unserialize($querie->microphones)!== null){

                    if(count(unserialize($querie->microphones)) > 0) {
                        foreach (unserialize($querie->microphones) as $checkbox_microphone) {
                            if(!in_array($checkbox_microphone, $event_mics)) {
                                unset($events[$key]);
                            }
                        }
                    }
                }
            }
            /*
            *** Filter PA-system
            */
            $pas = unserialize($querie->pas);
            foreach ($events as $key => $event) {
                switch ($pas[0]) {
                    // if pa is acoutic allow users with fullband en acoustic systems
                    case '1':
                        if($event->user->pa_id !== 1 && $event->user->pa_id !== 2){
                            unset($events[$key]);
                        }
                        break;
                    // only allow full band systems
                    case '2':
                        if($event->user->pa_id !== 2){
                            unset($events[$key]);
                        }
                        break;
                }
            }
            $to_name = $user->name;
            $to_email = $user->email;
            $body = "There are new results to you search query, go check it out";
            $data = [
                'name'=>$to_name,
                "body" => $body,
                "events" => $events
            ];
            if(count($events) > 0){


            Mail::send('emails.new_results', $data, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)
                        ->subject('New results!');
                $message->from('gigfinder.ahs@gmail.com','Gigfinder');
            });
        }

        }
    }

}
