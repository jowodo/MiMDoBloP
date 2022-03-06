OpenBSD in QEMU
===============

About OpenBSD
-------------
OpenBSD is a fork of BSD (Berkley Software Distribution)  which is it self a fork from the original UNIX and I've heard a lot of positive things about it. 
For some time I've played with the idea of installing it and some days ago it popped up in my mind and I decided to give it a try.
So I watched some youtube videos and read some articles and dove into it.
Especially this [video](https://youtu.be/oTShQIXSdqM) gave me a very good tip/warning: 
there is a big difference between how to retrieve information about Linux and OpenBSD. 
Because Linux is relatively wide spread, one can just duckduckgo one's question and find the answer. 
OpenBSD has a rather rtfm (read the fucking manual) mentality, but on the other hand it is well know for it qualitative manual pages. 
So I started this journey with a mindset of reading a lot of docu and it was amazing.

Installation 
------------
I decided to try it in a virtual machine first. 
As I am on Linux, my VM of choice is qemu because it can be used from the command line and I find that cool. 
So the first step was to create the virtual hard disk:

    qemu-img create -f qcow2 openbsdbox.img 10G

This command creates a dynamically allocated virtual hard disk with a maximum size of 10GB with the name openbsdbox.img and the file format qcow2. 
That means that the file will only be as big as it needs to be. 
I downloaded the image from [openbsd.org](https://www.openbsd.org/faq/faq4.html#Download): 

    wget https://cdn.openbsd.org/pub/OpenBSD/7.0/amd64/install70.iso

Now I can already boot into the installation live disk:

	qemu-system-x86_64 -drive file=/home/pur/Doc/Computer/Distros/obsdbox.img,format=qcow2 -enable-kvm -m 4G -cdrom /home/pur/Doc/Computer/Distros/openbsd_install70.iso -boot once=d


The installation process is rather straight forward. 
I was be prompted with some questions and the answers determined what has been installed. 
I chose to install a graphical user interface (GUI).
Then I rebooted, but I wasn't greeted by a nice OpenBSD display manager (graphical login), but rather the command line interface (CLI). 
Eventually, I found out that the problem was the video driver. 
How? I don't remember, but I think `dmesg` gave me the needed hint. 
The solution was to use the vmware vga card emulator: 

    qemu-system-x86_64 -drive file=/home/pur/Doc/Computer/Distros/obsdbox.img,format=qcow2 -enable-kvm -m 4G -vga vmware 

With this command I managed to arrive at the display manger and I could enter my user name and my password but I couldn't see my mouse. 

to be continued ...

After Boot
----------

After booting I read the mail with the `mail` command did some basic stuff:

	mail
	man afterboot 
	info
	su
	echo "permit :wheel persist" > /etc/doas.conf
	doas pkg_add vim screen

- In the first mail i got a nice intro to the some basic utilities like man, info, and the afterboot manual page. I would have loved to get this rather straight forward introduction when I first started with linux. 
- The afterboot manual page gives a short intro to many of the inner workings of the system (conifiguration files in `/etc/`, users, gorups, `su` and `doas`, `ssh` config, changing passwords `passwd`, networking, mounting, `rc` and many more). 
- The `info` command was completely new for me. I only got through the tutorial on how to navigate through the info nodes (pages) because it's nice to have an alternative to the manual pages provided by the `man command`. 
- I used `su` to get super user (root) privileges, to install some basic tools which I was missing. The first thing I did, though was to activate `doas` (`sudo` equivalent) for the wheel group. Finally, I installed (beloved) `vim` and `screen` as apparently `tmux` could not be found. 
- Some useful screen commands are (`C-a` stands for control+a): 
	- `C-a c` create a new tab
	- `C-a digit` switch to tab 0-9
	- `C-a C-a` switch to previous tab
	- `C-a S` split window horizontally
	- `C-a |` split window vertically
	- `C-a X` kill current region
