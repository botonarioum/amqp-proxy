TELEGRAM WEBHOOK GATEWAY
===
The problem is in init webserver, framework, and any other component for pulling webhooks from Telegram to our service. If you have one bot - is ok, but if the bot count is greater than just one - is overhead. In my opinion - I would like to write bot logic from scratch without any depending on to framework and webservers. Just workers. In the image below - you can see two ways: traditional (left) and with amqp-proxy (right).

![workflow](/docs/assets/workflow.png)

## Prepare environment variables

- Add domain to hosts. `echo '127.0.0.1    amqp-proxy.com' >> /etc/hosts`
- Create env file: `cp .env .env.local`. And change default values to yours.

## Run development server:
`make dev`

Open [amqp-proxy.com](amqp-proxy.com) in your browser

## Production (in process)
- Build image: `make build`
- Tag new version: `docker tag botonariom-amqp-proxy lov3catch/botonariom-amqp-proxy:v0.0.1`
- Push new version: `docker push lov3catch/botonariom-amqp-proxy:v0.0.1`

## Contribute
Before commit/push - ensure is everything are okay with code. `make analyse` run PHPStan analyse.

## Stay in touch
[Telegram](https://t.me/igorkpl)
