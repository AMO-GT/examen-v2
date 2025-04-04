<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Seed the products table with initial data.
     */
    public function run(): void
    {
        // Zorg ervoor dat de map bestaat
        Storage::disk('public')->makeDirectory('producten');
        
        // Kopieer de shampoo afbeelding naar storage
        $this->copyShampooImage();
        
        Product::create([
            'naam' => 'THE HAIR HUB CONDITIONER',
            'prijs' => 17.95,
            'beschrijving' => 'Perfecte aanvulling op de Hair Hub Shampoo. Deze conditioner ontwarrt, hydrateert en voedt het haar zonder het te verzwaren.',
            'foto_pad' => 'producten/SHAMPOO.png', // Gebruik dezelfde afbeelding voor nu
        ]);

        // Voeg meer producten toe indien gewenst
        Product::create([
            'naam' => 'THE HAIR HUB CONDITIONER',
            'prijs' => 17.95,
            'beschrijving' => 'Perfecte aanvulling op de Hair Hub Shampoo. Deze conditioner ontwarrt, hydrateert en voedt het haar zonder het te verzwaren.',
            'foto_pad' => 'producten/SHAMPOO.png', // Gebruik dezelfde afbeelding voor nu
        ]);

        Product::create([
            'naam' => 'THE HAIR HUB STYLING GEL',
            'prijs' => 15.50,
            'beschrijving' => 'Sterke hold styling gel voor alle kapsels. Geeft glans en definitie zonder plakkerig aan te voelen.',
            'foto_pad' => 'producten/SHAMPOO.png', // Gebruik dezelfde afbeelding voor nu
        ]);
    }
    
    /**
     * Kopieer de shampoo afbeelding van public/images naar storage/app/public/producten
     */
    private function copyShampooImage(): void
    {
        // Specifiek pad naar de SHAMPOO.png afbeelding
        $sourcePath = public_path('images/SHAMPOO.png');
        
        // Controleer of het bestand bestaat
        if (File::exists($sourcePath)) {
            // Kopieer de afbeelding naar storage/app/public/producten met behoud van de naam
            Storage::disk('public')->put('producten/SHAMPOO.png', File::get($sourcePath));
        } else {
            // Log een foutmelding als het bestand niet gevonden wordt
            \Log::error('Shampoo afbeelding niet gevonden op pad: ' . $sourcePath);
        }
    }
} 