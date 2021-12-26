variable "do_token" {
  
}

variable "ssh_key" {
  description = "SSH key name in DO Api"
  type = string
  default = "macbook"
}

variable "domain" {
  description = "Load balancer domain"
  type = string
  default = "botonarioum.one"
}
