output "server-ip" {
    description = "Server Public ip"
    value = aws_instance.ec2-instances.public_ip
  
}