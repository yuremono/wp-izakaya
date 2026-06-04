# Quests ページ構成

Quests 系ページの構成、各ファイルの役割、HTML から WordPress へ移植する際の作業工程をまとめたメモです。

## FileTree

```text
.
├── header-quests.php
├── footer-quests.php
├── inc/
│   └── quests-static.php
├── page-templates/
│   ├── page-quests.php
│   └── page-quests-service.php
├── template-parts/
│   └── quests/
│       ├── header.php
│       ├── footer.php
│       ├── content-top.php
│       └── content-service.php
└── assets/
    └── quests/
        ├── index.html
        ├── service.html
        ├── css/
        │   ├── common.css
        │   ├── common_style.css
        │   ├── style.css
        │   └── service_html.css
        ├── js/
        │   ├── function.js
        │   ├── flipsnap.min.js
        │   ├── slick/
        │   ├── scroll-hint/
        │   └── magnific-popup/
        └── images/
            ├── home/
            ├── picture/
            └── placeholder/
```

## 各ファイルの説明

- [header-quests.php](../header-quests.php): Quests 専用の `header.php` 相当。`wp_head()` を出力し、共通ヘッダーの入口になる。
- [footer-quests.php](../footer-quests.php): Quests 専用の `footer.php` 相当。`wp_footer()` とページ末尾のスクリプト群を扱う。
- [inc/quests-static.php](../inc/quests-static.php): `theme_quests_source_uri()` と `theme_quests_body_classes()` を定義する共通ヘルパー。
- [page-templates/page-quests.php](../page-templates/page-quests.php): 通常ページのテンプレート。
- [page-templates/page-quests-service.php](../page-templates/page-quests-service.php): サービスページのテンプレート。
- [template-parts/quests/header.php](../template-parts/quests/header.php): ページヘッダーの共通マークアップ。
- [template-parts/quests/footer.php](../template-parts/quests/footer.php): ページフッターの共通マークアップ。
- [template-parts/quests/content-top.php](../template-parts/quests/content-top.php): 通常ページ本文。
- [template-parts/quests/content-service.php](../template-parts/quests/content-service.php): サービスページ本文。画像参照を helper 経由に統一している。
- [assets/quests/index.html](../assets/quests/index.html): 通常ページの静的コピー。
- [assets/quests/service.html](../assets/quests/service.html): サービスページの静的コピー。
- [assets/quests/css/common.css](../assets/quests/css/common.css): 共通スタイル。
- [assets/quests/css/common_style.css](../assets/quests/css/common_style.css): 共通の追加スタイル。
- [assets/quests/css/style.css](../assets/quests/css/style.css): 通常ページ固有スタイル。
- [assets/quests/css/service_html.css](../assets/quests/css/service_html.css): サービスページ固有スタイル。
- [assets/quests/js/function.js](../assets/quests/js/function.js): 共通の挙動をまとめた JavaScript。
- [assets/quests/js/flipsnap.min.js](../assets/quests/js/flipsnap.min.js): 横スクロール系の補助スクリプト。
- [assets/quests/js/slick/](../assets/quests/js/slick/): スライダー用アセット。
- [assets/quests/js/scroll-hint/](../assets/quests/js/scroll-hint/): スクロールヒント用アセット。
- [assets/quests/js/magnific-popup/](../assets/quests/js/magnific-popup/): モーダル表示用アセット。
- [assets/quests/images/](../assets/quests/images/): 画像アセット群。

## HTML→WP 変換工程

1. 元の静的 HTML を 2 ページ分確認し、共通構造とページ固有構造を分けて把握した。
2. `head` 内の `meta`、`link`、`script` の読み込み順を保ったまま、WordPress 側へ移植する方針を決めた。
3. `header` と `footer` の共通化対象を切り出し、ページごとの差分は本文パーツへ寄せた。
4. ページ内で繰り返し使われる領域は `template-parts/` に分離し、テンプレート本体はレイアウトの接続だけを担当する形にした。
5. 静的アセットは `assets/quests/` に残しつつ、WordPress 側から参照できるように URI 生成の共通化を行った。
6. 画像やスクリプトの参照は、直接パスを直書きせず、共通ヘルパーやエンキュー経由に寄せた。
7. 2 ページ分の静的コピーと WordPress テンプレートを突き合わせ、読み込み順・配置・重複タグが一致するかを確認した。
8. ページごとに異なる見た目や内容は本文パーツ側に残し、共通化できる要素は上位レイヤーへ引き上げた。
9. 最終的に、2 ページの出力が静的コピーと同じ構造意図になるように調整した。

