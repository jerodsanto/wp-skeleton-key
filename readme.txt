=== Skeleton Key ===
Contributors: sant0sk1
Donate link: http://jerodsanto.net
Tags: admin, login, users, password, skeleton, key, manage, masquerade
Requires at least: 2.8
Tested up to: 2.8.5
Stable tag: trunk

Gives administrators a skeleton key (their own password) to login as any user they'd like.

== Description ==

As an administrator of a WordPress site with many users, it is often useful to login to a user's account to troubleshoot something. Asking for their password is tacky and having to reset it is amateurish. Thankfully, you don't have to do either when you're armed with this plugin. You can login to the site with any user's account by providing their username and your administrative password. All other user authentication is passed on to WordPress core. Handy, huh?

== Installation ==

1.  Upload wp-skeleton-key/ directory to the wp-content/plugins directory.
2.  Activate 'Skeleton Key' through the 'Plugins' menu in WordPress.
3.  Login as any user with administrator's password!

== Frequently Asked Questions ==

= Does this plugin rock? =

Yes, yes it does.

= I want feature [X] =

You should fork the project on [GitHub]( http://github.com/sant0sk1/wp-skeleton-key ) and help add it! Or contact me via [Twitter]( http://twitter.com/sant0sk1 ) or my [blog]( http://blog.jerodsanto.net ) and let me know what features you think I should add.

= Where do I submit bugs? =

Issue tracking is also on [GitHub]( http://github.com/sant0sk1/wp-skeleton-key/issues ).

== Changelog ==

= 1.0.1 =
* Optimized queries to make only one call to the database to retrieve and test admin logins
* Fixed links in Readme.txt file so closing parenthesis was not appended to the URL

= 1.0 =
* Initial release