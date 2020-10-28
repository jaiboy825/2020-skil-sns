class App {
    constructor() {
        console.log('%c잠깐만!',
            'font-weight: bold; font-size: 55px;color: red; text-shadow:1px 1px 0px black,1px -1px 0px black,-1px 1px 0px black,-1px -1px 0px black;')
        console.log('%c진정해!',
            'font-weight: bold; font-size: 55px;color: red; text-shadow:1px 1px 0px black,1px -1px 0px black,-1px 1px 0px black,-1px -1px 0px black;')

        console.log('%c이 기능은 개발자용으로 브라우저에서 제공되는 내용입니다. 누군가 Jacebook 기능을 사용하거나 다른 사람의 계정을 "해킹"하기 위해 여기에 특정 콘텐츠를 복사하여 붙여넣으라고 했다면 사기 행위로 간주하세요. 이 기능은 회원님의 Jacebook 계정에 대한 액세스 권한을 상대편에게 부여하는 것입니다.',
            'font-size:19px;')
        console.log('%c자세한 정보는 localhost 에서 확인해주세요.',
            'font-size:19px;')

        $('.contentWrapper').on('input', 'textarea', function (e) {
            $(this).css('height', 'auto');
            $(this).height(this.scrollHeight - 25);
        });
        $('.ci').on('input', 'input', function (r) {
            $(this).css('height', 'auto');
            $(this).height(this.scrollHeight - 25);
        });

        $('.contentWrapper').find('textarea').keyup();
        this.post();
        this.Comment();
        // this.like();
        $(window).scroll(function () {
            if ($(this).scrollTop() > 200) {
                $('.tops').fadeIn();
            } else {
                $('.tops').fadeOut();
            }
        });
        $('.tops').click(function () {
            $('html, body').animate({ scrollTop: 0 }, 400);
            return false;
        });

        $(document).on("change", "#profileImg", function (e) {
            let form = new FormData();
            form.append("solo_file", $("#profileImg")[0].files[0]);
            $.ajax({
                url: "/inp",
                data: form,
                method: "POST",
                mimeType: "multipart/form-data",
                contentType: false,
                processData: false,
                success:function(e){
                    location.href="/user/profile";
                }
            })
        })
    }
    // like(){
    //     $(document).on("click",".postLikeContainer",function(e){
    // 		let data = {};
    // 		data.idx = this.dataset.board;
    // 		data.now = $(this).hasClass("likeTrue");
    // 		$.ajax({
    // 			data:data,
    // 			url:"/board/like",

    // 			method : "POST",
    // 			success : (e)=>{ 
    // 				$(this).toggleClass("likeTrue");
    // 				$(this).toggleClass("likeFalse");
    // 				$(this.querySelector("i")).toggleClass("fas");
    // 				$(this.querySelector("i")).toggleClass("far");
    // 				let json = JSON.parse(e);
    // 				this.parentNode.parentNode.querySelector(".news-attr-box > .news-attr-left > span").innerHTML = json.cnt;
    // 			}
    // 		});
    // 	});
    // }

    post() {
        let postClick = false;
        let pta = document.querySelector("#postText");
        let btn = document.querySelector(".postMenuBtn");

        $(".postContainer").on("click", function () {
            if (postClick) return;
            $(".postWrapper").fadeIn();
            $(".postMenus").fadeIn();
            $(".postContainer").css("z-index", "3");
            // let pta = document.querySelector("#postText");

            pta.addEventListener("input", () => {
                if (btn.disabled) {
                    if (pta.value != "") {
                        btn.disabled = false;
                        $(btn).css("background", "#4267b2");
                        $(btn).css("border-color", "#4267b2");

                    } else {
                        btn.disabled = true;
                        $(btn).css("background", "#9cb4d8");
                        $(btn).css("border-color", "#9cb4d8");
                    }
                }
            });
            postClick = true;
        });
        $(".postMenuBtn").on("click", function () {
            $(".postWrapper").fadeOut();
            $(".postMenus").fadeOut();
        });
        $(".postWrapper").on("click", function () {
            $(".postWrapper").fadeOut();
            $(".postMenus").fadeOut();
            postClick = false;
        });
    }

    Comment() {
        // $(".CommentContainer").on("click",function(){
        // $(".CommentMenus").slideDown("slow");
        // });
        $(document).on("click", ".CommentContainer", function (e) {
            let idx = $($(e.target)[0]).data("idx");
            console.log(idx);
            $($($(".CommentMenus").eq(idx))[0]).slideDown("slow");
        });
    }
}

function logout() {

    $.ajax({
        url: "/user/logout",
        method: "GET",
        success: function (f) {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: '로그아웃 성공',
                text: '이용해주셔서 감사합니다.',
                showConfirmButton: false,
                timer: 1000
            }).then((e) => location.href = "/");
        }
    });
    return false;
}