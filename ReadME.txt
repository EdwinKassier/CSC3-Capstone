#========== CSC3003S Capstone project ===========#
Final semester Computer Science project focusing on the full pipeline of processes needed in software development

To be updated as the project progresses

#========== Collaborators ===========#
Edwin Kassier, Josh Redelinghuys & Charl Ritter

#========== VAGRANT HOW-TO ===========#
INITIATE:
1). Run "$ vagrant init" in project location, in console.

UP:
1). Run "$ vagrant up" in project location, in console.
This builds the vm.

SSH:
1). Run "$ vagrant ssh" in project location, in console.
This logs you into the vm's console.
2). Set up the enviroment, by installing these pacakges:

    sudo apt-get install mysql-server libapache2-mod-auth-mysql php5-mysql
    sudo mysql_install_db
    sudo /usr/bin/mysql_secure_installation (set root pass to root)
    sudo apt-get install php5 libapache2-mod-php5 php5-mcrypt
    sudo apt-get install -y php5-cgi php5-cli php5-curl php5-common php5-gd php5-mysql
    sudo apt-get install phpmyadmin apache2-utils (pass should now be root)

    sudo service apache2 restart


MISC:
1). HALT: in project location "$ vagrant halt" will shutdown the vm.
2). RELOAD: in project location "$ vagrant reload" will reload the vm. (only needed to install new packages)
3). DESTROY: in project location "$ vagrant destroy" will destroy the vm. (Not needed unless vm broke)
4). STATUS: in project location "$ vagrant status" will display the state of the vm.
5). EXIT: on the ssh, "$ exit", logs out he vm.

SHARE:
1). To be able to share, run this command to install: "$ vagrant plugin install vagrant-share".
2). Create account, download, unzip & move to windows/system32 from https://dashboard.ngrok.com/get-started.
3). Run ngrok and in its console run "$ ngrok authtoken <AUTH CODE>".
4). After this, run "$ vagrant share" in normal console.

VIEW SITE:
1). Go-to http://127.0.0.1:4567/public_html/