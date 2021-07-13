$(() => {
	$('#save_tweet').on('click', (event) => {
		event.preventDefault();
		if ($('#content_tweet').val().trim() == '') {
			alert('Tweet vacío');
		} else {
			save_post();
		}
	});
})
function save_post() {
	if ($('#content_tweet').val().trim() == '') {
		alert('Tweet vacío')
	} else {
		$.ajax({
	        type:'POST',
	        url: './home',
	        data: $('#send_tweets').serialize(),
	        success: function(result) {
	        	console.log(result);
	        	if (result.code != 200) {
	        		alert(result.message);
	        	} else {
	        		let appx = `<div class="post" id="${result.posting}" style="display:none;">
					        		<div class="post__avatar">
					          			<img src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png" alt="">
					        		</div>
					        	<div class="post__body">
					          	<div class="post__header">
						            <div class="post__headerText">
						              <h3>
						                <a href="">${result.user.full_name}</a>
						                <span class="post__headerSpecial"><i class="fas fa-certificate"></i> <a href="#">@${result.user.name}</a> <i class="date_posted">${result.tweet.creacion}</i></span>
						              </h3>
						            </div>
						            <div class="post__headerDescription">
						             	<p>${result.tweet.content}</p>
						            </div>
					          	</div>
					        </div>`;
	        		$('#posts').prepend(appx);
	        		$('#' + result.posting).fadeIn(200);
	        	}
	        	$('#send_tweets')[0].reset()
	        }
	    })
	}
}
function logout_confirm() {
	$('#modal_tweet').fadeIn(200);
}
function close_modal() {
	$('#modal_tweet').fadeOut(200);
}