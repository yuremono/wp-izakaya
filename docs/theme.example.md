# ${theme_name} テーマ構成ガイド

この文書は、`${theme_name}` テーマを初めて見る人が、次の点を把握できるようにするためのテンプレートです。

- WordPress がどのファイルを入口としてページを表示するか
- フロントページと個別ページの共通部分・固有部分
- ACF の入力値がどのテンプレートへ渡るか
- CSS・JavaScript・画像がどこから読み込まれるか
- ローカル環境と本番環境を整えるツールの役割

このテーマは `${site_url}` で使用する、`${page_summary}` 向けのクラシックテーマです。

## プレースホルダー

| プレースホルダー | 用途 | 例 |
| --- | --- | --- |
| `${theme_name}` | 管理画面や文書に表示するテーマ名 | Example Theme |
| `${theme_slug}` | ディレクトリ名やファイル名に使う識別子 | example-theme |
| `${function_prefix}` | PHP 関数・定数・ACF key の接頭辞 | example_theme |
| `${site_url}` | 公開URL | `https://example.com/` |
| `${page_summary}` | テーマが扱うページや目的の概要 | コーポレートサイト |
| `${secondary_page_name}` | 個別ページの表示名 | Detail |
| `${secondary_page_slug}` | 個別ページのスラッグ | detail |

`${secondary_page_slug}` はファイル名に使用するため、英小文字・数字・ハイフンなど、プロジェクトの命名規則に合う値へ置き換えます。

## 全体のファイルツリー

```text
${theme_slug}/
├── style.css                              # WordPressがテーマとして認識するためのテーマ情報
├── functions.php                          # テーマ機能を読み込む起点
├── header.php                             # <html>、<head>、<body>、wp_head()
├── footer.php                             # wp_footer()、</body>、</html>
├── front-page.php                         # WordPressのフロントページ入口
├── page.php                               # 専用テンプレート以外の固定ページ
├── index.php                              # 最終フォールバック
│
├── page-templates/
│   ├── top.php                            # 管理画面で選べるフロントページ用テンプレート
│   └── ${secondary_page_slug}.php         # 管理画面で選べる個別ページ用テンプレート
│
├── template-parts/
│   ├── site-header.php                    # ロゴ、主要導線、メインナビゲーション
│   ├── site-footer.php                    # 補助リンク、フッターナビ、コピーライト
│   ├── front-page-content.php              # フロントページ各セクションの呼び出し元
│   ├── ${secondary_page_slug}-content.php  # 個別ページ各セクションの呼び出し元
│   │
│   ├── front/
│   │   ├── hero.php                       # ページ冒頭の主要表示
│   │   ├── introduction.php               # 導入セクション
│   │   ├── primary-content.php            # 主要コンテンツ
│   │   ├── secondary-content.php          # 補足コンテンツ
│   │   └── closing.php                    # ページ末尾の導線
│   │
│   └── ${secondary_page_slug}/
│       ├── hero.php                       # 個別ページ冒頭の主要表示
│       ├── introduction.php               # 導入セクション
│       ├── primary-content.php            # 主要コンテンツ
│       ├── supplementary-content.php      # 補足情報
│       └── closing.php                    # ページ末尾の導線
│
├── inc/
│   ├── helpers.php                        # 汎用の値判定・アセット更新日時
│   ├── template-tags.php                  # 表示用ヘルパー
│   ├── setup.php                          # テーマサポート・メニュー・管理画面通知
│   ├── enqueue.php                        # CSS・JavaScriptの登録と読み込み
│   └── acf-pages.php                      # ページ別ACFフィールド定義
│
├── assets/
│   ├── css/
│   │   ├── base.css                       # リセット・基礎スタイル
│   │   ├── common.css                     # ページ共通スタイル
│   │   ├── front.css                      # フロントページ固有スタイル
│   │   └── ${secondary_page_slug}.css     # 個別ページ固有スタイル
│   ├── js/
│   │   ├── common.js                      # ページ共通の挙動
│   │   ├── front.js                       # フロントページ固有の挙動
│   │   └── ${secondary_page_slug}.js      # 個別ページ固有の挙動
│   └── images/
│       ├── common/                        # ページ共通画像
│       ├── front/                         # フロントページ用画像
│       ├── ${secondary_page_slug}/        # 個別ページ用画像
│       └── placeholder/                   # 未設定時の代替画像
│
├── tools/
│   ├── deploy.sh                          # 汎用のZIP作成・本番テーマ同期
│   └── local-wp-load.path.example         # ローカルwp-load.php設定例
├── tools-domain/
│   ├── bootstrap-site.php                 # 固定ページ・ACF・メニューの初期構築
│   ├── run-bootstrap-site.sh              # ローカル環境用の実行ラッパー
│   ├── sync-navigation.php                # ナビゲーション同期用入口
│   └── deploy-theme.sh                    # テーマ固有のデプロイ設定ラッパー
│
├── docs/
│   └── architecture.md                    # この構成ガイド
├── README.md                              # 環境、管理画面、運用方法
├── DEPLOYMENT.md                          # 本番配置先と公開手順
├── CHECKLIST.md                           # 作業記録
├── AGENTS.md                              # リポジトリの開発ルール
├── composer.json                          # PHPCS等の開発依存
└── phpcs.xml.dist                         # WordPressコーディング規約設定
```

ページ数や実装規模に応じて、不要なファイルは削除し、必要なセクションだけを追加します。ファイル名はコンテンツの文言ではなく、ページ内での役割が分かる名前を優先します。

## ページが表示されるまでの流れ

### フロントページ

管理画面の「表示設定」で `${front_page_title}` をホームページに指定します。

```text
${site_url}
  ↓
front-page.php
  ├── get_header()
  │     └── header.php
  ├── template-parts/site-header.php
  ├── template-parts/front-page-content.php
  │     ├── front/hero.php
  │     ├── front/introduction.php
  │     ├── front/primary-content.php
  │     ├── front/secondary-content.php
  │     └── front/closing.php
  ├── template-parts/site-footer.php
  └── get_footer()
        └── footer.php
```

`page-templates/top.php` も同じ部品を同じ順番で読み込みます。これは、固定ページ編集画面でフロントページ用テンプレートを明示的に選択できるようにするためです。

### 個別ページ

`${secondary_page_name}` 固定ページでは、`page-templates/${secondary_page_slug}.php` をページテンプレートとして選択します。

```text
${site_url}${secondary_page_slug}/
  ↓
page-templates/${secondary_page_slug}.php
  ├── get_header()
  │     └── header.php
  ├── template-parts/site-header.php
  ├── template-parts/${secondary_page_slug}-content.php
  │     ├── ${secondary_page_slug}/hero.php
  │     ├── ${secondary_page_slug}/introduction.php
  │     ├── ${secondary_page_slug}/primary-content.php
  │     ├── ${secondary_page_slug}/supplementary-content.php
  │     └── ${secondary_page_slug}/closing.php
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
  - `${function_prefix}_body_classes()` でページ判別用クラスを追加
- `footer.php`
  - `wp_footer()` を呼び、JavaScript等を出力
  - `</body>` と `</html>` を閉じる

サイト上に見えるヘッダーとフッターのマークアップは、`template-parts/site-header.php` と `template-parts/site-footer.php` が担当します。

### `template-parts/site-header.php`

テーマ内で共通する表示ヘッダーです。

- トップURLは `home_url( '/' )`
- ロゴはWordPressのカスタムロゴを優先
- カスタムロゴ未設定時はサイト名を表示
- 主要リンクはACF、メニュー、またはWordPress標準設定から取得
- ナビゲーションは `primary` メニュー位置を使用
- メニュー未割り当て時は `inc/setup.php` のフォールバックを使用

### `template-parts/site-footer.php`

テーマ内で共通する表示フッターです。

- サイト名はWordPressの一般設定から取得
- 補助リンクはACFまたはWordPressメニューから取得
- `footer` メニューを優先し、未割り当て時は `primary` を使用
- コピーライトの年は自動生成

## `functions.php` と `inc/` の関係

`functions.php` は機能ファイルを読み込む起点です。

```text
functions.php
  ├── inc/helpers.php
  ├── inc/template-tags.php
  ├── inc/setup.php
  ├── inc/enqueue.php
  └── inc/acf-pages.php
```

### `inc/helpers.php`

テーマ全体で使う小さな共通処理を定義します。

- ACF値が空かを判定する `${function_prefix}_acf_value_absent()`
- ファイル更新日時をCSS・JavaScriptのバージョンに使う `${function_prefix}_asset_version()`

### `inc/template-tags.php`

ACF、画像、URL、HTML出力とテンプレートの間をつなぐ表示用ヘルパーを定義します。

関数例:

- `${function_prefix}_asset_uri()`: `assets/` 内のURLを生成
- `${function_prefix}_body_classes()`: ページ判別用bodyクラスを返す
- `${function_prefix}_is_theme_view()`: テーマ固有の表示対象かを判定
- `${function_prefix}_meta()`: ACF値を取得し、必要に応じて投稿メタへfallback
- `${function_prefix}_url()`: URL項目を取得
- `${function_prefix}_image()`: ACF画像またはテーマ内代替画像を安全に出力
- `${function_prefix}_text()`: 1行テキストをエスケープして出力
- `${function_prefix}_lines()`: 改行付きテキストをエスケープして出力
- `${function_prefix}_rich()`: 許可したHTMLだけを出力

各セクションテンプレートは、原則として `get_field()` を直接呼ばず、表示用ヘルパーを経由します。これにより、ACFが無効な場合や値が未入力の場合の処理を一か所にまとめます。

### `inc/setup.php`

WordPress標準機能との接続を担当します。

- title-tag、アイキャッチ、カスタムロゴ、HTML5を有効化
- `primary` と `footer` のメニュー位置を登録
- 必須プラグインが無効な場合に管理画面へ通知
- メニュー未設定時のナビゲーションを定義

### `inc/enqueue.php`

CSSとJavaScriptの登録・読み込みを担当します。

フロントページでは `front.css`、個別ページでは `${secondary_page_slug}.css` を読み分け、その後に共通CSSを読み込みます。JavaScriptライブラリを使用する場合は、依存関係を明示して登録します。

テンプレートに `<link>` や `<script>` を直接書かず、このファイルに読み込みを集約します。

### `inc/acf-pages.php`

管理画面に表示するACFフィールドをPHPで登録します。

- `group_${function_prefix}_page_front`: フロントページ用
- `group_${function_prefix}_page_${secondary_page_slug}`: 個別ページ用

フィールドグループは固定ページテンプレートによって出し分けます。画像、見出し、本文、URLなど、ページの「内容」を管理画面から変更できるようにします。

レイアウトやフィールドの種類・順番はこのPHPファイルで管理します。ACF管理画面だけで自由に項目を増やす運用にする場合は、その方針を別途明記してください。

## ACF値が表示される仕組み

個別ページの項目を例にすると、値は次の経路で表示されます。

```text
管理画面の ${secondary_page_name} 固定ページ
  ↓ 保存
${function_prefix}_${secondary_page_slug}_item_heading 等の投稿メタ
  ↓ 取得
inc/template-tags.php
  └── ${function_prefix}_text()
  ↓ 呼び出し
template-parts/${secondary_page_slug}/primary-content.php
  ↓ 表示
個別ページの対象セクション
```

画像フィールドは、メディアライブラリのURLと代替テキストを使用します。未設定時は `assets/images/` 内の代替画像と、テンプレートで指定した代替テキストを使用します。

## CSS・JavaScript・画像の関係

```text
inc/enqueue.php
  ├── assets/css/*
  ├── assets/js/*
  └── 必要に応じて外部CDN

各セクションテンプレート
  └── ${function_prefix}_image()
        ├── ACFで選択したメディア画像
        └── assets/images/* の代替画像
```

ルートの `style.css` はWordPressテーマ情報を含みます。実際の画面スタイルを `assets/css/` に分離する場合は、その方針をREADMEにも記載します。

未使用のライブラリや移植元アセットを保管する場合は、現在読み込まれていないことと、残している理由を明記します。

## 管理画面とテーマファイルの対応

| 管理画面 | 主なコード |
| --- | --- |
| 固定ページ `${front_page_title}` | `front-page.php`、`page-templates/top.php`、`template-parts/front/` |
| 固定ページ `${secondary_page_name}` | `page-templates/${secondary_page_slug}.php`、`template-parts/${secondary_page_slug}/` |
| ページ別のACF入力欄 | `inc/acf-pages.php` |
| ACF値の取得・出力 | `inc/template-tags.php` |
| 外観 → メニュー | `inc/setup.php`、`site-header.php`、`site-footer.php` |
| 外観 → カスタマイズ → ロゴ | `inc/setup.php`、`site-header.php` |
| CSS・JavaScript | `inc/enqueue.php`、`assets/` |

## ローカル構築・本番反映ツール

### ローカル初期構築

`tools-domain/run-bootstrap-site.sh` はローカルWordPressのPHP環境を探し、`bootstrap-site.php` を実行します。

`bootstrap-site.php` の処理例:

1. `${theme_name}` テーマを有効化
2. 必須プラグインがインストール済みなら有効化
3. `${front_page_title}` と `${secondary_page_name}` 固定ページを作成または更新
4. ページテンプレートを割り当て
5. `${front_page_title}` をホームページに指定
6. `${navigation_name}` メニューを作成して `primary` に割り当て

既存の固定ページを削除して作り直すのではなく、スラッグ等の安定した識別子を基準に更新します。

### 本番反映

`tools-domain/deploy-theme.sh` はテーマ固有のテーマスラッグやZIP名を設定し、`tools/deploy.sh` を呼び出します。

`tools/deploy.sh` は開発用ファイルを除外してZIPを作成し、環境変数が設定されている場合だけ本番のテーマディレクトリへ同期します。WordPressのDBや別サイトは同期対象に含めません。

詳細な配置先と注意事項は [DEPLOYMENT.md](../DEPLOYMENT.md) に記載します。

## 既存構成から独立テーマへ移行する場合

別テーマ内の専用ページを独立テーマへ移す場合は、次のように役割を整理します。

| 移行前の役割 | 独立テーマでの配置例 |
| --- | --- |
| ページ専用のHTML文書ヘッダー | `header.php` |
| ページ専用の表示ヘッダー | `template-parts/site-header.php` |
| ページ専用の表示フッター | `template-parts/site-footer.php` |
| ページ専用のHTML文書フッター | `footer.php` |
| フロントページの大きな本文ファイル | `front-page-content.php` + `template-parts/front/*.php` |
| 個別ページの大きな本文ファイル | `${secondary_page_slug}-content.php` + `template-parts/${secondary_page_slug}/*.php` |
| 親テーマ内の専用CSS・JavaScript・画像 | `assets/css/`、`assets/js/`、`assets/images/` |
| 静的HTMLの参照用コピー | PHPテンプレートへの移行後に、必要性を判断して保管または削除 |

独立テーマではテーマ全体が同じ目的を持つため、ファイル名やディレクトリ名へテーマスラッグを重複して付ける必要はありません。ただし、PHPのグローバル関数、定数、ACF key、enqueue handleには衝突を避けるための接頭辞を付けます。

## 修正するときの入口

- ページ内の文章・画像・URLを変更する: WordPress管理画面のACF
- 入力欄の追加・削除・並び替え: `inc/acf-pages.php`
- HTML構造を変更する: `template-parts/front/` または `template-parts/${secondary_page_slug}/`
- 共通ヘッダー・フッターを変更する: `template-parts/site-header.php` / `site-footer.php`
- CSS・JavaScriptの読み込みを変更する: `inc/enqueue.php`
- 見た目を変更する: `assets/css/`
- インタラクションを変更する: `assets/js/`
- メニュー位置やテーマ機能を変更する: `inc/setup.php`
- ACF値のfallbackやエスケープを変更する: `inc/template-tags.php`

ACF値はテンプレートから直接 `echo` せず、用途に合った表示用ヘルパーを使用してください。
