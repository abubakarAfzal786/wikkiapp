This repository contains an application for viewing and editing text documents.
Users of the application can:

* Create new pages
* Edit any existing page
* View a list of existing content

## Your task

Please spend no more than 90 minutes on this task.

Question 1

In `api.php` you will find TODO comments. Work through these TODOs using your
creativity and judgment. Please only update the api.php file.

Question 2

Anyone who visits our site can make an edit. We would like to store the IP
address of everyone who has made an edit, and which article they have edited so
that we can guess which articles may have been vandalized. For example, imagine
we have a classroom in a school, where there are a number of students who are
vandalizing articles at once, with IP addresses 72.1.3.4 - 72.1.3.89, and we'd
like a list of which articles they have edited.

Design a database table (or tables) that will allow the app to efficiently look
up:
* For a given article, the IP addresses of all the people who have edited it
* For a given IP range, which articles have been edited from IP addresses in that
range.

Please describe your table(s) in markdown form, and describe any indexes you
would add. (Don't actually implement a database.) For example:

|Column name|Data type|Description          |
|-----------|---------|---------------------|
|article_id |integer  |The ID of the article|
|...        |...      |...                  |

Primary key index on article_id.

## How your response will be evaluated

Although this codebase could be improved in lots of places, we are only interested
in the specific questions we have asked. Please be prepared to discuss you answers
in person.

For question 1 we will broadly check:

* Following the instructions: Have you done what was asked by the TODOs?
* Code quality: Was the code changed to be cleaner than before and is any new code
that was added clean? (e.g. Writing clear comments, logical naming, appropriate
function length/scope etc. )
* Security: Did you consider the security implications of your changes?
* Performance: Did you consider the performance implications of your changes?

We will also check that you have used Git to make your changes with
[quality commit message(s)](https://www.mediawiki.org/wiki/Gerrit/Commit_message_guidelines/en).
Please make your changes in small, logical commits.

For question 2, we want to understand how you would map product requirements to a
database structure. We are not looking for specific knowledge of specific database
engines.

### Note

Please do not use any additional external libraries for this exercise.

## Usage

Download [composer](https://getcomposer.org/), then:

1. `composer install` – installs dependencies for the application
2. `composer serve` - Serves the application
   1. Web UI is available at http://localhost:8989.
   2. API is available at http://localhost:8989/api.php
   3. If you need to change the port, you can do that in `composer.json`
3. `composer seed` – Generate seed content for the application
4. `composer test` – Lint files and run tests

## Submission

Please create a ZIP file of the git repository and send back to the recruiter.
