module "sns-sqs-topic" {
  source = "./modules/sns"
}

module "sns-sqs-queue" {
  source = "./modules/sqs"
}

#module "ec2" {
#  source = "./modules/ec2"
#
#}