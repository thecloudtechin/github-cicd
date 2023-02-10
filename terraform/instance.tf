
resource "aws_key_pair" "dove-key" {
  key_name = "dovekey"
  public_key = file("dove-key.pub")
  
}

resource "aws_instance" "ec2-instances" {
    ami = var.AMIS[var.REGION]
    availability_zone = var.ZONE1
    instance_type = "t2.micro"
    key_name = aws_key_pair.dove-key.key_name
  #  vpc_security_group_ids = [ "sg-0e8aa9a9abb78902b" ]
    count = 1
    tags = {
      "Name" = "ec2-instance-${count.index}"
    
    }


    provisioner "file" {
      source = "web.sh"
      destination = "/tmp/web.sh"

    }

    provisioner "remote-exec" {
      inline = [
        "chmod u+x /tmp/web.sh",
        "sudo  /tmp/web.sh "
      ]
      
    }
    connection {
      user = var.USER
      private_key = file("dove-key")
      host = self.public_ip
      
    }
  
}

