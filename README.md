[![Build Status](https://travis-ci.org/SimpleLance/SimpleLance.svg?branch=feature%2Flaravel)](https://travis-ci.org/SimpleLance/SimpleLance)
[![Code Climate](https://codeclimate.com/github/SimpleLance/SimpleLance/badges/gpa.svg)](https://codeclimate.com/github/SimpleLance/SimpleLance)
[![Stories in Ready](https://badge.waffle.io/SimpleLance/SimpleLance.png?label=ready&title=Ready)](https://waffle.io/SimpleLance/SimpleLance)

SimpleLance
===========

A simple customer management / invoicing / project tracking tool built for freelancers.

Invoices can be paid within SimpleLance using stripe.

Note that projects can only be added by admin at present, this may change if demand calls for it.

There is also currently no support for alerts for tickets, projects or invoices and also invoices are not automatically
updated when past due.  This is all to come in future release.

2 Accounts exist, 1 admin and 1 customer.

admin - email = ```admin@admin.com``` / password = ```simplelance``` <br>
customer - email = ```user@user.com``` / password = ```simplelance```

Development is ongoing and updates will be released as regular as possible.

If you have a feature you would like to see added, please create an issue or PR

##Requirements

SimpleLance requires PHP > 5.4 to run. 

We recommend installing and running SimpleLance on Ubuntu x64 LTS. Other server  configurations will likely work.

##Installation

To install SimpleLance:

- Clone this repo: ```git clone git@github.com:SimpleLance/SimpleLance.git```
- Edit ```SimpleLance/app/config/database.php``` with your database settings.
- Point your web server virtual host at: ```/path/to/cloned/SimpleLance/public```
- Change Directory to ```/path/to/cloned/SimpleLance```
- Run the Database Migrations: ```php artisan migrate```
- Seed the Database: ```php artisan db:seed```
- You can login with the accounts above. Please remove or change the passwords to these accounts before making your site live.

Have trouble installing? Please create an issue and we'll do our best to help.

###Local Development

Vagrant is built into the project via Laravel Homestead

- Clone the repo to your local computer
- cd to the folder you cloned
- run ```vagrant up```
- run ```composer install``` to install dependencies
- add ```192.168.65.10    simplelance.dev``` to your hosts file

###Testing

To run the test suite run ```codecept run``` from the project root. This is made easier if you use the built in vagrant box.

### Contributing:

We welcome and love contributions! To facilitate receiving updates to SimpleLance, we encourage you to create a new personal branch after you fork this repository. This branch should be used for content and changes that are specific to your event. However, anything you are willing to push back should be updated in your master branch. This will help keep the master branch generic for future event organizers that choose to use the system. You would then be able to merge master to your private branch and get updates when desired!

Not sure what to work on? [Check the Ready tag](https://waffle.io/simplelance/simplelance)

Please include failing tests in all bug reports. Please include passing tests with new feature PRs. 

Please join us in #SimpleLance on the Freenode IRC network.
