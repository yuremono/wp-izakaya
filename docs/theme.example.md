# ${theme_name} テーマ構成ガイド

このファイルは、コピーして作る案件テーマの構成例です。テンプレート基盤を直接書き換えず、ディレクトリ全体をコピーした後で `${theme_name}`、`${theme_slug}`、`${page_name}`、`${page_slug}` を置換してください。

## 表示フロー

```text
front-page.php または page-templates/top.php
  ├── header.php
  ├── template-parts/site-header.php
  ├── template-parts/front-page-content.php
  │   └── template-parts/front/example.php
  ├── template-parts/site-footer.php
  └── footer.php

page-templates/example.php
  ├── header.php
  ├── template-parts/site-header.php
  ├── template-parts/example-page-content.php
  │   └── template-parts/example/example.php
  ├── template-parts/site-footer.php
  └── footer.php
```

## 役割

- `header.php`: HTML 文書開始、`wp_head()`、body class。
- `site-header.php`: ロゴ、CONTACT、`primary` メニュー。案件間で再利用する。
- `front-page-content.php` / `example-page-content.php`: `#contents_wrap`、`#contents`、`#main`、`#col_main`、`section` の骨格。
- `site-footer.php`: 空のフッター骨格。案件ごとに内容を追加する。
- `inc/template-tags.php`: ACF 無効時の投稿メタ fallback と用途別エスケープ。
- `inc/acf-pages.php`: 最小フィールド例。公開前に `example` を案件接頭辞へ置換する。
- `inc/enqueue.php`: 現在の CSS / JavaScript ディレクトリ構成を読み込む。

## ページを増やす

1. `page-templates/example.php` をコピーし、短いページ名へ変更する。
2. `template-parts/example-page-content.php` と `template-parts/example/example.php` をコピーする。
3. `get_template_part()` と ACF の `page_template` 条件を新しいパスへ変更する。
4. ACF の key と name は公開前に確定し、公開後は変更しない。

## 安全な出力

- 通常テキスト: `theme_text()`
- 改行テキスト: `theme_lines()`
- URL: `theme_url()` の戻り値を `esc_url()`
- 画像: `theme_image()`
- 許可 HTML: `theme_rich()`

ACF の戻り値を直接 `echo` しません。
