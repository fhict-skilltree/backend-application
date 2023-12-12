---
layout: default
title: REST API
nav_order: 5
parent: Technical Documentation
permalink: /docs/technical/rest-api
---

# REST API

## Development conventions

### Use UUID for resource identifiers

Identifiers of resources that are exposed through the REST API must be the UUID and not the internal ID (integer). 

Example resource response:

```diff
{
-    "id": 2032,
+    "uuid":  "9a70ad0a-7717-4750-8cb7-c95b62133382",
    "title": "Skilltree example"
}
```

Example API endpoint:

```diff
- GET /users/2032/settings,
+ GET /users/9a70ad0a-7717-4750-8cb7-c95b62133382/settings,
```

Concerns regarding using the ID:
* The incremental nature of IDs gives insights about the amount of resources that exists. Although this information is not confidential for the public, it's preferred to not expose undesired details.
* Malicious hackers can guess the resource identifiers and therefore attempt to access resources in endpoints that are not protected well enough. UUIDs are not incremental and have a probability of 2^12 which decreases the that chance people guess a UUID. 
* UUIDs can be shared across environments, allowing us to create consistent database setups when testing for example.
