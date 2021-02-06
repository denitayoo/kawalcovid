<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class ProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('provinsis')->insert([
            ['id' => 1,'kode_provinsi' => 1101,'nama_provinsi' => 'ACEH'],
            ['id' => 2,'kode_provinsi' => 1102,'nama_provinsi' => 'SUMATERA UTARA'],
            ['id' => 3,'kode_provinsi' => 1103,'nama_provinsi' => 'SUMATERA BARAT'],
            ['id' => 4,'kode_provinsi' => 1104,'nama_provinsi' => 'RIAU'],
            ['id' => 5,'kode_provinsi' => 1105,'nama_provinsi' => 'JAMBI'],
            ['id' => 6,'kode_provinsi' => 1106,'nama_provinsi' => 'SUMATERA SELATAN'],
            ['id' => 7,'kode_provinsi' => 1107,'nama_provinsi' => 'BENGKULU'],
            ['id' => 8,'kode_provinsi' => 1108,'nama_provinsi' => 'LAMPUNG'],
            ['id' => 9,'kode_provinsi' => 1109,'nama_provinsi' => 'KEPULAUAN BANGKA BELITUNG'],
            ['id' => 10,'kode_provinsi' => 11010,'nama_provinsi' => 'KEPULAUAN RIAU'],
            ['id' => 11,'kode_provinsi' => 11011,'nama_provinsi' => 'DKI JAKARTA'],
            ['id' => 12,'kode_provinsi' => 11012,'nama_provinsi' => 'JAWA BARAT'],
            ['id' => 13,'kode_provinsi' => 11013,'nama_provinsi' => 'JAWA TENGAH'],
            ['id' => 14,'kode_provinsi' => 11014,'nama_provinsi' => 'DI YOGYAKARTA'],
            ['id' => 15,'kode_provinsi' => 11015,'nama_provinsi' => 'JAWA TIMUR'],
            ['id' => 16,'kode_provinsi' => 11016,'nama_provinsi' => 'BANTEN'],
            ['id' => 17,'kode_provinsi' => 11017,'nama_provinsi' => 'BALI'],
            ['id' => 18,'kode_provinsi' => 11018,'nama_provinsi' => 'NUSA TENGGARA BARAT'],
            ['id' => 19,'kode_provinsi' => 11019,'nama_provinsi' => 'NUSA TENGGARA TIMUR'],
            ['id' => 20,'kode_provinsi' => 11020,'nama_provinsi' => 'KALIMANTAN BARAT'],
            ['id' => 21,'kode_provinsi' => 11021,'nama_provinsi' => 'KALIMANTAN TENGAH'],
            ['id' => 22,'kode_provinsi' => 11022,'nama_provinsi' => 'KALIMANTAN SELATAN'],
            ['id' => 23,'kode_provinsi' => 11023,'nama_provinsi' => 'KALIMANTAN TIMUR'],
            ['id' => 24,'kode_provinsi' => 11024,'nama_provinsi' => 'KALIMANTAN UTARA'],
            ['id' => 25,'kode_provinsi' => 11025,'nama_provinsi' => 'SULAWESI UTARA'],
            ['id' => 26,'kode_provinsi' => 11026,'nama_provinsi' => 'SULAWESI TENGAH'],
            ['id' => 27,'kode_provinsi' => 11027,'nama_provinsi' => 'SULAWESI SELATAN'],
            ['id' => 28,'kode_provinsi' => 11028,'nama_provinsi' => 'SULAWESI TENGGARA'],
            ['id' => 29,'kode_provinsi' => 11029,'nama_provinsi' => 'GORONTALO'],
            ['id' => 30,'kode_provinsi' => 11030,'nama_provinsi' => 'SULAWESI BARAT'],
            ['id' => 31,'kode_provinsi' => 11031,'nama_provinsi' => 'MALUKU'],
            ['id' => 32,'kode_provinsi' => 11032,'nama_provinsi' => 'MALUKU UTARA'],
            ['id' => 33,'kode_provinsi' => 11033,'nama_provinsi' => 'PAPUA BARAT'],
            ['id' => 34,'kode_provinsi' => 11034,'nama_provinsi' => 'PAPUA']

        ]);
    }
}