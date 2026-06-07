# `inc/` ディレクトリの説明

`inc/` には、テーマの中でも「表示そのものではなく、土台になる処理」を集めています。  
ここにあるファイルは、管理画面の入力項目、投稿タイプ、共通の取得処理、資産の読み込み、テーマ初期設定を担当します。

## `inc/enqueue.php`

CSS と JavaScript の読み込みをまとめています。

- どのページでどの CSS を使うかを決める
- 共通で使うライブラリを順番に読み込む
- WordPress の指定したタイミングで自動実行する

このテーマではページごとに見た目が大きく違うため、ここで読み込み対象を切り替えています。  
`inc/ENQUEUE.md` に詳細な解説があります。

## `inc/helpers.php`

他のファイルから使う小さな共通関数を置いています。

- テーマ内のパスを整える
- ACF の値が空かどうかを判定する
- 資産ファイルの更新時刻からバージョンを作る

処理の本体というより、他の処理を安定して動かすための基礎部品です。

## `inc/acf-pages.php`

管理画面で編集する項目を定義しています。

- 店舗共通情報のオプションページを登録する
- トップページや各下層ページの編集項目を登録する
- `drink` / `food` / `news` の追加項目を登録する

ここで定義された内容が、各テンプレートから参照されます。  
たとえば見出し、本文、画像、URL などの入力欄はこのファイルで決まります。

## `inc/cpt.php`

カスタム投稿タイプとタクソノミーを登録しています。

- `drink` は飲み物用の投稿タイプ
- `food` は料理用の投稿タイプ
- `news` はお知らせ用の投稿タイプ
- それぞれに対応するカテゴリーも登録する
- 初期状態で使うタームを用意する

固定ページだけでは数が増減するデータを管理しづらいため、ここで専用の投稿タイプを用意しています。

## `inc/setup.php`

テーマ全体の初期設定を入れています。

- テーマサポートを有効にする
- メニュー位置を登録する
- ACF が無効なときに管理画面へ注意を出す
- メニュー未設定時のフォールバックを用意する

テーマが最初に持つべき基本情報をここでまとめています。

## `inc/template-tags.php`

テンプレートから呼び出す共通の出力関数をまとめています。

- テーマ資産の URL を作る
- `body_class()` に使うクラスを返す
- 現在のページに応じて値を取得する
- 画像、テキスト、複数行テキスト、リッチテキストを安全に出力する
- 投稿タイプの一覧や焼酎セクションを描画する
- メニューのフォールバックを出す

テンプレート側は、このファイルにある関数を呼ぶことで、表示ロジックを簡潔に保っています。

## 使い分けの目安

- 「何を読み込むか」を見たいなら `enqueue.php`
- 「共通の小関数」を見たいなら `helpers.php`
- 「管理画面の入力欄」を見たいなら `acf-pages.php`
- 「投稿タイプや分類」を見たいなら `cpt.php`
- 「テーマの初期設定」を見たいなら `setup.php`
- 「テンプレートから呼ばれる表示処理」を見たいなら `template-tags.php`

## 補足

`inc/ENQUEUE.md` は `inc/enqueue.php` 専用の説明です。  
`INC.md` は `inc/` ディレクトリ全体の見取り図として使います。

## 具体例

### テンプレート内で値を出す

`inc/template-tags.php` にある関数は、ページテンプレートや `template-parts/` から呼び出します。

```php
<section class="hero">
	<h1><?php theme_text( 'front_heading', '焼酎と料理を楽しむ居酒屋' ); ?></h1>
	<div class="hero__lead">
		<?php theme_rich( 'front_lead', '<p>本文がまだ未設定です。</p>' ); ?>
	</div>
</section>
```

### 画像を扱う

画像フィールドは、画像が入っていればその画像を、未設定ならフォールバック画像を返します。

```php
<div class="hero__image">
	<?php theme_image( 'front_hero_image', 'images/home/mv01__pc.jpg', 'トップ画像' ); ?>
</div>
```

### 投稿タイプの一覧を出す

`inc/template-tags.php` には、`drink` や `news` の一覧を描画する関数もあります。

```php
<?php
$posts = theme_get_section_posts( 'drink', 'drink_category', 'genshu' );
if ( $posts ) {
	theme_render_menu_posts( $posts, 'drink_price' );
}
?>
```

### 読み込み処理を登録する

`inc/enqueue.php` は HTML の中ではなく、WordPress の読み込みタイミングで実行します。

```php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_assets' );
```

### ACF がなくても値を読む

ACF が無効でも投稿メタを読みに行き、値がなければフォールバックを返します。

```php
$phone = theme_option( 'shop_phone', '000-0000-0000' );
$url   = theme_option_url( 'shop_contact_url', '#' );
```

## PHP の見方

ここで使っている PHP は、画面の中で順番に処理を書くというより、`add_action()` や `add_filter()` で「いつ何をするか」を登録していく形です。  
JavaScript の `addEventListener()` に近い感覚で、イベントやタイミングに処理をぶら下げます。

その上で、`inc/` の中では大きく次のような役割分担になっています。

- `setup.php` はテーマの基本設定を登録する
- `cpt.php` は投稿タイプと分類の器を登録する
- `acf-pages.php` は管理画面の入力欄を登録する
- `enqueue.php` は読み込む CSS と JavaScript を登録する
- `helpers.php` と `template-tags.php` は、登録した値を取り出したり出力したりする

実際の使い方は、「まず登録する」「そのあとテンプレートで呼ぶ」という流れです。  
たとえば `cpt.php` で投稿タイプを登録し、`template-tags.php` でその投稿を取り出して、`page-templates/` や `template-parts/` で表示します。

## ファイル構成の慣習

WordPress には、必須の名前と、よく使われる慣習的な分け方があります。

- `functions.php` はテーマの起点になる
- `header.php` / `footer.php` / `index.php` / `page.php` / `front-page.php` は WordPress の標準テンプレート階層に沿う
- `template-parts/` は表示の部品を置く
- `page-templates/` は固定ページ用のテンプレートを分ける
- `assets/` は CSS / JavaScript / 画像を置く
- `languages/` は翻訳ファイルを置く
- `inc/` は共通処理をまとめるためによく使われるが、必須ではない

`inc/` の中身は、開発者やチームによって名前や分割が少し変わります。  
ただし役割の考え方は共通で、設定、登録、取得、出力に分けると整理しやすくなります。

このテーマは、`functions.php` を起点に `inc/` を読み込み、`template-parts/` と `page-templates/` で表示を組み立てています。  
そのため、構成としては WordPress の一般的なテーマ分割にかなり沿っています。

一方で、`inc/` の切り方そのものは固定ルールではありません。  
たとえば `setup.php` と `helpers.php` を一つにまとめる作り方もありますし、逆にさらに細かく分ける作り方もあります。  
このテーマは、読みやすさと保守のしやすさを優先して、機能ごとに分けている形です。
