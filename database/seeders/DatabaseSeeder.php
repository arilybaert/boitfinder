<?php

namespace Database\Seeders;

use App\Models\Bandmember;
use App\Models\Pa;
use App\Models\User;
use App\Models\Microphone;
use App\Models\MicrophonesUser;
use App\Models\Genre;
use App\Models\GenresUser;
use App\Models\Event;
use App\Models\EventsGenre;
use App\Models\Applicant;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        //
        // PA Systems
        //


        $pa_akoustic = Pa::factory()->create([
            'name' => 'Akoustic'
        ]);
        $pa_full_band = Pa::factory()->create([
            'name' => 'Full band'
        ]);

        //
        // Users (Event)
        //
        $address = array(
            array('Grand Place 12A', '1000', 'Brussel', '50.8467', '4.3547'),
            array('Rue du Pont de la Carpe 7', '1000', 'Brussel', '50.8467', '4.3547'),
            array('Impasse de la Fidélité 4', '1000', 'Brussel', '50.8467', '4.3547'),
            array('Annonciadenstraat 5', '9000', 'Gent', '51.0538286', '3.7250121'),
            array('Klein Turkije 16', '9000', 'Gent', '51.0538286', '3.7250121'),
            array('Schuddevisstraatje 2', '9000', 'Gent', '51.0538286', '3.7250121'),
            array('Wolstraat 46', '2000', 'Antwerpen', '51.2211097', '4.3997081'),
            array('Leopold de Waelstraat 2', '2000', 'Antwerpen', '51.2211097', '4.3997081'),
            array('Melkmarkt', '2000', 'Antwerpen', '51.2211097', '4.3997081'),
            array('Oude Markt 32', '3000', 'Leuven', '50.879202', '4.7011675'),
        );
        for($i=0; $i<10; $i++){
            $user = User::factory()->create([
                'role' => 'event',
                'address' => $address[$i][0],
                'zipcode' => $address[$i][1],
                'city' => $address[$i][2],
                'latitude' => $address[$i][3],
                'longitude' => $address[$i][4],

                'vimeo_id' => '529663747',
                'coverphoto' => 'src/img/event/cover/cover-' . $i . '.jpg',

                'pa_id' => $i%2 == 0 ? 1 : 2
            ]);
        }

        //
        // Users (Artist)
        //

        for($i=0; $i<10; $i++){
            $user = User::factory()->create([
                'role' => 'artist',
                'zipcode' => $address[$i][1],
                'city' => $address[$i][2],

                'genre_description' => 'Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Etiam scelerisque tortor diam, vel aliquam leo vestibulum in. Suspendisse consectetur lacus et justo egestas consequat. Nulla id risus massa. Donec eu eleifend nunc.',
                'coverphoto' => 'src/img/artist/cover/cover-' . $i . '.jpg',
                'vimeo_id' => '529663747',
                'rider' => 'src/img/artist/rider/rider-0',

                'pa_id' => $i%2 == 0 ? 1 : 2
            ]);
        }

        //
        // Microphones
        //

        $vocals = Microphone::factory()->create([
            'name' => 'Vocals'
        ]);
        $stringed_instruments = Microphone::factory()->create([
            'name' => 'Stringed Instruments'
        ]);
        $piano = Microphone::factory()->create([
            'name' => 'Piano'
        ]);
        $drum = Microphone::factory()->create([
            'name' => 'Drum'
        ]);


        //
        // Microphones Users TUSSENTABEL
        //

        // Event mics
        for($i = 1 ; $i<5 ; $i++) {

            $event_1 = MicrophonesUser::factory()->create([
                'user_id' => $i,
                'microphone_id' => $i
                ]);
        }

        // Event with all mics present

        for($i = 5; $i<10 ; $i++) {

            $microphone_1 = MicrophonesUser::factory()->create([
                'user_id' => $i,
                'microphone_id' => 1
            ]);
            $microphone_2 = MicrophonesUser::factory()->create([
                'user_id' => $i,
                'microphone_id' => 2
            ]);
            $microphone_3 = MicrophonesUser::factory()->create([
                'user_id' => $i,
                'microphone_id' => 3
            ]);
            $microphone_4 = MicrophonesUser::factory()->create([
                'user_id' => $i,
                'microphone_id' => 4
            ]);
        }

        // Artist mics
        for($i = 11 ; $i<16 ; $i++) {
            $mics = [1, 2, 3, 4];
            $event_1 = MicrophonesUser::factory()->create([
                'user_id' => $i,
                'microphone_id' => $mics[array_rand($mics)],
                ]);
        }

        // Artists with all mics present

        for($i = 16; $i<21 ; $i++) {

            $microphone_1 = MicrophonesUser::factory()->create([
                'user_id' => $i,
                'microphone_id' => 1
            ]);
            $microphone_2 = MicrophonesUser::factory()->create([
                'user_id' => $i,
                'microphone_id' => 2
            ]);
            $microphone_3 = MicrophonesUser::factory()->create([
                'user_id' => $i,
                'microphone_id' => 3
            ]);
            $microphone_4 = MicrophonesUser::factory()->create([
                'user_id' => $i,
                'microphone_id' => 4
            ]);
        }

        //
        // Bandmembers
        //
        for($i = 1 ; $i<5 ; $i++) {
            $artists = User::where('role', 'artist')->get();
            foreach ($artists as $artist ) {
                $bandmember_vocal = Bandmember::factory()->create([
                    'user_id' => $artist->id,
                    'function' => 'vocals',
                    'photo' => 'src/img/bandmembers/bandmember-1.jpg'
                ]);
                $bandmember_vocal = Bandmember::factory()->create([
                    'user_id' => $artist->id,
                    'function' => 'Lead guitar',
                    'photo' => 'src/img/bandmembers/bandmember-2.jpg'
                ]);
                $bandmember_vocal = Bandmember::factory()->create([
                    'user_id' => $artist->id,
                    'function' => 'Rytmic guitar',
                    'photo' => 'src/img/bandmembers/bandmember-3.jpg'
                ]);
                $bandmember_vocal = Bandmember::factory()->create([
                    'user_id' => $artist->id,
                    'function' => 'Drummer',
                    'photo' => 'src/img/bandmembers/bandmember-4.jpg'
                ]);
            }
        }


        //
        // Genres
        //

        $all_genres = ['Alternative', 'Rock', 'Pop', 'Jazz', 'Folk', 'Traditional Jazz', 'Blues', 'Swing', 'Soul', 'Country', 'Bluesgrass', 'Garage Rock', 'Indie Pop', 'House', 'Electric', 'Contemporary', 'Dance', 'Classica','World', 'Latino', 'Hip-Hop', 'Reggae', 'Vocal Jazz'];
        foreach ($all_genres as $genre) {
            $genre_element = Genre::factory()->create([
                'name' => $genre,
            ]);
        }


        //
        // GenresUser
        //
        $all_genres = [];
        $genres = Genre::all();
        foreach ($genres as $genre) {
            array_push($all_genres, $genre->id);
        }
        $artists = User::where('role', 'artist')->get();
        foreach ($artists as $artist ) {
            $bandmember_vocal = GenresUser::factory()->create([
                'user_id' => $artist->id,
                'genre_id' => $all_genres[array_rand($all_genres)],
            ]);
        }



        //
        // Event
        //
        $all_genres = [];
        $genres = Genre::all();
        foreach ($genres as $genre) {
            array_push($all_genres, $genre->id);
        }
        $all_users = [];
        $users = User::where('role', 'event')->get();
        foreach ($users as $user) {
            array_push($all_users, $user->id);
        }
        for($i = 1; $i<11; $i++ ){
            $event = Event::factory()->create([
                'coverphoto' => 'src/img/event/poster/event-' . $i . '.jpg',
                'genre_id' => $all_genres[array_rand($all_genres)],
                'user_id' => $all_users[array_rand($all_users)],

            ]);
        }


        //
        // Applicants
        //
        $events = Event::all();
        $all_users = [];
        $users = User::where('role', 'artist')->get();
        foreach ($users as $user) {
            array_push($all_users, $user->id);
        }
        foreach ($events as $event) {
            $applicant = Applicant::factory()->create([
                'status' => 'pending',
                'event_id' => $event->id,
                'user_id' => $all_users[array_rand($all_users)],
            ]);
        }

        //
        // Event_Genres
        //
        $events = Event::all();
        $all_genres = [];
        $genres = Genre::all();
        foreach ($genres as $genre) {
            array_push($all_genres, $genre->id);
        }
        foreach ($events as $event) {
            $events_genre = EventsGenre::factory()->create([
                'event_id' => $event->id,
                'genre_id' => $all_genres[array_rand($all_genres)],
            ]);
        }

    }
}
