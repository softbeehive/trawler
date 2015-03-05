Flickr Ocean Trawler
=======================

Introduction
------------

- Live: http://ef.softbeehive.com/
- Code: https://github.com/softbeehive/trawler

I always start from idea. This time inspiration came when I was thinking about physical aspect of word "scraping", I remembered WWI and mine sweepers, which are associated with British navy and German submarines. British naval trawlers are looking for underwater mines. I found ideal picture which illustrated spirit of my imagination ([this one](http://3.bp.blogspot.com/-aO9Jsgz5QzE/T89pZO-3oGI/AAAAAAAAB18/_eQ9UzfXq2Q/s1600/Pair+of+trawlers+sweeping+row+of+anchored+mines+in+WWI.jpg)).

So I called it Flickr Ocean Trawler. Search terms are called "operations". They are stored in history of operations. I created unique graphical style, exclusively drew trawler using my Intuos 5 pen tablet.
Every operation's representation works in two modes: intelligence (table way) and actual results (visual way). I even tried to visualize mines and trawling process using canvas, but it requires plenty of time and efforts.

During coding I followed SOLID principles as much as possible, if we go through the task I did much more than was asked to shape it as real world product. Technically it works accordingly next algorithm: passing query - getting results from Flickr by API - processing and saving data to MySQL - rendering view. And yes, it works as a single page application firing ajax requests instead of page refresh.

Application relies on Zend Framework 2.2, written in PHP 5.4 and run on Ubuntu server. JavaScript control is written in jQuery. As base backend component for dealing with Flickr API I used Zend Service called Flickr, I modified it because originally it was broken and didn't work with Zend HttpRequest class. Results got from Flickr are limited by 48 per query.
Browser support. Tested in Mozilla Firefox 26+, Chrome 31+, Opera 12.16 (Linux Mint 16, 64-bit) , IE9, IE10 (Win 7, 64-bit)

Stuff to improve
- data validation,
- update/delete operation
- db save algorithm impovement
- graphical part
- pagination or ajax load on scroll 

Task
------------
Take a look at https://github.com/softbeehive/trawler/blob/master/task.md