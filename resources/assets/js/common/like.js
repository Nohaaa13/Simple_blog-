var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');


var postId = 0;
$('.like').on('click', function(event) {
    event.preventDefault();
    let postId = event.target.parentNode.parentNode.dataset['postid'];
    var isLike = event.target.previousElementSibling == null;
    let urlLike = $(this).data('location');
    $.ajax({
        method: 'POST',
        url: urlLike,
        data: { _token: CSRF_TOKEN,
            isLike: isLike,
            postId: postId
        }
    })
        .done(function(data) {
          event.target.innerText == 'Like' ? event.target.innerText='You like this post' :  event.target.innerText='Like' ;
            let likePost = $('span[data-post="'+postId+'"]');
            likePost.text(data.success);
        });
});

var commentId = 0;
$('.likeComment').on('click', function(event) {
    event.preventDefault();
    let commentId = event.target.parentNode.parentNode.dataset['commentid'];
    var isLike = event.target.previousElementSibling == null;
    let urlLike = $(this).data('location');
    $.ajax({
        method: 'POST',
        url: urlLike,
        data: { _token: CSRF_TOKEN,
            isLike: isLike,
            commentId: commentId
        }
    })
        .done(function(data) {
            event.target.innerText == 'Like' ? event.target.innerText='You like this comment' :  event.target.innerText='Like' ;
            let likeComment = $('span[data-comment="'+commentId+'"]');
            likeComment.text(data.success);
        });
});
