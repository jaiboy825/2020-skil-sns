window.onload = function () {

}

function loginProcess(){
    if ($.trim(email.value) == "") {
		email.focus();
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: '빈값',
            text: '이메일을 입력하세요.',
            showConfirmButton: false,
            timer: 1000
          });
        return false;
    }
    
    if($.trim(password.value) == "") {
        password.focus();
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: '빈값',
            text: '비밀번호를 입력하세요.',
            showConfirmButton: false,
            timer: 1000
          });
        return false;
    }

    let data = {};
    data.email = email.value;
    data.password = password.value;

    $.ajax({
        data: data,
        url: "/main/login",
        method: "POST",
        success: function (f) {
            if(f == "") {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: '로그인 실패',
                    text: '이메일 또는 비밀번호가 올바르지 않습니다.',
                    showConfirmButton: false,
                    timer: 1000
                  }).then((e) => location.href = "/");
            } else {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: '로그인 성공',
                    text: '환영합니다',
                    showConfirmButton: false,
                    timer: 1000
                  }).then((e) => location.href = "/");
            }
        }
    });
    return false;
}

