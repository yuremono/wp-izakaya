# ${theme_name} デプロイ手順

この文書の `${...}` は、リポジトリをコピーした後で案件の値へ置換する。

## 置換値

- `${theme_name}`: 管理画面に表示するテーマ名
- `${theme_slug}`: テーマディレクトリ名
- `${production_wp_path}`: 本番 WordPress のルート
- `${production_theme_path}`: `${production_wp_path}/wp-content/themes/${theme_slug}`

## テーマ反映

1. `tools-domain/deploy-theme.example.sh` の `example-theme` を `${theme_slug}` へ置換する。
2. `.env.deploy` に接続先を設定する。`DEPLOY_PATH` は必ず `${production_theme_path}` を指す。
3. `tools-domain/deploy-theme.example.sh --zip-only` で配布 ZIP を確認する。
4. 本番同期前に `DEPLOY_HOST`、`DEPLOY_USER`、`DEPLOY_PATH` を再確認する。
5. 管理画面で `${theme_name}` を有効化し、固定ページとメニューを確認する。

`tools/deploy.sh` は `DEPLOY_PATH` に `/wp-content/themes/` が含まれない場合は停止する。DB 操作や WordPress 本体の同期は行わない。
