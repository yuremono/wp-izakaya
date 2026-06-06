# tools-domain/

テーマごとに値を変更する補助ツールの雛形を置く。

## 使用前の手順

1. このリポジトリ自体を直接案件用に書き換えず、ディレクトリ全体をコピーする。
2. コピー先で `example-theme`、`Example`、ローカルパス、本番パスを案件の値へ置換する。
3. `bootstrap-site.example.php` 冒頭の `$config` を確認する。
4. 実行対象の `wp-load.php` が意図した WordPress であることを確認してから実行する。

## ファイル

- `bootstrap-site.example.php`: テーマ有効化、Front / Example 固定ページ、ホーム設定、メニュー作成。
- `run-bootstrap-site.example.sh`: ローカル PHP から bootstrap を実行するラッパー。
- `sync-nav.example.php`: bootstrap と同じ設定でメニューを同期する入口。
- `deploy-theme.example.sh`: `tools/deploy.sh` に案件固有のテーマスラッグと ZIP 名を渡す。

既存ページとメニュー項目を更新するため、設定値を置換する前に実行してはいけない。
