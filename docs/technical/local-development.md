---
layout: default
title: Technical Documentation
nav_order: 1
has_children: true
permalink: /docs/technical/local-development
---

# Local Development

## Installing

### Prerequisites

1. Docker 
   1. In order to follow the standard installation guide, you must have Docker installed. 

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
