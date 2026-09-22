# best-expert-web

Сайт БЭСТ — https://best-expert.pro/

## Production

Production root:

/var/www/u0556989/data/www/best-expert.pro

Repository:

/var/www/u0556989/data/repos/best-expert-web

## Git workflow

- `main` — production-ready code
- разработка ведется в отдельных feature-ветках
- изменения попадают в `main` через Pull Request
- production deploy выполняется только из чистой ветки `main`

## Deploy

Проверка изменений:

./deploy/deploy-production.sh --dry-run

Боевой deploy:

./deploy/deploy-production.sh

## Server-only data

Не хранятся в Git:

- `/bitrix/`
- `/upload/`
- `/marketplace/`
- `favicon.ico`
- `yandex_*.html`
- runtime/cache files
- секреты и локальные конфигурации
