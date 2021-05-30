![SeAT](https://i.imgur.com/aPPOxSK.png)

<h2 align="center">
SeAT: A Simple, EVE Online API Tool and Corporation Manager
</h2>

**简体中文**|[English](./docs/en-US.md)

# SeAT Mumble

这款插件为为您的 [SeAT](https://github.com/eveseat/seat) 提供了一种使用查询和授予权限系统管理 Mumble 的方法。

## 安装

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