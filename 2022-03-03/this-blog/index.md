The Creation Of MDBlog
======================
## The Idea
I wanted to create a blog for some time now, but never got to it.
Finally, here it is. 
Actually this blog post was created after beginning of the [OpenBSD in QEMU](./2022-03-04-openbsd-qemu) post because in the beginning I just wanted to write a blog post about what I had accomplished. However little it was, I was happy that I finally had overcome the issue 

## Using Markdown
I started writing HTML code and noticed how cumbersome it was. 
At work I use a lot of markdown language and remembered that I once saw a [video](https://yewtu.be/watch?v=N_ttw2Dihn8) about a markdown blog. 
So I duckduckwent "markdown server" or what ever - I can't remember. 
I found [this github repo](https://github.com/swharden/md2html-php) and failed miserably and 
[this github repo](https://github.com/nd1012/MarkDown-Server), but got stuck, so I filed an issue and got a quick response, but in the meantime I have already started implementing my own inspired by the heart of the later above mentioned repository: the `markdown` command, which is the only dependency except for PHP and coreutils. 
If you ever look for another markdown solution for your website, I advise you to search for "php markdown" instead ([parsedown](https://parsedown.org/demo) looks pretty neat). 
So I started scripting as I already had some PHP experience. 
At first it was just a quick fix, as I wanted to document my experience with installing OpenBSD, but now **MDBlog** is growing more and more usable. 
At the moment the whole blog is still on github, which might change if this grows into a project others want to use, what I don't believe since there are many smooth, clean and matured php markdown servers. 

## How To Use It
### First steps 
In your `/var/www/html` folder clone the github repository into a directory `blog`. 
Of course you can downloaded into any other directory. 
<pre>
git clone https://github.com/pur80a/MDBlog.git /var/www/html/blog 
</pre>
Then, to get things running, you will have to edit the config file: `/var/www/html/blog/res/config.php`. 

If you are in the base directory, in order to create a post make a directory
and create a link to the ./res/index.php file from within your new directory:
<pre>mkdir year-month-day/title
cd year-month-day/title
ln -s ../res/index.php .
</pre>
or you just run the `mkpost.sh` script: 
<pre>./res/mkpost.sh
</pre>
which will set up a new blog post for you. 
All you will have to do is change into the newly created directory and edit the index.md file. 

Test Area
---------
    indented code test
![test pic](../../../images/space.jpg)


| this | is | a |
| --- | --- | --- |
| test | table | yes |

TODOs
----
- code scrollable (chrome on macOS doesn't work (maybe within div?)
- overview also markdown 
- option to have subdirs 
- pre-publish 
