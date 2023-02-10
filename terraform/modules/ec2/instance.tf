
# resource "aws_key_pair" "dove-key" {
#   key_name = "dovekey"
#   public_key = file("dove-key.pub")
  
# }

resource "aws_instance" "ec2-instances" {
    ami = "ami-0f8ca728008ff5af4"
    availability_zone = "ap-south-1a"
    instance_type = "t3.medium"
    # key_name = aws_key_pair.dove-key.key_name
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
      user = "ubuntu"
      private_key = file("dove-key")
      host = self.public_ip
      
    }
  
}

