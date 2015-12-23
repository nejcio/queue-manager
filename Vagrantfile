Vagrant.configure(2) do |config|
#vm box
  config.vm.box = "ubuntu/trusty64"
#forwarded port
  config.vm.network "forwarded_port", guest: 80, host: 1248
  # Create a private network, which allows host-only access to the machine
  # using a specific IP.
  config.vm.network "private_network", ip: "192.168.33.12"
    #ansible config
    config.vm.provision :ansible do |ansible|
      ansible.limit = 'all,localhost'
      ansible.playbook = "playbook.yml"
    end
end
