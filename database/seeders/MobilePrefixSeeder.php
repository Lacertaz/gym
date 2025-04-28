<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MobilePrefix;

class MobilePrefixSeeder extends Seeder
{
    public function run(): void
    {
        $prefixes = [
            ['prefix' => '0811', 'operator' => 'Telkomsel', 'description' => 'Kartu Halo (Postpaid)'],
            ['prefix' => '0812', 'operator' => 'Telkomsel', 'description' => 'SimPATI'],
            ['prefix' => '0813', 'operator' => 'Telkomsel', 'description' => 'SimPATI'],
            ['prefix' => '0821', 'operator' => 'Telkomsel', 'description' => 'Kartu As'],
            ['prefix' => '0822', 'operator' => 'Telkomsel', 'description' => 'Kartu As'],
            ['prefix' => '0823', 'operator' => 'Telkomsel', 'description' => 'Kartu As'],
            ['prefix' => '0851', 'operator' => 'Telkomsel', 'description' => 'Kartu As'],
            ['prefix' => '0852', 'operator' => 'Telkomsel', 'description' => 'Kartu As'],
            ['prefix' => '0853', 'operator' => 'Telkomsel', 'description' => 'Kartu As'],
            ['prefix' => '0814', 'operator' => 'Indosat Ooredoo Hutchison (IM3)', 'description' => 'IM3'],
            ['prefix' => '0815', 'operator' => 'Indosat Ooredoo Hutchison (IM3)', 'description' => 'IM3'],
            ['prefix' => '0816', 'operator' => 'Indosat Ooredoo Hutchison (IM3)', 'description' => 'IM3'],
            ['prefix' => '0855', 'operator' => 'Indosat Ooredoo Hutchison (IM3)', 'description' => 'Matrix (Postpaid)'],
            ['prefix' => '0856', 'operator' => 'Indosat Ooredoo Hutchison (IM3)', 'description' => 'IM3'],
            ['prefix' => '0857', 'operator' => 'Indosat Ooredoo Hutchison (IM3)', 'description' => 'IM3'],
            ['prefix' => '0858', 'operator' => 'Indosat Ooredoo Hutchison (IM3)', 'description' => 'IM3'],
            ['prefix' => '0895', 'operator' => 'Indosat Ooredoo Hutchison (Tri)', 'description' => 'Tri'],
            ['prefix' => '0896', 'operator' => 'Indosat Ooredoo Hutchison (Tri)', 'description' => 'Tri'],
            ['prefix' => '0897', 'operator' => 'Indosat Ooredoo Hutchison (Tri)', 'description' => 'Tri'],
            ['prefix' => '0898', 'operator' => 'Indosat Ooredoo Hutchison (Tri)', 'description' => 'Tri'],
            ['prefix' => '0899', 'operator' => 'Indosat Ooredoo Hutchison (Tri)', 'description' => 'Tri'],
            ['prefix' => '0817', 'operator' => 'XL Axiata', 'description' => 'XL'],
            ['prefix' => '0818', 'operator' => 'XL Axiata', 'description' => 'XL'],
            ['prefix' => '0819', 'operator' => 'XL Axiata', 'description' => 'XL'],
            ['prefix' => '0859', 'operator' => 'XL Axiata', 'description' => 'XL'],
            ['prefix' => '0877', 'operator' => 'XL Axiata', 'description' => 'XL'],
            ['prefix' => '0878', 'operator' => 'XL Axiata', 'description' => 'XL'],
            ['prefix' => '0831', 'operator' => 'XL Axiata (AXIS)', 'description' => 'AXIS'],
            ['prefix' => '0832', 'operator' => 'XL Axiata (AXIS)', 'description' => 'AXIS'],
            ['prefix' => '0833', 'operator' => 'XL Axiata (AXIS)', 'description' => 'AXIS'],
            ['prefix' => '0838', 'operator' => 'XL Axiata (AXIS)', 'description' => 'AXIS'],
            ['prefix' => '0881', 'operator' => 'Smartfren', 'description' => 'Smartfren'],
            ['prefix' => '0882', 'operator' => 'Smartfren', 'description' => 'Smartfren'],
            ['prefix' => '0883', 'operator' => 'Smartfren', 'description' => 'Smartfren'],
            ['prefix' => '0884', 'operator' => 'Smartfren', 'description' => 'Smartfren'],
            ['prefix' => '0885', 'operator' => 'Smartfren', 'description' => 'Smartfren'],
            ['prefix' => '0886', 'operator' => 'Smartfren', 'description' => 'Smartfren'],
            ['prefix' => '0887', 'operator' => 'Smartfren', 'description' => 'Smartfren'],
            ['prefix' => '0888', 'operator' => 'Smartfren', 'description' => 'Smartfren'],
            ['prefix' => '0889', 'operator' => 'Smartfren', 'description' => 'Smartfren'],
            ['prefix' => '0827', 'operator' => 'Net1 (tidak aktif)', 'description' => 'Ceria/Net1'],
            ['prefix' => '0828', 'operator' => 'Net1 (tidak aktif)', 'description' => 'Ceria/Net1'],
        ];

        foreach ($prefixes as $data) {
            MobilePrefix::updateOrCreate(
                ['prefix' => $data['prefix']],
                ['operator' => $data['operator'], 'description' => $data['description']]
            );
        }
    }
}
