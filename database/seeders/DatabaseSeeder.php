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
use App\Models\Song;
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
                'coverphoto' => 'img/event/cover/cover-' . $i . '.jpg',

                'pa_id' => $i%2 == 0 ? 1 : 2
            ]);
        }

        //
        // Users (Artist)
        //
        $content = array(
            array(
                'Elektronic',
                'Hey, wij zijn Elektronic. We zijn een Belgische EDM groep uit Gent. Elektronic werd opgericht door onze frontman Seppe Reinaert in 20012. In 2013 voegde Robert Geldhof zich toe en was het DJ duo compleet. Sinds 2018 treden we op met onze vaste MC Maarten Lambricht.',
                'We draaien House, Hiphop en zelfs D&B. We halen samples uit oude jazz en bluesplaten. Deze verwerken we op een unieke manier in onze setlist. Als je muziek uit de oude doos eens in een nieuw jasje wilt horen moet je bij Elektronic zijn.',
            ),
            array(
                'ZONK',
                'Wij zijn ZONK, een Belgische band, die actief is sinds 2003. Onze groep bestaat uit vier jongens: Jasper is de tekstschrijver en zanger van de groep en speelt ook gitaar, Bert is drummer, en de broers Thomas en Serge spelen respectievelijk gitaar en basgitaar.
                We schrijven onze eigen songs. Je kan ons kennen van de song ‘Let me free’ die door enkele radiostations werd opgenomen. Sindsdien hebben we een kleine maar trouwe fanbase die ook wel de Zonkers genoemd worden.
                ',
                'ZONK brengt rock en hardrock. Onze eigen songs zijn eerder autobiografisch en gaan over liefde en opgroeien. In deze onderwerpen kunnen vele jongeren zich herkennen. Elke optreden is een groot feest. Hopelijk leren jullie ons kennen tijdens onze volgende gig.'
            ),
            array(
                'Jef Artois',
                'Hallo, mijn naam is Jef Artois. Jef Artois is niet mijn echte naam maar klinkt beter dan Jef Zwartenbroek. Als echte Leuvenaar drink ik enkel pintjes van ons Leuvens bier ‘Stella Artois’.
                Ik heb een machine die mijn muziek in loops afspeelt. Hiermee kan volwaardige songs maken. Vandaag breng ik verschillend popsongs in verschillende kroegen. Het is tijd om mijn talent te laten zien buiten de stadsgrenzen van Leuven.
                ',
                'Ik cover voornamelijk bekende popsongs, hedendaags maar ook van vroeger. Ik maak het publiek blij door elke keer wel een aanzoekje te spelen. Naast mijn covers maak ik ook mijn eigen popsongs. Naast gitaar speel ik ook piano, harmonica, saxofoon en drum.
                Rustige nummers met harmonica worden afgewisseld door sterke gitaargeluiden.
                '
            ),
            array(
                'Grapejuice',
                "Wij zijn Grapejuice. We zijn een Gentse folkgroep. De groep werd in 2018 gevormd in het Gentse café Den Hemel door Jan Theuns (gitaar), Kobe Vandenabeele (viool), Pieter Derdelinks (trekzak), Hassan Collier en Kato Nys (beide zang). Op 16 januari 2018 traden We voor het eerst samen op in folkclub 't Begin in Belsele met bewerkingen van traditionele volksmelodieën. ",
                'We begonnen met het bewerken van "traditionele volksmelodieën", maar vervolgens zijn we ook eigen nummers beginnen schrijven. In de meeste liederen staat de liefde voor de stad Gent centraal. '
            ),
            array(
                'Jazzhole',
                'Hey, Jazzhole is een Antwerpse groep die ontstond in 2008. Onze muziek is een mix van jazz, rock en experimentele muziek. Stichtend lid is zanger-gitarist Raf Troul. Jazzhole bestond uit een beperkt aantal kernleden, voortdurend bijgestaan door bevriende muzikanten uit andere groepen. Sinds 2011 bestaan we onder onze vaste formatie. Jazzhole staat bekend voor hun interactieve optredens.',
                'Jazz met een hoek af. Door het hoge tempo en improvisatie talent sleegt Jazzhole er in om een heel alledaagse sound te realiseren. Lange intro’s en solo stukken kan je hier zeker verwachten. '
            ),
            array(
                "‘tzeetje",
                "‘tzeetje is een rockband uit Oostende die een mengeling van glamrock, rock-'n-roll, garagerock en pop speelt. Wij wonnen in 2017 de Ostend beach Rock Marathon. Sindsien spelen we in verschillende jeugcafé’s in Oostende en omstreken. Ondanks ons dialect die we meenemen in onze teksten kan heel vlaanderen genieten van onze muziek. In de toekomst zouden we graag enkele gig’s spelen in heel Vlaanderen.",
                "‘zeetje brengt stevige rock met een Oost-Vlaamse tongval. Ons lokaal dialect maakt onze sound uniek en authentiek. Hou je niet van Oost-vlaams? Geen zorgen, als je van ijzersterke rockrifs en gitaarsolo’s houdt dan ben je nog steeds aan het juiste adres! "
            ),
            array(
                'Rock ‘n roll Rudy',
                'Ik ben Rock ’n roll Rudy. Bekend in heel Antwerpen. Menige kroegen heb ik opgetreden. Ik ben een echte old-school rocker in hart en nieren. Je kan mij herkennen aan mijn groot postuur en lange grijze baard. Ik speel elektrisch en elektrische banjo.',
                'Mijn genre kan je omschrijven als roots-rock sterk gelijkend op nummers van Neil Young. Met mijn elektrische banjo creeër ik in sommige songs een country vibe. Ook mijn mondharmonica haal ik elk optreden wel eens boven.'
            ),
            array(
                'Mojo Risen',
                'Onze band bestaat uit leden van overal uit de wereld. We hebben elkaar eigenlijk geheel toevallig leren kennen tijdens optredens, op school of andere musicale festiviteiten. Hirdoor zijn we in feite heel natuurlijk bij één gekomen. Dit wil niet zeggen dat we daardoor niet goed op elkar ingespeeld zijn, in tegendeel zelfs.',
                'Wat wij spelen is voornamelijk Blues, onze gitarist heeft een enorme obsessie met het Robert Johnson, deze invloed is duidelijk te horen in onze muziek.'
            ),
            array(
                'Old Order',
                'Hello, we are a young and fun New Wave/Post punk band. All of us attend the Conservatorium in Ghent. This means that we have a profound knowledge of music theory and songwriting. In the near future we aim to play a variety of concerts to build a name for ourselves and gain a dedicated following.',
                'Our genre is kind of specific, we play mostly New Wave that is inspired by bands like The Cure, New Order and The Police. Besides New Wave we also do a lot of Punk, but we try to keep our concerts focused on one genre.'
            ),
            array(
                'The Amigos',
                'Hi there. We are a group of band members who are all obsessed with reggae. We are all inspired by that one legend but it is already known. If you are looking for a band with the necessary ambience, you know where to find us.',
                "Our genre is inspired by Jamaincan culture. Let's not lie, Bob Marley is the supreme god. There are other legends like Bunny Clarke, Delroy Wilson, Frankie Paul and Winston Rodney."
            )
            );
        for($i=0; $i<10; $i++){
            $id = $i + 11;
            $user = User::factory()->create([
                'name' => $content[$i][0],
                'description' => $content[$i][1],
                'genre_description' => $content[$i][2],
                'role' => 'artist',
                'zipcode' => $address[$i][1],
                'city' => $address[$i][2],
                'latitude' => $address[$i][3],
                'longitude' => $address[$i][4],
                'genre_description' => 'Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Etiam scelerisque tortor diam, vel aliquam leo vestibulum in. Suspendisse consectetur lacus et justo egestas consequat. Nulla id risus massa. Donec eu eleifend nunc.',
                'coverphoto' => 'img/artist/cover/cover-' . $i . '.jpg',
                'vimeo_id' => '529663747',
                'rider' => 'doc/rider/'. $id . '/rider.png',

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
        // for($i = 1 ; $i<5 ; $i++) {
            $artists = User::where('role', 'artist')->get();
            foreach ($artists as $artist ) {
                $bandmember_vocal = Bandmember::factory()->create([
                    'user_id' => $artist->id,
                    'function' => 'Vocals',
                    'photo' => 'img/bandmembers/'. $artist->id . '/3.jpg'
                ]);
                $bandmember_vocal = Bandmember::factory()->create([
                    'user_id' => $artist->id,
                    'function' => 'Lead guitar',
                    'photo' => 'img/bandmembers/'. $artist->id . '/4.jpg'
                ]);
                $bandmember_vocal = Bandmember::factory()->create([
                    'user_id' => $artist->id,
                    'function' => 'Drummer',
                    'photo' => 'img/bandmembers/'. $artist->id . '/2.jpg'
                ]);
                $bandmember_vocal = Bandmember::factory()->create([
                    'user_id' => $artist->id,
                    'function' => 'Bass guitar',
                    'photo' => 'img/bandmembers/'. $artist->id . '/1.jpg'
                ]);
            }
        // }


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
                'coverphoto' => 'img/event/poster/event-' . $i . '.jpg',
                'genre_id' => $all_genres[array_rand($all_genres)],
                'user_id' => $i,

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

        // songs
        $users = User::where('role', 'artist')->get();
        foreach ($users as $user) {
            Song::factory()->create([
                'url' => 'songs/' . $user->id . '/1.mp3',
                'user_id' => $user->id,
            ]);
            Song::factory()->create([
                'url' => 'songs/' . $user->id . '/2.mp3',
                'user_id' => $user->id,
            ]);
            Song::factory()->create([
                'url' => 'songs/' . $user->id . '/3.mp3',
                'user_id' => $user->id,
            ]);
            Song::factory()->create([
                'url' => 'songs/' . $user->id . '/4.mp3',
                'user_id' => $user->id,
            ]);
        }

    }
}
