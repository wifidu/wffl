My notes :cn:

基本环境
========
### Composer 加速
```  $composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/ ```
### 创建Laravel应用
```$ composer create-project laravel/laravel larabbs --prefer-dist "6.*"```
### 修改Hosts文件
```vim /etc/hosts```
在最后一行添加
```192.168.10.10 laravel.test```
### 新增站点
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
### 虚拟机指令
- 开启虚拟机`cd ~/Homestead && vagrant up`
- 进入虚拟机`vagrant ssh`
- 关闭虚拟机`cd ~/Homestead && vagrant halt`
- 重启虚拟机`cd ~/Homestead && vagrant provision && vagrant relod`

前端流
=====
### Laravel项目中使用Bootstrap
```$ composer require laravel/ui --dev```

上面的命令安装完成后，使用以下命令来引入Bootstrap

```$ php artisan ui bootstrap```

### 运行 Laravel Mix

- 更换国内镜像：

```$ npm config set registry=https://registry.npm.taobao.org```

```$ yarn config set registry https://registry.npm.taobao.org```

- 然后使用Yarn安装依赖：

```$ yarn install```

- 安装成功后，运行以下命令：

```$ npm run watch-poll``` 

**当修改app.scss之后运行这个命令才能使改变的代码部分生效，当然你也可以在后台一直运行着这个命令。**

### 解决浏览器缓存问题

对`webpack.mix.js`文件稍作修改在`mix()`方法后面加上`.version()`

### 安装字体图标库

```$ yarn add @fortawesome/fontawesome-free```

Of course, you should load it in 

*resources/sass/app.scss*

```
// Variables
@import 'variables';

// Bootstrap
@import '~bootstrap/scss/bootstrap';

// Fontawesome
@import '~@fortawesome/fontawesome-free/scss/fontawesome';
@import '~@fortawesome/fontawesome-free/scss/regular';
@import '~@fortawesome/fontawesome-free/scss/solid';
@import '~@fortawesome/fontawesome-free/scss/brands';
```
完了之后别忘了运行`npm run watch-poll`进行编译
