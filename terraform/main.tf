resource "aws_cloudwatch_event_rule" "console" {
  name        = "public-sns-message-to-outbox-topic-${var.environment}"
  description = "Sending a message to outbox topic every 5 minutes"

  schedule_expression = "rate(5 minutes)"
}



resource "aws_cloudwatch_event_target" "sns" {
  for_each  = var.eventbridge_cron_aws_cloudwatch_event_target
  rule      = aws_cloudwatch_event_rule.console.name
  target_id = each.key
  arn       = each.value.arn
  input     = <<JSON
  {
    "TenantId":"${each.value.tenant_id}",
    "Type":"PKI.Evoya.Shared.Domain.Messages.PurgeOutboxMessage",
    "CorrelationId":"${each.value.correlation_id}"
  } 
  JSON
}

resource "aws_sns_topic" "sns-topic" {
  count = length(var.sns_topics)
  name = var.sns_topics[count.index]
}