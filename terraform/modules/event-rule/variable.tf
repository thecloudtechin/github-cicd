 variable "eventbridge_cron_aws_cloudwatch_event_target" {
   default = {
     "D9vGe8C3JFUAAkeO" = {
       arn            = "arn:aws:sns:eu-central-1:457967234952:outbox-topic-config"
       tenant_id      = "D9vGe8C3JFUAAkeO"
       correlation_id = "13ef5142-27fa-4f8e-9934-85a364a5457a"
     },
#     "KORa21Ptc3rpvXPa" = {
#       arn            = "arn:aws:sns:eu-central-1:457967234952:outbox-topic-config"
#       tenant_id      = "KORa21Ptc3rpvXPa"
#       correlation_id = "13ef5142-27fa-4f8e-9934-85a364a5457a"
#     },
#     "GjVleyCQxZuY5vXn" = {
#       arn            = "arn:aws:sns:eu-central-1:457967234952:outbox-topic-config"
#       tenant_id      = "GjVleyCQxZuY5vXn"
#       correlation_id = "13ef5142-27fa-4f8e-9934-85a364a5457a"
#     },
#     "KrOdiX3KxRWIKsRx" = {
#       arn            = "arn:aws:sns:eu-central-1:457967234952:outbox-topic-config"
#       tenant_id      = "KrOdiX3KxRWIKsRx"
#       correlation_id = "13ef5142-27fa-4f8e-9934-85a364a5457a"
#     }
   }
 }

 variable "environment" {
   default = develpo-env
 }