kogod60
=======

A WordPress site to celebrate Kogod's 60th anniversary.


To run SASS:
============

* In Terminal, navigate to wp-content/themes/kogod-60
* sass --watch scss:css

To add new SASS partial file:
=============================

* Create a new file in the appropriate location (generally speaking 'modules' do not output CSS, but define SASS mixins and functions, 'partials' outputs CSS)
* Import the new files in scss/main.scss

See http://thesassway.com/beginner/how-to-structure-a-sass-project for more information.