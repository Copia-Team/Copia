<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Faq;
use App\Models\User;
use App\Models\Store;
use App\Models\Slider;
use App\Models\Article;
use App\Models\Product;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\Classification;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::Create([
            'name'=>'Admin',
            'username'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=> bcrypt('password'),
            'no_telp'=>'080987654321',
            'role'=> 'admin'
        ]);

        User::Create([
            'name'=>'Petani',
            'username'=>'petani',
            'email'=>'petani@gmail.com',
            'password'=> bcrypt('password'),
            'no_telp'=>'081234567890',
            'role'=> 'petani'
        ]);

        User::Create([
            'name'=>'Budi Sudirman',
            'username'=>'budirman',
            'email'=>'budirman@gmail.com',
            'password'=> bcrypt('password'),
            'no_telp'=>'081267890345',
            'role'=> 'petani'
        ]);

        User::Create([
            'name'=>'Admin 2',
            'username'=>'admintwo',
            'email'=>'admin2@gmail.com',
            'password'=> bcrypt('password'),
            'no_telp'=>'080986521743',
            'role'=> 'admin'
        ]);

        User::Create([
            'name'=>'Admin 3',
            'username'=>'admintre',
            'email'=>'admin3@gmail.com',
            'password'=> bcrypt('password'),
            'no_telp'=>'080952861743',
            'role'=> 'admin'
        ]);

        User::Create([
            'name'=>'Siti Agustina',
            'username'=>'sitagus',
            'email'=>'sitagus@gmail.com',
            'password'=> bcrypt('password'),
            'no_telp'=>'081890734265',
            'role'=> 'petani'
        ]);

        Category::Create(['category'=>'Pencarian','slug'=>'pencarian']);
        Category::Create(['category'=>'Perawatan','slug'=>'perawatan']);
        Category::Create(['category'=>'Penanaman','slug'=>'penanaman']);
        Category::Create(['category'=>'Pengolahan','slug'=>'pengolahan']);

        Classification::Create(['class'=>'Pengolahan','slug'=>'pengolahan']);
        Classification::Create(['class'=>'Perawatan','slug'=>'perawatan']);
        Classification::Create(['class'=>'Penanaman','slug'=>'penanaman']);
        Classification::Create(['class'=>'Pencarian','slug'=>'pencarian']);

        // Slider::Create(['title'=>'SLider 1', 'body'=>'Ini adalah body dari slider 1']);
        // Slider::Create(['title'=>'SLider 2', 'body'=>'Ini adalah body dari slider 2']);
        // Slider::Create(['title'=>'SLider 3', 'body'=>'Ini adalah body dari slider 3']);

        Store::Create([
            'user_id'=>2,
            'name'=>'Camony Store',
            'address'=>'Jl. Padjajaran',
            'no_telp'=>'081236789045',
            'latitude'=> '-6.595038',
            'longitude'=> '106.816635'
        ]);

        Store::Create([
            'user_id'=>3,
            'name'=>'Budirman Store',
            'address'=>'Jl. Sudirman',
            'no_telp'=>'081268907345',
            'latitude'=> '-6.795038',
            'longitude'=> '106.916635'
        ]);

        Store::Create([
            'user_id'=>6,
            'name'=>'Sitagus Store',
            'address'=>'Jl. Babakan',
            'no_telp'=>'081268907345',
            'latitude'=> '-6.5971',
            'longitude'=> '106.8060'
        ]);

        Product::Create([
            'store_id'=>1,
            'name'=>'Jagung Manis',
            'harvested'=>'2023-10-03',
            'yields'=>2500,
            'stock'=>0,
            'price'=>7500.00
        ]);

        Product::Create([
            'store_id'=>1,
            'name'=>'Jagung Manis disc',
            'harvested'=>'2023-11-03',
            'yields'=>3000,
            'stock'=>1895,
            'discount'=>20,
            'price'=>8500.00
        ]);

        Product::Create([
            'store_id'=>2,
            'name'=>'Jagung Ceria',
            'harvested'=>'2023-11-03',
            'yields'=>4000,
            'stock'=>2500,
            'price'=>8300.00
        ]);

        Product::Create([
            'store_id'=>1,
            'name'=>'Jagung Placholder 3',
            'harvested'=>'2023-12-03',
            'yields'=>3000,
            'stock'=>1895,
            'discount'=>20,
            'price'=>8500.00
        ]);

        Product::Create([
            'store_id'=>1,
            'name'=>'Jagung placholder 4',
            'harvested'=>'2024-1-03',
            'yields'=>3000,
            'stock'=>1895,
            'discount'=>20,
            'price'=>8500.00
        ]);

        Product::Create([
            'store_id'=>1,
            'name'=>'Jagung placholder 5',
            'harvested'=>'2024-2-03',
            'yields'=>3000,
            'stock'=>1895,
            'discount'=>20,
            'price'=>8500.00
        ]);

        Product::Create([
            'store_id'=>1,
            'name'=>'Jagung placholder 6',
            'harvested'=>'2024-3-03',
            'yields'=>3000,
            'stock'=>1895,
            'discount'=>20,
            'price'=>8500.00
        ]);

        Product::Create([
            'store_id'=>1,
            'name'=>'Jagung placholder 7',
            'harvested'=>'2024-4-03',
            'yields'=>3000,
            'stock'=>1895,
            'discount'=>20,
            'price'=>8500.00
        ]);

        Product::Create([
            'store_id'=>1,
            'name'=>'Jagung placholder 8',
            'harvested'=>'2024-5-03',
            'yields'=>3000,
            'stock'=>1895,
            'discount'=>20,
            'price'=>8500.00
        ]);

        Product::Create([
            'store_id'=>3,
            'name'=>'Jagung Siti ',
            'harvested'=>'2023-11-03',
            'yields'=>5000,
            'stock'=>5000,
            'discount'=>15,
            'price'=>7800.00
        ]);

        Transaction::Create([
            'product_id'=>1,
            'user_id'=>2,
            'date'=>'2023-8-04',
            'many'=>2500,
            'stock'=>0,
            'price'=>18750000.00
        ]);

        Transaction::Create([
            'product_id'=>2,
            'user_id'=>2,
            'date'=>'2023-9-04',
            'many'=>5,
            'stock'=>2995,
            'price'=>42500.00
        ]);

        Transaction::Create([
            'product_id'=>2,
            'user_id'=>2,
            'date'=>'2023-10-06',
            'many'=>100,
            'stock'=>2895,
            'price'=>850000.00
        ]);

        Transaction::Create([
            'product_id'=>2,
            'user_id'=>2,
            'date'=>'2023-11-07',
            'many'=>1000,
            'stock'=>1895,
            'price'=>8500000.00
        ]);

        Transaction::Create([
            'product_id'=>2,
            'user_id'=>2,
            'date'=>'2023-11-09',
            'many'=>1000,
            'stock'=>895,
            'price'=>8500000.00
        ]);

        Transaction::Create([
            'product_id'=>3,
            'user_id'=>3,
            'date'=>'2023-11-05',
            'many'=>1500,
            'stock'=>2500,
            'price'=>12450000.00
        ]);

        Faq::Create([
            'question'=>'Bagaimana cara saya mencari produk jagung di website ini?',
            'answer'=>'Anda bisa mengklik tanda search dibagian pojok kanan atas lalu ketikkan jenis jagung yang anda cari',
            'category_id'=>1,
            'status'=> true
        ]);

        Faq::Create(['question'=>'Bagaimana cara saya merawat jagung?']);

        // Faq::Create([
        //     'question'=>'Bagaimana cara saya mencari produk jagung di website ini? 2',
        //     'answer'=>'Anda bisa mengklik tanda search dibagian pojok kanan atas lalu ketikkan jenis jagung yang anda cari 2',
        //     'category_id'=>1,
        //     'status'=> true
        // ]);

        Faq::Create([
            'question'=>'Bagaimana cara saya Merawat jagung? ',
            'answer'=>'Pengairan. Pengairan yang dilakukan setelah melakukan pembibitan merupakan hal penting yang harus dilakukan agar tanaman jagung mendapatkan air yang cukup',
            'category_id'=>2,
            'status'=> true
        ]);

        Faq::Create([
            'question'=>'Bagaimana cara saya menanam jagung?',
            'answer'=>'Tanam benih jagung pada kedalaman 3 hingga 5 cm. Setiap lubang sebaiknya diisi 2 biji jagung',
            'category_id'=>3,
            'status'=> true
        ]);

        Faq::Create([
            'question'=>'Olahan apa saja yang biasa di buat dari jagung?',
            'answer'=>'sup jagung, es jagung, puding jagung santan, bubur jagung manis, es jagung hawai, sup jagung telur',
            'category_id'=>4,
            'status'=> true
        ]);

        Faq::Create([
            'question'=>'Pengendalian penyakit untuk tanaman jagung menggunakan apa?',
            'answer'=>'penyemprotan fungisida atau dengan menggunakan thiram dan karboxin, serta pengasapan atau perawatan suhu panas selama 17 menit dengan suhu 55°C',
            'category_id'=>2,
            'status'=> true
        ]);

    //     Article::Create([
    //         'classification_id'=>'1',
    //         'title'=>'Post Pertama',
    //         'slug'=>'post-pertama',
    //         'excerpt'=> 'Lorem ipsum dolor sit amet, consectetur adipisicing elit 1',
    //         'body'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit 1, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
    //         'source'=>'CNN Indonesia',
    //         'link'=>'https://www.google.com'
    //         ]);

    //         Article::Create([
    //         'classification_id'=>'3',
    //         'title'=>'Post Kedua',
    //         'slug'=>'post-kedua',
    //         'excerpt'=> 'Lorem ipsum dolor sit amet, consectetur adipisicing elit 2',
    //         'body'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit 2, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
    //         'source'=>'CNN Indonesia',
    //         'link'=>'https://www.google.com'
    //         ]);

    //         Article::Create([
    //         'classification_id'=>'1',
    //         'title'=>'Post Ketiga',
    //         'slug'=>'post-ketiga',
    //         'excerpt'=> 'Lorem ipsum dolor sit amet, consectetur adipisicing elit 3',
    //         'body'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit 3, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
    //         'source'=>'CNN Indonesia',
    //         'link'=>'https://www.google.com'
    //         ]);

    //         Article::Create([
    //         'classification_id'=>'2',
    //         'title'=>'Post Keempat',
    //         'slug'=>'post-keempat',
    //         'excerpt'=> 'Lorem ipsum dolor sit amet, consectetur adipisicing elit 4',
    //         'body'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit 4, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
    //         'source'=>'CNN Indonesia',
    //         'link'=>'https://www.google.com'
    //         ]);

    //         Article::Create([
    //         'classification_id'=>'1',
    //         'title'=>'Post Kelima',
    //         'slug'=>'post-lima',
    //         'excerpt'=> 'Lorem ipsum dolor sit amet, consectetur adipisicing elit 5',
    //         'body'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit 5, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
    //         'source'=>'CNN Indonesia',
    //         'link'=>'https://www.google.com'
    //         ]);

    //         Article::Create([
    //         'classification_id'=>'3',
    //         'title'=>'Post Keenam',
    //         'slug'=>'post-keenam',
    //         'excerpt'=> 'Lorem ipsum dolor sit amet, consectetur adipisicing elit 6',
    //         'body'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit 6, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
    //         'source'=>'CNN Indonesia',
    //         'link'=>'https://www.google.com'
    //         ]);

    //         Article::Create([
    //             'classification_id'=>'4',
    //             'title'=>'Artikel Ketujuh',
    //             'slug'=>'artikel-ketujuh',
    //             'excerpt'=> 'artikel Lorem ipsum dolor sit amet, consectetur adipisicing elit 7',
    //             'body'=>'artikel Lorem ipsum dolor sit amet, consectetur adipisicing elit 7, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
    //             'source'=>'CNN Indonesia',
    //             'link'=>'https://www.google.com'
    //             ]);
    }

}
