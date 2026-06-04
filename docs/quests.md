# Quests ページ構成

Quests 系ページを WordPress 化したときの FileTree と作業工程をまとめたメモです。
`html-to-wp` スキルの流れをベースにしつつ、このプロジェクトで実際に必要だった差分も含めています。

## FileTree

```text
header-quests.php
footer-quests.php
inc/quests-static.php
page-templates/
  page-quests.php
  page-quests-service.php
template-parts/
  quests/
    header.php
    footer.php
    content-top.php
    content-service.php
assets/
  quests/
    index.html
    service.html
    css/
      common.css
      common_style.css
      style.css
      service_html.css
    js/
      function.js
      flipsnap.min.js
      slick/
      scroll-hint/
      magnific-popup/
    images/
      home/
      picture/
      placeholder/
```

## 実装工程

1. 既存の静的 HTML を確認し、Quests のトップページとサービスページを切り出した。
2. 共通の WordPress 側構成として `header-quests.php` と `footer-quests.php` を用意した。
3. `page-templates/page-quests.php` と `page-templates/page-quests-service.php` を作成し、各ページを専用テンプレートに分岐した。
4. `inc/quests-static.php` に `theme_quests_source_uri()` と `theme_quests_body_classes()` を実装し、静的アセット参照と body class を共通化した。
5. `template-parts/quests/content-top.php` と `template-parts/quests/content-service.php` に本文を移植した。
6. `assets/quests/index.html` と `assets/quests/service.html` の head / script / stylesheet の並びを確認し、元のコピーと差分が出ないよう調整した。
7. `assets/quests/index.html` に混入していた重複 canonical を整理した。
8. サービスページの画像参照を `theme_quests_source_uri()` 経由に統一した。
9. `docs/quests.md` を、現在の FileTree と作業工程に合わせて更新した。

## このプロジェクトで追加で必要だった確認

`html-to-wp` の標準的な流れだけでは足りず、以下を実際のプロジェクト状態から判断して追加した。

- 静的 HTML と WordPress テンプレートの読み込み順比較
- `assets/quests/index.html` の重複 canonical の整理
- サービスページ画像の helper 化
- 静的コピーと PHP テンプレートの参照先差分の照合

