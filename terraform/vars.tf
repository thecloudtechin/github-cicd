variable "REGION" {
    description = "AWS Region for Launching VPC"
    default = "us-east-2"
  
}

variable "AMIS" {
    type = map
    default = {
        us-east-2 = "ami-0cbea92f2377277a4"
        us-west-2 = "ami-083caf7916b3be0ba"
        ap-south-1 = "ami-03907f4254994e14a"
    }
  
}

variable "ZONE1" {
    default = "us-east-2a"
  
}

variable "USER" {
    default = "ubuntu"
  
}

variable "ACCESS_KEY" {}
variable "SECRET_KEY" {}