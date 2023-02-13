variable "eventbridge_cron_aws_cloudwatch_event_target" {}
variable "environment" {}
variable "sns_topics" {
  type = any
  default = ["patient-topic-config", "patient-linking-topic-config", "screening-topic-config", "evoyareport-topic-config", "event-history-topic-config", "outbox-topic-config"]
}

# variable "eventbridge_cron_aws_cloudwatch_event_target" {
#   type = any
#   "D9vGe8C3JFUAAkeO" = {
#     arn            = "arn:aws:sns:eu-central-1:457967234952:outbox-topic-config"
#     tenant_id      = "D9vGe8C3JFUAAkeO"
#     correlation_id = "13ef5142-27fa-4f8e-9934-85a364a5457a"
#   },
#
# }