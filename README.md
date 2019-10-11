# laravel-admin（如果帮助了你，请给个Star），请认真看介绍
laravel-admin码的B2B电子商务行业门户后台网站管理系统<br>
开箱即用，当前已发布商城、会员、项目、文章、项目资讯、问答、图库管理、供应管理、网站配置、等模型<br>
新增微信小程序版本，详情请移步https://github.com/imnotdoubi/laraveladmin-xcx<br>

目前已更新PC端预览，链接查看 http://b2b.yht7.com/<br>

后台查看链接查看 http://b2b.yht7.com/admin/auth/login  用户密码：yunhaitian  admin<br>


#安装方式

1、git clone https://github.com/imnotdoubi/laravel-admin.git<br>

有朋友说更新慢，因此取消了数据中图片和vendor文件夹，<br>
2、public目录下载(包含样式记得下载)<br>
http://b2b.yht7.com/data/public.zip<br>

3、composer install <br>
注意：如果您更新后遇到问题，请直接点击下面的链接下载替换本地目录<br>
http://b2b.yht7.com/data/vendor.zip<br>

4、php artisan migrate 迁移<br>


5、数据导入(因为数据部分是采集的，因此没做填充)<br>

导入方法：根目录下public\data\laradmin.sql文件数据，然后配置项.env文件,执行php artisan key:generate


6、（没问题可忽略这一步）如果前端会员注册有问题：<br>
可以先执行：php artisan make:auth<br>
然后替换掉\resources\views\auth 和  \app\Http\Controllers\Auth文件夹 下的内容  跟 \config\auth.php文件


#你本地访问地址
前端：http://127.0.0.1
后台：http://127.0.0.1/admin/auth/login  默认密码 admin  admin

#部分截图
![laravel-admin](https://github.com/imnotdoubi/laravel-admin/blob/master/public/vimg/10.jpg)
![laravel-admin](https://github.com/imnotdoubi/laravel-admin/blob/master/public/vimg/11.jpg)
![laravel-admin](https://github.com/imnotdoubi/laravel-admin/blob/master/public/vimg/12.jpg)
![laravel-admin](https://github.com/imnotdoubi/laravel-admin/blob/master/public/vimg/13.jpg)
![laravel-admin](https://github.com/imnotdoubi/laravel-admin/blob/master/public/vimg/14.jpg)
![laravel-admin](https://github.com/imnotdoubi/laravel-admin/blob/master/public/vimg/15.jpg)
