<?php

use Illuminate\Database\Seeder;
use App\Apartment;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $name_a = ['Villa', 'Casa', 'Residenza', 'Appartamento', 'B&B', 'Borgo', 'Casale'];
        $name_b = ['Amodio', 'Zavaglia', 'Meleqi', 'Santoro', 'Scollo', 'del duca', 'del conte', 'del sole', 'belvedere', 'del principe', 'Roma', 'Milano', 'sul mare', 'sul monte', 'sulla collina', 'Napoli', 'Cosenza', 'Palmi', 'Messina', 'Varese', 'Ragusa'];

        $way_a = ['Corso', 'Piazza', 'Strada', 'Contrada', 'Frazione', 'Via', 'Borgo', 'Viale'];
        $way_b = ['Giuseppe Garibaldi', 'Camillo benso conte di cavour', 'vittorio emanuele', 'roma', 'sorrento', 'bruno buozzi', 'maria montessori', 'giuseppe mazzini', 'dante alighieri', 'giuseppe verdi', 'giuseppe matteotti', 'IV novembre', 'papa giovanni XXIII', 'palmiro togliatti', 'alcide de gasperi', 'filippo turati',  'enrico fermi', 'francesco petrarca', 'galileo galilei', 'I Maggio', 'giosuè carducci', 'la madonna'];
        $city = ['Agrigento', 'Alessandria', 'Ancona', 'Aosta', 'Arezzo', 'Ascoli Piceno', 'Asti', 'Avellino', 'Bari', 'Barletta', 'Belluno', 'Benevento', 'Bergamo', 'Biella', 'Bologna', 'Bolzano', 'Brescia', 'Brindisi', 'Cagliari', 'Caltanissetta', 'Campobasso', 'Iglesias', 'Caserta', 'Catania', 'Catanzaro', 'Chieti', 'Como', 'Cosenza', 'Cremona', 'Crotone', 'Cuneo', 'Enna', 'Fermo', 'Ferrara', 'Firenze', 'Foggia', 'Forlì-Cesena', 'Frosinone', 'Genova', 'Gorizia', 'Grosseto', 'Imperia', 'Isernia', 'La Spezia', 'Latina', 'Lecce', 'Lecco', 'Livorno', 'Lodi', 'Lucca', 'Macerata', 'Mantova', 'Massa-Carrara', 'Matera', 'Messina', 'Milano', 'Modena', 'Monza', 'Napoli', 'Novara', 'Nuoro', 'Olbia-Tempio', 'Oristano', 'Padova', 'Palermo', 'Parma', 'Pavia', 'Perugia', 'Pesaro', 'Pescara', 'Piacenza', 'Pisa', 'Pistoia', 'Pordenone', 'Potenza', 'Prato', 'Ragusa', 'Ravenna', 'Reggio Calabria', 'Reggio Emilia', 'Rieti', 'Rimini', 'Roma', 'Rovigo', 'Salerno', 'Medio Campidano', 'Sassari', 'Savona', 'Siena', 'Siracusa', 'Sondrio', 'Taranto', 'Teramo', 'Terni', 'Torino', 'Ogliastra', 'Trapani', 'Trento', 'Treviso', 'Trieste', 'Udine', 'Varese', 'Venezia', 'Cusio', 'Vercelli', 'Verona', 'Vibo Valentia', 'Vicenza', 'Viterbo'];

        $users = User::all();

        for ($i=0; $i < 200; $i++) {
            $apartment = new Apartment;
            $apartment->title = Arr::random($name_a) . ' ' . Arr::random($name_b);
            $apartment->description = $faker->text($maxNbChars = 2000)   ;
            $apartment->n_rooms = $faker->numberBetween(1, 6);
            $apartment->n_beds = $faker->numberBetween(1, 6);
            $apartment->n_bathrooms = $faker->numberBetween(1, 4);
            $apartment->squaremeters = $faker->numberBetween(50, 400);
            $apartment->address = Arr::random($way_a). ' ' . Arr::random($way_b) . ', ' . rand(1,100). ', '. Arr::random($city);
            $apartment->latitude = $faker->randomFloat($nbMaxDecimals = 4, $min = 45, $max = 46);
            $apartment->longitude = $faker->randomFloat($nbMaxDecimals = 4, $min = 8, $max = 10);
            $apartment->is_active = $faker->boolean();
            $apartment->created_at = now();
            $apartment->updated_at = now();
            $apartment->host_id = $users->random()->id;
            $apartment->save();
        }
    }
}
