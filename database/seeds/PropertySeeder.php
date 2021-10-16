<?php
    use App\Models\Property;
    use Illuminate\Database\Seeder;

    class PropertySeeder extends Seeder{
        /**
         * * Run the database seeds.
         * @return void
         */
        public function run () {
            factory(Property::class, 25)->create();

            foreach (Property::all() as $property) {
                $property->update([
                    'folder' => "property/$property->id_property",
                ]);
            }
        }
    }