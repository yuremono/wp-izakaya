# Deployment Notes

Local WP からレンタルサーバーへ移すときのメモ。日常更新の手順は [UPDATE_TO_PROD.md](./UPDATE_TO_PROD.md) を参照する。

## Xserver 契約後に先にやること

DNS 反映待ちの間でも、次の作業はこのリポジトリ内だけで進められる。

1. `npm run deploy -- --zip-only --no-phpcs` を実行して、`assets/theme.css` と `assets/tailwind.css`、`assets/mindmap-runtime.js` を最新化し、配布用 ZIP を作る。
2. `composer install` 後に `composer run phpcs` を通し、PHP の静的チェックを済ませる。
3. `exports/yuremono-wp-content.xml` を作る。
4. `README.md` の公開前チェックリストを見ながら、フォーム文言、メニュー、固定ページ、`work`、`news` の最終確認をする。
5. Local 用の初期データ投入スクリプトを使うなら、対象サイトを間違えないように `tools/AGENTS.md` を先に読む。
6. `tools/local-wp-load.path.example` は、Local 用の `wp-load.php` パスを確認したいときの参照にする。

## 生成済みファイル

- `dist/0520portfolio-wp-theme.zip`: テーマアップロード用 ZIP。
- `exports/yuremono-wp-content.xml`: WordPress インポーター用の投稿・固定ページ・CPT エクスポート。
- `exports/yuremono-wp-db.sql`: Local WP の DB エクスポート。

`dist/` と `exports/` はローカル生成物なので Git 管理しない。

## 本番側でやること

1. WordPress をインストールする。
2. ACF、Contact Form 7、SEO SIMPLE PACK、WP Multibyte Patch、UpdraftPlus を入れる。
3. テーマをアップロードするか、SSH と `DEPLOY_*` が使えるなら `npm run deploy -- --delete` で同期する。
4. テーマを有効化する。
5. `exports/yuremono-wp-content.xml` を WordPress インポーターで取り込む。SSH と WP-CLI が使えるなら、`npm run deploy:prod` でテーマ同期と合わせて実行できる。
6. メディア、固定ページ、Works、お知らせ、メニューを確認する。
7. 表示設定でホームページを固定ページにする。
8. パーマリンクを保存する。
9. Contact Form 7 の送信先・送信元を本番ドメイン用に直す。
10. SEO SIMPLE PACK のトップページ description、OGP画像、各ページのメタ情報を確認する。
11. SSL を有効化し、管理画面とフロントが HTTPS で開くことを確認する。
12. バックアップ、スマホ表示、フォーム送信を確認する。
13. DNS 反映後に、旧 URL が残っていないかと mixed content が出ていないかを確認する。

## 注意

- `exports/yuremono-wp-db.sql` は丸ごと移行や復元確認用。既存本番 DB に直接流すと上書き事故につながるため、通常は WXR インポートを優先する。
- `wp import` は何度も流すと投稿や固定ページが増えることがある。XML が更新されたときだけ使う。
- Local URL は `http://localhost:10008`。本番移行後は URL 置換や画像URLを必ず確認する。
- DNS 反映待ちの間は、本番側の一時 URL や `hosts` 切り替えで表示確認だけ先に進める。
- 本番公開前に、デモ文言、仮メールアドレス、仮住所、不要な固定ページを確認する。
- `npm run deploy -- --delete` は、`DEPLOY_PATH` が正しいことを確認してから使う。

## `npm run deploy` の設定

本番同期を使う場合は、次の環境変数を設定するか、リポジトリ直下の `.env.deploy` に書く。`tools/deploy.sh` は `.env.deploy` があれば自動で読む。

```bash
DEPLOY_HOST="example.com" \
DEPLOY_USER="example" \
DEPLOY_PATH="/home/example/www/example.com/public_html/wp-content/themes/0520portfolio-wp" \
npm run deploy -- --delete
```

- `DEPLOY_DELETE=1` を付けると、ローカルにないファイルを本番からも消す。
- `--zip-only` を付けると、ZIP 作成だけで止める。
- `--no-phpcs` を付けると、PHP の静的チェックを飛ばして ZIP 作成だけにできる。
- `--import-xml` を付けると、ZIP 作成と本番テーマ同期のあとに `exports/yuremono-wp-content.xml` を本番へ取り込む。
- `PORTFOLIO_PHP` を指定すると、PHP の実行バイナリを固定できる。

## 手順の入口

- 作業コマンドの一覧は `tools/AGENTS.md` を見る。
- まず配布用 ZIP を作るなら `npm run deploy -- --zip-only --no-phpcs` を使う。
- 本番へ直接同期するなら `DEPLOY_HOST` / `DEPLOY_USER` / `DEPLOY_PATH` を設定して `npm run deploy -- --delete` を使う。
- テーマ同期と XML 取り込みをまとめるなら `npm run deploy:prod` を使う。
