resource "aws_sns_topic" "sns-sq-topic" {
  count = length(var.sns_topics)
  name = var.sns_topics[count.index]
  kms_master_key_id = var.sns_topics[count.index] == "outbox-topic" ? "" : "alias/sns/test"
}

module "sns-sqs" {
  source = "../sqs"

}

resource "aws_sns_topic_subscription" "sqs-sns-topic-subs" {
  count = length(var.sns_topics)
  endpoint  = module.sns-sqs.sqs-arn
  protocol  = "sqs"
  topic_arn = aws_sns_topic.sns-sq-topic[count.index].arn
}
