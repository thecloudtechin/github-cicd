# This is a basic workflow that is manually triggered

name: Terraform Manual workflow

# Controls when the action will run. Workflow runs when manually triggered using the UI
# or API.
on:
workflow_dispatch:
# Inputs the workflow accepts.
inputs:
env:
type: choice
# Friendly description to be shown in the UI instead of 'name'
description: 'Select Environment'
# Input has to be provided for the workflow to run
options:
- alpha
- int
- demo
- staging
- production
required: true
url:
type: text
description: 'Enter URL'
required: true
tenant:
type: text
description: 'Enter Tenant'
required: true
terraform:
type: choice
description: 'Select Method'
options:
- apply
- destroy
required: true
permissions:
contents: write
packages: write

# A workflow run is made up of one or more jobs that can run sequentially or in parallel
jobs:
terraform:
name: 'Terraform'
runs-on: ubuntu-latest
environment: develop-env


# Use the Bash shell regardless whether the GitHub Actions runner is ubuntu-latest, macos-latest, or windows-latest
defaults:
run:
shell: bash

steps:
# Checkout the repository to the GitHub Actions runner
- name: Checkout
uses: actions/checkout@v3

# Install the latest version of Terraform CLI and configure the Terraform CLI configuration file with a Terraform Cloud user API token
- name: Setup Terraform
uses: hashicorp/setup-terraform@v1

- name: Create Directory
run: |
mkdir -p datadog/synthetic/files/${{ inputs.env }}/${{ inputs.tenant }}
echo 'path="../../data/${{ inputs.env }}/${{ inputs.tenant }}/terraform.tfstate"' > datadog/synthetic/files/${{ inputs.env }}/${{ inputs.tenant }}/${{ inputs.tenant }}.conf

# Initialize a new or existing Terraform working directory by creating initial files, loading any remote state, downloading modules, etc.
- name: Terraform Init
run: |
terraform -chdir=datadog/synthetic init -reconfigure -lock=false -backend-config=files/${{ inputs.env }}/${{ inputs.tenant }}/${{ inputs.tenant }}.conf

# Generates an execution plan for Terraform
- name: Terraform Plan
run: |
terraform -chdir=datadog/synthetic plan -var="api_key=${{ secrets.TF_VAR_API_KEY }}" -var="app_key=${{ secrets.TF_VAR_APP_KEY }}" -var="url=${{ inputs.url }}" -var="email=${{ secrets.TF_VAR_EMAIL }}" -var="env-name=${{ inputs.env }}" -var="name=${{ inputs.env }}" -var="tenant=${{ inputs.tenant }}" -input=false -lock=false

# On push to "main", build or change infrastructure according to Terraform configuration files
# Note: It is recommended to set up a required "strict" status check in your repository for "Terraform Cloud". See the documentation on "strict" required status checks for more information: https://help.github.com/en/github/administering-a-repository/types-of-required-status-checks
- name: Terraform ${{ inputs.terraform }}
run: |
terraform -chdir=datadog/synthetic ${{ inputs.terraform }} -var="api_key=${{ secrets.TF_VAR_API_KEY }}" -var="app_key=${{ secrets.TF_VAR_APP_KEY }}" -var="url=${{ inputs.url }}" -var="email=${{ secrets.TF_VAR_EMAIL }}" -var="env-name=${{ inputs.env }}" -var="name=${{ inputs.env }}" -var="tenant=${{ inputs.tenant }}" -auto-approve -input=false -lock=false
#       #if: github.ref == 'refs/heads/"main"' && github.event_name == 'push'

- name: Commit & Push File
run: |
git config --global user.email "${{ secrets.GH_EMAIL }}"
git config --global user.name "${{ secrets.GH_USER }}"
git add -A
git commit -m "Added changed files"
git push origin main
