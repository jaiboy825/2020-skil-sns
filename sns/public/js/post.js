const log = console.log;

function postProcess(fileList) {//app에서 처리한 이미지 파일들을 받아옴
    if ($.trim(postText.value) == "") {
        postText.focus();
        $(".postWrapper").fadeIn();
        $(".postMenus").fadeIn();
        $(".postContainer").css("z-index", "3");
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: '빈값',
            text: '내용을 입력하세요.',
            showConfirmButton: false,
            timer: 1000
        });
        return false;
    }

    // let param = {postText: postText.value, postType:postType.value, postImg:ib.files};
    let param = new FormData();
    param.append("postText", postText.value);
    param.append("postType", postType.value);
    for(let i = 0; i<fileList.length; i++){
        param.append("postImg[]", fileList[i]);
    }

    $.ajax({
        data: param,
        type: "POST",
        url: "/write",
        mimeType: "multipart/form-data",
        contentType: false,
        processData: false,
        success: function (f) {
            console.log(f);
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: '게시글 작성 성공',
                text: '성공',
                showConfirmButton: false,
                timer: 1000
            }).then((e) => location.href = "/");
        }
    });
    return false;
}


function onKeyDown() {
    if (event.keyCode == 13) {
        console.log("asdf");
        CommentProcess(event.target);

    }
}

function CommentProcess(target) {
    // const ci = document.querySelector(".ci");
    if (target.value == "") {
        target.focus();
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: '빈값',
            text: '내용을 입력하세요.',
            showConfirmButton: false,
            timer: 1000
        });
        return false;
    }
    let data = {};
    data.postComment = target.value;
    let comment_menus = target.parentNode;
    console.log(comment_menus);
    let board_idx = comment_menus.dataset.board_idx;
    data.board_id = board_idx;

    $.ajax({
        data: data,
        url: "/comt",
        method: "POST",
        success: function (f) {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: '댓글 작성 성공',
                text: '성공',
                showConfirmButton: false,
                timer: 700
            }).then((e) => location.href = "/");
        }
    });
    return false;
}
function DeletePost(){
    let idx = $($(event.target)[0]).data("board_idx");
    let data = {};
    data.board_id = idx;
    $.ajax({
        data: data,
        url: "/del",
        method: "POST",
        success: function (f) {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: '삭제 성공',
                text: '성공',
                showConfirmButton: false,
                timer: 700
            }).then((e) => location.href = "/");
        }
    });
    return false;
}
function DeleteComment(){
    let idx = $($(event.target)[0]).data("board_idx");
    console.log(idx);
    let data = {};
    data.bi = idx;
    $.ajax({
        data: data,
        url: "/delc",
        method: "POST",
        success: function (f) {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: '삭제 성공',
                text: '성공',
                showConfirmButton: false,
                timer: 700
            }).then((e) => location.href = "/");
        }
    });
    return false;
}

