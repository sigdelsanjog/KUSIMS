<?php

use Illuminate\Database\Seeder;
use App\Models\DocumentType;


class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $documents[] = [
        //     ['name'=>'Copy of personal identification'],
        //     ['name'=>'Transcript SLC'],
        //     ['name'=>'Transcript +2'],
        //     ['name'=>'Character Certificate SLC'],
        //     ['name'=>'Character Certificate +2'],
        //     ['name'=>'Migration Certificate +2']
        // ];

        // $docType = DocumentType::create($documents);

        DocumentType::insert([
                        ['name'=>'Copy of personal identification'],
                        ['name'=>'Transcript SLC'],
                        ['name'=>'Transcript +2'],
                        ['name'=>'Character Certificate SLC'],
                        ['name'=>'Character Certificate +2'],
                        ['name'=>'Migration Certificate +2']
        ]);

        // $docType->save();
    }
}
