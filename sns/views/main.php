<div class="container mainS">
    <div class="row mt-5 mains">
        <!-- 1줄은 12칸으로 이루어져 있어 -->
        <div class="col-10 offset-1 postTop">
            <?php if (isset($_SESSION['user'])) : ?>
                <div class="postContainer">
                    <div class="makePost">
                        <p>게시물 만들까</p>
                        <div class="timesContainer">
                            <i class="fas fa-times"></i>
                        </div>
                    </div>
                    <div class="contentWrapper">
                        <!-- <form class="posts" onsubmit="return postProcess();"> -->
                        <form class="posts" method="POST" enctype="multipart/form-data">
                            <div class="imgContainer">
                                <?php foreach ($user as $users) : ?>
                                    <?php if ($users->name == $_SESSION['user']->name) : ?>
                                        <img src="<?= $users->img ?>" alt="profile" class="profileImgMp">
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                            <textarea title="<?= $_SESSION['user']->name ?>님, 무슨 생각을 하고 있음?" name="postText" id="postText" cols="30" rows="1" class="pta" placeholder="<?= $_SESSION['user']->name ?>님, 무슨 생각을 하고 있음?" <c:out value="${content}" /></textarea>
                            <div class="showUpImg"></div>
                            <div class="postbtnContainer">
                                <label class="photoUpContainer" for="photoUpInput"><img src="/imgs/photo.png" alt="" class="photoupImg">
                                    <div class="photoUp">사진 및 사진</div>
                                </label>
                                <input type="file" id="photoUpInput" name="postImg[]" multiple>
                                <button class="tagUpContainer" type="button"><img src="/imgs/tag.png" alt="" class="tagupImg">
                                    <div class="tagUp">친구 태그하기</div>
                                </button>
                            </div>
                            <div class="postMenus">
                                <div class="postMenuBtnContainer">
                                    <div class="pOption">
                                        <li class="newContainer"><img src="/imgs/newsImg.png" alt="" class="newsImg">뉴스피드
                                            <select id="postType" class="tagSelect" name="">
                                                <option value="친구만" selected>친구만</option>
                                                <option value="나만 보기">나만 보기</option>
                                                <option value="전체 공개">전체 공개</option>
                                            </select>
                                        </li>
                                    </div>
                                    <script src="/js/app.js"></script>
                                    <script src="/js/post.js"></script>
                                    <script src="/js/main.js"></script>
                                    <script>
                                        window.addEventListener("load", function() {
                                            let app = new App();
                                        });
                                    </script>
                                    <script>
                                        $(".post").val() == $("#postType").val();
                                    </script>
                                    <input type="hidden" class="post" name="postType" value="">
                                    <div class="pmbContainer">
                                        <button type="button" class="postMenuBtn" disabled>게시</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="postsTitle">게시글</div>
                <div class="upButtonContainer">
                    <button class="tops"><i class="fas fa-angle-up"></i></button>
                </div>
                <?php foreach ($list as $key => $item) : ?>
                    <div class="postsBoxs">
                        <div class="postUserInfo">

                            <?php foreach ($user as $users) : ?>
                                <?php if ($users->name == $item->name) : ?>
                                    <a href="/user/profile"><img src="<?= $users->img ?>" alt="profile" class="profileImgMp"></a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <a class="postUserName" href="/user/profile"><?= $item->name ?></a>
                            <?php if ($item->type == "전체 공개") :?>
                            <div class="postUserType"><i class="fas fa-globe-asia"></i></div>
                            <?php elseif ($item->type == "친구만") :?>
                            <div class="postUserType"><i class="fas fa-users"></i></div>
                            <?php elseif ($item->type == "나만 보기") :?>
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
                                            <a id="delete" onclick="DeletePost();" data-board_idx="<?=$item->board_id ?>">삭제</a>
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
                                                <a href="/user/profile"><img src="<?= $users->img ?>" alt="profile" class="profileImgMp"></a>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        <div class="postUserComment">
                                            <a class="CommentUserName" href="/user/profile"><?= $items->name ?></a>
                                            <label class="CommentUserText" ><?= $items->ctext ?></label>
                                        </div>
                                        <?php if ($_SESSION['user']->id == $items->user_id) : ?>
                                            <i class="fas fa-ellipsis-h menus">
                                                <div class="dropdown-menu">
                                                    <a id="delete" onclick="DeleteComment();"data-board_idx="<?=$items->id ?>" >삭제</a>
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
                        <input type="text" placeholder="댓글을 입력하라고..." onKeyDown="onKeyDown();" class="ci">
                        <label class="cimt">글을 게시하려면 Enter 키를 누르세요.</label>
                    </div>
                <?php endforeach; ?>
                
                <div class="end">
                    <div class="endCircle"></div>

                </div>
                <div class="postWrapper"></div>
                <div class="f">
                    <div class="friendPlus">
                        <?php foreach ($user as $users) : ?>
                               <img src="<?= $users->img ?>" alt="사진" class="fpp">
                               <div><?= $users->name ?></div>
                        <?php endforeach; ?>
                    </div>
                    <div class="fCC">
                        <div class="friendContainer" aria-label="스크롤 가능한 부분" role="group" tabindex="0" style="overscroll-behavior: contain contain;">

                        </div>

                    </div>
                </div>
        </div>
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
    <?php else : ?>
        <div class="mj">
            <!-- <div class="jumbotron jumbotron-fluid mj-imgBox"> -->
            <div class="container1">
                <div class="lm">Jacebook에서 전세계에 있는 친구, 가족, 지인들과<br>함께 이야기를 나눠보세요</div>
                <img src="./imgs/world.png" alt="img" class="limg">
            </div>
            <!-- </div> -->

            <form class="register" onsubmit="return registerProcess();">
                <div class="registerForm">
                    <div class="r1">가입하기</div>
                    <div class="r2">빠르고 쉽습니다.</div>


                    <div class="idBox">
                        <input type="text" class="firstName" name="fname" placeholder="성(姓)" id="firstName">
                        <input type="text" class="lastName" name="userName" placeholder="이름(성은 제외)" id="lastName">
                    </div>
                    <input type="email" class="email" name="userid" placeholder="이메일 또는 이메일" id="emails">


                    <input type="password" class="password" name="password" placeholder="새 비밀번호" id="pw">
                    <input type="password" class="passwordc" name="passwordc" placeholder="새 비밀번호 확인" id="pwc">
                </div>
                <div class="rm">가입하기 버튼을 클릭하면 Jacebook의 약관, 데이터 정책 및 쿠<br>키 정책에 동의하게 됩니다.Jacebook으로부터 SMS 알림을 받<br>을 수 없으며 알림은 언제든지 옵트 아웃할 수 없습니다.</div>
                <div class="registerWrapper">
                    <button type="submit" class="rbtn">가입하기</button>
                </div>
            </form>
        </div>

        <script src="/js/login.js"></script>
        <script src="/js/register.js"></script>
        <script>
            document.querySelector(".adt").addEventListener("click", e => {
                Swal.fire({
                    title: '그냥 잊지말라고',
                    width: 600,
                    padding: '3em',
                    background: '#fff url(/imgs/trees.png)',
                    backdrop: `rgba(0,0,123,0.4)
                            url("/imgs/bmo.gif")
                            center top
                            no-repeat`
                });
            });
        </script>
    <?php endif; ?>
    </div>
</div>
</div>