<?php

use App\Entity\Posts;
use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator as Crumbs;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use App\Entity\User\User;

/**
 * CLIENT
 */
// Home
Breadcrumbs::register('client.home', function (Crumbs $crumbs) {
    $crumbs->push(trans('user.page.home.header'), route('client.home'));
});
// Post delete
Breadcrumbs::register('client.post.delete', function (Crumbs $crumbs, Posts $post) {
    $crumbs->parent('client.home');
    $crumbs->push(trans('user.page.post.delete'),route('client.post.delete', $post));
});

// Post create
Breadcrumbs::register('client.post.create', function (Crumbs $crumbs) {
    $crumbs->parent('client.home');
    $crumbs->push(trans('user.page.post.create'), route('client.post.create'));
});
// Post edit
Breadcrumbs::register('client.post.edit', function (Crumbs $crumbs, Posts $post) {
    $crumbs->parent('client.home');
    $crumbs->push(trans('user.page.post.edit'), route('client.post.edit',$post));
});
// Post show
Breadcrumbs::register('client.post.show', function (Crumbs $crumbs, Posts $post) {
    $crumbs->parent('client.home');
    $crumbs->push(trans('user.page.post.show'), route('client.post.show',$post));
});
// Post Client list
Breadcrumbs::register('client.post.list', function (Crumbs $crumbs, User $users ) {
    $crumbs->parent('client.home');
    $crumbs->push(trans('user.page.post.list'), route('client.post.list',$users));
});
/**
 * ADMIN
 */
// Home
Breadcrumbs::register('admin.home', function (Crumbs $crumbs) {
    $crumbs->push(trans('user.page.home.header'), route('admin.home'));
});

