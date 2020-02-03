/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

require('./common/modal');
require('./common/like');

$(function () {

    const sort = $('#sort');

    $("#like").on('click', function (e) {
        let type = $(this).data('sort');
        $('#sort').val(type);
    });
    $("#timeDown").on('click', function (e) {
        let type = $(this).data('sort');
        $('#sort').val(type);
    });
    $("#time").on('click', function (e) {
        let type = $(this).data('sort');
        $('#sort').val(type);
    });
});




