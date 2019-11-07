#### Composer 加速
```  $composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/ ```
#### 创建Laravel应用
```$ composer create-project laravel/laravel larabbs --prefer-dist "6.*"```
#### 修改Hosts文件
```vim /etc/hosts```
在最后一行添加
```192.168.10.10 laravel.test```
#### 新增站点
```vim ~/Homestead/Homestead.yaml```
```yaml
---
ip: "192.168.10.10"
memory: 2048
cpus: 1
provider: virtualbox

authorize: ~/.ssh/id_rsa.pub

keys:
    - ~/.ssh/id_rsa

folders:
    - map: ~/Code
      to: /home/vagrant/Code

sites:
    - map: homestead.test
      to: /home/vagrant/Code/Laravel/public
    - map: larabbs.test # <--- 这里
      to: /home/vagrant/Code/larabbs/public # <--- 这里

databases:
    - homestead
    - larabbs # <--- 这里
```
`sites` 会将域名映射到虚拟机的`/home/vagrant/Code/laravel/public`文件夹上，`databases`会创建新的数据库
#### 虚拟机指令
- 开启虚拟机`cd ~/Homestead && vagrant up`
- 进入虚拟机`vagrant ssh`
- 关闭虚拟机`cd ~/Homestead && vagrant halt`
- 重启虚拟机`cd ~/Homestead && vagrant provision && vagrant relod`
