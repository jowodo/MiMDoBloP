The Creation Of MDBlog
======================
## The Idea
I wanted to have a lightweight blog system which is based on markdown.

## Dependencies

- http server (tested with apache) 
- PHP 
- `markdown` executable (any other MD to HTML parser will do)
- *coreutils* (`awk`, `basename`, `echo`, `ls`, `readlink`, `pwd`, `tail`, `tr`, `wc`) 

## History
I started writing HTML code and noticed how cumbersome it was. 
At work I use a lot of markdown language and remembered that I once saw a [video](https://yewtu.be/watch?v=N_ttw2Dihn8) about a markdown blog. 
So I duckduckwent "markdown server" or what ever - I can't remember and found two potential repositories: [this github repo](https://github.com/swharden/md2html-php) and 
[this github repo](https://github.com/nd1012/MarkDown-Server). 
Unfortunately, I didn't get neither running so I got my own running. 
At first it was just a quick fix, but now **MDPHP** is growing more and more usable. 

If you ever look for another markdown solution for your website, I advise you to search for "php markdown" ([parsedown](https://parsedown.org/demo) looks pretty neat). 


## How To Use It
<pre>
git clone https://github.com/pur80a/MDBlog.git /var/www/html/blog 
cd /var/www/html/blog 
vim res/config.php
./res/mkpost.sh My First Post#follow directions
</pre>

- clone the repository into a directory of your choice (`/var/www/html/blog` will be assumed)
- chanchge into the blog's base directory 
- edit configuration file 
- make your first post # Title will be autmatically be [sluggyfied](https://en.wikipedia.org/wiki/Clean_URL#Slug)


All you will have to do is change into the newly created directory and 
Now you can happily edit the `index.md` file. 

## heading with link {#link}
heading with link can be created by using 
<pre>
## heading {#link}
</pre>
[test](./#link)

Test Area
---------

    indented code test

![test pic](./space.jpg)


| this | is | a |
| --- | --- | --- |
| test | table | yes |

TODOs
----
- code scrollable (chrome on macOS doesn't work (maybe within div?)
- overview also markdown 
- option to have subdirs 
- pre-publish 
- home page/overview list reverse (oldest on top) 
- show the last three articles at bottom of overview/homepage
- rename this page to tutorial 
