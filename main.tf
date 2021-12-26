terraform {
  required_providers {
    digitalocean = {
      source  = "digitalocean/digitalocean"
      version = "~> 2.0"
    }
  }
}

provider "digitalocean" {
  token = var.do_token
}

data "digitalocean_ssh_key" "ssh_key" {
  name = var.ssh_key
}

resource "digitalocean_domain" "domain" {
  name = var.domain
}

resource "digitalocean_record" "dns-record" {
  domain = digitalocean_domain.domain.name
  name   = "@"
  type   = "A"
  value  = digitalocean_loadbalancer.lb.ip
}

resource "digitalocean_certificate" "lb-cert" {
  name    = "le-lb-cert"
  type    = "lets_encrypt"
  domains = [digitalocean_domain.domain.name]
}

resource "digitalocean_droplet" "proxy" {
  image  = "docker-20-04"
  name   = "botonarioum-proxy-${count.index}"
  region = "ams3"
  size   = "s-1vcpu-1gb"
  count  = 2

  ssh_keys = [
    data.digitalocean_ssh_key.ssh_key.id
  ]
}

resource "digitalocean_loadbalancer" "lb" {
  name   = "proxy-load-balancer"
  region = "ams3"

  forwarding_rule {
    entry_port     = 80
    entry_protocol = "http"

    target_port     = 80
    target_protocol = "http"

    certificate_id = digitalocean_certificate.lb-cert.id
  }

  healthcheck {
    port     = 22
    protocol = "tcp"
  }

  droplet_ids = digitalocean_droplet.proxy.*.id
}

output "droplet_ips" {
  value = digitalocean_droplet.proxy.*.id
}