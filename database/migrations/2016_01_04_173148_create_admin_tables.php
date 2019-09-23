<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminTables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function getConnection()
    {
        return config('admin.database.connection') ?: config('database.default');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('admin.database.users_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 190)->unique();
            $table->string('password', 60);
            $table->string('name');
            $table->string('email',100)->nullable();
            $table->string('avatar')->nullable();
            $table->bigInteger('autoflg')->default(0)->nullable();
            $table->string('token', 255)->nullable();
            $table->string('oid', 255)->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
        });

        Schema::create(config('admin.database.roles_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->unique();
            $table->string('slug', 50)->unique();
            $table->timestamps();
        });

        Schema::create(config('admin.database.permissions_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->unique();
            $table->string('slug', 50)->unique();
            $table->string('http_method')->nullable();
            $table->text('http_path')->nullable();
            $table->timestamps();
        });

        Schema::create(config('admin.database.menu_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0);
            $table->integer('order')->default(0);
            $table->string('title', 50);
            $table->string('icon', 50);
            $table->string('uri', 50)->nullable();
            $table->string('permission')->nullable();

            $table->timestamps();
        });

        Schema::create(config('admin.database.role_users_table'), function (Blueprint $table) {
            $table->integer('role_id');
            $table->integer('user_id');
            $table->index(['role_id', 'user_id']);
            $table->timestamps();
        });

        Schema::create(config('admin.database.role_permissions_table'), function (Blueprint $table) {
            $table->integer('role_id');
            $table->integer('permission_id');
            $table->index(['role_id', 'permission_id']);
            $table->timestamps();
        });

        Schema::create(config('admin.database.user_permissions_table'), function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('permission_id');
            $table->index(['user_id', 'permission_id']);
            $table->timestamps();
        });

        Schema::create(config('admin.database.role_menu_table'), function (Blueprint $table) {
            $table->integer('role_id');
            $table->integer('menu_id');
            $table->index(['role_id', 'menu_id']);
            $table->timestamps();
        });

        Schema::create(config('admin.database.operation_log_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('path');
            $table->string('method', 10);
            $table->string('ip');
            $table->text('input');
            $table->index('user_id');
            $table->timestamps();
        });

        Schema::create(config('admin.database.wbsdb_articles_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255);
            $table->string('flag', 30)->nullable();
            $table->integer('parent_id')->default(0);
            $table->string('keyword',255)->nullable();
            $table->string('description',255)->nullable();
            $table->text('content')->nullable();
            $table->integer('hits')->default(50)->nullable();
            $table->integer('favs')->default(0)->nullable();
            $table->integer('status')->default(1)->nullable();
            $table->string('conver',255)->nullable();
            $table->integer('author_id')->default(1)->nullable();
            $table->index(['parent_id', 'hits', 'status','author_id']);
            $table->date('created_date')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::create(config('admin.database.wbsdb_asks_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0);
            $table->integer('level')->default(0)->nullable();
            $table->string('title', 255);
            $table->string('thumb',255)->nullable();
            $table->integer('hits')->default(50)->nullable();
            $table->integer('comments')->default(0)->nullable();
            $table->mediumText('content')->nullable();
            $table->integer('quesid')->default(0)->nullable();
            $table->integer('author_id')->default(0)->nullable();
            $table->integer('hidden')->default(0)->nullable();
            $table->integer('status')->default(1)->nullable();
            $table->index(['parent_id', 'hits', 'status','author_id','quesid']);
            $table->timestamps();
        });

        Schema::create(config('admin.database.wbsdb_categories_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0)->nullable();
            $table->integer('order')->default(1)->nullable();
            $table->string('typename', 60);
            $table->string('typedir', 30);
            $table->string('title', 255)->nullable();
            $table->string('keyword',255)->nullable();
            $table->string('description',255)->nullable();
            $table->text('content')->nullable();
            $table->integer('mid')->default(1)->nullable();
            $table->integer('status')->default(1)->nullable();
            $table->integer('author_id')->default(0)->nullable();
            $table->index(['parent_id', 'order', 'status','author_id','mid']);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::create(config('admin.database.wbsdb_companys_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('combrand', 100)->unique();
            $table->string('purl', 30);
            $table->string('comname', 120);
            $table->bigInteger('level')->default(0)->nullable();
            $table->integer('status')->default(1)->nullable();
            $table->bigInteger('vip')->default(0)->nullable();
            $table->string('type', 100)->nullable();
            $table->bigInteger('catid')->default(0)->nullable();
            $table->bigInteger('parent_id')->default(0)->nullable();
            $table->bigInteger('province')->default(0)->nullable();
            $table->bigInteger('city')->default(0)->nullable();
            $table->bigInteger('district')->default(0)->nullable();
            $table->string('mode', 100)->nullable();
            $table->bigInteger('capital')->default(0)->nullable();
            $table->string('size', 100)->nullable();
            $table->string('regyear', 30)->nullable();
            $table->string('business', 255)->nullable();
            $table->string('telephone', 50)->nullable();
            $table->string('fax', 50)->nullable();
            $table->string('mail', 50)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('imagesarr', 255)->nullable();
            $table->string('homepage', 255)->nullable();
            $table->string('thumb', 255)->nullable();
            $table->string('introduce', 255)->nullable();
            $table->integer('hits')->default(50)->nullable();
            $table->bigInteger('mdnum')->default(10)->nullable();
            $table->bigInteger('yxnum')->default(50)->nullable();
            $table->bigInteger('sqnum')->default(25)->nullable();
            $table->string('renqun', 199)->nullable();
            $table->string('title', 255)->nullable();
            $table->string('keyword',255)->nullable();
            $table->string('description',255)->nullable();
            $table->text('content')->nullable();
            $table->integer('author_id')->default(0)->nullable();
            $table->index(['parent_id','catid','status']);
            $table->index(['province','city','hits']);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::create(config('admin.database.wbsdb_company_datas_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->text('content')->nullable();
        });

        Schema::create(config('admin.database.wbsdb_investments_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',255);
            $table->bigInteger('order')->default(1)->nullable();
        });

        Schema::create(config('admin.database.wbsdb_modules_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255);
            $table->bigInteger('order')->default(1)->nullable();
        });

        Schema::create(config('admin.database.wbsdb_malls_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0)->nullable();
            $table->bigInteger('level')->default(1)->nullable();
            $table->string('title', 255);
            $table->string('brand', 100);
            $table->bigInteger('num')->default(1)->nullable();
            $table->decimal('price',10,2)->default(1.00)->nullable();
            $table->bigInteger('amount')->default(0)->nullable();
            $table->string('thumb', 255)->nullable();
            $table->string('litpic', 255)->nullable();
            $table->bigInteger('province')->default(0)->nullable();
            $table->bigInteger('city')->default(0)->nullable();
            $table->text('content')->nullable();
            $table->string('keyword',255)->nullable();
            $table->string('introduce',255)->nullable();
            $table->integer('status')->default(1)->nullable();
            $table->integer('hits')->default(50)->nullable();
            $table->string('n1',255)->nullable();
            $table->string('n2',255)->nullable();
            $table->integer('author_id')->default(0)->nullable();
            $table->index(['parent_id', 'status','author_id','province','city','hits']);
            $table->timestamps();
        });

        Schema::create(config('admin.database.wbsdb_news_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('comid')->default(0)->nullable();
            $table->string('title', 255);
            $table->integer('hits')->default(50)->nullable();
            $table->string('thumb', 255)->nullable();
            $table->integer('status')->default(1)->nullable();
            $table->string('keyword',255)->nullable();
            $table->string('description',255)->nullable();
            $table->text('content')->nullable();
            $table->integer('author_id')->default(0)->nullable();
            $table->index(['comid', 'status','author_id','hits']);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::create(config('admin.database.wbsdb_photos_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0);
            $table->string('title', 255);
            $table->string('thumb', 255)->nullable();
            $table->string('conver', 255)->nullable();
            $table->string('introduce', 255)->nullable();
            $table->string('keyword',255)->nullable();
            $table->string('description',255)->nullable();
            $table->integer('hits')->default(50)->nullable();
            $table->integer('status')->default(1)->nullable();
            $table->integer('author_id')->default(0)->nullable();
            $table->index(['parent_id', 'status','author_id','hits']);
            $table->timestamps();
        });


        Schema::create(config('admin.database.wbsdb_phonemanages_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('phoneno',255);
            $table->string('name',255)->nullable();
            $table->string('address',255)->nullable();
            $table->string('ip',191)->nullable();
            $table->string('note',255)->nullable();
            $table->string('host',255)->nullable();
            $table->timestamps();
        });

        Schema::create(config('admin.database.wbsdb_questions_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('askid')->default(0);
            $table->mediumText('content')->nullable();
            $table->integer('author_id')->default(0)->nullable();
            $table->bigInteger('fandui')->default(0)->nullable();
            $table->bigInteger('zhichi')->default(0)->nullable();
            $table->bigInteger('hidden')->default(0)->nullable();
            $table->string('ip',191)->nullable();
            $table->bigInteger('status')->default(1)->nullable();
            $table->index(['askid', 'status','author_id']);
            $table->timestamps();
        });

        Schema::create(config('admin.database.wbsdb_settings_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('enable',4)->nullable();
            $table->string('title',255)->nullable();
            $table->string('keyword',255)->nullable();
            $table->string('description',255)->nullable();
            $table->string('slogan',255)->nullable();
            $table->string('copyright',255)->nullable();
            $table->string('icp',255)->nullable();
            $table->mediumText('statistic')->nullable();
            $table->string('logo',255)->nullable();
        });

        Schema::create(config('admin.database.wbsdb_userlog_table'), function (Blueprint $table) {
            $table->integer('user_id');
            $table->string('ip',191)->nullable();
            $table->timestamps();
        });


        Schema::create(config('admin.database.wbsdb_users_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('oid',255)->nullable();
            $table->string('username',255)->nullable();
            $table->string('password',255)->nullable();
            $table->string('name',255);
            $table->string('email',255)->nullable();
            $table->mediumText('avatar')->nullable();
            $table->bigInteger('autoflg')->default(0)->nullable();
            $table->bigInteger('status_at')->default(1)->nullable();
            $table->string('token',255)->nullable();
            $table->string('tel',255)->nullable();
            $table->string('address',255)->nullable();
            $table->string('qq',255)->nullable();
            $table->string('wx',255)->nullable();
            $table->string('remember_token',255)->nullable();
            $table->timestamps();
        });

        Schema::create(config('admin.database.wbsdb_areas_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('parent_id')->default(0);
            $table->string('name',255);
            $table->string('title',255);
            $table->bigInteger('order')->default(0)->nullable();
            $table->index('parent_id');
        });

        Schema::create(config('admin.database.wbsdb_sells_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('parent_id')->default(0)->nullable();
            $table->bigInteger('typeid')->default(0)->nullable();
            $table->bigInteger('areaid')->default(0)->nullable();
            $table->bigInteger('level')->default(0)->nullable();
            $table->string('title', 255);
            $table->string('introduce',255)->nullable();
            $table->string('n1',255)->nullable();
            $table->string('n2',255)->nullable();
            $table->string('v1',255)->nullable();
            $table->string('v2',255)->nullable();
            $table->string('brand', 100)->nullable();
            $table->text('content')->nullable();
            $table->decimal('price', 10,2)->nullable();
            $table->bigInteger('minamount')->default(0)->nullable();
            $table->bigInteger('amount')->default(0)->nullable();
            $table->string('keyword',255)->nullable();
            $table->integer('hits')->default(50)->nullable();
            $table->string('litpic', 255)->nullable();
            $table->string('thumb', 255)->nullable();
            $table->string('company', 255)->nullable();
            $table->string('telephone', 30)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('qq', 255)->nullable();
            $table->string('wx', 255)->nullable();
            $table->bigInteger('totime')->default(0)->nullable();
            $table->bigInteger('totimeid')->default(1)->nullable();
            $table->integer('status')->default(1)->nullable();
            $table->integer('author_id')->default(0)->nullable();
            $table->index(['parent_id', 'status','author_id','typeid','areaid','hits']);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('admin.database.users_table'));
        Schema::dropIfExists(config('admin.database.roles_table'));
        Schema::dropIfExists(config('admin.database.permissions_table'));
        Schema::dropIfExists(config('admin.database.menu_table'));
        Schema::dropIfExists(config('admin.database.user_permissions_table'));
        Schema::dropIfExists(config('admin.database.role_users_table'));
        Schema::dropIfExists(config('admin.database.role_permissions_table'));
        Schema::dropIfExists(config('admin.database.role_menu_table'));
        Schema::dropIfExists(config('admin.database.operation_log_table'));
        Schema::dropIfExists(config('admin.database.wbsdb_articles_table'));
        Schema::dropIfExists(config('admin.database.wbsdb_areas_table'));
        Schema::dropIfExists(config('admin.database.wbsdb_asks_table'));
        Schema::dropIfExists(config('admin.database.wbsdb_categories_table'));
        Schema::dropIfExists(config('admin.database.wbsdb_companys_table'));
        Schema::dropIfExists(config('admin.database.wbsdb_company_datas_table'));
        Schema::dropIfExists(config('admin.database.wbsdb_investments_table'));
        Schema::dropIfExists(config('admin.database.wbsdb_malls_table'));
        Schema::dropIfExists(config('admin.database.wbsdb_modules_table'));
        Schema::dropIfExists(config('admin.database.wbsdb_news_table'));
        Schema::dropIfExists(config('admin.database.wbsdb_phonemanages_table'));
        Schema::dropIfExists(config('admin.database.wbsdb_photos_table'));
        Schema::dropIfExists(config('admin.database.wbsdb_questions_table'));
        Schema::dropIfExists(config('admin.database.wbsdb_sells_table'));
        Schema::dropIfExists(config('admin.database.wbsdb_settings_table'));
        Schema::dropIfExists(config('admin.database.wbsdb_userlog_table'));
        Schema::dropIfExists(config('admin.database.wbsdb_users_table'));
    }
}
