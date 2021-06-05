![SeAT](https://i.imgur.com/aPPOxSK.png)

<h2 align="center">
SeAT: A Simple, EVE Online API Tool and Corporation Manager
</h2>
<a href="https://packagist.org/packages/arielheleneto/seat-mumble"><img src="https://poser.pugx.org/arielheleneto/seat-mumble/v/stable" /></a>
<a href="https://packagist.org/packages/arielheleneto/seat-mumble"><img src="https://poser.pugx.org/arielheleneto/seat-mumble/v/unstable" /></a>
<a href="https://packagist.org/packages/arielheleneto/seat-mumble"><img src="https://poser.pugx.org/arielheleneto/seat-mumble/license" /></a>
<a href="https://styleci.io/repos/360905740"><img src="https://styleci.io/repos/360905740/shield?branch=master" alt="StyleCI"></a>

**简体中文** | [English](./docs/en-US.md)

# SeAT Mumble

这款插件为为您的 [SeAT](https://github.com/eveseat/seat) 提供了一种使用查询和授予权限系统管理 Mumble 的方法。

## 安装

考虑到以容器方式运行的 SeAT 的数据库无法轻易地被外部服务器访问，建议使用常规数据库或考虑将数据库端口暴露到主机。

### 常规安装

首先，在 env 文件中添加参数 `MUMBLE_ADD`。该参数的值为您的语音服务器地址。

在 SeAT 根目录下运行下列命令。

```shell
php artisan down
composer require arielheleneto/seat-mumble
php artisan migrate
php artisan up
```

现在，当您以正确的权限登录 **SeAT** 时，您应该会在侧边栏中看到一个「Mumble 管理」类别。

然后，在「设置 - 计划任务」中添加 `mumble:refresh` 计划任务，**建议**每小时执行一次，以取消不符合权限的用户的服务器访问权限。

