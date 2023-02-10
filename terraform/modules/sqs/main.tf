resource "aws_sqs_queue" "sns-sqs-queue" {
  name = "sns-sqs-queue"
  kms_master_key_id = "alias/sns/test"
}

