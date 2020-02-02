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
/**
 * ADMIN
 */
// Home
Breadcrumbs::register('admin.home', function (Crumbs $crumbs) {
    $crumbs->push(trans('user.page.home.header'), route('admin.home'));
});
// Home -> Clients list
Breadcrumbs::register('admin.clients.list', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push(trans('admin.page.clients.header'), route('admin.clients.list'));
});
// Client list -> Show user
Breadcrumbs::register('admin.clients.show', function (Crumbs $crumbs, User $user) {
    $crumbs->parent('admin.clients.list');
    $crumbs->push(trans('admin.page.clients.show', ['name' => is_null($user->general_info) || $user->general_info->getFio() == false ?
        '' : $user->general_info->getFio()->getFullName()]), route('admin.clients.show', $user));
});
// Client -> Client edit view
Breadcrumbs::register('admin.clients.edit.list', function (Crumbs $crumbs, User $user) {
    $crumbs->parent('admin.clients.show', $user);
    $crumbs->push(trans('admin.page.clients.edit.header'), route('admin.clients.edit.list', $user));
});
