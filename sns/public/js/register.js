const email_ptn = /^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i

window.onload = function () {

}

function registerProcess() {

	if ($.trim(firstName.value) == "") {
		firstName.focus();
		Swal.fire({
			icon: 'error',
			title: '빈 값',
			text: '성(姓)을 입력해주세요.',
			width: 600,
			padding: '3em',
			showConfirmButton: false,
            timer: 1100,
			background: '#fff url(/imgs/trees.png)',
			backdrop: `rgba(0,0,123,0.4)
					url("/imgs/odk.gif")
					right center
					no-repeat`
		});
		return false;
	}
	if ($.trim(lastName.value) == "") {
		lastName.focus();
		Swal.fire({
			icon: 'error',
			title: '빈 값',
			text: '성(姓)을 제외한 이름을 입력해주세요.',
			width: 600,
			padding: '3em',
			showConfirmButton: false,
            timer: 1100,
			background: '#fff url(/imgs/trees.png)',
			backdrop: `rgba(0,0,123,0.4)
					url("/imgs/ps.gif")
					left center
					no-repeat`
		});
		return false;
	}

	if ($.trim(emails.value) == "") {
		emails.focus();
		Swal.fire({
			icon: 'error',
			title: '빈 값',
			text: '이메일을 입력해주세요.',
			width: 600,
			padding: '3em',
			showConfirmButton: false,
            timer: 1100,
			background: '#fff url(/imgs/trees.png)',
			backdrop: `rgba(0,0,123,0.4)
					url("/imgs/oh.gif")
					100px 50px
					no-repeat`
		});
		return false;
	}

	if (!email_ptn.test($.trim(emails.value))) {
		emails.focus();
		Swal.fire({
			icon: 'error',
			title: '올바르지 않은 이메일 형식',
			text: '이메일을 다시 작성해주시길 바랍니다.',
			width: 600,
			padding: '3em',
			showConfirmButton: false,
            timer: 1100,
			background: '#fff url(/imgs/trees.png)',
			backdrop: `rgba(0,0,123,0.4)
					url("/imgs/os.gif")
					100px 50px
					no-repeat`
		});
		return false;
	}

	if ($.trim(pw.value) == "") {
		pw.focus();
		Swal.fire({
			icon: 'error',
			title: '빈 값',
			text: '비밀번호를 입력해주시길 바랍니다.',
			width: 600,
			padding: '3em',
			showConfirmButton: false,
            timer: 1100,
			background: '#fff url(/imgs/trees.png)',
			backdrop: `rgba(0,0,123,0.4)
					url("/imgs/oh.gif")
					1300px 50px
					no-repeat`
		});
		return false;
	}

	if ($.trim(pwc.value) == "") {
		pwc.focus();
		Swal.fire({
			icon: 'error',
			title: '빈 값',
			text: '비밀번호 확인란을 작성해주시길 바랍니다.',
			width: 600,
			padding: '3em',
			showConfirmButton: false,
            timer: 1100,
			background: '#fff url(/imgs/trees.png)',
			backdrop: `rgba(0,0,123,0.4)
					url("/imgs/odk.gif")
					100px center
					no-repeat`
		});
		return false;
	}

	if ($.trim(pw.value) != $.trim(pwc.value)) {
		pwc.focus();
		Swal.fire({
			icon: 'error',
			title: '비밀번호 불일치',
			text: '다시 작성해주시길 바랍니다.',
			width: 600,
			padding: '3em',
			showConfirmButton: false,
            timer: 1100,
			background: '#fff url(/imgs/trees.png)',
			backdrop: `rgba(0,0,123,0.4)
					url("/imgs/odk.gif")
					1300px center
					no-repeat`
		});
		return false;
	}

	let data = {};
	data.fname = firstName.value;
	data.lname = lastName.value;
	data.email = emails.value;
	data.pwd = pw.value;

	$.ajax({
		data: data,
		url: "/main/register",
		method: "POST",
		success: function (e) {
			// let json = JSON.parse(e);
			if (e == "")  {
				Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: '이메일 중복',
                    text: '입력하신 이메일은 이미 가입된 이메일 입니다.',
                    showConfirmButton: false,
                    timer: 1100
                  });

			}
			else {
				Swal.fire({
					position: 'center',
					icon: 'success',
					title: '회원가입 성공',
					text: '환영합니다',
					showConfirmButton: false,
					timer: 1100,
					backdrop: `rgba(0,0,123,0.4)
					url("/imgs/ohi.gif")
					left center
					no-repeat`
				  }).then((e) => location.href = "/");
			}
		}
	});
	return false;
}