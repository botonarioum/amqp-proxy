TELEGRAM WEBHOOK GATEWAY
===

## Prepare environment variables

- Add domain to hosts. `echo '127.0.0.1    gateway.com' >> /etc/hosts`
- Create env file: `cp .env .env.local`. And change default values to yours.

## Run development server:
`make dev`

Open [gateway.com](gateway.com) in your browser

## Production (in process)
- Build image: `make build`
- Tag new version: `docker tag botonariousdsdsdm-gateway lov3catch/botonarioum-gateway:v0.0.1`
- Push new version: `docker push lov3catch/botonarioum-gateway:v0.0.1`

## Contribute
Before commit/push - ensure is everything are okay with code. `make analyse` run PHPStan analyse.

## Stay in touch
[Telegram](https://t.me/igorkpl)
