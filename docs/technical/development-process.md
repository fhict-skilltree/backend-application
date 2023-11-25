---
layout: default
title: Development Process
nav_order: 4
parent: Technical Documentation
permalink: /docs/technical/development-process
---

# Development Process

The GitHub infrastructure is used to manage the development process for this project. The details of the development
process are listed below. It's important that this process is well understood by the team and followed. The process is
designed to keep the quality of our work high. Backlogs can easily grow in size, filled with tickets that are not easy
to understand.

## Project board

The [project board](https://github.com/orgs/fhict-skilltree/projects/1) is used to keep track of the current sprint. The
tickets in the sprint will be discussed one by one during Daily Standup. This will keep the focus on the Sprint goals
and gives the team the opportunity to discuss how they can help each-other getting things done in the sprint. Think
about necessary discussions or code reviews. If there are impediments, they can be shared with the team.

The following status columns have been created:

* Ready (tickets that are ready to be picked up)
* In progress
* Ready for review
* Reviewed
* Done

## Tickets (issues and pull requests)

Our planned and unplanned work needs to be written down and documented in tickets. This ensures that anyone can go back
in time to find out why something was created, what the requirements were, which decisions where made in the process and
anything else that could be useful to help that person.

A ticket is nothing more than a collective word for an event that must be investigated or a work item that must be
addressed. The following type of tickets can be created:

* Task
* Bug
* User story
* Epic

Each ticket must be labeled with the corresponding label. This allows us to identify these types more easily and we can
filter the results based on ticket type.

### User story estimations

User stories will be required to contain an estimation once it's moved from the `New` column to `Ready`.

The estimation is not time-base, but complexity based. Therefore, we'll be using a slightly modified version of the
Fibonacci sequence:

* 1
* 2
* 3
* 5
* 8
* 13
* 20
* 40

### Priorities

There is usually a difference in the priority of tickets. There a few level of priorities that can be assigned to
tickets. This will help with identifying high priority work from less important work.

* Highest
* High
* Medium
* Low
