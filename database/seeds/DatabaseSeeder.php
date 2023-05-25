<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Divisi;
use App\Level;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        Divisi::create([
            'divisi' => '-'
        ]);

        Divisi::create([
            'divisi' => 'Digital Printing (Meta Print)'
        ]);

        Divisi::create([
            'divisi' => 'UKM Center'
        ]);

        Divisi::create([
            'divisi' => 'Urban Farming (Vertonik Farm)'
        ]);

        Divisi::create([
            'divisi' => 'Konveksi (Samara Apprarel)'
        ]);

        Divisi::create([
            'divisi' => 'Workshop Permata & Training Center'
        ]);

        Divisi::create([
            'divisi' => 'Cafe : Coffe & Eatery (Biruni Cafe)'
        ]);

        Divisi::create([
            'divisi' => 'Nursery & Revegetasi (Bentala Nursery)'
        ]);

        Divisi::create([
            'divisi' => 'Sentra Pertanian Terpadu (Tim Maggot & Agro Buah)'
        ]);

        Level::create([
            'level' => 'Admin'
        ]);
        Level::create([
            'level' => 'Divisi'
        ]);
        Level::create([
            'level' => 'Genper'
        ]);

        User::create([
            'foto' => 'user.jpg',
            'nm_depan' => 'Admin',
            'nm_belakang' => 'Admin',
            'jk' => 'Laki-laki',
            'tmp_lahir' => 'Sungai Danau',
            'tgl_lahir' => '05 Agustus 2002',
            'nohp' => '082254388310',
            'email' => 'deathcrew17@gmail.com',
            'alamat' => 'Jl. Karya Bersama, RT.19',
            'id_divisi' => 1,
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'id_level' => 1,

        ]);
        User::create([
            'foto' => 'user.jpg',
            'nm_depan' => 'Satria',
            'nm_belakang' => 'Kurniawan',
            'jk' => 'Laki-laki',
            'tmp_lahir' => 'Sungai Danau',
            'tgl_lahir' => '04 Agustus 2002',
            'nohp' => '082254388230',
            'email' => 'deathcrew237@gmail.com',
            'alamat' => 'Jl. Karya Bersama, RT.19',
            'id_divisi' => 1,
            'username' => 'satria',
            'password' => bcrypt('1234'),
            'id_level' => 3,
        ]);
    }
}
