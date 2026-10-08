<?php
/**
 * Content for the server, dungeon and ABYSS TIDE sections.
 *
 * Kept as plain arrays so copy can be edited in one place.
 *
 * @package Nehaverse
 */

if (!defined('ABSPATH')) {
    exit;
}

function nehaverse_world_image(string $name, bool $small = false): string
{
    return nehaverse_asset('images/world/' . $name . ($small ? '-sm' : '') . '.webp');
}

function nehaverse_servers(): array
{
    return [
        [
            'id'       => 'survival',
            'name'     => 'サバイバル',
            'summary'  => 'みんなが住んでいるメインのサーバーです。家を建てたら土地を申請しておけば、ほかの人に壊されません。ショップやオークションで売り買いしたり、依頼を出したり受けたりもできます。',
            'gate'     => '家を建てて、商売して、暮らすところ。',
            'play'     => '拠点づくり、土地保護、商売、釣り、チュートリアル',
            'difficulty' => 'Hard',
            'capacity' => '50人',
            'list'     => [
                '土地の申請と保護、チェスト保護、ホーム',
                'ショップ、オークション、依頼',
                '釣りと料理',
                '初参加チュートリアル（採掘と土地申請の練習、完了で 5,000円）',
            ],
            'note'     => 'PvP はオンです。保護していない場所では気をつけてください。',
            'image'    => 'survival-harbor',
            'thumbs'   => ['survival-market', 'survival-shop'],
            'link'     => ['url' => 'https://map.nehaverse.net', 'label' => 'Webマップで街を見る', 'external' => true],
        ],
        [
            'id'       => 'resource',
            'name'     => '資源',
            'summary'  => '資源を集めるためのサーバーですが、敵がかなり強くなっています。洞窟は敵が多めで、動物も体当たりしてきます。ダンジョンを回って、敵や宝箱から武器・部品・専用素材を集めましょう。鉱石は一括で掘れます。',
            'gate'     => '掘りに行くところ。敵は強め。',
            'play'     => '資源採集、強化された敵、ダンジョン、装備集め',
            'difficulty' => 'Easy',
            'capacity' => '120人',
            'list'     => [
                'ダンジョン: ピラミッド、港の遺跡、教会、地下都市など',
                '一括採掘',
                '敵と宝箱から武器・部品・専用素材',
            ],
            'note'     => '',
            'image'    => 'pyramid-exterior',
            'thumbs'   => ['pyramid-hall', 'pyramid-corridor'],
            'link'     => ['url' => home_url('/dungeons/'), 'label' => 'ダンジョンと敵のレベルを見る', 'external' => false],
        ],
        [
            'id'       => 'pvp',
            'name'     => 'PvP',
            'summary'  => '対戦用のサーバーです。NexusBattle と、最大4人で敵の波を耐える ABYSS TIDE が遊べます。少しだけ空を飛べる羽や、毒・スタン付きの剣もここで使えます。',
            'gate'     => '対戦と ABYSS TIDE。',
            'play'     => 'NexusBattle、特殊武器、ABYSS TIDE',
            'difficulty' => '—',
            'capacity' => '20人',
            'list'     => [
                'ABYSS TIDE（最大4人、1ウェーブ100秒）',
                'NexusBattle',
                '特殊武器: 飛べる羽、毒・スタンの剣',
            ],
            'note'     => '',
            'image'    => 'abyss-lobby',
            'thumbs'   => ['abyss-bestiary', 'abyss-hall'],
            'link'     => ['url' => home_url('/abyss-tide/'), 'label' => 'ABYSS TIDE を見る', 'external' => false],
        ],
    ];
}

function nehaverse_dungeons(): array
{
    return [
        [
            'name'   => 'ピラミッド',
            'area'   => '砂漠',
            'text'   => '砂漠に建っている大きなピラミッドです。中は松明の回廊が続いています。砂漠の敵は Lv35 以上なので、装備をそろえてから入ってください。',
            'images' => ['pyramid-exterior', 'pyramid-hall', 'pyramid-corridor', 'pyramid-depths'],
            'icon'   => 'fa-monument',
        ],
        [
            'name'   => '港の遺跡',
            'area'   => '海岸',
            'text'   => '海辺にある遺跡です。',
            'images' => [],
            'icon'   => 'fa-anchor',
        ],
        [
            'name'   => '教会',
            'area'   => '',
            'text'   => '教会のダンジョンです。',
            'images' => [],
            'icon'   => 'fa-church',
        ],
        [
            'name'   => '地下都市',
            'area'   => '地下',
            'text'   => '地下に広がる都市です。深い場所ほど敵のレベルが上がります。',
            'images' => [],
            'icon'   => 'fa-city',
        ],
    ];
}

function nehaverse_abyss_enemies(): array
{
    return [
        'ノーマル'   => ['タイドランナー', 'タイドウォーカー'],
        'ハード'     => ['フレアガンナー', 'オーグメンター', 'ヴァンガード', 'ヘビーシェル'],
        'ナイトメア' => ['ヴォイドコーラー', '深淵の巨腕 アビススラマー'],
    ];
}

function nehaverse_abyss_stages(): array
{
    return [
        ['name' => '海岸通り', 'en' => 'SEASIDE AVENUE'],
        ['name' => 'ビーチ', 'en' => 'BEACH'],
        ['name' => 'テニスコート', 'en' => 'TENNIS COURT'],
        ['name' => '植物園', 'en' => 'BOTANICAL GARDEN'],
    ];
}
