# Quests 改善チェックリスト

`NOTE.2.md` の改善意見に基づく作業ログ。作業を中断した場合は、このファイルの「再開メモ」から続ける。

## 作業項目

- [x] ヘッダー/フッターの固定文言を WordPress 標準情報または ACF 入力に置き換える
- [x] CONTACT / LINE / Instagram URL を管理画面から変更できるようにする
- [x] 主要画像を ACF 画像フィールドで差し替え可能にする
- [x] 画像の alt をメディアライブラリの代替テキストまたは説明文から出す
- [x] ACF 無効時の管理画面注意表示を追加する
- [x] README に実装意図・編集可能項目・CSS 配置方針を追記する
- [x] 生成元由来の `id="c***"` を cssファイルとhtmlタグどちらもclass に置き換える
- [x] PHP 構文チェックと差分チェックを実行する

## 保留・後続候補

- [x] 料金表・対応エリア表を HTML 入力から固定数フィールドへ移行する
- [x] `front-page-content.php` をセクション単位に分割する
- [x] `service-page-content.php` をセクション単位に分割する
- [x] CSS / JS ライブラリの利用状況を棚卸しし、README に記録する
- [x] 主要IDに同名classは併記済み。#contents .c***で対応

## 再開メモ

- 主要実装と検証は完了。`php -l` と `git diff --check` は通過した。
- `composer.json` がないため、README記載の `composer run phpcs` は未実行。
- ACF Pro は使わず、固定ページテンプレートの ACF フィールドで対応した。
- `href="#"` は NOTE 内で「現状維持」の判断があるため、本文中のSNS風投稿などは原則触っていない。ヘッダー/フッター/CTAなど運用上必要なリンクだけ改善対象にした。

- ユーザーが下記をもとに/Users/yanoseiji/projects/0605quests/inc/acf-quests-pages.phpを編集。cssで元々非表示だったdivをhtml上で削除したため、ACF設定を削除したつもりだが、不備があるかもしれない。不自然に行が開いている箇所がそう。
「 調べた限り、指定ID削除に関して theme_quests_image() 由来のACF画
  像フィールドが直接問題になる箇所はありません。

  ただし、HTMLだけ削除すると「管理画面に残るが表示されないACFテキ
  スト項目」はあります。

  - service c351 / c353: inc/acf-quests-pages.php:159 の
    quests_service_about_*

  - service c266 / c299: inc/acf-quests-pages.php:163 の
    quests_service_intro_*

  - service c326: inc/acf-quests-pages.php:166 の
    quests_service_point_1_*

  - service c329: inc/acf-quests-pages.php:169 の
    quests_service_point_2_*

  - front c344: inc/acf-quests-pages.php:126 の quests_life_1_*

  今回追加した画像ACFで該当しそうな
  quests_service_point_image_1〜4 は、現状 template-parts/
  service-page-content.php:60 の別ブロック側で使われています。指
  定ID群そのものではありません。

  結論: フロント表示上は削除だけでも壊れません。ただし管理画面の
  混乱を避けるなら、上記の表示先が消えたACFフィールドも inc/acf-
  quests-pages.php から削除するのが妥当です。」

## 今回の確認結果

- サービスページから表示先が消えた `quests_service_about_*`、`quests_service_intro_*`、`quests_service_point_1_*`、`quests_service_point_2_*` は ACF 定義から削除した。
- トップページの `quests_life_1_heading` と `quests_life_1_body` は `template-parts/front/life.php` で使用中のため維持した。
- 不自然な空行は構文上の問題ではなかったが、削除対象の周辺を整理した。
