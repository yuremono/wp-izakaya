# AGENTS.md

## 目的

このリポジトリは、案件ごとにディレクトリ全体をコピーして使う WordPress クラシックテーマ基盤。

## HTML から WordPress への移植

- 静的 HTML サイトを WordPress テーマへ移植する作業は、必ず `html-to-wp` スキルを使用する。
- 作業対象が「Current Directory のみ」か「Current Directory と WP Template Directory の両方」かを、ユーザーの指示から判定する。
- 反映範囲が明確でない場合は、編集を始める前に必ずユーザーへ確認する。

## GitHub 運用

- WP Template Directory では、GitHubへの commit / push を行わない。
- WP Template Directory を複製した固有テーマでは、`html-to-wp` スキル実行中にGitHubへの commit / push を行わない。
- 固有テーマは、ユーザーがローカル表示と実装内容に問題がないことを確認した後で、新規GitHubリポジトリを作成する。
- 新規リポジトリ作成後に、固有テーマの完成状態をcommitし、SSH形式のリモートURLへpushする。

## コピー後の設定

- 基盤を直接案件用に変更せず、コピー先で作業する。
- `Example Theme`、`example-theme`、`Example`、`example` を案件値へ置換する。
- `docs/theme.example.md` と `README.md` の置換一覧を確認する。
- `.bak` は予備ファイル。読込・編集・削除をしない。

## 命名

- PHP グローバル関数: `snake_case`
- 定数: `THEME_` + `SCREAMING_SNAKE_CASE`
- ACF key: `group_pc_*` / `field_pc_*` または案件で決めた固定接頭辞
- ACF name: `snake_case`
- 既存静的 HTML のクラスは維持し、新規独自クラスは PascalCase
- `wp_enqueue_*` ハンドル: `theme-` + kebab-case

## 実装

- `assets/css/`、`assets/js/`、`assets/images/` は案件ごとの静的資産領域。
- ヘッダーは `template-parts/site-header.php` を基礎として維持する。
- フッターと本文は骨格から案件ごとに構築する。
- ACF は `inc/acf-pages.php`、値取得は `inc/template-tags.php` に集約する。
- ACF 無効時に fatal error を起こさず、投稿メタへ fallback する。
- 属性、本文、URL、許可 HTML は用途別にエスケープする。
- リピーターを前提にせず、増減可能な一覧には CPT を検討する。

## 検証

- PHP lint
- `composer run phpcs`
- `rtk git diff --check`
- 最小テストカバレッジ 80%

本番反映は `DEPLOYMENT.md` を確認し、対象テーマディレクトリ以外へ同期しない。
