<?php

return [
    'field' => [
        'body' => "Post body",
        'title' => 'Title',
        'author' => 'Author name',
        'bodyComment' => "Comment body",
    ],
    'filter' => [
        'header' => 'Filtration',
        'time' => 'Creation time ',
        'like' => 'Like higher',
    ],
    'page' => [
        'home' => [
            'header' => 'Post page',
        ],
        'post' => [
            'delete' => 'Delete post',
            'create' => 'Create post',
            'edit' => 'Edit post',
            'show' => 'Show full post',
            'list' => 'List author posts',

        ],
    ],
    'action' => [
        'add' => 'Create post',
        'addComment' => 'Create comment',
        'update' => 'Update post',
        'deleteModalTitle' => 'You confirm the removal of the post :name',
        'save' => 'Save',
    ],
    'message' => [
        'errorValidatePost' => 'Not all fields are full!',
        'successCreatePost' => 'Post created successfully',
        'errorCreatePost' => 'Post  not created, an error occurred!',
        'successCreateComment' => 'Comment created successfully',
        'errorCreateComment' => 'Comment  not created, an error occurred!',
        'successEditPost' => 'Post update successfully',
        'errorEditPost' => 'Post  not update, an error occurred!',
        'successDeletePost' => 'Post deleted successfully!',
        'errorsDeletePost' => 'Post was not deleted, an error occurred!',
    ]
];
