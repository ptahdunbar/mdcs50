# For a complete reference of vagrant, please see the online documentation at
# https://docs.vagrantup.com.
#
# For a complete reference of Varrgrant for Vagrant, please see the online documentation at
# https://github.com/ptahdunbar/Vagrant.json

require 'rubygems'
require 'json'
require 'rbconfig'

# Store the current version of Vagrant
vagrant_version = Vagrant::VERSION.sub(/^v/, '')

# Are we on windows? Yeah, let's remember this just in case.
is_windows = (RbConfig::CONFIG['host_os'] =~ /mswin|mingw|cygwin/)

# Store the current path
vagrant_dir = File.expand_path(File.dirname(__FILE__))

# Optional. install vagrant plugins from your Customfile. i.e.:
# required_plugins = %w(vagrant-exec vagrant-pristine)
required_plugins = %w()

required_plugins.each do |plugin|
    system "vagrant plugin install #{plugin}" unless Vagrant.has_plugin? plugin
end

# Try Vagrant.local.json first
if File.exists? "Vagrant.local.json"
    boxfile = "Vagrant.local.json"

# Okay, try Vagrant.json
elsif File.exists? "Vagrant.json"
    boxfile = "Vagrant.json"
end

# pass in a boxfile to load.
ARGV.each do |arg|
    if arg.include?('--boxfile=')
        boxfile = arg.gsub('--boxfile=', '')
    end
end

# Customfile - POSSIBLY UNSTABLE
#
# Use this to insert your own (and possibly rewrite) Vagrant config lines. Helpful
# for mapping additional drives. If a file 'Customfile' exists in the same directory
# as this Vagrantfile, it will be evaluated as ruby inline as it loads.
#
# Note that if you find yourself using a Customfile for anything crazy or specifying
# different provisioning, then you may want to consider a new Vagrantfile entirely.
if File.exists?(File.join(vagrant_dir,'Customfile')) then
    eval(IO.read(File.join(vagrant_dir,'Customfile')), binding)
end

# Create a Vagrant based off the example file.
if File.exists? boxfile
    boxes = JSON.parse(File.read(boxfile));
else
    data = %{[
    {
        "hostname": "vagrant"
    }
]}
    f = File.new("Vagrant.json", "w")
    f.write(data)
    f.close

    puts "[success] Created Vagrant.json. Configure your VM and launch vagrant up!"
    puts "[info] Configure your vagrant environment by adding Vagrant definitions to Vagrant.json."
    exit
end

puts "[info] Loading box configuration from #{boxfile}"

# Vagrantfile API version.
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
    #
    # Loop and configure each VM defined in boxfile.
    #
    boxes.each_with_index do |node, index|

      # GUARD: hostname is the only required param.
      next unless node["hostname"]

      # get the hostname and tld
      if node["hostname"].include? "."
        tld = node["hostname"].split('.').last;
        hostname = node["hostname"]
        host = node["hostname"].split('.').first
      else
        tld = "dev"
        hostname = node["hostname"] + "." + tld
        host = node["hostname"]
      end

      # get the box to use for this node
      box = node["box"] ? node["box"] : "ubuntu/trusty64"

      # get the IP address or setup a sequential one
      node_count = index + 1
      ip_address = node["ip"] ? node["ip"] : "%d.%d.%d.%d" % [10, 10, 10, node_count.to_s.ljust(3, '0')]

      # debug box settings
      #puts "hostname: #{hostname}"
      #puts "host: #{host}"
      #puts "tld: #{tld}"
      #puts "box: #{box}"
      #puts "ip_address: #{ip_address}"

      #
      # VM CONFIGURATION
      #
      config.vm.define "#{hostname}" do |configure_node|

        # Set the box to use for this node
        configure_node.vm.box = box

        # Set the guest IP address
        configure_node.vm.network "private_network", ip: ip_address, :netmask => "255.255.255.0"

        #
        # Configure: Shell Script provisioning
        # Learn more: https://docs.vagrantup.com/v2/provisioning/shell.html
        #
        if node["provision"]
            if node["provision"].kind_of? String
                configure_node.vm.provision "shell", path: "#{node["provision"]}"
            else
                node["provision"].each do |script|

                    if script.kind_of? String
                        configure_node.vm.provision "shell", path: "#{script}"
                    else
                        next unless ( script.include?('path') or script.include?('inline') )

                        #puts "script: #{script}"

                        config.vm.provision "shell" do |s|
                            s.inline = script['inline'] if script['inline']
                            s.path = script['path'] if script['path']
                            s.args = script['args'] if script['args']
                            s.privileged = script['privileged'] if script['privileged']
                            s.binary = script['binary'] if script['binary']
                            s.upload_path = script['upload_path'] if script['upload_path']
                            s.keep_color = script['keep_color'] if script['keep_color']
                            s.powershell_args = script['powershell_args'] if script['powershell_args']
                        end
                    end
                end
            end
        end

        #
        # DNS settings
        #
        if Vagrant.has_plugin? "vagrant-hostsupdater"
            configure_node.hostsupdater.remove_on_suspend = true
            configure_node.vm.hostname = hostname
            configure_node.hostsupdater.aliases = box["hostname"] if box["hostname"].kind_of?(Array)
        end

        #
        # Port forwarding
        # http://docs.vagrantup.com/v2/networking/forwarded_ports.html
        #
        if node["forwarded_ports"]
            node["forwarded_ports"].each do |port|
                configure_node.vm.network "forwarded_port", guest: port["guest"], host: port["host"]
            end
        end

        #
        # Synced folders
        # http://docs.vagrantup.com/v2/synced-folders/basic_usage.html
        #
        if node["synced_folders"]
            node["synced_folders"].each do |params|
                next unless ( params.include?('host') or params.include?('guest') )

                folder_args = params.dup
                folder_args.delete('host')
                folder_args.delete('guest')
                folder_args = Hash[folder_args.map{ |key, value| [key.to_sym, value] }]

                # debug arguments passed
                #puts "params: #{params}"
                #puts "folder_args: #{folder_args}"

                configure_node.vm.synced_folder params["host"], params["guest"], folder_args
            end
        end

        #
        # For convenience :)
        #
        if node["shared_folders"]
            node["shared_folders"].each do |params|
                next unless ( params.include?('host') or params.include?('guest') )

                folder_args = params.dup
                folder_args.delete('host')
                folder_args.delete('guest')
                folder_args = Hash[folder_args.map{ |key, value| [key.to_sym, value] }]

                # debug arguments passed
                #puts "params: #{params}"
                #puts "folder_args: #{folder_args}"

                configure_node.vm.synced_folder params["host"], params["guest"], folder_args
            end
        end

        #
        # SSH Settings override
        #
        if node["settings"]
            configure_node.ssh.username = node["settings"]["ssh_username"] if node["settings"]["ssh_username"]
            configure_node.ssh.host = node["settings"]["ssh_host"] if node["settings"]["ssh_host"]
            configure_node.ssh.port = node["settings"]["ssh_port"] if node["settings"]["ssh_port"]
            configure_node.ssh.private_key_path = node["settings"]["private_key_path"] if node["settings"]["private_key_path"]
            configure_node.ssh.forward_agent = node["settings"]["forward_agent"] if node["settings"]["forward_agent"]
            configure_node.ssh.forward_x11 = node["settings"]["forward_x11"] if node["settings"]["forward_x11"]
            configure_node.ssh.insert_key = node["settings"].include?("insert_key") ? node["settings"]["insert_key"] : true

            if node["settings"]["disable_default_synced_folder"]
                configure_node.configure_node.synced_folder ".", "/vagrant", id: "vagrant-root", disabled: true
            end
        end

        #
        # Provider: Virtualbox
        #
        configure_node.vm.provider :virtualbox do |virtualbox, override|

            # DNS fix
            virtualbox.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
            virtualbox.customize ["modifyvm", :id, "--natdnsproxy1", "on"]

            if node["settings"]
                virtualbox.gui = true if node["settings"]["gui"]

                virtualbox.cpus = node["settings"]["cpus"] if node["settings"]["cpus"]
                virtualbox.memory = node["settings"]["memory"] if node["settings"]["memory"]
            end

            if node["settings"] and node["settings"].include? "disable_vm_optimization"
                host = RbConfig::CONFIG['host_os']

                # Give VM 1/4 system memory & access to all cpu cores on the host
                if host =~ /darwin/
                    cpus = `sysctl -n hw.ncpu`.to_i
                    memory = `sysctl -n hw.memsize`.to_i / 1024 / 1024 / 4
                elsif host =~ /linux/
                    cpus = `nproc`.to_i
                    memory = `grep 'MemTotal' /proc/meminfo | sed -e 's/MemTotal://' -e 's/ kB//'`.to_i / 1024 / 4
                else # sorry Windows folks, I can't help you
                    cpus = 2
                    memory = 1024
                end

                #puts "Optimized CPUs: #{cpus}"
                #puts "Optimized Memory: #{memory}"

                virtualbox.memory = memory
                virtualbox.cpus = cpus
            end
        end

        #
        # Provider: VMWare Fusion
        #
        configure_node.vm.provider :vmware_fusion do |vmware, override|
            if node["settings"]
                override.vm.node_url = "http://files.vagrantup.com/precise64_vmware.node"
                vmware.gui = true if node["settings"]["gui"]
                vmware.vmx["numvcpus"] = node["settings"]["cpus"] if node["settings"]["cpus"]
                vmware.vmx["memsize"] = node["settings"]["cpus"] if node["settings"]["memory"]
            end
        end

        #
        # Provider: Amazon Web Services (AWS)
        #
        configure_node.vm.provider :aws do |aws, override|
            if node["aws"]
                override.vm.box_url = "https://github.com/mitchellh/vagrant-aws/raw/master/dummy.box"

                # Required parameters
                aws.ami = node["aws"]["ami"] || 'ami-d05e75b8'
                aws.instance_type = node["aws"]["instance_type"] || 't2.micro'
                aws.keypair_name = node["aws"]["keypair_name"] || raise("An error occurred. Missing aws 'keypair name'.")
                override.ssh.username = node["aws"]["username"] || 'ubuntu'
                override.ssh.private_key_path = node["aws"]["private_key_path"]

                # Alternative approach: add keys into your .bashrc or .zshrc profile
                # export AWS_SECRET_KEY=secret_key
                # export AWS_ACCESS_KEY=secret_key
                aws.access_key_id = node["aws"]["access_key_id"] || ENV["AWS_ACCESS_KEY"]
                aws.secret_access_key = node["aws"]["secret_access_key"] || ENV["AWS_SECRET_KEY"]
                aws.session_token = node["aws"]["session_token"] || ENV["AWS_SESSION_TOKEN"]

                # optional settings
                aws.region = node["aws"]["region"] if node["aws"]["region"]
                aws.availability_zone = node["aws"]["availability_zone"] if node["aws"]["availability_zone"]
                aws.security_groups = node["aws"]["security_groups"] if node["aws"]["security_groups"]
                aws.tags = node["aws"]["tags"] if node["aws"]["tags"]
                aws.subnet_id = node["aws"]["subnet_id"] if node["aws"]["subnet_id"]
                aws.availability_zone = node["aws"]["availability_zone"] if node["aws"]["availability_zone"]
                aws.elastic_ip = node["aws"]["elastic_ip"] if node["aws"]["elastic_ip"]
                aws.use_iam_profile = node["aws"]["use_iam_profile"] if node["aws"]["use_iam_profile"]
                aws.private_ip_address = node["aws"]["private_ip_address"] if node["aws"]["private_ip_address"]
                aws.user_data = node["aws"]["user_data"] if node["aws"]["user_data"]
                aws.iam_instance_profile_name = node["aws"]["iam_instance_profile_name"] if node["aws"]["iam_instance_profile_name"]
                aws.iam_instance_profile_arn = node["aws"]["iam_instance_profile_arn"] if node["aws"]["iam_instance_profile_arn"]
                aws.instance_package_timeout = node["aws"]["instance_package_timeout"] if node["aws"]["instance_package_timeout"]
                aws.instance_ready_timeout = node["aws"]["instance_ready_timeout"] if node["aws"]["instance_ready_timeout"]
            end
        end

        #
        # Provider: Digital Ocean
        #
        configure_node.vm.provider :digital_ocean do |digital_ocean, override|
            if node["digital_ocean"]
                override.vm.box_url = "https://github.com/smdahlen/vagrant-digitalocean/raw/master/box/digital_ocean.box"

                # Alternative: export DIGITAL_OCEAN_TOKEN=secret_key
                digital_ocean.token = node["digital_ocean"].include?("token") ? node["digital_ocean"]["token"] : ENV["DIGITAL_OCEAN_TOKEN"]

                # Optional
                override.ssh.private_key_path = node["digital_ocean"]["private_key_path"]
                override.ssh.username = node["digital_ocean"]["username"] if node["digital_ocean"]["username"]
                digital_ocean.ssh_key_name = node["digital_ocean"].include?("ssh_key_name") ? node["digital_ocean"]["ssh_key_name"] : 'Vagrant'
                digital_ocean.image = node["digital_ocean"].include?("image") ? node["digital_ocean"]["image"] : "ubuntu-14-04-x64"
                digital_ocean.region = node["digital_ocean"].include?("region") ? node["digital_ocean"]["region"] : "nyc2"
                digital_ocean.size = node["digital_ocean"].include?("size") ? node["digital_ocean"]["size"] : "512mb"
                digital_ocean.ipv6 = node["digital_ocean"].include?("ipv6") ? node["digital_ocean"]["ipv6"] : false
                digital_ocean.private_networking = node["digital_ocean"].include?("private_networking") ? node["digital_ocean"]["private_networking"] : false
                digital_ocean.backups_enabled = node["digital_ocean"].include?("backups_enabled") ? node["digital_ocean"]["backups_enabled"] : false
                digital_ocean.setup = node["digital_ocean"].include?("setup") ? node["digital_ocean"]["setup"] : true
            end
        end

        # Speed up vagrant
        configure_node.cache.scope = :box if Vagrant.has_plugin? "vagrant-cachier"

      end # config.vm.define

    end # boxes.each
end # Vagrant.configure
