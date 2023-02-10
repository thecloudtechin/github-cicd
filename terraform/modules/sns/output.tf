output "sns-topics-arn" {
  value = aws_sns_topic.sns-sq-topic.*.arn
}