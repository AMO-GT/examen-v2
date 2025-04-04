<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Eigenaar;

class ProductenTableSeeder extends Seeder
{
    public function run(): void
    {
        $eigenaar = Eigenaar::first();

        if (!$eigenaar) {
            throw new \Exception('Geen eigenaar gevonden. Zorg ervoor dat de MedewerkersTableSeeder eerst wordt uitgevoerd.');
        }

        $producten = [
            [
                'naam' => 'Kerastase Shampoo',
                'beschrijving' => 'Luxe shampoo voor beschadigd haar',
                'prijs' => 29.99,
                'voorraad' => 50,
                'eigenaar_id' => $eigenaar->eigenaar_id
            ],
            [
                'naam' => 'Redken Conditioner',
                'beschrijving' => 'Voedende conditioner voor droog haar',
                'prijs' => 24.99,
                'voorraad' => 50,
                'eigenaar_id' => $eigenaar->eigenaar_id
            ],
            [
                'naam' => 'L\'Oreal Hair Color',
                'beschrijving' => 'Professionele haarverf in verschillende kleuren',
                'prijs' => 19.99,
                'voorraad' => 50,
                'eigenaar_id' => $eigenaar->eigenaar_id
            ],
            [
                'naam' => 'Wella Hairspray',
                'beschrijving' => 'Sterke fixatie voor alle haartypes',
                'prijs' => 15.99,
                'voorraad' => 50,
                'eigenaar_id' => $eigenaar->eigenaar_id
            ],
            [
                'naam' => 'Kérastase Hair Mask',
                'beschrijving' => 'Intensief voedend haarmasker',
                'prijs' => 34.99,
                'voorraad' => 50,
                'eigenaar_id' => $eigenaar->eigenaar_id
            ],
            [
                'naam' => 'Redken Heat Protect',
                'beschrijving' => 'Hittebescherming voor het stylen',
                'prijs' => 22.99,
                'voorraad' => 50,
                'eigenaar_id' => $eigenaar->eigenaar_id
            ]
        ];

        foreach ($producten as $product) {
            Product::create($product);
        }
    }
} 