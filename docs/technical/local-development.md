---
layout: default
title: Local Development
nav_order: 2
parent: Technical Documentation
permalink: /docs/technical/local-development
---

# Local Development

## Installing

### Prerequisites

**Docker:** In order to follow the standard installation guide, you must have Docker installed.

### Clone repository
The codebase is hosted on GitHub at [github.com/fhict-skilltree/backend-application](https://github.com/fhict-skilltree/backend-application).

Clone the repository by running:

```shell
git clone git@github.com:fhict-skilltree/backend-application.git
```

### Setup application

We have created a shell script to automate the building and installation process of the application. Run the following command in your terminal:

```shell
sh setup-dev.sh
```

This script will build and start the Docker containers and execute the necessary steps to have a basic working application.

### Running commands in the PHP service

If you want to execute scripts or run commands, you need to open up a shell process in the PHP container. You can do that as follows:

```shell
docker compose exec php sh
```
