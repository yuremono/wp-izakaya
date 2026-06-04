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
- [footer-quests.php](../footer-quests.php): Quests 専用の `footer.php` 相当。script 直書きは置かず、`wp_footer()` だけを通す。
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

## 現在の構成方針

- Quests 系ページは、既存のフロントページとは別の見た目、CSS、JavaScript を持つページ群として同一テーマ内に実装している。
- WordPress の別テーマにはせず、専用ページテンプレート、専用 header/footer、専用テンプレートパーツで分離する。
- CSS と JavaScript は `inc/enqueue.php` で Quests 系ページに限定して読み込む方針。
- JavaScript は `inc/enqueue.php` に集約し、`footer-quests.php` に script 直書きを残さない。
- `assets/quests/js/function.js` は `$` グローバル前提のため、Quests 系ページでは `jquery` 読み込み後に `window.$ = window.jQuery;` を出力する。
- Quests 系ページは既存テーマの共通サイト遷移から外し、`SiteTransitionPending`、transition overlay、`theme-site-transition` を出力しない。
- 本文は `template-parts/quests/` に分離し、ページテンプレート本体は `get_header()`、本文パーツ、`get_footer()` の接続だけを担当する。
- 画像などの静的アセット参照は `theme_quests_source_uri()` を通し、出力時に `esc_url()` する。
- `quests` には `QuestsPageTop` と `home` の body class を付け、`quests-service` には `QuestsPageService` を付ける。
- リンク先は現段階では確定させず、Quests 系ページ内のリンクはすべて `href="#"` のダミーリンクとして扱う。
- 静的 HTML 由来の `<pan>` は `assets/quests/js/function.js` の処理対象なので、現時点では意図的に残す。
- ACF/CPT 化は現段階では大規模に入れず、ページ全体の固定本文はテンプレートに残す。今後、編集頻度の高い単体文言・画像は ACF、スタッフ・FAQ・料金表のように増減する一覧は CPT を検討する。

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

## 実装経緯メモ

1. まず既存の静的 HTML を WordPress 内で表示できる状態にし、表示崩れとアセット読み込みの影響範囲を確認した。
2. `quests` と `quests-service` は同一テーマ内の専用ページ群として扱い、フロントページへ CSS/JavaScript の影響を出さない方針にした。
3. 共通アセットは `assets/quests/` にまとめ、通常ページとサービスページのページ別 CSS を分けた。
4. 初期段階では静的 HTML の body 断片を読む方式も検討したが、一般的な WordPress の構成へ寄せるため、現在はテンプレートパーツへ本文を分割している。
5. サービスページでは静的 HTML 由来の `home` class を付けず、`theme_quests_body_classes()` でページごとの body class を切り替えている。
6. `footer-quests.php` の script 直書きを削除し、Quests 系 CSS/JS は `inc/enqueue.php` に集約した。
7. WordPress 標準 jQuery の noConflict により旧式 JS の `$` 前提が崩れないよう、Quests 系ページだけ `$` 互換を追加した。
8. 共通サイト遷移の `SiteTransitionPending` によって本文が非表示のままになる問題を避けるため、Quests 系ページではサイト遷移 overlay と script を除外した。

## 既知の確認事項

- Quests 系ページのリンクは、現段階では意図的に `href="#"` のダミーリンクにしている。遷移先が確定した段階で `wp_nav_menu()`、`home_url()`、`get_permalink()`、または専用 helper へ置き換える。
- 静的 HTML 由来の空属性、不要コメント、重複しやすい ID は、見た目確認後に整理する。
- 現在の本文は固定テンプレートパーツであり、管理画面から文章や画像を編集する構成ではない。編集可能化する場合は、固定本文全体を一括で ACF/CPT 化するのではなく、更新頻度と増減の有無を見て最小範囲から設計する。

## 表示確認メモ

- `http://localhost:10008/quests/` は HTTP `200` を返す。
- `quests` の body class には `QuestsPage QuestsPageTop home root` が出る。`SiteTransitionPending` は出さない。
- `quests-service` の body class には `QuestsPage QuestsPageService root` が出る。`SiteTransitionPending` は出さない。
- Quests 系ページでは `theme-quests-function-js` を読み込む。
- Quests 系ページでは `theme-site-transition-js` を読み込まない。
