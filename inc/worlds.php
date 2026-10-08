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
            'label'    => 'SURVIVAL',
            'name'     => 'サバイバルサーバー',
            'tagline'  => '暮らす、建てる、稼ぐ。',
            'summary'  => 'neha鯖の中心になるワールドです。建てた場所は土地申請で守れて、ショップやオークション、依頼、釣りや料理など、長く遊ぶための仕組みがそろっています。',
            'difficulty' => 'Hard',
            'capacity' => '50人',
            'play'     => '拠点づくり、土地保護、商売、釣り、チュートリアル',
            'stats'    => [
                ['label' => '難易度', 'value' => 'Hard'],
                ['label' => '定員', 'value' => '50人'],
                ['label' => 'モード', 'value' => 'サバイバル'],
            ],
            'features' => [
                ['icon' => 'fa-shield-halved', 'title' => '土地保護', 'text' => '建てた場所を申請して守れます。チェスト保護やホームも使えます。'],
                ['icon' => 'fa-store', 'title' => '経済と取引', 'text' => 'ショップ、オークション、依頼でプレイヤー同士が取引できます。'],
                ['icon' => 'fa-fish', 'title' => '釣りと料理', 'text' => '冒険の合間にのんびり楽しめる要素もあります。'],
                ['icon' => 'fa-graduation-cap', 'title' => '初参加チュートリアル', 'text' => '採掘や土地申請を練習できます。完了報酬は 5,000円。'],
            ],
            'note'     => 'このサーバーは PvP が有効です。保護されていない場所では気をつけましょう。',
            'image'    => 'survival-harbor',
            'thumbs'   => ['survival-market', 'survival-shop'],
            'link'     => ['url' => 'https://map.nehaverse.net', 'label' => 'Webマップで街を見る', 'external' => true],
        ],
        [
            'id'       => 'resource',
            'label'    => 'RESOURCE',
            'name'     => '資源サーバー',
            'tagline'  => '掘って、潜って、強くなる。',
            'summary'  => '資源集めのためのワールドですが、それだけではありません。独自に生成された地形にダンジョンが点在し、レベル付きの強化された敵が待ち構える探索と戦闘のフィールドです。',
            'difficulty' => 'Easy',
            'capacity' => '120人',
            'play'     => '資源採集、強化された敵、ダンジョン、装備集め',
            'stats'    => [
                ['label' => '難易度', 'value' => 'Easy'],
                ['label' => '定員', 'value' => '120人'],
                ['label' => '敵レベル', 'value' => 'Lv1–60'],
            ],
            'features' => [
                ['icon' => 'fa-mountain-sun', 'title' => '独自の地形生成', 'text' => '見たことのない地形を探索できます。鉱石は一括採掘に対応。'],
                ['icon' => 'fa-dungeon', 'title' => 'ダンジョン', 'text' => 'ピラミッド、港の遺跡、教会、地下都市などが眠っています。'],
                ['icon' => 'fa-skull', 'title' => 'レベル付きの敵', 'text' => '通常の地域は Lv1–15、砂漠や深い地域では Lv35–60。'],
                ['icon' => 'fa-gem', 'title' => '装備集め', 'text' => '敵や宝箱から武器、部品、専用素材が手に入ります。'],
            ],
            'note'     => '',
            'image'    => 'pyramid-exterior',
            'thumbs'   => ['pyramid-hall', 'pyramid-corridor'],
            'link'     => ['url' => home_url('/dungeons/'), 'label' => 'ダンジョンと敵を見る', 'external' => false],
        ],
        [
            'id'       => 'pvp',
            'label'    => 'PVP',
            'name'     => 'PvPサーバー',
            'tagline'  => '対戦と、専用ゲームのアリーナ。',
            'summary'  => '対戦ゲーム NexusBattle や、仲間と押し寄せる敵の波に挑む「ABYSS TIDE」を遊べるサーバーです。ここでしか手に入らない特殊武器も登場します。',
            'difficulty' => '—',
            'capacity' => '20人',
            'play'     => 'NexusBattle、特殊武器、ABYSS TIDE の波状戦闘',
            'stats'    => [
                ['label' => '定員', 'value' => '20人'],
                ['label' => 'ABYSS TIDE', 'value' => '最大4人'],
                ['label' => 'ウェーブ', 'value' => '100秒×3'],
            ],
            'features' => [
                ['icon' => 'fa-water', 'title' => 'ABYSS TIDE', 'text' => '最大4人で敵の波を迎え撃つウェーブ戦闘。追加ウェーブも。'],
                ['icon' => 'fa-chess-rook', 'title' => 'NexusBattle', 'text' => 'プレイヤー同士で競い合う対戦ゲームです。'],
                ['icon' => 'fa-feather', 'title' => '飛べる羽', 'text' => '短い時間だけ空を飛べる特殊アイテム。'],
                ['icon' => 'fa-bolt', 'title' => '毒とスタンの剣', 'text' => '相手に状態異常を与える特殊武器。'],
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
            'text'   => '砂漠にそびえる巨大なピラミッド。松明に照らされた回廊が奥へと続きます。砂漠は高レベルの敵が出やすい地域なので、装備を整えてから挑みましょう。',
            'images' => ['pyramid-exterior', 'pyramid-hall', 'pyramid-corridor', 'pyramid-depths'],
            'icon'   => 'fa-monument',
        ],
        [
            'name'   => '港の遺跡',
            'area'   => '海岸',
            'text'   => '海辺に残された遺跡。宝箱から武器や専用素材が見つかることがあります。',
            'images' => [],
            'icon'   => 'fa-anchor',
        ],
        [
            'name'   => '教会',
            'area'   => '',
            'text'   => '探索の途中で見つかる教会のダンジョン。宝箱の中身もチェックしてみましょう。',
            'images' => [],
            'icon'   => 'fa-church',
        ],
        [
            'name'   => '地下都市',
            'area'   => '地下',
            'text'   => '地下深くに広がる都市。深い地域ほど敵のレベルが上がります。',
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

/**
 * Small speech bubble with the Nehal mascot.
 */
function nehaverse_nehal_says(string $text, string $modifier = ''): void
{
    ?>
    <div class="nv-nehal <?php echo esc_attr($modifier); ?>">
        <img class="nv-nehal__icon" src="<?php echo nehaverse_asset('images/nehal-v3-transparent.svg'); ?>" alt="" width="64" height="64" loading="lazy">
        <p class="nv-nehal__bubble"><span class="nv-nehal__name">ネハル</span><?php echo esc_html($text); ?></p>
    </div>
    <?php
}
