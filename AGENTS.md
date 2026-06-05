# AGENTS.md

## 命名

| 種別 | ルール | 例 |
| --- | --- | --- |
| PHP グローバル関数 | snake_case | `theme_quests_meta`, `theme_asset_version` |
| 定数 | `THEME_` + SCREAMING_SNAKE_CASE | `THEME_GETTEXT_DOMAIN` |
| ACF グループ／フィールドの `key` | `group_pc_*` / `field_pc_*`（公開後は変更しない） | `group_pc_page_quests` |
| ACF フィールドの `name`（メタキー） | snake_case、ブロックごとに接頭辞をそろえる | `hero_*`, `service_1_*`, `footer_contact_*` |
| クラス名 | 静的HTML由来の既存クラスは維持。新規独自クラスは PascalCase | `QuestsPage`, `QuestsPageService` |
| `wp_enqueue_*` ハンドル | `theme-` + kebab-case | `theme-quests-style` |

## 出力（ACF 含む）

テンプレートでは **属性・本文・URL ごとに** `esc_attr` / `esc_html` / `esc_url`（など）を使う。ACF の戻りはそのまま `echo` しない。

## 入力欄をどう増やすか（このテーマの前提）

ページに載せる文章や画像の**中身**は、「そのページの編集画面」から入れる。

クエストトップとサービスページの入力欄は `inc/acf-quests-pages.php` で定義する。固定ページテンプレートごとに `group_pc_page_quests` / `group_pc_page_quests_service` を分け、`page_template` ルールで表示を切り替える。

一方で、入力欄の**種類や並び**はテーマの PHP に書いてある想定。**種類を増やしたり並び替えたりするときはコードを直す前提**で、拡張機能の設定画面だけで項目を増やす運用は想定しない。

有料版のリピーター機能は使用予定なし。

## WordPress 画面構築の基本ルール

- クエスト2ページに表示されるテキスト・長文HTMLは、原則として `inc/acf-quests-pages.php` の ACF フィールドから取得する。
- ACF フィールドを追加しただけで終わらせず、管理画面で編集者が場所を理解できるように `default_value` と説明を入れる。
- 管理画面から増減する一覧を追加する場合は、リピーターを使わず CPT を検討する。ただし現時点では CPT は未使用。
- 初期データ投入用の `tools/` はこのテーマから削除済み。既存編集を上書きする自動投入処理は追加しない。
- ACF は導入済み前提だが、テーマコードでは `function_exists( 'get_field' )` や `get_post_meta()` fallback を使い、ACF 無効時の fatal error を避ける。
- WYSIWYG でHTMLを扱う場合は `wp_kses()` と `theme_quests_allowed_html()` を使う。
- 現時点のヘッダー・フッターリンクは静的HTML由来のダミーリンク。管理画面化が必要になった時点で `wp_nav_menu()` へ移す。
- 旧デモ用途の ACF グループや文言を残して管理画面を混乱させない。現在のフロントページに不要なフィールド登録は読み込まない。

## [重要]ページのスタイル方針

- 既にテンプレート側で使っている静的HTML由来のクラスは、そのまま残す。
- 新規作成または作り直しのセクション・コンポーネントは、原則としてカスタムクラスを作成してまとめる。
- 既存のカスタムクラスに対する見た目の派生は、`Is` 接頭辞のモディファイアで切り替える。
- モディファイアを増やす場合、基本スタイルそのものは変えず、バリエーションだけを足す。

## 専用スキル

このテーマの管理画面編集・ACF・CPT・メニュー化を扱うときは、必要に応じて `.codex/skills/wp-admin/SKILL.md` を読む。

## PHP の静的チェック（PHPCS）

テーマ直下で **`composer install`**（初回のみ）のあと **`composer run phpcs`**。WordPress のコーディング規約に沿っているかを機械的に検査する。自動修正できるものは **`composer run phpcbf`**。

## 本番反映

サブディレクトリ側 WordPress への反映は [QUESTS_DEPLOYMENT.md](./QUESTS_DEPLOYMENT.md) を見る。ルートディレクトリの WordPress には影響させない。


<!-- headroom:rtk-instructions -->
# RTK (Rust Token Killer) - Token-Optimized Commands

When running shell commands, **always prefix with `rtk`**. This reduces context
usage by 60-90% with zero behavior change. If rtk has no filter for a command,
it passes through unchanged — so it is always safe to use.

## Key Commands
```bash
# Git (59-80% savings)
rtk git status          rtk git diff            rtk git log

# Files & Search (60-75% savings)
rtk ls <path>           rtk read <file>         rtk grep <pattern>
rtk find <pattern>      rtk diff <file>

# Test (90-99% savings) — shows failures only
rtk pytest tests/       rtk cargo test          rtk test <cmd>

# Build & Lint (80-90% savings) — shows errors only
rtk tsc                 rtk lint                rtk cargo build
rtk prettier --check    rtk mypy                rtk ruff check

# Analysis (70-90% savings)
rtk err <cmd>           rtk log <file>          rtk json <file>
rtk summary <cmd>       rtk deps                rtk env

# GitHub (26-87% savings)
rtk gh pr view <n>      rtk gh run list         rtk gh issue list

# Infrastructure (85% savings)
rtk docker ps           rtk kubectl get         rtk docker logs <c>

# Package managers (70-90% savings)
rtk pip list            rtk pnpm install        rtk npm run <script>
```

## Rules
- In command chains, prefix each segment: `rtk git add . && rtk git commit -m "msg"`
- For debugging, use raw command without rtk prefix
- `rtk proxy <cmd>` runs command without filtering but tracks usage
<!-- /headroom:rtk-instructions -->
