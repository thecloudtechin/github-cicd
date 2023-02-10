variable "REGION" {
    description = "AWS Region for Launching VPC"
    default = "ap-south-1"
  
}

variable "AMIS" {
    type = map
    default = {
        us-east-2 = "ami-0cbea92f2377277a4"
        us-west-2 = "ami-083caf7916b3be0ba"
        ap-south-1 = "ami-0be14a4fc6ac897de"
    }
  
}

variable "ZONE1" {
    default = "ap-south-1a"
  
}

variable "USER" {
    default = "ubuntu"
  
}

variable "ACCESS_KEY" {
    default =  "AKIA5Y2IBW7RJBSVPZ7V"
}
variable "SECRET_KEY" {
    default = "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"
    
}