MiMDoBloP (Minimal Mark Down Blog for PHP) 
=============================

MiMDoBloP **Mi**nimal **M**ark **Do**wn **Blo**g for **P**HP is simplistic dynamically generated markdown blog. 

Quick Start
-----------
It is as easy as executing 5 commands and you are ready to go. Clone the github repository into a directory of your choice, change into the directory, adapt the configuration file, create your first post and edit your first blog post. 
<pre>
git clone https://github.com/pur80a/MDBlog.git /var/www/html/blog 
cd /var/www/html/blog 
vim res/config.php
./res/mkpost.sh my-first-post
</pre>

Dependencies 
------------
- a running PHP server e.g. apache with php extension 
- a markdown to html converter e.g. [`markdown`](https://daringfireball.net/projects/markdown/) or [`pandoc`](https://github.com/jgm/pandoc)
- `bash`, `sed` and `grep`
- gnu coreutils (`basename`, `echo`, `ln`, `ls`,`mkdir`, `pwd`, `readlink`, `tail`, `tr`, `wc`) 
- `vim` or any other command line text editor

Resources
---------
In the resource directory `res` following files can be found:
- `res.php`: file which consists of all the code which is used to generate the blog posts. 
- `index.php`: file which is linked in every blog post directory to convert MD to HTML 
- `style.css`: style sheet 
- `config.php`: a configuration file 
- `mkpost.sh`: a tiny script to create the skeleton for a new post 

Directory Structure
-------------------
The remaining folders should be named YYYY-MM-DD (and are name in this manner automatically by the `mkpost.sh` script). The date format can be changed as pleased in the `mkpost.sh` script (eg. YYYY-MM, see `man(1) date`). The folders can even be named arbitrarily, but chronological order is not guaranteed. This could be used to categorize blog posts. 

The name of the parent directory will be used as a title for the web page. If the `index.php` file (link) is missing, the post will not be displayed in the overview. This can be used to hide post which aren't finished. Alternatively, one can rename the `index.php` file and work on the post (this breaks the seamless navigation. 

Markdown File Structure
-----------------------
The first two lines are not printed in the resulting HTML file. The first line is used as a general heading and the second line is discarded. 

