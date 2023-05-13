<?php
  use App\Models\Category;
  use App\Models\ForeignCategoryProperty;
  use Cviebrock\EloquentSluggable\Services\SlugService;
  use Illuminate\Database\Seeder;

  class PropertySeeder extends Seeder {
    /**
     * * The Seeder Model.
     * @var \App\Models\Property
     */
    protected $model = \App\Models\Property::class;

    /**
     * Run the database seeds.
     * 
     * @return void
     */
    public function run () {
      // factory($this->model, 25)->create();

      $property = $this->model::create([
        'name' => 'Depto. pleno centro y dos locales (ref.:14)',
        'description' => 'Parte superior con un departamento amplio y cómodo. abajo cuenta con dos locales, uno pequeño y otro grande con salón, cocina, baño, deposito y ambiente grande.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(2),
        Category::find(5),
      ]);

      $property = $this->model::create([
        'name' => 'Campo 224 has mixto (REF.: 17)',
        'description' => 'Campo de 224 has al costado de ruta 228 km 75,5. Con casa grande, molinos automaticos, silos, tinglado y galpon.',
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(1),
        Category::find(4),
      ]);

      $property = $this->model::create([
        'name' => 'Casa Calle mitre casi rivadavia (ref.:19)',
        'description' => 'Casa cómoda, sobre terreno de 12x30 mtros. con todos los servicios. Compuesta de: living, dos habitaciones, comedor, cocina y lavadero. Cochera doble más fogón con cocina, baño y patio. Casa a reparar. Buena ubicación, calle Mitre entre Rivadavia y Moreno.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(1),
      ]);

      $property = $this->model::create([
        'name' => 'Propiedad calle Rivadavia casi Brown',
        'description' => 'Casa de 2 habitaciones, Cocina/comedor, baño. Todos los servicios. Lavadero exterior, entrada para coche. Sobre terreno de 12 x 40 mts.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(1),
      ]);

      $property = $this->model::create([
        'name' => 'Departamento en Bahía Blanca',
        'description' => 'Departamente en Bahía Blanca de 20. Monoambiente 7° piso, ubicado en la calle Zelarrayán entre 19 de mayo y 11 de Abril , a 3 cuadra de la plaza principal. Cocina Kichenet, Heladera. Piso parquet U$D 43000.',
        'id_location' => 6, // ? Bahía Blanca
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(2),
      ]);

      $property = $this->model::create([
        'name' => 'Campo de 224 has. agrícola/ganadero',
        'description' => 'Ubicado sobre la Ruta 228 Km 77,5. Casa grande de 3 habitaciones. Galpón de 15 x 31 mts. Galpón de 7,5 x 12 mts. Manga / 2 lotes / silos.',
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(1),
        Category::find(4),
        Category::find(8),
      ]);

      $property = $this->model::create([
        'name' => 'Casa en Ugarte y Av. San Martín',
        'description' => 'Casa en calle Ugarte casi Av. San Martín. 3 habitaciones, 2 baños, cocina y living comedor, galpón con fogón, garage, oficina, baño y lavadero. Todos los servicios.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(1),
      ]);

      $property = $this->model::create([
        'name' => 'Casa en Necochea',
        'description' => 'Casa en la ciudada de Necoceha ubicada en la calle 54 y esquina 67. 3 habitaciones, 2 baños completos, cocina, living, garage y patio pequeño.',
        'id_location' => 2, // ? Necochea
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(1),
      ]);

      $property = $this->model::create([
        'name' => 'Quinta de 2 hectáreas, con casa grande',
        'description' => 'Quinta de 2 hectáreas, con 1 casa grande, 3 habitaciones, 2 baños, cocina comedor, lavadero y garage. La otra construcción a 30 mts. En buenas condiciones. Luz eléctrica, cable canal. Monte al costado. A dos cuadras del asfalto.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(1),
        Category::find(6),
      ]);

      $property = $this->model::create([
        'name' => 'Quinta de 122 x 35 mts. sobre calle Colón',
        'description' => 'Quinta de 122 x 35 mts. sobre calle Colón en sección quinta. Consta de 3 habitaciones en perfecto estado muy bien equipadas con baño en cada una, gran cocina y garage independiente c/u. En la parte de atrás una edificación que fue fabrica de embutidos y frigorífico de muy buen tamaño y edificación. Tiene energía eléctrica y agua.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(6),
      ]);

      $property = $this->model::create([
        'name' => 'Campo de 125 has. a 2 kilómetros de San Cayetano',
        'description' => 'Campo de 125 has. a 2 kilómetros de San Cayetano. Tierra negra.',
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(4),
      ]);

      $property = $this->model::create([
        'name' => 'Casa en calle céntrica. Calle Rivadavia',
        'description' => 'Casa en calle céntrica en Calle Rivadavia e/ Av. San Martín y 25 de mayo. Casa, muy deteriorada. Pero ubicación esplíndida. Hay que hacer mucho, pero tendrá su recompensa en un futuro. Su valor se multiplicara por cuatro. Es una inversión a futuro. Y lo más importante, posee planos y escritura, apta para crédito bancario.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(1),
      ]);

      $property = $this->model::create([
        'name' => 'Chalet calle 80 e/ 57 y 55 Necochea',
        'description' => 'Todo lujo y materiales de primera. Su valor es relativamente bajo. hermoso y grande chalet en calle 80 e/ 57 y 55 Necochea. Con todas las comodidades 4 habitaciones, 4 baños, yacuzzi, quincho, pileta. Todo lujo y materiales de primera. Su valor es relativamente bajo.',
        'id_location' => 2, // ? Necochea
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(7),
      ]);

      $property = $this->model::create([
        'name' => 'Chalet Alpino en balneario San Cayetano',
        'description' => 'Chalet alpino con fogón y garage en balneario San Cayetano, sobre terreno de 15 por 30 metros en calle las acacias, muy linda zona. Posee en la parte de abajo, cocina comedor, living y baño. En la parte de arriba 2 habitaciones con placard empotrados y pasillo. Atrás posee fogón grande con cocina y baño completo, y garage con cocina y baño completo. Todo con Luz eléctrica, agua corriente. Cable canal y estufa Ulstrup. Todo en buen estado de mantenimiento, en el verano son dos alquileres.',
        'id_location' => 7, // ? Balneario de San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(7),
      ]);

      $property = $this->model::create([
        'name' => 'Departamento en Mar del Plata - 2 dormitorios',
        'description' => 'Departamento de con 2 dormitorios en Mar del Plata en Av. Luro 3050 (entre Catamarca y La Rioja). Con comedor, cocina, baño, muy soleado y luminoso.',
        'id_location' => 1, // ? Mar del Plata
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(2),
      ]);

      $property = $this->model::create([
        'name' => 'Terreno a una cuadra del asfalto',
        'description' => 'Terreno a una cuadra del asfalto. Los servicios pasan por la esquina del frente. Ideal para la construcción de casas quintas, complejo. Grandísimo.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(3),
      ]);

      $property = $this->model::create([
        'name' => 'Departamento en Mar del Plata en AV. Luro',
        'description' => 'Departamento en Mar del Plata, ubicado en Av. Luro 1050. Esta compuesto de 2 dormitorios a la calle, un baño, cocina separada, instalación para lavarropas, termotanque nuevo, living comedor amplio muy soleado.',
        'id_location' => 1, // ? Mar del Plata
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(2),
      ]);

      $property = $this->model::create([
        'name' => 'Terreno de 20 x 50 metros',
        'description' => 'Terreno de 20 x 50 metros, con todos los servicios menos el gas. Ideal galpón, detrás de cancha de Sportivo. Listo para escriturar.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(3),
      ]);

      $property = $this->model::create([
        'name' => 'Casa con escritura y planos',
        'description' => 'Casa, con escritura y planos. Consulte y la venderá.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(1),
      ]);

      $property = $this->model::create([
        'name' => 'Terreno en Av. Independencia',
        'description' => 'Terreno de 10 x 40 mts. en Av. Independencia, con todos los servicios y asfalto. El terreno tiene documentación en orden.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(3),
      ]);

      $property = $this->model::create([
        'name' => 'Terreno de 15 x 40 mts. con todos los servicios',
        'description' => 'Terreno de 15 x 40 metros ubicado en Av. Sgto Cabral entre Av. Independencia y 9 de Julio, con todos los servicios.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(3),
      ]);

      $property = $this->model::create([
        'name' => 'Campo de 112 has. en Colonia Rivadavia',
        'description' => 'Campo de 112 has. en Colonia Rivadavia, 100% agrícola, muy buena tierra negra, financiación.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(4),
      ]);

      $property = $this->model::create([
        'name' => 'Depto. en Necochea 1 1/2 amb. frente al mar',
        'description' => 'Depto. en Necochea de 1 1/2 ambiente, frente al mar en calle 2 casi 77. Se compone de: gran comedor con vista al mar, cocina separada, lavadero, baño y placares en todos los ambientes. Muy lindo. Haga cuentas: se alquila de abril/noviembre 4000 por mes y diciembre/marzo a $900/día. Lavadero en planta alta',
        'id_location' => 2, // ? Necochea
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(2),
      ]);

      $property = $this->model::create([
        'name' => 'Casa muy cómoda con local en pleno centro',
        'description' => 'Casa muy cómoda con local en pleno centro y opcional otra casa anexa. Local mas chico que pertenece a casa de planta alta. Se puede vender todo como una unidad o por separado. Local grande con oficina y casa atrás.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(1),
        Category::find(5),
      ]);

      $property = $this->model::create([
        'name' => 'Majestuoso chalet de 233 mts. cuadrados en calle céntrica',
        'description' => 'Majestuoso chalet de 233 metros cuadrados en calle céntrica, compuesto de 3 habitaciones, 2 baños, 1 toilette, gran linving con fogón, cocina con anafe y horno en pared, lavadero, mucho placard, puertas y ventanas de cedro, calefacción por caldera, patio con parrilla, cochera cubierta y descubierta, gran galería habitación y baño de servicio. Mucha luz exterior. Escritura y planos en condiciones. Lujo total. Para verlo por dentro, llámame, le encantará. Acepta distintos medios de pago. Y como coralario, confort, calidad y la mejor ubicación.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(7),
      ]);

      $property = $this->model::create([
        'name' => '2 departamentos con un gran galpón atrás',
        'description' => 'Dos departamentos con un gran galpón atrás, sobre terreno de 10 x 60 mts. Ideal para dar vivienda en alquiler y galpón para trabajo. El departamento 1 tiene, 2 habitaciones, cocina comedor, lavadero y baño. El departamento 2 tiene: 1 habitación con baño, cocina comedor y lavadero. El galpón es de 10 x 15 metros, con fosa y trifásica. Ideal para inversiones rentables.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(2),
        Category::find(8),
      ]);

      $property = $this->model::create([
        'name' => 'Depto. de 4 habitaciones en calle 60 y 61 Necochea',
        'description' => 'Depto. en el mejor punto de Necochea, frente a plaza, calle 60 y 61. 4 habitaciones, 2 baños, cocina, living, patio, parrilla, mucha luz y todo en perfectas condiciones.',
        'id_location' => 2, // ? Necochea
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(2),
      ]);

      $property = $this->model::create([
        'name' => 'Casa cómoda sobre terreno de 15 x 45 mts',
        'description' => 'Casa cómoda sobre terreno de 15 x 45 mts. compuesta de: living, cocina, pasillo a baño completo, 2 habitaciones y espacio para guardar coche. A un costado garage con: cocina amplia, baño completo y habitación.  Atrás un cómodo y amplio lavadero. Todos los servicios y con distintos medidores. Apto crédito bancario y un precio relativamente accesible. Calle Sarmiento casi Colón',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(1),
      ]);

      $property = $this->model::create([
        'name' => 'Terreno de 10 x 36 mts.',
        'description' => 'Terreno de 10 x 36 metros. Calle 1 de Mayo casi Belgrano. Con medianera. Próximamente calle que pasará el asfalto. Pegado a las dos casas de los mídicos.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(3),
      ]);

      $property = $this->model::create([
        'name' => 'Quinta de 2 has. a 2 cuadras de calle Colón',
        'description' => 'Quinta de 2 hectáreas. A dos cuadras del asfalto, calle Colón, una casa grande con dos cocinas, dos baños, tres habitaciones, comedor con fogón, red eléctrica, cable canal, garage y una construcción a un costado. Precio relativamente bajo. Mucha luz en los ambientes',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(1),
        Category::find(6),
      ]);

      $property = $this->model::create([
        'name' => 'Quinta de 7 has.',
        'description' => 'Quinta de 7 hectáreas con casa muy amplia a terminar. Casa con living de 11x9 mts., baño de 7x2 mts., cocina y habitación. Tiene techo y caños para su cableado. Agua de red y energía eléctrica, aparte de ser tierra negra. Pegado al casco urbano. Calle de entoscado la circundan.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(1),
        Category::find(6),
      ]);

      $property = $this->model::create([
        'name' => 'Casa con buena distribución',
        'description' => 'Casa con buena distribución, compuesta por un living, cocina, baño, 2 amplias habitaciones y lavadero. Garage para 2 autos y fogón con baño. Sobre terreno de 10 x 35 mts.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(1),
      ]);

      $property = $this->model::create([
        'name' => 'Dpto. en pleno centro con local comercial',
        'description' => 'Departamento en San Cayetano en pleno centro, pegado al Club Sportivo. Contiene 3 habitaciones, 2 baños, cocina, comedor y negocio en la parte de adelante.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(2),
      ]);

      $property = $this->model::create([
        'name' => 'Campo de 186 has. 100% agrícola',
        'description' => 'Campo de 186 has. 100% agrícola ubicada frente a la laguna "el junco" y la balanza de Deferrari.',
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(4),
      ]);

      $property = $this->model::create([
        'name' => 'Campo de 179 has.',
        'description' => 'Campo de 179.31 has. 100% agrícola, cerca de Benito Juárez, a 7 km de ruta 86. Contiene 2 parcelas, 1 de 72 has. y la otra de 107.31 has. Su precio es de U$ 2900/has. Buenos alambres externos.',
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(4),
      ]);

      $property = $this->model::create([
        'name' => 'Inmueble 350 mts2. en pleno centro',
        'description' => 'Inmueble de 350 mts2. cubierto, ubicado en esquina 25 de Mayo y 9 de Julio excelente ubicación comercial, con negocio en funcionamiento. Salón comercial, salón exibidor, oficina, 2 baños, fogón, sótano y deposito.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(1),
        Category::find(5),
      ]);

      $property = $this->model::create([
        'name' => 'Gran casa, amplia y hermosa',
        'description' => 'Gran casa, amplia, hermosa, todo lo que tiene que tener una casa, amplio living, amplia cocina, habitaciones, baños, lavadero, garage, patio. Madera, mármol, bello. Hace varios años no la habita nadie, pero es un palacio, solo falta mantenimiento.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(1),
      ]);

      $property = $this->model::create([
        'name' => 'Terreno de 10x60 mts. Todos los servicios',
        'description' => 'Terreno de 10x60 mts. Sobre asfalto y todos los servicios a pasos de la Escuela N19.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(3),
      ]);

      $property = $this->model::create([
        'name' => 'Interesante, amplia y cómoda casa en la Dulce',
        'description' => 'Interesante , amplia y cómoda casa en Avenida 25 y calle 24 ciudad de La Dulce. Posee living con fogón, cocina amplia, baño y 3 habitaciones, la habitación principal es grande. Con patio de 40 metros y arboles frutales.',
        'id_location' => 8, // ? La Dulce
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(1),
      ]);

      $property = $this->model::create([
        'name' => 'Excelente gran departamento en Av. Independencia casi Brown',
        'description' => 'Excelente gran departamento en Av. Independencia casi Brown. Consta de 3 habitaciones, amplia cocina, comedor, balcón muy amplio con lavadero. Ideal para inversión.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(2),
      ]);

      $property = $this->model::create([
        'name' => 'Gran galpón sobre 6 lotes unificados',
        'description' => 'Gran galpón sobre 6 lotes unificados. Dicho galpón mide 15x50 mts. de fondo. Consta de sanitarios (varón/mujer), depósito, portones en los 4 lados, oficina, fogón, manposteria de ladrillo común reforzada con columna en todo su perímetro, chapa galvanizada y claraboyas, fosa para vehículos, corriente trifásica, piso de hormigón armado. Posee losa y grúa con riel en toda su extensión. Sobre un predio de 20x30 mts. y otro de 30x65 mts.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(8),
      ]);

      $property = $this->model::create([
        'name' => '22 terrenos de 15x30 mts. y 20x60 mts. en excelente lugar',
        'description' => '22 terrenos de 15x30 mts. y 20x60 mts. en excelente lugar, con mucha proyección.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(3),
      ]);

      $property = $this->model::create([
        'name' => 'Excepcional chalet sobre Av. Independencia',
        'description' => 'Excepcional chalet sobre Av. Independencia, sobre terreno de 15 x 45 metros. Gran living comedor, cocina amplia, dos habitaciones y baño. Afuera garage doble, lavadero y muy linda pileta de natación de material de 3,5 x 7 metros.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(7),
      ]);

      $property = $this->model::create([
        'name' => 'Excepcional campo de 40 hectáreas a 7 km del Balneario',
        'description' => 'Excepcional campo de 40 hectáreas a 7 km del Balneario San Cayetano a un costado de la ruta de entrada al mismo. Rindes fabulosos, tendrá cosechas excelentes o muy buenas. U$ 13 mil dólares/has, en 3 años recupera su inversión.',
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(4),
      ]);

      $property = $this->model::create([
        'name' => 'Excepcional campo de 586 has.',
        'description' => 'Excepcional campo de 586 has. Compuesto de: 11 lotes, 3 molinos, luz trifásica, tinglado nuevo, galpón, 7 silos de 200 Tn, 4 tanques de combustible, manga, cómoda casa con estufas Ulstrup, casa personal, buenos alambrados. A 20 km de San Cayetano. Camino estoscado.',
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(1),
        Category::find(4),
      ]);

      $property = $this->model::create([
        'name' => 'Gran terreno de 15 x 50 mts.',
        'description' => 'Gran terreno de 15x50 mts. con todos los servicios y medianera e interesante galpón atrás. Calle Mitre numero 32.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(3),
        Category::find(8),
      ]);

      $property = $this->model::create([
        'name' => 'Negocio con casa sobre terreno de 20 x 60 metros',
        'description' => 'Negocio con casa sobre terreno de 20 x 60 mts. en Av. Uriburu entre 25 de mayo y Mitre, con todos los servicios.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(1),
        Category::find(5),
      ]);

      $property = $this->model::create([
        'name' => 'Gran casa en pleno centro de la ciudad',
        'description' => 'Gran casa deteriorada, muchos ambientes, paredes solidas, de gran terreno de 15 x 57 metros y una ubicación predilecta en Av San Martín entre Rivadavia y Belgrano.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(1),
      ]);

      $property = $this->model::create([
        'name' => 'Quinta de 8 has. cerca a asfalto, con servicios de luz, gas y agua',
        'description' => 'Quinta de 8 has., cerca a asfalto, con servicios de luz, gas y agua, cable canal. En dos lotes, buenos alambrados, casa grande, cocina, comedor, dos baños, varias estufas, 3 habitaciones. Galpón y pileta de material.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(1),
        Category::find(6),
      ]);

      $property = $this->model::create([
        'name' => 'Casa en calle Mitre N°635',
        'description' => 'Casa por dentro, en ubicada en calle Mitre N°635, sobre un terreno ideal de 15x45 metros.  Consta de 3 habitaciones (una con placard empotrado), pisos flotantes, una en suite, mas baño completo, gran living de 10 x 4,5 metros, cocina de 4 x 4 metros, mucha luz, puerta ventana. Lavadero con termo, mas conexión para cocina. Radiador en todos los ambientes. Hermosa y espaciosa. Techo de yeso y chapa exterior. Apta crédito bancario.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(1),
      ]);

      $property = $this->model::create([
        'name' => 'Excelentes terrenos con todos los servicios',
        'description' => 'Excelentes terrenos sobre asfalto con todos los servicios.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(3),
      ]);

      $property = $this->model::create([
        'name' => 'Gran terreno con 2 negocios y 1 casa',
        'description' => 'Gran terreno con dos negocios deteriorados y casa más atrás con todos los servicios. Tremenda edificación con una magnífica proyección por dimensiones y ubicación.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(1),
        Category::find(5),
      ]);

      $property = $this->model::create([
        'name' => 'Campo de 252 has. a 37 km de San Cayetano',
        'description' => 'Campo de 252 has. a 37 km de San Cayetano sobre camino entoscado. El 90% del campo posee suelos de buena aptitud agrícola para cultivos de cosecha. Cuenta con: Casa principal, galpón de material con pisos de cemento, casa de encargado, manga y corrales. 2 Silos de chapa. 2 molinos con tanques y aguadas completas.',
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(1),
        Category::find(4),
      ]);

      $property = $this->model::create([
        'name' => 'Magnífico terreno de 40x60 mts.',
        'description' => 'Magnífico terreno de 40 mtros x 60 mtros, zona quinta muy próxima a Av. Independencia, para grandes proyectos. Terreno plano.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(3),
      ]);

      $property = $this->model::create([
        'name' => 'Casa en Necochea sobre terreno de 12 x 35 mts.',
        'description' => 'Casa en Necochea ubicada en calle 73 N 3019. Living, dos habitaciones, cocina comedor, lavadero, garage grande, fogón y patio. Sobre terreno de 12 x 35 mts. Buen precio.',
        'id_location' => 2, // ? Necochea
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(1),
      ]);

      $property = $this->model::create([
        'name' => 'Excepcional terrerno ubicado en Sgto. Cabral y 9 de Julio',
        'description' => 'Excepcional terreno de 40 x 30 metros, ubicado en Sgto. Cabral y 9 de Julio. Todos los servicios, sobre avenida.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(3),
      ]);

      $property = $this->model::create([
        'name' => 'Casa en buenas condiciones, calle 6 de septiembre casi 25 de mayo',
        'description' => 'Casa en buenas condiciones muy próximo al centro, calle 6 de septiembre casi 25 de mayo. Casa compuesta de Iiving, cocina comedor, dos habitaciones y baño. Afuera garage, lavadero y depósito. En perfecto estado. Garage con fogón y patio.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(1),
      ]);

      $property = $this->model::create([
        'name' => 'Campo de 85 has. en partido de Benito Juárez ',
        'description' => 'Campo de 85 has. en partido de Benito Juárez, ubicado en Ruta 3 a 11,5 km de la ciudad. Casa Habitable, en uso. Galpón. Monte, Chanchesia corrales 4 Potreros, 1 Molino nuevo y Aguadas. Alambrados internos regulares y malos. Alambrados perimetrales buen estado. Valor: 4000 usd x ha Puede tomar en parte de pago hasta 50% propiedades en Benito Juárez y Necochea.',
        'id_location' => 5, // ? Benito Juárez
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(1),
        Category::find(4),
        Category::find(8),
      ]);

      $property = $this->model::create([
        'name' => 'Casa ubicada en P.N. Carrera entre Rivadavia y Belgrano',
        'description' => 'Vendo hermosa casa ubicada en Pedro N. Carrera entre Rivadavia y Belgrano, sobre terreno ideal, de 15x45 metros. Living, cocina, baño dos habitaciones, otra habitación con baño en suite, afuera lavadero con garage con fogón y mas atrás pileta de fibra. Lugar, comodidad y buen estado general.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(1),
      ]);

      $property = $this->model::create([
        'name' => 'Comercio con depósito y cocina y casa en sitio transitado',
        'description' => 'Comercio con depósito y cocina y casa en sitio transitado. Casa con cocina, comedor, dos habitaciones patio interno y todos los servicios. En regular condiciones.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(1),
        Category::find(5),
      ]);

      $property = $this->model::create([
        'name' => 'Campo',
        'description' => 'Son 75 has ubicado entre Benito Juárez y Necochea, cruzando el río Quequén. Sobre la ruta. Terreno alto para cultivo, agrícola-ganadero. Galpón en uso; casa a reciclar U$S 3.500 la hectárea.',
        'id_location' => 5, // ? Benito Juárez
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(1),
        Category::find(4),
        Category::find(8),
      ]);

      $property = $this->model::create([
        'name' => 'Hermoso depto en plena peatonal de Necochea',
        'description' => 'Hermoso depto en plena peatonal de Necochea. Calle 83 N° 226, edificio Florida, a metros de la playa. Contrafrente muy luminoso, dos ambientes, habitación con placard amplio empotrado, cocina, comedor, baño. Con o sin muebles, listo para habitar.',
        'id_location' => 2, // ? Necochea
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(2),
      ]);

      $property = $this->model::create([
        'name' => 'Campo de 234 has. a 3 km de ruta 3',
        'description' => 'Campo de 234 has, está ubicado entre Adolfo G. Chávez y Benito Juárez, a 3 km de ruta 3. 90 has acumuladas sembrables lomadas marcadas, no hay fotos hay que revisar directo, monte molinos etc, a mejorar. Precio u$ 4000/ has.',
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(4),
      ]);

      $property = $this->model::create([
        'name' => 'Campo 100 has. agrícolas sobre ruta 75',
        'description' => 'Campo 100 has. agrícolas sobre ruta 75 a 5 km de Adolfo G Chaves. Con casa y galpón a reparar.',
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(1),
        Category::find(4),
        Category::find(8),
      ]);

      $property = $this->model::create([
        'name' => 'Campo de 40 has a 6 km de Energía',
        'description' => 'Campo de 40 has a 6 km de Energía, camino entoscado, buena casa con fogón y garage. Actualmente con pastura. Financiación a 3 años. Valor u$4500/ has',
        'id_location' => 10,
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(1),
        Category::find(4),
      ]);

      $property = $this->model::create([
        'name' => 'Gran galpón de casi 200 mts2 en 25 de Mayo',
        'description' => 'Gran galpón de casi 200 metros cuadrados sobre un terreno de 30x30 metros, en 25 de Mayo e Hipólito Yrigoyen. Inmejorable ubicación.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(8),
      ]);

      $property = $this->model::create([
        'name' => 'Terreno de 10 x 30 mts.',
        'description' => 'Terreno de 10x30 mts. en Av. de La Canal entre Figueroa Alcorta y 14 de Julio. Con vecinos a su alrededor, servicios de agua y la luz y con su respectiva documentación.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(3),
      ]);

      $property = $this->model::create([
        'name' => 'Terreno de 10 x 30 metros, pasa luz, agua y cloacas.',
        'description' => 'Terreno de 10 x 30 metros, pasa luz, agua y cloacas. A metros del asfalto.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(3),
      ]);

      $property = $this->model::create([
        'name' => 'Excepcional terreno de 15 x 45 mts. con todos los servicios y asfalto.',
        'description' => 'Excepcional terreno, ideal por su tamaño de 15 x 45 mts. con todos los servicios y asfalto.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(3),
      ]);

      $property = $this->model::create([
        'name' => 'Depto grande en calle 83 entre 2 y 4 Necochea',
        'description' => 'Depto grande en calle 83 entre 2 y 4 Necochea sobre galería Florida. Consta de, living, cocina y lavadero. Dos habitaciones y baño. Más habitaciones y baño de servicio, en buen estado y súper tranquilo y luminoso. Es contrafrente. Un precio comparado con inmuebles similares, precio bajo.',
        'id_location' => 2, // ? Necochea
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(2),
      ]);

      $property = $this->model::create([
        'name' => 'Campo 100% agrícola, a 25 km de San Cayetano',
        'description' => 'Campo 100% agrícola, a 25 km de San Cayetano para la localidad de Adolfo G. Chaves, a un costado de la ruta 75. Campo con 3 pozos de agua para riego, buenos alambrados y casa regular. De un lado limita ruta 75 y del otro lado arroyo Cristiano Muerto Y no es tan alto su valor a pesar de ser puramente agrícola. Consulte.',
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(4),
      ]);

      $property = $this->model::create([
        'name' => 'Casa sobre terreno de 18 x 70 metros',
        'description' => 'Casa sobre terreno de 18 x 70 metros. Casi en la entrada de San Cayetano, calle Av. independencia',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(1),
      ]);

      $property = $this->model::create([
        'name' => 'Excelente campo de 130 has. 100% agrícola',
        'description' => 'Excelente campo de 130 has a 5 km de San Cayetano, 100% agrícola, buenos rindes. Calle entoscada.',
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(4),
      ]);

      $property = $this->model::create([
        'name' => 'Casa en el centro sobre terreno 10.50 x 24 mts.',
        'description' => 'Casa sobre terreno de 10.50 x 24 mts., en calle 9 de Julio casi Av. San Martín. Compuesto de, dos habitaciones, living, cocina y baño. Más fogón atrás. Con todos los servicios.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(1),
      ]);

      $property = $this->model::create([
        'name' => 'Casa en buenas condiciones sobre terreno de 10x60 mts.',
        'description' => 'Casa en buenas condiciones sobre terreno de 10 x 60 metros con todos los servicios y asfalto. Compuesto de: living comedor amplio, baño y dos habitaciones.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(1),
      ]);

      $property = $this->model::create([
        'name' => 'Casa sobre terreno 10x40 mts. con todos los servicios y asfalto',
        'description' => 'Casa chica sobre calle Brown casi independencia. Sobre terreno de de 10 x 40 metros con todos los servicios y asfalto. Compuesto de: living comedor, cocina, baño y dos habitaciones. Garage grande con cocina y patio con medianera. En buen estado general.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(1),
      ]);

      $property = $this->model::create([
        'name' => 'Terreno de 50 x 34 mts. con galpón para maquinarias y oficina ',
        'description' => 'Gran superficie de 50 x 34 metros. Con Galpón de 21 x 10metros (2 protones, taller con mesa de trabajo), 4 silos (60 mil kg), oficina, privado, depósito, baños, fogón. Con servicios de luz, agua, piso de hormigón, gas en vereda. Tres portones exterior de ingreso. Lugar ideal para trabajar con maquinarias y depósito. En la entrada de San Cayetano.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(3),
        Category::find(8),
      ]);

      $property = $this->model::create([
        'name' => 'Excelente depto de 2 ambientes en Mar del Plata',
        'description' => 'Depto de 2 amb con balcón saliente a la calle Calle Entre Ríos al 1800. Cuenta con living comedor con cocina integrada todo en cerámicos con balcón saliente a la calle. Dormitorio separado en pisos cerámicos con ventana al balcón saliente. Baño reciclado con ducha en suitte. Excelente inversión para vivir o renta. Agua caliente central. Posibilidad de alquilar cochera a media cuadra. OPORTUNIDAD- BAJO DE PRECIO. VENDE URGENTE entre u$49 Y u$53 mil dólares.',
        'id_location' => 1, // ? Mar del Plata
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(2),
      ]);

      $property = $this->model::create([
        'name' => 'Local y casa sobre terreno de 20x30 metros con todos los servicios',
        'description' => 'Local y casa sobre terreno de 20x30 mts. con todos los servicios',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(1),
        Category::find(5),
      ]);

      $property = $this->model::create([
        'name' => 'Casa ubicada sobre calle Colón con terreno de 10x20 metros',
        'description' => 'Casa bien ubicada sobre terreno de 10x20 metros, calle Colón. Living comedor, habitación y baño más garage y habitacion. Lavadero y mucho patio atrás.',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(1),
      ]);

      $property = $this->model::create([
        'name' => 'Campo de 150 has Estableciendo Don Luis',
        'description' => 'Campo de 150 has. Estableciendo Don Luis, 126 has agrícola y 22 de bajos ideal para vacas, con manga, 2 silos 50 Tn, electrificación, a 12 km de ruta y 9 km a San Cayetano.',
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(4),
      ]);

      $property = $this->model::create([
        'name' => 'Casa en Balneario San Cayetano',
        'description' => 'Compuesta de: dos habitaciones, baño. Cocina y comedor, afuera fogón y arboleda a su alrededor y disfrutar un buen verano en el balneario San Cayetano.',
        'id_location' => 7, // ? Balneario de San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(1),
      ]);

      $property = $this->model::create([
        'name' => 'Casa para habitar en Av. Principal sobre terreno de 10x20 mts',
        'description' => 'Casa lista para habitar ubicada en la Av. principal de San Cayetano. Comedor cocina, dos habitaciones baño, amplio garaje con fogón y lavadero. Todos los servicios. ',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(1),
      ]);

      $property = $this->model::create([
        'name' => 'Excelente casa, con detalles de categoría. Para vivir toda la vida!!!',
        'description' => '',
        'id_location' => 3, // ? San Cayetano
        'favorite' => 1,
        'slug' => 'propiedad',
        'id_created_by' => 1,
      ]);

      $property->foreign([
        Category::find(1),
      ]);

      foreach (Property::all() as $property) {
        $property->update([
          'folder' => "property/$property->id_property",
          'slug' => SlugService::createSlug($this->model, 'slug', $property->name),
        ]);
      }
    }
  }