---
name: html-to-wp
description: 別ディレクトリの静的 HTML サイトを、現在の WordPress クラシックテーマ基盤へ移植する。既存実装の検出、資産移植、ページテンプレート化、共通部品化、管理画面化の前段までを扱う。
---

# html-to-wp

別ディレクトリにある静的 HTML サイトを、作業先リポジトリの既存 WordPress テーマ構成へ移植するときに使う。

## 前提条件

- 作業先は、WP Template Directory をユーザーが複製し、案件固有名へリネームしたテーマディレクトリとする。
- WP Template Directory 自体を案件用に編集しない。
- 移植元は `/Users/yanoseiji/projects/0604past-works/` 内にあり、ユーザーが事前に用意したドメイン名のディレクトリを静的 HTML サイトとして参照する。
- ユーザーが Local by Flywheel に WordPress をインストール済みであることを前提とする。
- ユーザーが Xserver に公開先の新規サブディレクトリを作成済みであることを前提とする。
- Local の WordPress テーマディレクトリへ、案件固有テーマディレクトリを指すシンボリックリンクを作成してから移植作業を開始する。
- シンボリックリンク名は案件固有テーマのディレクトリ名と一致させ、既存リンクや実ディレクトリを誤って上書きしないことを確認する。
- Local のサイトパス、テーマディレクトリ、公開先サブディレクトリなど前提情報が不足または矛盾している場合は、作業を中断してユーザーへ確認する。

## GitHub 運用

- WP Template Directory ではcommit / pushを行わない。
- `html-to-wp` の移植作業中は、複製された案件固有テーマでもcommit / pushを行わない。
- ローカル表示と実装内容に問題がないことをユーザーが確認するまで、新規GitHubリポジトリを作成しない。
- ユーザー確認後に案件固有テーマ用の新規GitHubリポジトリを作成し、完成状態をcommitしてSSH形式のリモートURLへpushする。

## 最優先ルール

- 作業先の `AGENTS.md`、`README.md`、`docs/theme.example.md`、実ファイルを正とし、このスキルの例より優先する。
- テンプレート基盤を直接案件化せず、案件用にコピーされた作業先で実装する。
- 移植元ディレクトリは参照専用とし、HTML、CSS、JavaScript、画像を編集しない。
- `.bak` は読込・編集・削除しない。
- 作業開始前に、対象工程がすでに実施済みか確認する。既存ファイルを機械的に上書きしない。
- ユーザーの未コミット変更を保持し、関係のない変更を戻さない。
- puppeteer は使わない。

## 目的

- 元サイトの見た目、DOM 構造、既存クラス、資産パスの意味、読み込み順、ページ間リンクを保つ。
- 現行テーマの責務分離、helper、ACF fallback、メニュー、エスケープ規約へ適合させる。
- 共通ヘッダー、共通フッター、ページ本文、ページ別アセットを重複なく分離する。
- 移植後に WordPress の URL、管理画面、デプロイへ段階的に移行できる状態を作る。

## 現行テーマ基盤の前提

作業先に同等の構成がある場合は、新しい方式を追加せず既存構成を拡張する。

```text
header.php
  HTML 文書開始、language_attributes()、wp_head()、body_class()、wp_body_open()

footer.php
  wp_footer()、閉じタグ

template-parts/site-header.php
  共通表示ヘッダー

template-parts/site-footer.php
  共通表示フッター

front-page.php / page-templates/*.php
  ページの組み立て

template-parts/*-page-content.php
  #contents_wrap 以下のページ骨格

template-parts/<page>/*.php
  ページ固有セクション

inc/enqueue.php
  CSS / JavaScript の登録、依存、ページ条件

inc/helpers.php
  資産バージョンなどの低レベル helper

inc/template-tags.php
  資産 URI、body class、ページ判定、ACF fallback、安全な出力

inc/acf-pages.php
  ACF ローカルフィールド
```

- 通常は `get_header( 'name' )` / `get_footer( 'name' )` 用の専用 header/footer を新設しない。
- 静的サイトの `<header>` / `<footer>` は、それぞれ `site-header.php` / `site-footer.php` へ移す。
- `header.php` / `footer.php` は WordPress の文書骨格として維持する。
- `theme_source_uri()`、`theme_asset_version()`、`theme_meta()`、`theme_image()`、`theme_text()`、`theme_lines()`、`theme_rich()` など既存 helper があれば再利用する。
- PHP グローバル関数、ACF name は `snake_case`、新規独自 CSS クラスはプロジェクト規約に従う。移植元の既存クラスは変更しない。

## フェーズ 0: 読み取り専用の事前調査

編集前に、作業先と移植元を分けて調査する。

### 作業先

1. `AGENTS.md` と参照先の指示を読む。
2. `git status --short` で既存変更を把握する。
3. `README.md`、`docs/theme.example.md`、`functions.php` を読む。
4. `header.php`、`footer.php`、`front-page.php`、`page-templates/`、`template-parts/` を確認する。
5. `inc/enqueue.php`、`inc/helpers.php`、`inc/template-tags.php`、`inc/acf-pages.php` を確認する。
6. `assets/` を確認し、移植済みの CSS、JavaScript、画像がないか調べる。
7. `composer.json`、テスト、PHPCS、デプロイ手順を確認する。

### 移植元

1. 入口となる全 HTML と対応するページ名を列挙する。
2. 各 HTML の `head`、表示ヘッダー、本文、表示フッター、末尾 script を分離して比較する。
3. CSS、JavaScript、画像、フォント、iframe、外部 CDN を一覧化する。
4. HTML 内の `src`、`href`、CSS の `url()`、JavaScript 内の資産参照を確認する。
5. ページ別 CSS と共通 CSS、ページ別本文と共通部品を分類する。
6. 静的出力に含まれる動的生成物や外部サービス由来のスナップショットを特定する。

## 実施済み工程の判定

作業前に、次の状態を「未実施」「一部実施」「完了」に分類する。

- 案件名、テーマ名、slug、text domain の置換
- 静的資産の `assets/` へのコピー
- 共通ヘッダーとフッターの移植
- トップページ本文の移植
- 下層ページテンプレートの作成
- ページ別 CSS / JavaScript の enqueue
- 静的リンクの WordPress URL 化
- メニュー化
- ACF / CPT 化
- 初期ページ、メニュー、デモデータの投入
- ローカル表示確認
- 本番反映設定

一部実施済みの場合は、既存実装の意図と差分を確認して不足分だけを補う。完成済みの工程を別方式で作り直さない。

## 変換計画

編集前にページ対応表を作る。

| 静的 HTML | WordPress 側 | 本文パーツ | ページ別 CSS | 備考 |
| --- | --- | --- | --- | --- |
| `index.html` | `front-page.php` または `page-templates/top.php` | `template-parts/front-page-content.php` 以下 | 対応する CSS | トップ |
| 下層 HTML | `page-templates/<slug>.php` | `template-parts/<slug>-page-content.php` 以下 | 対応する CSS | 固定ページ |

表には全ページを含め、slug、テンプレート名、ナビゲーション表示名も確定する。

## 推奨実装順

1. 作業先の案件用プレースホルダーが未置換なら、`README.md` と `docs/theme.example.md` に従って置換する。
2. 移植元の `css/`、`js/`、`images/`、`img/` など必要資産を、構造を保って作業先の `assets/` へコピーする。
3. 参照されていない管理画面用画像や不要な生成物は、参照調査なしに全コピーしない。
4. 共通表示ヘッダーを `template-parts/site-header.php` へ移植する。
5. 共通表示フッターを `template-parts/site-footer.php` へ移植する。
6. トップ本文を `front-page-content.php` と `template-parts/front/` 以下へ分割する。
7. 下層ページごとに `page-templates/<slug>.php`、`<slug>-page-content.php`、`template-parts/<slug>/` を作る。
8. `theme_is_custom_view()` と `theme_body_classes()` を全移植ページへ拡張する。
9. CSS / JavaScript を `inc/enqueue.php` に集約し、共通とページ固有を条件分岐する。
10. 画像、内部リンク、外部リンク、電話、アンカー、iframe を用途別に変換する。
11. 必要なページとメニューの初期構築ツールを案件値へ調整する。
12. 静的 HTML と WordPress 出力を比較し、構造と表示を確認する。
13. 表示が安定してから、管理画面化が必要な項目だけを ACF / CPT / `wp_nav_menu()` へ移す。

## HTML の切り分け

- `<html>`、`<head>`、`<body>` は本文パーツへコピーしない。
- 静的 `<header id="global_header">` は `site-header.php` の候補。
- 静的 `<footer id="global_footer">` は `site-footer.php` の候補。
- `#contents_wrap` 以下は各 `*-page-content.php` の候補。
- 複数ページで完全一致する本文ブロックだけを共通テンプレートパーツにする。
- ページ固有のまとまりは `template-parts/<slug>/` へ置く。
- 既存 JS の selector に使われている空要素、ID、class は、参照確認前に削除しない。
- 静的 HTML の不正な入れ子や重複 ID は、まず再現し、表示確認後に影響を調べて直す。

## アセット移植

- 移植元のディレクトリ構造を極力保ち、機械的な参照変換を可能にする。
- HTML の画像は `theme_source_uri()` または既存の画像 helper を使い、`esc_url()` する。
- CSS 内の相対 `url()` は、CSS の配置先を変えると壊れるため必ず確認する。
- JavaScript 内の相対パスも検索する。
- ファイル名の大文字小文字を変えない。
- `img/` と `images/` のように複数ルートがある場合は、統合による衝突を避け、必要なら両方を `assets/` 下へ保持する。
- HTML が参照するファイルの存在確認を行い、元から欠損している参照と移植漏れを区別する。
- 静的 HTML 自体を保存用としてテーマへコピーするのは、ユーザーが求める場合か、比較用成果物として明確な用途がある場合だけにする。

## enqueue 設計

- `inc/enqueue.php` の既存関数を拡張し、別の enqueue 系統を重複作成しない。
- 共通 CSS、ページ別 CSS、共通 JavaScript、ページ別 JavaScriptを分類する。
- 静的 HTML の読み込み順を記録し、WordPress の依存配列へ置き換える。
- ページ固有アセットは `is_front_page()` / `is_page_template()` などで限定する。
- 依存配列には、登録または enqueue される handle だけを書く。
- handle は `theme-` + kebab-case とする。
- ローカル資産の version は既存の `theme_asset_version()` を使う。
- WordPress 同梱 jQuery を優先し、外部 jQuery と二重読み込みしない。
- `$` グローバルが必要なら、対象ページ群に限定して既存方式の互換処理を使う。
- footer や本文へ script を直書きせず、原則 enqueue する。
- `async`、`defer`、inline script が順序に影響する場合は、その属性と実行位置を維持する実装を選ぶ。
- 実際に使われていない plugin や CDN は、HTML に記載されているだけで無条件に移植しない。JS / DOM / CSS の参照を確認する。
- Google Analytics などの計測コードは、ID と運用要件を確認し、開発環境で意図せず送信しない。

## URL とナビゲーション

- `index.html` は `home_url( '/' )` へ変換する。
- 下層の `*.html` は、確定した固定ページ URL、`get_permalink()`、専用 URL helper、または `wp_nav_menu()` へ変換する。
- `#anchor`、`tel:`、`mailto:`、外部 URL は静的ページリンクと区別する。
- 未確定リンクは勝手に公開 URL を推測せず、ダミーであることを記録する。
- `target="_blank"` の外部リンクには `rel="noopener noreferrer"` を付ける。
- 共通ナビゲーションは最終的に `wp_nav_menu()` を優先するが、初期再現時は固定 HTML を保ってもよい。
- メニュー化する場合は、既存 `primary` / `footer` location と fallback を再利用する。
- ナビゲーションの表示名、順序、現在ページ class、スマートフォンメニューの selector を維持する。

## 管理画面化

- 静的 HTML の全要素を最初から ACF 化しない。まず固定テンプレートで表示を安定させる。
- ACF は `inc/acf-pages.php`、値取得と出力は `inc/template-tags.php` に集約する。
- ACF 無効時は投稿メタへ fallback し、fatal error を起こさない。
- ACF key は `group_pc_*` / `field_pc_*` または案件で確定した固定接頭辞を使い、公開後に変更しない。
- text、textarea、URL、画像、WYSIWYG は既存 helper とエスケープ方式を再利用する。
- 編集頻度の高い単体文言、画像、CTA は ACF の候補。
- 投稿、事例、商品、メニュー、FAQ など増減・並び替えが必要な一覧は CPT を検討する。
- 静的な SNS 埋め込み一覧は、更新方法を確認してから CPT、外部 API、埋め込み、固定 HTML のいずれかを選ぶ。
- 初期データ投入は既存内容を上書きせず、未設定値だけを補完する。

## セキュリティと出力

- 通常テキストは `esc_html()` または `theme_text()`。
- 属性値は `esc_attr()`。
- URL は `esc_url()`。
- 改行テキストは既存の `theme_lines()`。
- 画像は既存の `theme_image()` または用途に合う WordPress 画像 API。
- 許可 HTML は `wp_kses()` または `theme_rich()`。
- iframe は許可ドメインと属性を限定して出力する。
- 管理画面値、投稿メタ、URL パラメータを未エスケープで出力しない。
- 外部 script、古いライブラリ、追跡コードは、必要性とリスクを確認してから導入する。

## 既存テーマとの干渉確認

- `body_class()` の追加 class と CSS selector を確認する。
- `visibility: hidden`、ローディング、overlay、scroll lock、pending class がないか確認する。
- 共通 JS を除外する場合、JS が解除する前提の class や要素も対象ページから除外する。
- `theme_is_custom_view()` の追加漏れでアセットが読み込まれない状態を防ぐ。
- `theme_body_classes()` が全下層ページをトップ扱いしないよう、ページ別 class を設計する。
- `page.php` や `index.php` など、移植対象外ページの挙動を壊さない。

## 検証

### 静的比較

- 全ページについて、header、本文、footer、CSS、JavaScript、画像、リンクの対応を確認する。
- 元 HTML に存在する参照先が、移植先にも存在するか機械的に確認する。
- 共通部品の差分が意図したページ固有差分だけか確認する。

### HTTP / DOM

- `curl -sS -D - <url>` で HTTP `200` を確認する。
- HTML に `wp_head()` / `wp_footer()` の出力があることを確認する。
- 対象本文、body class、ページ別 CSS / JavaScript が出力されることを確認する。
- 二重 script、404 asset、不要な pending class、意図しないダミーリンクがないことを確認する。

### ブラウザ

- プロジェクトで指定されたブラウザ手段を使い、puppeteer は使わない。
- デスクトップとモバイル幅で、初期表示、画像、メニュー、アンカー、スライダー、モーダル、スクロール、iframe を確認する。
- コンソールの JavaScript error とネットワークの 404 を確認する。
- JavaScript 有効時と、必要に応じて無効時の初期表示を確認する。

### コード

```bash
find . -name '*.php' -not -path './vendor/*' -print0 | xargs -0 -n1 php -l
composer run phpcs
rtk git diff --check
```

- リポジトリのテストを実行する。
- テスト対象がある場合は最小カバレッジ 80% を維持する。
- Composer、WordPress、ローカル URL などがなく実行できない検証は、理由と未確認範囲を報告する。

## 完了条件

- 対象となる全静的ページに WordPress 側の対応先がある。
- 共通 header / footer とページ固有本文の責務が分離されている。
- CSS / JavaScript が必要なページだけへ正しい順序で読み込まれる。
- 画像、内部リンク、外部リンク、電話、アンカー、iframe が用途に合う形で動作する。
- `wp_head()`、`wp_footer()`、`body_class()`、`wp_body_open()` が保たれている。
- ACF が無効でも fatal error にならない。
- PHP lint、PHPCS、diff check、既存テスト、ブラウザ確認の結果が記録されている。
- 移植元と無関係な作業先ファイルを変更していない。
- 移植元ディレクトリを変更していない。

## やってはいけないこと

- 移植元 HTML を直接編集して辻褄を合わせる。
- 現行テーマに既存の header/footer/helper/enqueue があるのに、並行する独自方式を追加する。
- 全ページを一つの巨大テンプレートへ貼り付ける。
- すでに完了している資産コピーやテンプレート化を無条件にやり直す。
- 静的リンクを根拠なく仮 slug へ置換する。
- ACF の存在を前提に直接 `get_field()` の結果を出力する。
- CSS 内 `url()` や JavaScript 内の相対参照を確認せず、資産ディレクトリを再編する。
- 古い外部ライブラリや計測コードを必要性の確認なしにそのまま有効化する。
- 表示確認だけで完了とし、lint、PHPCS、リンク、404、コンソール error を確認しない。
