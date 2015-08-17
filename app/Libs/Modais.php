<?php

namespace Ecograph\Libs;

use Ecograph\CategoryProduct;
use Ecograph\ProdutoPerfil;
use Ecograph\Perfil;

Class Modais {

    public static function modal($categoria) {
        $check_produtos = $categoria->CategoryProduct()->lists('product_id');
        //se existir produtos vinculados
        if (count($check_produtos) > 0) {
            $perfis = ProdutoPerfil::wherein('product_id',$check_produtos)->groupby('perfil_id')->lists('perfil_id','id');

            return $perfis;
        }
        return false;
    }

    public static function perfis($perfis, $produtoperfil) {
        foreach ($perfis as $id=>$perfil_id) {
            if($perfil_id != 0){
                $perfil  = $produtoperfil->find($id)->Perfil;
                $array_perfil[] = $perfil->toArray();
            }
        }
        return $array_perfil;
    }

   /* public static function upload($categoria) {
        $uploads = Array(
            'adesivo' => Array
                (
                'docid' => '2d808b64-579d-4617-abce-2741de51d6fd',
                'docpass' => '1302697a-448e-49e4-ba99-9843ddcc57d6',
                'docname' => '',
                'doccat' => 'Adesivo',
                'docdes' => 'ad-inserir arquivo',
                'docimg' => 'ad-inserir arquivo',
                'created_at' => 'now()',
                'updated_at' => 'now()'
            ),
            'agenda' => Array
                (
                'docid' => '9c516c6f-bae3-4024-b18a-cd0dc1b98cdd',
                'docpass' => '3c28efc4-1766-46a8-9867-0a6a6ca82f5c',
                'docname' => '',
                'doccat' => 'Agenda',
                'docdes' => 'ag-inserir arquivo',
                'docimg' => 'ag-inserir arquivo',
                'created_at' => 'now()',
                'updated_at' => 'now()'
            ),
            'photobookgrande' => Array
                (
                'docid' => 'fbd7e55d-e858-4c8b-81b8-4af8f4f88076',
                'docpass' => '44de89e5-ef29-407f-81f8-20ca986da262',
                'docname' => '',
                'doccat' => 'Photo Book Grande',
                'docdes' => 'bkg-inserir arquivo ',
                'docimg' => 'bkg-inserir arquivo ',
                'created_at' => 'now()',
                'updated_at' => 'now()'
            ),
            'photobookmedio' => Array
                (
                'docid' => 'bf997a61-64be-4be8-97e6-4af621e6be15',
                'docpass' => '2d41ec8a-4d9a-4069-b34c-80a47177d0cc',
                'docname' => '',
                'doccat' => 'Photo Book Médio',
                'docdes' => 'bkm-inserir arquivo',
                'docimg' => 'bkm-inserir arquivo',
                'created_at' => 'now()',
                'updated_at' => 'now()'
            ),
            'photobookpequeno' => Array
                (
                'docid' => '67ca6bfd-9b31-4dbb-91a1-771e9bb12e75',
                'docpass' => '72137709-76ec-4c3b-a6f0-3d5a8429bdfb',
                'docname' => '',
                'doccat' => 'Photo Book Pequeno',
                'docdes' => 'bkp-inserir arquivo',
                'docimg' => 'bkp-inserir arquivo',
                'created_at' => 'now()',
                'updated_at' => 'now()'
            ),
            'cadernopersonalizada' => Array
                (
                'docid' => '8a8dc323-179a-4e5e-8fd0-99d00cef3599',
                'docpass' => 'ba87e7fa-dd5d-418a-a6a8-54229a05b423',
                'docname' => '',
                'doccat' => 'Caneca personalizada',
                'docdes' => 'cad-inserir arquivo ',
                'docimg' => 'cad-inserir arquivo',
                'created_at' => 'now()',
                'updated_at' => 'now()'
            ),
            'caderno' => Array
                (
                'docid' => 'ccd4b7a3-4115-4e18-8f97-ff7810512ff1',
                'docpass' => '814632fe-ee0b-4c74-bd0b-0a08ce913673',
                'docname' => '',
                'doccat' => 'Caderno',
                'docdes' => 'ca-inserir arquivo',
                'docimg' => 'ca-inserir arquivo',
                'created_at' => 'now()',
                'updated_at' => 'now()'
            ),
            'canecapersonalizada' => Array
                (
                'docid' => 'e668b523-cbeb-4f54-85fc-917b035de089',
                'docpass' => '54c783b9-15d1-4c45-a8f2-fb7d573dd00c',
                'docname' => '',
                'doccat' => 'Caneca personalizada',
                'docdes' => 'cat-inserir arquivo',
                'docimg' => 'cat-inserir arquivo ',
                'created_at' => 'now()',
                'updated_at' => 'now()'
            ),
            'calendariodebolso' => Array
                (
                'docid' => '40de8cf8-6ac1-46ab-81ac-e2f4c4b6242b',
                'docpass' => '8704d77d-c3fb-44db-9724-86381a49e98b',
                'docname' => '',
                'doccat' => 'Calendário de bolso',
                'docdes' => 'clb-inserir arquivo',
                'docimg' => 'clb-inserir arquivo',
                'created_at' => 'now()',
                'updated_at' => 'now()'
            ),
            'calendariodemesa' => Array
                (
                'docid' => 'f67dac48-80d5-467e-89f8-3f6721029866',
                'docpass' => 'b6312a4c-5a65-484f-bd5f-5790843f7f23',
                'docname' => '',
                'doccat' => 'Calendário de mesa',
                'docdes' => 'clm-inserir arquivo',
                'docimg' => 'clm-inserir arquivo',
                'created_at' => 'now()',
                'updated_at' => 'now()'
            ),
            'camisetas' => Array
                (
                'docid' => 'b5e7b616-fc44-4c19-bb79-558a482bd7e2',
                'docpass' => 'f5b953a1-c8de-41e9-b14f-2648bbca0ab7',
                'docname' => '',
                'doccat' => 'Camisetas',
                'docdes' => 'cm-inserir arquivo',
                'docimg' => 'cm-inserir arquivo',
                'created_at' => 'now()',
                'updated_at' => 'now()'
            ),
            'cartaopostal' => Array
                (
                'docid' => '9c2c8985-b2da-4481-bda5-7b97d7f19b94',
                'docpass' => '7194503f-d94c-474f-82b5-7a1490650c08',
                'docname' => '',
                'doccat' => 'Cartão postal',
                'docdes' => 'cp-inserir arquivo',
                'docimg' => 'cp-inserir arquivo',
                'created_at' => 'now()',
                'updated_at' => 'now()'
            ),
            'cartaz' => Array
                (
                'docid' => '1256e865-52a9-40a2-9641-873e71612694',
                'docpass' => '67486f85-5272-4c0d-a4d9-8d3b9e29b4a4',
                'docname' => '',
                'doccat' => 'Cartaz',
                'docdes' => 'ctz-inserir arquivo',
                'docimg' => 'ctz-inserir arquivo',
                'created_at' => 'now()',
                'updated_at' => 'now()'
            ),
            'cartaodevisita' => Array
                (
                'docid' => 'ceb25f27-f297-4e5d-ae12-06b85c9e834c',
                'docpass' => '967ee5b1-8027-42f4-b593-1f813ef42807',
                'docname' => '',
                'doccat' => 'Cartão de visita',
                'docdes' => 'cv-inserir arquivo',
                'docimg' => 'cv-inserir arquivo',
                'created_at' => 'now()',
                'updated_at' => 'now()'
            ),
            'envelopesaco' => Array
                (
                'docid' => '0e229539-ddb6-4cb2-b1bc-d8d38bc62a2c',
                'docpass' => '447d4ea1-9c71-4643-85c0-64e3747e4b07',
                'docname' => '',
                'doccat' => 'Envelope Saco',
                'docdes' => 'ev-inserir arquivo',
                'docimg' => 'ev-inserir arquivo',
                'created_at' => 'now()',
                'updated_at' => 'now()'
            ),
            'folder' => Array
                (
                'docid' => '93c864d8-d77e-434f-abf5-486394bffa61',
                'docpass' => '2115a109-1ef9-465b-bfd8-b7c97c4dd75b',
                'docname' => '',
                'doccat' => 'Folder',
                'docdes' => 'fd-inserir arquivo',
                'docimg' => 'fd-inserir arquivo',
                'created_at' => 'now()',
                'updated_at' => 'now()'
            ),
            'Flyer' => Array
                (
                'docid' => '55ca5cab-42c5-4145-8b4f-03aef7379bf7',
                'docpass' => 'ea146906-d540-4e8e-a484-3fe3d5200de4',
                'docname' => '',
                'doccat' => 'Flyer',
                'docdes' => 'fl-inserir arquivo',
                'docimg' => 'fl-inserir arquivo',
                'created_at' => 'now()',
                'updated_at' => 'now()'
            ),
            'capagalaxy2' => Array
                (
                'docid' => '90788596-ff6b-4a09-bc18-4ceac0dabbae',
                'docpass' => 'dd1f9c0e-5813-47d0-bef0-f3b92c8ddcad',
                'docname' => '',
                'doccat' => 'Capa Galaxy 2',
                'docdes' => 'glx2-inserir arquivo',
                'docimg' => 'glx2-inserir arquivo',
                'created_at' => 'now()',
                'updated_at' => 'now()'
            ),
            'capagalaxy3' => Array
                (
                'docid' => 'd0f6adf6-b3b9-45be-88cd-73e98d9dbae6',
                'docpass' => 'f46b27ad-8652-452d-98dc-d5ede8c9cb9c',
                'docname' => '',
                'doccat' => 'Capa Galaxy 3',
                'docdes' => 'glx3-inserir arquivo',
                'docimg' => 'glx3-inserir arquivo',
                'created_at' => 'now()',
                'updated_at' => 'now()'
            ),
            'capaiphone4' => Array
                (
                'docid' => '7fde7346-cc23-4359-bf89-c173d5c96550',
                'docpass' => '5cb607b3-a827-492e-9793-1193e343764a',
                'docname' => '',
                'doccat' => 'Capa iPhone 4',
                'docdes' => 'ip4-inserir arquivo',
                'docimg' => 'ip4-inserir arquivo',
                'created_at' => 'now()',
                'updated_at' => 'now()'
            ),
            'capaiphone5' => Array
                (
                'docid' => '6ccb52de-819a-4e2b-9de3-95287889a620',
                'docpass' => '98f30284-d642-4d06-b29c-83efe4fc6199',
                'docname' => '',
                'doccat' => 'Capa iPhone 5',
                'docdes' => 'ip5-inserir arquivo',
                'docimg' => 'ip5-inserir arquivo',
                'created_at' => 'now()',
                'updated_at' => 'now()'
            ),
            'caseipad' => Array
                (
                'docid' => '16a965cb-693f-4fe4-a191-aa025feaa439',
                'docpass' => 'ee8adf39-89f7-4ed2-9f37-63a411f45d18',
                'docname' => '',
                'doccat' => 'Case iPad',
                'docdes' => 'ipd-inserir arquivo',
                'docimg' => 'ipd-inserir arquivo',
                'created_at' => 'now()',
                'updated_at' => 'now()'
            ),
            'envelopeoficio' => Array
                (
                'docid' => 'd0204920-01e4-47a6-97de-57b982991885',
                'docpass' => '035e7e19-3d06-4c1f-a176-6485d862c908',
                'docname' => '',
                'doccat' => 'Envelope Ofício',
                'docdes' => 'of-inserir arquivo',
                'docimg' => 'of-inserir arquivo',
                'created_at' => 'now()',
                'updated_at' => 'now()'
            ),
            'papeltimbrado' => Array
                (
                'docid' => '30f99c09-5899-4b08-985e-2689577e3ff7',
                'docpass' => 'bc2b264c-b088-463a-b365-1916080384f6',
                'docname' => '',
                'doccat' => 'Papel Timbrado',
                'docdes' => 'pc-inserir arquivo',
                'docimg' => 'pc-inserir arquivo',
                'created_at' => 'now()',
                'updated_at' => 'now()'
            ),
            'pasta' => Array
                (
                'docid' => 'a2aeab84-cd02-4993-887e-07fd85619067',
                'docpass' => 'b0b92bc9-b6fb-4939-8c7d-4927666c8ddc',
                'docname' => '',
                'doccat' => 'Pasta',
                'docdes' => 'pt-inserir arquivo',
                'docimg' => 'pt-inserir arquivo',
                'created_at' => 'now()',
                'updated_at' => 'now()'
            ),
            'receituario' => Array
                (
                'docid' => '2c565252-a2da-414b-9a36-4a6eb8b22971',
                'docpass' => '74d7d3fb-4ee4-411e-871c-7af7d8c978aa',
                'docname' => '',
                'doccat' => 'Receituário',
                'docdes' => 'rc-inserir arquivo',
                'docimg' => 'rc-inserir arquivo',
                'created_at' => 'now()',
                'updated_at' => 'now()'
            ),
            'revista' => Array
                (
                'docid' => '2863c552-df7d-41f1-84f3-7df7feeaeafe',
                'docpass' => 'c1818a4e-281e-4254-a4e9-056d92c5340e',
                'docname' => '',
                'doccat' => 'Revista',
                'docdes' => 'rev-inserir arquivo',
                'docimg' => 'rev-inserir arquivo',
                'created_at' => 'now()',
                'updated_at' => 'now()'
            ),
        );
        return $uploads[$categoria];
    }*/

}
