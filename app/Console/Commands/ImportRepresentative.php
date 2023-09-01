<?php

namespace App\Console\Commands;

use App\Enum\GenderEnum;
use App\Models\Representative;
use DateTime;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use ZipArchive;
use Illuminate\Support\Facades\Storage;

class ImportRepresentative extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-representative';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import representative from json zip file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filename = $this->ask('Enter filename');

        $this->info('Extracting archive...');
        $this->extractZipFile($filename);

        $this->info('Importing representative...');
        $this->readFiles();

        $this->info('Cleaning up...');
        $this->cleanUp();

        $this->info('Done!');
    }

    private function extractZipFile(string $filename): void
    {
        $zip = new ZipArchive();

        $zip->open(storage_path('app/representative/' . $filename));
        $zip->extractTo(storage_path('app/representative/temp'));
        $zip->close();
    }

    private function cleanUp(): void
    {
        File::deleteDirectory(storage_path('app/representative/temp/json'));
    }

    public function readFiles(): void
    {
        $directory = storage_path('app/representative/temp/json/acteur');
        if (!File::isDirectory($directory)) {
            $this->error('No directory found, data maybe have been change, verify you zip file!');
            return;
        }

        $files = File::files($directory);

        foreach ($files as $file) {
            $jsonData = json_decode($file->getContents(), true, 512, JSON_THROW_ON_ERROR)['acteur'];
            $this->info('Importing representative ' . $jsonData['uid']['#text']);
            $this->importRepresentative($jsonData);
        }
    }

    private function importRepresentative(array $jsonData): void
    {
        $representative = Representative::firstOrNew(['external_id' => $jsonData['uid']['#text']]);

        $representative->first_name = $jsonData['etatCivil']['ident']['prenom'];
        $representative->last_name = $jsonData['etatCivil']['ident']['nom'];
        $representative->birthday = new DateTime($jsonData['etatCivil']['infoNaissance']['dateNais']);
        $representative->gender = match ($jsonData['etatCivil']['ident']['civ']) {
            'M.' => GenderEnum::MALE,
            'Mme' => GenderEnum::FEMALE,
            default => GenderEnum::NON_BINARY,
        };
        $jobTitle = $jsonData['profession']['libelleCourant'];
        $representative->job_title = is_string($jobTitle)? $jobTitle : null;
        $representative->save();
    }
}
