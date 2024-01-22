# WAPH-Web Application Programming and Hacking

## Instructor: Dr. Phu Phung

## Student

**Name**: Amit Gaddi

**Email**: gaddiat@ucmail.uc.edu

**Short-bio**: Amit Gaddi has keen interests in IT. 

![Amit's headshot](images/Pic.jpg)

## Repository Information

Respository's URL: [https://github.com/gaddiat/waph-gaddiat.git](https://github.com/gaddiat/waph-gaddiat.git)

This is a private repository for Amit Gaddi to store all code from the course. The organization of this repository is as follows.

### Labs 

[Hands-on exercises in lectures](labs) 

  - [Lab 0](https://github.com/gaddiat/waph-gaddiat/tree/main/labs/lab0): Development Environment Setup

# Lab 0 - Development Environment Setup 


## The lab's overview

In this lab we have covered setting up softwares in the Ubuntu Virtual Machine and setting up git repository in the Virtual MAchine and performing git operation on our private repository

[https://github.com/gaddiat/waph-gaddiat/tree/main/labs/lab0](https://github.com/gaddiat/waph-gaddiat/tree/main/labs/lab0)

## Part I - Ubuntu Virtual Machine & Software Installation

Steps-
1,Opened the sand box  
2,Deployed my virtual machine  
3,Installed the softwares required as in the pdf shared using apt command.  


### Apache Web Server Testing

After installing the Apache sever 2, finding out my ip address and using it in the browser to check Apache server 

![Apache Screenshot](images/apache.png)

## Part II - git Repositories and Exercises

### The course repository

Using git commands and ssh cloned the repository.

![git clone](images/gitclone.png)

### Private Repository

Created a private repsoitory from the github website.

[https://github.com/gaddiat/waph-gaddiat.git](https://github.com/gaddiat/waph-gaddiat.git)

First created SSH using the ubuntu terminal and then using the SSH code clone the repository in the machine. performed changes on README markdown file.

![git commit and push](images/gitcp.png)

![git commit and push](images/gitcp1.png)

I have used the 'pandoc -f markdown-implicit_figures README.md --pdf-engine=xelatex -t latex  -o lab0.pdf' command to generate by pdf as I was getting an error.