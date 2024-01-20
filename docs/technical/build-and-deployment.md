---
layout: default
title: Build and Deployment
nav_order: 6
parent: Technical Documentation
permalink: /docs/technical/build-and-deployment
---

# Build and Deployment

## Building

The backend application is containerized using Docker. The built image is based on the official PHP-FPM image and adds
the necessary dependencies and tools, to run the container on any environment. The Dockerfile can be found
at: `./docker/php/build.Dockerfile`.

The image build and publishing process is automated using
a [GitHub Action](https://github.com/fhict-skilltree/backend-application/actions/workflows/build.yml). The container
image is published to the GitHub Container Registry.

Builds are automatically started for the following events:
1. Commits to the `main` or `develop` branches. The image tag is equal to the branch name.
2. Created Git tags. The image tag is equal to the tag name.

## Releasing new versions

### Versioning Scheme

Calendar Versioning (CalVer) is the versioning scheme used for naming our releases. You can read more about this specification at https://calver.org/.

The actual version scheme that we're going to use is still being researched. 

## Deploying

Deployments to environments can be done by using the created Deployments workflows. Choose the deployment workflow that has been created for the desired environment. You need to provide the version number, you want to deploy to that environment. 

Deployments to production requires an approval from @cyrildewit.
