TELEGRAM WEBHOOK GATEWAY
===

## Prepare environment variables
`cp .env .env.local`

And change default values to yours.


## Run development server:
`make dev`

Open [127.0.0.1:8080](127.0.0.1:8080) in your browser

## Production (in process)
- Build image: `make build`
- Tag new version: `docker tag botonariousdsdsdm-gateway lov3catch/botonarioum-gateway:v0.0.1`
- Push new version: `docker push lov3catch/botonarioum-gateway:v0.0.1`

## Contribute
Before commit/push - ensure is everything are okay with code. `make analyse` run PHPStan analyse.

## Stay in touch
[Telegram](https://t.me/igorkpl)
