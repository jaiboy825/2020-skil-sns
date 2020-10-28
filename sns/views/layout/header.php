<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jacebook</title>
    <link rel="stylesheet" href="/vendor/bootstrap441/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="shortcut icon" href="/imgs/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/fontawesome/css/all.css">

    <!-- font-awesome 라이브러리 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <!-- bootstrap 라이브러리 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="/js/jquery-3.4.1.js"></script>
    <!-- <script src="/js/like.js"></script> -->
    <!-- main -->
</head>

<body>
    <div class="container-fluid jbt">
        <header class="header">
            <nav class="navbar navbar-expand-lg navbar-light jnav">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <?php if (isset($_SESSION['user'])) : ?>

                <?php else : ?>
                    <form class="formWrapper" onsubmit="return loginProcess();">
                        <!-- <form class="formWrapper" method="POST" action="/main/login"> -->
                    <?php endif; ?>
                    <div class="collapse navbar-collapse top" id="mainNav">
                        <div class="tableWrapper">
                            <a href="/" class="logo">jacebook</a>
                            <?php if (isset($_SESSION['user'])) : ?>
                                <style>
                                    .logo {
                                        display: none;
                                    }

                                    .jbt {
                                        height: 42px;
                                        width: 100%;
                                        position: fixed;
                                        z-index: 100;
                                    }

                                    .tableWrapper {
                                        height: 42px;
                                    }

                                    .jnav {
                                        padding: 0;
                                    }

                                    .mainS {
                                        padding: 12px;
                                    }

                                    .SearchContainer {
                                        width: 448px;
                                        height: 23px;
                                        padding: 0 2px;
                                    }

                                    .SearchInput {
                                        border: none;
                                        width: 393px;
                                        height: 23px;
                                        padding: 0 5px;
                                    }

                                    .SearchButton {
                                        background: #f5f6f7;
                                        border: none;
                                        border-radius: 0 2px 2px 0;
                                        width: 46px;
                                        height: 23px;
                                    }
                                </style>
                                <h1 class="luch">
                                    <a href="/" class="logouC">
                                        <img class="logou" src="/imgs/favicon.png">

                                    </a>

                                </h1>
                                <div class="SearchContainer">
                                    <input type="text" class="SearchInput" placeholder="검색">
                                    <button class="SearchButton"><i class="fas fa-search"></i></button>
                                </div>
                                <div class="logininfo">
                                    <?php foreach ($user as $users) : ?>
                                        <?php if ($users->name == $_SESSION['user']->name) : ?>
                                            <img src="<?= $users->img ?>" alt="profile" class="hprofileImgMp">
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <a href="/user/profile">
                                        <label for="user" class="userNameLabel"><?= $_SESSION['user']->name ?></label>
                                    </a>

                                    <div class="menusContainer">
                                        <i class="fas fa-caret-down menuss">
                                            <div class="dropdown-menu">
                                                <a href="/" class="btn" onclick="return logout();">로그아웃</a>
                                            </div>
                                        </i>
                                    </div>
                                </div>
                                <script>
                                    $('.menuss').click(function() {
                                        $(this).attr('tabindex', 1).focus();
                                        $(this).toggleClass('active');
                                        $(this).find('.dropdown-menu').slideToggle(300);
                                    });
                                    $('.menuss').focusout(function() {
                                        $(this).removeClass('active');
                                        $(this).find('.dropdown-menu').slideUp(300);
                                    });
                                </script>
                            <?php else : ?>

                                <table class="jT">
                                    <div class="table-container">
                                        <tr>
                                            <td class="emailTd">
                                                <label for="email" class="emaill">이메일 또는 이메일</label>
                                            </td>
                                            <td class="pwTd">
                                                <label for="password" class="passwordl">비밀번호</label>
                                            </td>
                                        </tr>
                                        <tr class="input-box">
                                            <td>
                                                <input type="email" class="inputtext loginbox" name="email" id="email">
                                            </td>
                                            <td>
                                                <input type="password" class="inputtext loginbox" name="password" id="password">
                                            </td>
                                            <td>
                                                <label class="uiButtonConfirm" id="loginbutton" for="lb">
                                                    <input value="로그인" type="submit" id="lb">
                                                </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="login_form_label_field"></td>
                                            <td class="login_form_label_field">
                                                <div>
                                                    <a class="adt">계정을 잊지마세요</a>
                                                </div>
                                            </td>
                                        </tr>
                                    </div>
                                </table>
                        </div>
                        <?php if (isset($_SESSION['user'])) : ?>

                        <?php else : ?>
                    </form>
                <?php endif; ?>
            <?php endif; ?>
    </div>

    </nav>
    </div>
    </header>
    <?php if (isset($_SESSION['err'])) : ?>
        <div class="alert alert-<?= $_SESSION['err']['css'] ?> out">
            <?= $_SESSION['err']['msg'] ?>
        </div>
        <?php unset($_SESSION['err']); ?>

        <script>
            let fade = document.querySelector(".out");
            setTimeout(() => {
                fade.classList.add("fade-out");
                setTimeout(() => {
                    fade.remove();
                }, 500);
            }, 3000);
        </script>
    <?php endif; ?>
    </div>