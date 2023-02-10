#!/bin/bash
apt  update 
apt  install apache2 -y 
systemctl restart apache2
systemctl enable apache2
