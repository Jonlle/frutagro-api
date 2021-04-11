<?php

use Illuminate\Database\Seeder;

class FinancialEntitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $financial_entities = [
            ['code' => '0156', 'entity_name' => '100%BANCO'],
            ['code' => '0196', 'entity_name' => 'ABN AMRO BANK'],
            ['code' => '0172', 'entity_name' => 'BANCAMIGA BANCO MICROFINANCIERO, C.A.'],
            ['code' => '0171', 'entity_name' => 'BANCO ACTIVO BANCO COMERCIAL, C.A.'],
            ['code' => '0166', 'entity_name' => 'BANCO AGRICOLA'],
            ['code' => '0175', 'entity_name' => 'BANCO BICENTENARIO'],
            ['code' => '0128', 'entity_name' => 'BANCO CARONI, C.A. BANCO UNIVERSAL'],
            ['code' => '0164', 'entity_name' => 'BANCO DE DESARROLLO DEL MICROEMPRESARIO'],
            ['code' => '0102', 'entity_name' => 'BANCO DE VENEZUELA S.A.I.C.A.'],
            ['code' => '0114', 'entity_name' => 'BANCO DEL CARIBE C.A.'],
            ['code' => '0149', 'entity_name' => 'BANCO DEL PUEBLO SOBERANO C.A.'],
            ['code' => '0163', 'entity_name' => 'BANCO DEL TESORO'],
            ['code' => '0176', 'entity_name' => 'BANCO ESPIRITO SANTO, S.A.'],
            ['code' => '0115', 'entity_name' => 'BANCO EXTERIOR C.A.'],
            ['code' => '0003', 'entity_name' => 'BANCO INDUSTRIAL DE VENEZUELA.'],
            ['code' => '0173', 'entity_name' => 'BANCO INTERNACIONAL DE DESARROLLO, C.A.'],
            ['code' => '0105', 'entity_name' => 'BANCO MERCANTIL C.A.'],
            ['code' => '0191', 'entity_name' => 'BANCO NACIONAL DE CREDITO'],
            ['code' => '0116', 'entity_name' => 'BANCO OCCIDENTAL DE DESCUENTO.'],
            ['code' => '0138', 'entity_name' => 'BANCO PLAZA'],
            ['code' => '0108', 'entity_name' => 'BANCO PROVINCIAL BBVA'],
            ['code' => '0104', 'entity_name' => 'BANCO VENEZOLANO DE CREDITO S.A.'],
            ['code' => '0168', 'entity_name' => 'BANCRECER S.A. BANCO DE DESARROLLO'],
            ['code' => '0134', 'entity_name' => 'BANESCO BANCO UNIVERSAL'],
            ['code' => '0177', 'entity_name' => 'BANFANB'],
            ['code' => '0146', 'entity_name' => 'BANGENTE'],
            ['code' => '0174', 'entity_name' => 'BANPLUS BANCO COMERCIAL C.A'],
            ['code' => '0190', 'entity_name' => 'CITIBANK.'],
            ['code' => '0121', 'entity_name' => 'CORP BANCA.'],
            ['code' => '0157', 'entity_name' => 'DELSUR BANCO UNIVERSAL'],
            ['code' => '0151', 'entity_name' => 'FONDO COMUN'],
            ['code' => '0601', 'entity_name' => 'INSTITUTO MUNICIPAL DE CR&#201;DITO POPULAR'],
            ['code' => '0169', 'entity_name' => 'MIBANCO BANCO DE DESARROLLO, C.A.'],
            ['code' => '0137', 'entity_name' => 'SOFITASA']
        ];

        foreach ($financial_entities as $row) {
            App\FinancialEntity::create($row);
        }

    }
}
