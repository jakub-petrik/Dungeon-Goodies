<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Carbon;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Sakamoto Days 2',
            'price' => 12.99,
            'type' => 'Manga',
            'series' => 'Sakamoto Days',
            'manufacturer' => 'Yuto',
            'format' => 'Paperback',
            'date_of_release' => '2020-12-27',
            'description' => 'Manga about dude that is like John Wick but little chubby ep-2.',
            'image_1' => 'Products/Sakamoto_Days_2.jpg',
            'image_2' => 'Products/Sakamoto_Days_2_Back.jpg',
            'on_sale' => false,
            'sale_percent' => null,
        ]);

        Product::create([
            'name' => 'Sakamoto Days 1',
            'price' => 12.99,
            'type' => 'Manga',
            'series' => 'Sakamoto Days',
            'manufacturer' => 'Yuto',
            'format' => 'Paperback',
            'date_of_release' => '2020-11-21',
            'description' => 'Manga about dude that is like John Wick but little chubby.',
            'image_1' => 'Products/Sakamoto_Days_1.jpg',
            'image_2' => 'Products/Sakamoto_Days_1_Back.jpg',
            'on_sale' => false,
            'sale_percent' => null,
        ]);

        Product::create([
            'name' => 'The Walking Dead Compendium Vol.1',
            'price' => 49.99,
            'type' => 'Comics',
            'series' => 'The Walking Dead',
            'manufacturer' => 'Image Comics',
            'format' => 'Paperback',
            'date_of_release' => '2009-05-19',
            'description' => 'Comics about interpersonal drama and zombies.',
            'image_1' => 'Products/Walking_Dead_ComVol1.jpg',
            'image_2' => 'Products/Walking_Dead_ComVol1_Back.jpg',
            'on_sale' => false,
            'sale_percent' => null,
        ]);

        Product::create([
            'name' => 'Fell Vol.1',
            'price' => 12.99,
            'type' => 'Comics',
            'series' => 'Fell Series',
            'manufacturer' => 'Image Comics',
            'format' => 'Paperback',
            'date_of_release' => '2007-05-23',
            'description' => 'Dark crimes about shady detective.',
            'image_1' => 'Products/Fell.jpg',
            'image_2' => 'Products/Fell_Back.jpg',
            'on_sale' => true,
            'sale_percent' => 25,
        ]);

        Product::create([
            'name' => 'Funko Pop! - The Batman',
            'price' => 15.99,
            'type' => 'Funko POP!',
            'series' => 'The Batman Figures',
            'manufacturer' => 'Warner Bros',
            'format' => null,
            'date_of_release' => '2022-11-15',
            'description' => 'Vinyl figure from the world of The Batman.',
            'image_1' => 'Products/Funko_Pop_TheBatman.jpg',
            'image_2' => 'Products/Funko_Pop_TheBatman_Back.jpg',
            'on_sale' => true,
            'sale_percent' => 10,
        ]);

        Product::create([
            'name' => 'Funko Pop! - SandMan',
            'price' => 15.99,
            'type' => 'Funko POP!',
            'series' => 'Spider-Man Figures',
            'manufacturer' => 'Marvel',
            'format' => null,
            'date_of_release' => '2020-02-03',
            'description' => 'Vinyl figure from the world of Spider-Man.',
            'image_1' => 'Products/Funko_Pop_SandMan.jpg',
            'image_2' => 'Products/Funko_Pop_SandMan_Back.jpg',
            'on_sale' => false,
            'sale_percent' => null,
        ]);

        Product::create([
            'name' => 'Funko Pop! - Zombie Wolverine',
            'price' => 15.99,
            'type' => 'Funko POP!',
            'series' => 'Zombie Figures',
            'manufacturer' => 'Marvel',
            'format' => null,
            'date_of_release' => '2021-05-23',
            'description' => 'Vinyl figure from the world of X-Men.',
            'image_1' => 'Products/Funko_Pop_ZombieWolverine.jpg',
            'image_2' => 'Products/Funko_Pop_ZombieWolverine_Back.jpg',
            'on_sale' => false,
            'sale_percent' => null,
        ]);

        Product::create([
            'name' => 'Funko Pop! - Shrimp Rick',
            'price' => 15.99,
            'type' => 'Funko POP!',
            'series' => 'Rick&Morty Figures',
            'manufacturer' => 'Adult Swim',
            'format' => null,
            'date_of_release' => '2019-09-11',
            'description' => 'Vinyl figure from the world of Rick&Morty.',
            'image_1' => 'Products/Funko_Pop_ShrimpRick.jpg',
            'image_2' => 'Products/Funko_Pop_ShrimpRick_Back.jpg',
            'on_sale' => false,
            'sale_percent' => null,
        ]);

        Product::create([
            'name' => 'Junji Ito - Shiver',
            'price' => 12.99,
            'type' => 'Manga',
            'series' => 'Junji Ito Series',
            'manufacturer' => 'Adult Swim',
            'format' => 'Hardcover',
            'date_of_release' => '2015-04-04',
            'description' => 'Scary Japanese manga.',
            'image_1' => 'Products/Junji_Ito_Shiver.jpg',
            'image_2' => 'Products/Junji_Ito_Shiver_Back.jpg',
            'on_sale' => true,
            'sale_percent' => 20,
        ]);

        Product::create([
            'name' => 'Wolverine: Old Man Logan',
            'price' => 12.99,
            'type' => 'Comics',
            'series' => 'Marvel Series',
            'manufacturer' => 'Marvel',
            'format' => 'Paperback',
            'date_of_release' => '2019-09-19',
            'description' => 'Marvel comics about old Logan.',
            'image_1' => 'Products/OldManLogan.jpg',
            'image_2' => 'Products/OldManLogan_Back.jpg',
            'on_sale' => true,
            'sale_percent' => 15,
        ]);

        Product::create([
            'name' => 'Funko Pop! - Nebula',
            'price' => 15.99,
            'type' => 'Funko POP!',
            'series' => 'Avengers Figures',
            'manufacturer' => 'Marvel',
            'format' => null,
            'date_of_release' => '2021-02-12',
            'description' => 'Vinyl figure from the world of Avengers.',
            'image_1' => 'Products/Funko_Pop_Nebula.jpg',
            'image_2' => 'Products/Funko_Pop_Nebula_Back.jpg',
            'on_sale' => true,
            'sale_percent' => 10,
        ]);

        Product::create([
            'name' => 'Funko Pop! - Spider-Man',
            'price' => 15.99,
            'type' => 'Funko POP!',
            'series' => 'Spider-Man Figures',
            'manufacturer' => 'Marvel',
            'format' => null,
            'date_of_release' => '2020-02-03',
            'description' => 'Vinyl figure from the world of Spider-Man.',
            'image_1' => 'Products/Funko_Pop_SpiderMan.jpg',
            'image_2' => 'Products/Funko_Pop_SpiderMan_Back.jpg',
            'on_sale' => true,
            'sale_percent' => 10,
        ]);
    }
}
