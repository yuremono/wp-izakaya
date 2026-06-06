# WordPress Theme Template

静的 HTML をクラシック WordPress テーマへ移植するための汎用基盤です。トップページ、追加固定ページ、共通ヘッダー、空のフッター、ACF の最小例、初期構築・デプロイ補助を含みます。

## 使い始める

このディレクトリを直接案件用に書き換えず、最初にプロジェクト全体をコピーしてください。コピー先で次の値を一括置換します。

| プレースホルダー・初期値 | 置換内容 |
| --- | --- |
| `${theme_name}` / `Example Theme` | テーマ表示名 |
| `${theme_slug}` / `example-theme` | テーマディレクトリと text domain |
| `${page_name}` / `Example` | 追加ページ名 |
| `${page_slug}` / `example` | 追加ページスラッグ |
| `${local_wp_path}` | ローカルの `wp-load.php` |
| `${production_theme_path}` | 本番テーマ配置先 |

特に `style.css`、`functions.php`、`inc/acf-pages.php`、`tools-domain/*.example.*` を確認してください。公開後の ACF `group_*` / `field_*` キーは変更しません。

## 構成

- `page-templates/top.php`: トップ固定ページ用テンプレート
- `page-templates/example.php`: コピーして使う追加ページ例
- `template-parts/site-header.php`: 維持して使う共通表示ヘッダー
- `template-parts/site-footer.php`: 案件ごとに中身を追加する空の骨格
- `template-parts/front/example.php`: トップのセクション例
- `template-parts/example/example.php`: 追加ページのセクション例
- `inc/template-tags.php`: ACF fallback、画像、URL、安全な出力
- `inc/acf-pages.php`: text、textarea、image、URL、WYSIWYG の最小例
- `tools-domain/`: コピー後に設定値を変更して使う案件固有ツール

`assets/css/`、`assets/js/`、`assets/images/` は案件の静的サイト資産を置く領域です。

## 初期構築

1. `tools/local-wp-load.path.example` を `tools/local-wp-load.path` へコピーし、`${local_wp_path}` を記入する。
2. `tools-domain/bootstrap-site.example.php` 冒頭の `$config` を案件値へ変更する。
3. 対象 WordPress を確認してから `tools-domain/run-bootstrap-site.example.sh` を実行する。

初期構築は既存ページとメニューを更新するため、コピー前や設定確認前には実行しません。

## 検証

```bash
find . -name '*.php' -not -path './vendor/*' -print0 | xargs -0 -n1 php -l
composer run phpcs
rtk git diff --check
```

本番反映は [DEPLOYMENT.md](./DEPLOYMENT.md)、詳細構成は [docs/theme.example.md](./docs/theme.example.md) を参照してください。
