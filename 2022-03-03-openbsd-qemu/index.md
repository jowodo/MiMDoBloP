About OpenBSD
=======
OpenBSD is a fork of BDS which is it self a fork from the original UNIX and I've heard a lot of positive things about it. 
I've played with the idea of installing and some days ago it popped up in my mind and I decided to give it a try.
So I watched some youtube videos and read some articles and dove into it.
Especially this [video](https://youtu.be/oTShQIXSdqM) gave me a very good tip/warning: 
there is a big difference between how to retrieve information about Linux and OpenBSD. 
Because Linux is relatively wide spread, you can just search-engine your question and find your answer. 
OpenBSD has a rather rtfm (read the fuxxing manual) mentality, but on the other hand it is well know for it qualitative manual pages. 
So I started this journey with the mindset of reading a lot of docu and it was amazing.

Installation 
============
I decided to try it in a virtual machine first. 
As I am on Linux, my VM of choice is qemu because it can be used from the command line and I find that cool. 
So the first step was to create the virtual hard disk:

`qemu-img create -f qcow2 openbsdbox.img 10G`

This command creates a dynamically allocated virtual hard disk with a maximum size of 10GB with the name openbsdbox.img and the file format qcow2. 
I downloaded the image from [openbsd.org](https://www.openbsd.org/faq/faq4.html#Download): 

`wget https://cdn.openbsd.org/pub/OpenBSD/7.0/amd64/install70.iso` 

Now we can already boot into the installation live disk.

`qemu-system-x86_64 -drive file=/home/pur/Doc/Computer/Distros/obsdbox.img,format=qcow2 -enable-kvm -m 4G -cdrom /home/pur/Doc/Computer/Distros/openbsd_install70.iso -boot once=d`

The installation process is rather straight forward. 
You will be prompted with some questions and the answers will determine your installation.
