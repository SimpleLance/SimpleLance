VAGRANTFILE_API_VERSION = "2"

path = "#{File.dirname(__FILE__)}"

require 'yaml'
require path + '/scripts/simplelance.rb'

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  SL.configure(config, YAML::load(File.read(path + '/simplelance.yaml')))

  config.vm.provision "shell", path: "scripts/customize.sh"
end
