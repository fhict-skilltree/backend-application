---
layout: default
title: Local Development
nav_order: 2
parent: Technical Documentation
permalink: /docs/technical/traefik-gateway
---

# Traefik Gateway

## Installing

### Prerequisites

**Docker:**

In order to follow the standard installation guide, you must have Docker installed.

### Clone repository

The codebase is hosted on GitHub at [github.com/fhict-skilltree/traefik-gateway](https://github.com/fhict-skilltree/traefik-gateway).

Clone the repository by running:

```shell
git clone git@github.com:fhict-skilltree/traefik-gateway.git
```

### Start the service

We have created a shell script to start the Traefik gateway. Run the following command in the root directory of the repository.

```shell
sh start.sh
```

You can visit the Traefik dashboard at: https://traefik.localhost/

### Stop the service

To stop the Traefik gateway service, run:

```shell
sh stop.sh
```
