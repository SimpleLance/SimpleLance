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

##Installation

To install SimpleLance:

- TODO: Update Install to support new laravel version

###Local Development

Vagrant is built into the project via Laravel Homestead

- Clone the repo to your local computer
- cd to the folder you cloned
- run ```vagrant up```
- run ```composer install``` to install dependencies
- add ```192.168.65.10    simplelance.dev``` to your hosts file

###Testing

To run the test suite run ```codecept run``` from the project root. This is made easier if you use the built in vagrant box.

###ToDo / Contributing:

There are a few things left to be done:

- Create admin dashboard / customer home screen
- Finish email notifications
- General code tidy
- Improve (create!) documentation
- General front end improvements (nothing radical, but it needs serious loving)

If you feel so inclined to help with any of these, please open a PR and get stuck in.
