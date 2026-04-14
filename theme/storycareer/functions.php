<?php
/**
 * STORY CAREER テーマ機能
 */

// アイキャッチ画像サポート
add_theme_support('post-thumbnails');
add_theme_support('title-tag');
add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));

// CSS/JS読み込み
function storycareer_enqueue_assets() {
    $ver = wp_get_theme()->get('Version');
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;700&family=Noto+Serif+JP:wght@300;700&display=swap', array(), null);
    wp_enqueue_style('storycareer-common', get_template_directory_uri() . '/css/common.css', array(), $ver);
    wp_enqueue_script('storycareer-animations', get_template_directory_uri() . '/js/animations.js', array(), $ver, true);
    wp_enqueue_script('storycareer-nav', get_template_directory_uri() . '/js/nav.js', array(), $ver, true);
    wp_enqueue_script('storycareer-cursor', get_template_directory_uri() . '/js/cursor.js', array(), $ver, true);
}
add_action('wp_enqueue_scripts', 'storycareer_enqueue_assets');

// ナビゲーションメニュー登録
register_nav_menus(array(
    'primary' => 'ハンバーガーメニュー',
    'footer' => 'フッターメニュー',
));

// 抜粋の文字数
function storycareer_excerpt_length($length) {
    return 80;
}
add_filter('excerpt_length', 'storycareer_excerpt_length');

// 抜粋の末尾
function storycareer_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'storycareer_excerpt_more');

// カスタムカーソルのcursor:none用インラインCSS + 不要なスクロールトップボタン非表示
function storycareer_cursor_style() {
    echo '<style>*{cursor:none!important}#pagetop,.pagetop,.back-to-top,.scroll-top,[id*="pagetop"]{display:none!important}</style>';
}
add_action('wp_head', 'storycareer_cursor_style', 5);

// OGPタグ出力
function storycareer_ogp() {
    $ogp_image = get_template_directory_uri() . '/images/ogp.png';
    $description = 'AIを駆使しながら人の可能性を最大化し、事業成長につなげる。HR × AXコンサルティング。';

    if (is_singular()) {
        $title = get_the_title() . ' | ' . get_bloginfo('name');
        $url = get_permalink();
        if (has_post_thumbnail()) {
            $ogp_image = get_the_post_thumbnail_url(null, 'full');
        }
        $excerpt = get_the_excerpt();
        if ($excerpt) $description = wp_strip_all_tags($excerpt);
    } else {
        $title = get_bloginfo('name') . ' | 人の可能性を再定義する。';
        $url = home_url('/');
    }
    ?>
    <meta property="og:title" content="<?php echo esc_attr($title); ?>">
    <meta property="og:description" content="<?php echo esc_attr($description); ?>">
    <meta property="og:image" content="<?php echo esc_url($ogp_image); ?>">
    <meta property="og:url" content="<?php echo esc_url($url); ?>">
    <meta property="og:type" content="<?php echo is_front_page() ? 'website' : 'article'; ?>">
    <meta property="og:site_name" content="STORY CAREER">
    <meta name="twitter:card" content="summary_large_image">
    <?php
}
add_action('wp_head', 'storycareer_ogp');
