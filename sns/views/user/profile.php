<script>
    window.addEventListener("load", function() {
        $(".footerU").css('display', "none");
        $(".footerL").css('display', "none");
    });
</script>
<div class="wrapper">
    <div class="profileBackground">
        <div class="profileBack">
            <div class="profileBi">
                <div class="BackgroundImg">
                    <?php foreach ($user as $users) : ?>
                        <?php if ($users->name == $_SESSION['user']->name) : ?>
                            <img src="<?= $users->backimg ?>" alt="profile" class="BackgroundImgMpp">
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <label class="backgroundImgs" for="backgroundImg"><i class="fas fa-camera"></i> 커버 사진 추가</label>
                    <input id="backgroundImg" type="file">
                    <div class="profileBackgr">
                        <form class="profile" method="POST" action="/inp">
                            <label for="profileImg" class="profileContainer"> <i class="fas fa-camera"></i>
                                <div>업데이트</div>
                            </label>
                            <input id="profileImg" type="file" name="solo_file">
                            <?php foreach ($user as $users) : ?>
                                <?php if ($users->name == $_SESSION['user']->name) : ?>
                                    <img src="<?= $users->img ?>" alt="profile" class="profileImgMpp">
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </form>
                    </div>
                </div>
                <div class="pBC">
                    <div class="profileB">
                        <ul class="profileMenu">
                            <div class="pIContainer">
                                <div class="profileInfo">내 정보</div>
                            </div>

                        </ul>

                    </div>
                </div>

            </div>
            <style>
                .postContainer {
                    margin-top: 12px;
                }
            </style>
            <div class="myprofileContainers">
                <div class="MyProfileInfo">
                    <div class="MPII"></div>
                    <div class="myprofilePhoto">
                        <div class="mpPP">
                            <i class="far fa-images"></i>
                        </div>
                        <a class="mpPMC"><label class="mpPM">사진</label></a>
                        <label class="mpImages" for="mpImages">사진 추가</label>
                        <input id="mpImages" type="file">
                    </div>
                    <div class="myprofilePhoto">
                        <div class="mpFP">
                            <i class="fas fa-user-friends"></i>
                        </div>
                        <a class="mpFMC"><label class="mpFM">친구</label></a>
                        <label class="fpFriends" for="fpFriends">친구 찾기</label>
                    </div>
                </div>
                <div class="profilePostContainer">
                    <div class="profilePost">
                        <div class="myPostList"><?= $_SESSION['user']->name ?>의 게시물</div>
                        <div class="upButtonContainers">
                            <button class="tops"><i class="fas fa-angle-up"></i></button>
                        </div>
                        <?php foreach ($list as $key => $item) : ?>
                            <div class="postsBoxs">
                                <div class="postUserInfo">
                                    <?php foreach ($user as $users) : ?>
                                        <?php if ($users->name == $item->name) : ?>
                                            <img src="<?= $users->img ?>" alt="profile" class="profileImgMp">
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <a class="postUserName" href="/user/profile"><?= $item->name ?></a>
                                    <?php if ($item->type == "전체 공개") : ?>
                                        <div class="postUserType"><i class="fas fa-globe-asia"></i></div>
                                    <?php elseif ($item->type == "친구만") : ?>
                                        <div class="postUserType"><i class="fas fa-users"></i></div>
                                    <?php elseif ($item->type == "나만 보기") : ?>
                                        <div class="postUserType"><i class="fas fa-user"></i></div>
                                    <?php endif ?>
                                    <div class="postUserTime"><?php $signdate = $item->time;
                                                                $someTime = time() - strtotime("$signdate");
                                                                if ($someTime < 60) {
                                                                    echo "방금";
                                                                } else if ($someTime >= 60 and $someTime < 3600) {
                                                                    echo floor($someTime / 60) . "분 전";
                                                                } else if ($someTime >= 3600 and $someTime < 86400) {
                                                                    echo floor($someTime / 3600) . "시간 전";
                                                                } else if ($someTime >= 86400 and $someTime < 2419200) {
                                                                    echo floor($someTime / 86400) . "일 전";
                                                                } else {
                                                                    echo date("y-m-d", strtotime($signdate));
                                                                }
                                                                ?></div>
                                    <div class="menusContainer">

                                        <?php if ($_SESSION['user']->id == $item->email) : ?>
                                            <i class="fas fa-ellipsis-h menus">
                                                <div class="dropdown-menu">
                                                    <a id="delete" onclick="DeletePost();" data-board_idx="<?= $item->board_id ?>">삭제</a>
                                                </div>
                                            </i>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="postUserText"><?= nl2br(htmlentities($item->text)) ?></div>
                                <div class="postUserImg">
                                    <?php foreach ($listi as $items) : ?>
                                        <?php if ($item->board_id == $items->board_id) : ?>
                                            <img src="/<?= $items->img ?>" alt="img" class="UserPostImgs">
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>

                                <div class="postLikeContainer likefalse">
                                    <button class="LikeContainer" data-idx="<?= $key ?>">
                                        <div id="LikeImage">
                                            <i class="far fa-thumbs-up"></i>
                                            <p class="jop">좋아요</p>
                                        </div>
                                    </button>
                                    <a class="CommentContainer" aria-pressed="false" role="button" tabindex="-1" data-idx="<?= $key ?>">
                                        <div id="CommentImg" data-idx="<?= $key ?>">
                                            <i class="far fa-comment-alt" data-idx="<?= $key ?>"></i>
                                            <p data-idx="<?= $key ?>">댓글</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="CommentContainers">
                                    <?php foreach ($listc as $items) : ?>
                                        <?php if ($item->board_id == $items->postid) : ?>
                                            <div class="CommentC">
                                                <?php foreach ($user as $users) : ?>
                                                    <?php if ($users->name == $item->name) : ?>
                                                        <img src="<?= $users->img ?>" alt="profile" class="profileImgMpc">
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                                <div class="postUserComment">
                                                    <a class="CommentUserName" href="/user/profile"><?= $items->name ?></a>
                                                    <label class="CommentUserText"><?= $items->ctext ?></label>
                                                </div>
                                                <?php if ($_SESSION['user']->id == $items->user_id) : ?>
                                                    <i class="fas fa-ellipsis-h menus">
                                                        <div class="dropdown-menu">
                                                            <a id="report" onclick="DeleteComment();" data-board_idx="<?= $items->postid ?>" data-board_text="<?= $items->ctext ?>">삭제</a>
                                                        </div>
                                                    </i>
                                                <?php endif; ?>
                                                <div class="postUserTimec"><?php $signdate = $items->time;
                                                                            $someTime = time() - strtotime("$signdate");
                                                                            if ($someTime < 60) {
                                                                                echo "방금";
                                                                            } else if ($someTime >= 60 and $someTime < 3600) {
                                                                                echo floor($someTime / 60) . "분 전";
                                                                            } else if ($someTime >= 3600 and $someTime < 86400) {
                                                                                echo floor($someTime / 3600) . "시간 전";
                                                                            } else if ($someTime >= 86400 and $someTime < 2419200) {
                                                                                echo floor($someTime / 86400) . "일 전";
                                                                            } else {
                                                                                echo date("y-m-d", strtotime($signdate));
                                                                            }
                                                                            ?></div>

                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="CommentMenus" data-board_idx="<?= $item->board_id ?>">
                                <?php foreach ($user as $users) : ?>
                                    <?php if ($users->name == $_SESSION['user']->name) : ?>
                                        <img src="<?= $users->img ?>" alt="profile" class="profileImgMpc">
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <input type="text" placeholder="댓글을 입력하라고..." onKeyDown="onKeyDowns();" class="ci">
                                <label class="cimt">글을 게시하려면 Enter 키를 누르세요.</label>

                            </div>
                        <?php endforeach; ?>
                        <script>
                            $('.menus').click(function() {
                                $(this).attr('tabindex', 1).focus();
                                $(this).toggleClass('active');
                                $(this).find('.dropdown-menu').slideToggle(300);
                            });
                            $('.menus').focusout(function() {
                                $(this).removeClass('active');
                                $(this).find('.dropdown-menu').slideUp(300);
                            });
                        </script>
                        <script>
                            function onKeyDowns() {
                                if (event.keyCode == 13) {
                                    CommentProcesss(event.target);
                                }
                            }

                            function CommentProcesss(target) {
                                if ($.trim(target.value) == "") {
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
                                let board_idx = comment_menus.dataset.board_idx;
                                data.board_id = board_idx;
                                $.ajax({
                                    data: data,
                                    url: "/comts",
                                    method: "POST",
                                    success: function(f) {
                                        Swal.fire({
                                            position: 'center',
                                            icon: 'success',
                                            title: '댓글 작성 성공',
                                            text: '성공',
                                            showConfirmButton: false,
                                            timer: 700
                                        }).then((e) => location.href = "/user/profile");
                                    }
                                });

                                return false;
                            }

                            function DeletePost() {
                                let idx = $($(event.target)[0]).data("board_idx");
                                let data = {};
                                data.board_id = idx;
                                $.ajax({
                                    data: data,
                                    url: "/del",
                                    method: "POST",
                                    success: function(f) {
                                        Swal.fire({
                                            position: 'center',
                                            icon: 'success',
                                            title: '삭제 성공',
                                            text: '성공',
                                            showConfirmButton: false,
                                            timer: 700
                                        }).then((e) => location.href = "/user/profile");
                                    }
                                });
                                return false;
                            }

                            function DeleteComment() {
                                let idx = $($(event.target)[0]).data("board_idx");
                                let cut = $($(event.target)[0]).data("board_text");
                                console.log(idx);
                                let data = {};
                                data.bi = idx;
                                data.text = cut;
                                console.log(cut);
                                $.ajax({
                                    data: data,
                                    url: "/delc",
                                    method: "POST",
                                    success: function(f) {
                                        Swal.fire({
                                            position: 'center',
                                            icon: 'success',
                                            title: '삭제 성공',
                                            text: '성공',
                                            showConfirmButton: false,
                                            timer: 700
                                        }).then((e) => location.href = "/user/profile");
                                    }
                                });
                                return false;
                            }
                        </script>
                        <div class="end">
                            <div class="endCircle"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="postWrapper"></div>
    <div class="f">
        <div class="friendPlus">
            <?php foreach ($user as $users) : ?>

            <?php endforeach; ?>
        </div>
        <div class="fCC">
            <div class="friendContainer" aria-label="스크롤 가능한 부분" role="group" tabindex="0" style="overscroll-behavior: contain contain;">

            </div>

        </div>
    </div>
</div>
<script src="/js/main.js"></script>
<script>
    window.addEventListener("load", function() {
        let app = new App();
    });
</script>