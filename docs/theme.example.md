# ${theme_name} テーマ構成ガイド

この文書は、${theme_name} テーマを初めて見る人が、次の点を把握できるようにするための構成ガイドです。

- WordPress がどのファイルを入口としてページを表示するか
- トップページとサービスページの共通部分・固有部分
- ACF の入力値がどのテンプレートへ渡るか
- CSS・JavaScript・画像がどこから読み込まれるか
- ローカル環境と本番環境を整えるツールの役割

 `https://yuremono.com/quests/` 配下で動く、トップページとサービスページ専用の独立したクラシックテーマです。

## 全体のファイルツリー

```text
quests/
├── style.css                         # WordPressがテーマとして認識するためのテーマ情報
├── functions.php                     # テーマ機能を読み込む起点
├── header.php                        # <html>、<head>、<body>、wp_head()
├── footer.php                        # wp_footer()、</body>、</html>
├── front-page.php                    # WordPressのフロントページ入口
├── page.php                          # ${theme_name}専用テンプレート以外の固定ページ
├── index.php                         # 最終フォールバック
│
├── page-templates/
│   ├── top.php                # 管理画面で選べる「Top」
│   └── ${page_name}.php            # 管理画面で選べる「${page_name}」
│
├── template-parts/
│   ├── site-header.php               # ロゴ、CONTACT、メインナビゲーション
│   ├── site-footer.php               # SNS、フッターナビ、コピーライト
│   ├── front-page-content.php         # トップページ各セクションの呼び出し元
│   ├── ${page_name}-page-content.php       # サービスページ各セクションの呼び出し元
│   │
│   ├── front/
│   │   ├── hero.php                  # メインビジュアル
│   │   ├── about.php                 # About
│   │   ├── introduction.php          # Introduction
│   │   ├── features.php              # ${theme_name}紹介・パララックス画像
│   │   ├── education.php             # Educationカード
│   │   ├── life.php                  # LIFEカード群
│   │   ├── enjoy.php                 # Enjoy・下部コピー
│   │   └── social.php                # Instagram風の固定表示
│   │
│   └── ${page_name}/
│       ├── hero.php                  # ${page_name}ページのメインビジュアル
│       ├── overview.php              # 導入用の背景ブロック
│       ├── details.php               # 長文説明・Point周辺画像
│       ├── plan.php                  # PLAN・料金表・対応エリア表
│       └── flow.php                  # Flow・下部CTA
│
├── inc/
│   ├── helpers.php                   # 汎用の値判定・アセット更新日時
│   ├── quests-static.php             # ${theme_name}表示用ヘルパー
│   ├── setup.php                     # テーマサポート・メニュー・管理画面通知
│   ├── enqueue.php                   # CSS・JavaScriptの登録と読み込み
│   └── acf-quests-pages.php           # トップ・サービス用ACFフィールド定義
│
├── assets/
│   ├── css/
│   │   ├── bxi.css                   # 移植元レイアウトの基礎CSS
│   │   ├── index_html.css            # トップページ固有CSS
│   │   ├── ${page_name}_html.css          # サービスページ固有CSS
│   │   ├── common.css                # 両ページ共通CSS
│   │   ├── common_style.css          # 共通コンポーネント・装飾CSS
│   │   └── style.css                 # ${theme_name}表示の最終調整CSS
│   ├── js/
│   │   ├── function.js               # Slick・GSAP・Lenis等の初期化
│   │   ├── bxi.js                    # ヘッダー等の既存UI制御
│   │   ├── slick/                    # スライダー
│   │   ├── magnific-popup/           # ポップアップ
│   │   ├── scroll-hint/              # 保管のみ。現在は読み込まない
│   │   └── flipsnap.min.js           # 保管のみ。現在は読み込まない
│   └── images/
│       ├── home/                      # ページ内画像とACF未設定時の代替画像
│       └── placeholder/               # SNS風表示等のプレースホルダー
│
├── tools/
│   ├── deploy.sh                     # 汎用のZIP作成・本番テーマ同期
│   └── local-wp-load.path.example    # ローカルwp-load.php設定例
├── tools-domain/
│   ├── bootstrap-quests-site.php      # 固定ページ・ACF・メニューの初期構築
│   ├── run-bootstrap-quests-site.sh   # Local WP用の初期構築実行ラッパー
│   ├── sync-quests-nav.php            # ${theme_name}ナビゲーション同期用入口
│   └── deploy-quests.sh               # ${theme_name}用デプロイ設定ラッパー
│
├── docs/
│   └── quests.md                     # この構成ガイド
├── README.md                          # 環境、管理画面、運用方法
├── QUESTS_DEPLOYMENT.md               # 本番配置先と公開手順
├── CHECKLIST.md                       # 改善作業の記録
├── AGENTS.md                          # このリポジトリの開発ルール
├── composer.json                      # PHPCS開発依存と実行スクリプト
└── phpcs.xml.dist                     # WordPressコーディング規約設定
```

## ページが表示されるまでの流れ

### トップページ

管理画面の「表示設定」で `Front` をホームページに指定しています。

```text
https://yuremono.com/quests/
  ↓
front-page.php
  ├── get_header()
  │     └── header.php
  ├── template-parts/site-header.php
  ├── template-parts/front-page-content.php
  │     ├── front/hero.php
  │     ├── front/about.php
  │     ├── front/introduction.php
  │     ├── front/features.php
  │     ├── front/education.php
  │     ├── front/life.php
  │     ├── front/enjoy.php
  │     └── front/social.php
  ├── template-parts/site-footer.php
  └── get_footer()
        └── footer.php
```

`page-templates/top.php` も同じ部品を同じ順番で読み込みます。これは、固定ページ編集画面でテンプレート「Top」を明示的に選べるようにするためです。

### サービスページ

`Service` 固定ページでは、テンプレート「${page_name}」を選択します。

```text
https://yuremono.com/quests/${page_name}/
  ↓
page-templates/${theme_name}-${page_name}.php
  ├── get_header()
  │     └── header.php
  ├── template-parts/site-header.php
  ├── template-parts/${page_name}-page-content.php
  │     ├── ${page_name}/hero.php
  │     ├── ${page_name}/overview.php
  │     ├── ${page_name}/details.php
  │     ├── ${page_name}/plan.php
  │     └── ${page_name}/flow.php
  ├── template-parts/site-footer.php
  └── get_footer()
        └── footer.php
```

## 共通外枠とページ部品の分担

### `header.php` と `footer.php`

この2ファイルはHTML文書全体の外枠です。

- `header.php`
  - `<!DOCTYPE html>` から `<body>` 開始までを出力
  - `wp_head()` を呼び、`inc/enqueue.php` で登録したCSS等を出力
  - `theme_quests_body_classes()` でページ判別用クラスを追加
- `footer.php`
  - `wp_footer()` を呼び、JavaScript等を出力
  - `</body>` と `</html>` を閉じる

サイト上に見えるヘッダーとフッターのマークアップは、これらではなく `template-parts/site-header.php` と `template-parts/site-footer.php` が担当します。

### `template-parts/site-header.php`

すべての${theme_name}ページで共通する表示ヘッダーです。

- トップURLは `home_url( '/' )`
- ロゴはWordPressのカスタムロゴを優先
- カスタムロゴ未設定時はサイト名を表示
- CONTACT・LINEリンクは現在の固定ページに保存されたACF値を使用
- ナビゲーションは `primary` メニュー位置を使用
- メニュー未割り当て時は `inc/setup.php` のフォールバックを使用

### `template-parts/site-footer.php`

すべての${theme_name}ページで共通する表示フッターです。

- サイト名はWordPressの一般設定から取得
- LINE・Instagram URLはACFから取得
- `footer` メニューを優先し、未割り当て時は `primary` を使用
- コピーライトの年は自動生成

## `functions.php` と `inc/` の関係

`functions.php` は処理を直接大量に書く場所ではなく、機能ファイルを読み込む起点です。

```text
functions.php
  ├── inc/helpers.php
  ├── inc/quests-static.php
  ├── inc/setup.php
  ├── inc/enqueue.php
  └── inc/acf-quests-pages.php
```

### `inc/helpers.php`

テーマ全体で使える小さな共通処理です。

- ACF値が空かを判定する `theme_acf_value_absent()`
- ファイル更新日時をCSS・JSのバージョンに使う `theme_asset_version()`

### `inc/quests-static.php`

ACF、画像、URL、HTML出力とテンプレートの間をつなぐ表示用ヘルパーです。

主な関数:

- `theme_quests_source_uri()`: `assets/` 内のURLを生成
- `theme_quests_body_classes()`: トップ・サービス用bodyクラスを返す
- `theme_is_quests_view()`: ${theme_name}対象ページかを判定
- `theme_quests_meta()`: ACF値を取得し、ACF無効時は投稿メタへfallback
- `theme_quests_url()`: URL項目を取得
- `theme_quests_image()`: ACF画像またはテーマ内代替画像を安全に出力
- `theme_quests_text()`: 1行テキストをエスケープして出力
- `theme_quests_lines()`: 改行付きテキストをエスケープして出力
- `theme_quests_rich()`: 許可したHTMLだけを出力
- `theme_quests_table()`: 料金表・エリア表を固定数フィールドから生成

各セクションテンプレートは、原則として `get_field()` を直接呼ばず、これらの関数を経由します。これにより、ACFが無効な場合や値が未入力の場合の処理を一か所にまとめています。

### `inc/setup.php`

WordPress標準機能との接続を担当します。

- title-tag、アイキャッチ、カスタムロゴ、HTML5を有効化
- `primary` と `footer` のメニュー位置を登録
- ACFが無効な場合に管理画面へ警告を表示
- メニュー未設定時のナビゲーションを定義

### `inc/enqueue.php`

${theme_name}ページでのみCSSとJavaScriptを読み込みます。

トップページでは `index_html.css`、サービスページでは `${page_name}_html.css` を読み分け、その後に共通CSSを読み込みます。JavaScriptは jQuery、Lenis、GSAP、ScrollTrigger、Slick、Magnific Popup、`function.js`、`bxi.js` の依存順で登録します。

テンプレートに `<link>` や `<script>` を直接書かず、このファイルに読み込みを集約しています。

### `inc/acf-quests-pages.php`

管理画面に表示するACFフィールドをPHPで登録します。

- `group_pc_page_quests`: トップページ用
- `group_pc_page_quests_${page_name}`: サービスページ用

フィールドグループは固定ページテンプレートによって出し分けます。画像、見出し、本文、URL、料金、対応エリア、Flow等の「内容」を管理画面から変更できます。

レイアウトやフィールドの種類・順番はこのPHPファイルで管理します。ACF管理画面だけで自由に項目を増やす運用ではありません。

## ACF値が表示される仕組み

例として、サービスページの料金表は次の経路で表示されます。

```text
管理画面のService固定ページ
  ↓ 保存
quests_${page_name}_price_1_label 等の投稿メタ
  ↓ 取得
inc/quests-static.php
  └── theme_quests_table()
  ↓ 呼び出し
template-parts/${page_name}/plan.php
  ↓ 表示
サービスページの料金表
```

画像の場合は、ACF画像フィールドに設定されたメディアのURLと代替テキストを使用します。未設定時は `assets/images/home/` の画像と、テンプレートで指定した代替テキストを使用します。

## CSS・JavaScript・画像の関係

```text
inc/enqueue.php
  ├── assets/css/*
  ├── assets/js/*
  └── 外部CDN
        ├── YakuHanJP
        ├── Google Fonts
        ├── Line Awesome
        ├── Lenis
        └── GSAP / ScrollTrigger

各セクションテンプレート
  └── theme_quests_image()
        ├── ACFで選択したメディア画像
        └── assets/images/* の代替画像
```

ルートの `style.css` はWordPressテーマ情報専用です。実際の画面スタイルは `assets/css/` にあります。

`assets/js/scroll-hint/` と `assets/js/flipsnap.min.js` は移植元との比較用に残していますが、現在のページでは読み込んでいません。

## 管理画面とテーマファイルの対応

| 管理画面 | 主なコード |
| --- | --- |
| 固定ページ `Front` | `front-page.php`、`page-templates/quests-top.php`、`template-parts/front/` |
| 固定ページ `Service` | `page-templates/quests-${page_name}.php`、`template-parts/${page_name}/` |
| Front / ServiceのACF入力欄 | `inc/acf-quests-pages.php` |
| ACF値の取得・出力 | `inc/quests-static.php` |
| 外観 → メニュー | `inc/setup.php`、`site-header.php`、`site-footer.php` |
| 外観 → カスタマイズ → ロゴ | `inc/setup.php`、`site-header.php` |
| CSS・JavaScript | `inc/enqueue.php`、`assets/` |

## ローカル構築・本番反映ツール

### ローカル初期構築

`tools-domain/run-bootstrap-quests-site.sh` は Local WP のPHP環境を探し、`bootstrap-quests-site.php` を実行します。

`bootstrap-quests-site.php` は次を行います。

1. ${theme_name}テーマを有効化
2. ACFがインストール済みなら有効化
3. `Front` と `${page_name}` 固定ページを作成または更新
4. ページテンプレートを割り当て
5. `Front` をホームページに指定
6. $`theme_names} Navigation` を作成して `primary` に割り当て

既存の固定ページを削除して作り直すのではなく、スラッグを基準に更新します。

### 本番反映

`tools-domain/deploy-quests.sh` は${theme_name}用のテーマ名・ZIP名を設定し、`tools/deploy.sh` を呼び出します。

`tools/deploy.sh` は開発用ファイルを除外してZIPを作成し、環境変数が設定されている場合だけ本番のテーマディレクトリへ同期します。WordPressのDBやルート側のWordPressは同期対象ではありません。

詳細な配置先と注意事項は [QUESTS_DEPLOYMENT.md](../QUESTS_DEPLOYMENT.md) を参照してください。

## 旧構成から現在構成への対応

| 旧構成 | 現在の構成 |
| --- | --- |
| `header-quests.php` | `header.php` + `template-parts/site-header.php` |
| `footer-quests.php` | `template-parts/site-footer.php` + `footer.php` |
| `page-templates/page-quests.php` | `front-page.php` / `page-templates/quests-top.php` |
| `page-templates/page-${page_name}.php` | `page-templates/${page_name}.php` |
| `template-parts/quests/content-top.php` | `front-page-content.php` + `template-parts/front/*.php` |
| `template-parts/quests/content-${page_name}.php` | `${page_name}-page-content.php` + `template-parts/${page_name}/*.php` |
| `template-parts/quests/header.php` | `template-parts/site-header.php` |
| `template-parts/quests/footer.php` | `template-parts/site-footer.php` |
| `assets/quests/css/` | `assets/css/` |
| `assets/quests/js/` | `assets/js/` |
| `assets/quests/images/` | `assets/images/` |
| 静的な `index.html` / `${page_name}.html` | PHPテンプレートへ移行済みのため廃止 |

旧構成では親テーマの中に${theme_name}専用ファイルを追加していました。現在はテーマ全体が${theme_name}専用なので、ファイル名やディレクトリ名から `quests-` / `quests/` の重複を減らしています。

## 修正するときの入口

- ページ内の文章・画像・URLを変更する: WordPress管理画面のACF
- 入力欄の追加・削除・並び替え: `inc/acf-quests-pages.php`
- HTML構造を変更する: `template-parts/front/` または `template-parts/${page_name}/`
- 共通ヘッダー・フッターを変更する: `template-parts/site-header.php` / `site-footer.php`
- CSS・JSファイルの読み込みを変更する: `inc/enqueue.php`
- 見た目を変更する: `assets/css/`
- スライダーやスクロール演出を変更する: `assets/js/function.js`
- メニュー位置やテーマ機能を変更する: `inc/setup.php`
- ACF値のfallbackやエスケープを変更する: `inc/quests-static.php`

ACF値はテンプレートから直接 `echo` せず、用途に合った${theme_name}ヘルパーを使用してください。
