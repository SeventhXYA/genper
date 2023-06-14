<?php

use App\Akundivisi;
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
            'divisi' => 'Sentra Pertanian Terpadu (Agro Permata)'
        ]);

        Divisi::create([
            'divisi' => 'Digital Printing & Advertising (Meta Print)'
        ]);

        Divisi::create([
            'divisi' => 'UKM Center Permata (Pojok UKM)'
        ]);

        Divisi::create([
            'divisi' => 'Urban Farming (Vertonik Farm)'
        ]);

        Divisi::create([
            'divisi' => 'Konveksi Permata (Samara Apparel)'
        ]);

        Divisi::create([
            'divisi' => 'Cafe : Coffe & Eatery (Biruni Cafe)'
        ]);

        Divisi::create([
            'divisi' => 'Workshop Permata & Training Center'
        ]);

        Divisi::create([
            'divisi' => 'Nursery & Revegetasi (Bentala Nursery)'
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

        Akundivisi::create([
            'id_divisi' => 1,
            'username' => 'divisiA',
            'password' => bcrypt('divisiA'),
            'id_level' => 2,
        ]);

        Akundivisi::create([
            'id_divisi' => 2,
            'username' => 'divisiB',
            'password' => bcrypt('divisiB'),
            'id_level' => 2,
        ]);

        Akundivisi::create([
            'id_divisi' => 3,
            'username' => 'divisiC',
            'password' => bcrypt('divisiC'),
            'id_level' => 2,
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
            'id_divisi' => 1,
            'username' => 'satria',
            'password' => bcrypt('1234'),
            'id_level' => 3,
        ]);
        User::create([
            'foto' => 'user.jpg',
            'nm_depan' => 'Jaka',
            'nm_belakang' => 'Permadi',
            'jk' => 'Laki-laki',
            'tmp_lahir' => 'Sungai Danau',
            'tgl_lahir' => '25 Februari 2001',
            'nohp' => '082223338230',
            'email' => 'jakaper@gmail.com',
            'id_divisi' => 2,
            'username' => 'jaka',
            'password' => bcrypt('1234'),
            'id_level' => 3,
        ]);
    }
}
