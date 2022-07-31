<?php

use Config_item_fee_model as itemFee;

class FeeItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->_createDefaultItemFee();
    }

    protected function _createDefaultItemFee()
    {
        $items = $this->_dataSeed();

        foreach ($items as $id => $item) {
            itemFee::save([
                'item_id' => $id,
                'item_name' => $item['name'],
                'item_description' => $item['desc'],
                'item_price' => $item['price'],
                'school_id' => $item['school'],
            ]);
        }

        $class = get_class($this);

        echo "<b style='color:red'><i>{$class}</i></b> running succesfully <br>";
    }

    public function _dataSeed()
    {
        return [
            1 => ['name' => 'YURAN PENDAFTARAN', 'desc' => 'PENDAFTARAN (MURID BARU)', 'price' => 50, 'school' => 1],
            2 => ['name' => 'YURAN BULANAN', 'desc' => 'BULANAN (TADIKA)', 'price' => 130, 'school' => 1],
            3 => ['name' => 'YURAN', 'desc' => 'BULANAN (3 - 4 TAHUN)', 'price' => 180, 'school' => 1],
            4 => ['name' => 'YURAN', 'desc' => 'BULANAN (5 - 12 TAHUN)', 'price' => 150, 'school' => 1],
            5 => ['name' => 'PERKAKASAN BELAJAR', 'desc' => '1 - ALAT TULIS, 2 - WARNA, 3 - FOTOSTAT', 'price' => 50, 'school' => 1],
            6 => ['name' => 'BUKU', 'desc' => 'TEKS, AKTIVITI, TULIS', 'price' => 160, 'school' => 1],
            7 => ['name' => 'PAKAIAN', 'desc' => '2 PASANG (UNIFORM/T-SHIRT & TRACKSUIT)', 'price' => 80, 'school' => 1],
        ];
    }
}
