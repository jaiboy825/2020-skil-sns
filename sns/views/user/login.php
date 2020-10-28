<div class="container">
    <div class="row">
        <h2 class="my-3">로그인</h2>
        <div class="col-10 offset-1">
            <form method="post" action="/main/login">
                <div class="form-group">
                    <label for="userid">Email</label>
                    <input type="email" class="form-control" id="userid" name="userid">
                </div>
                <div class="form-group">
                    <label for="password">비밀번호</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <button type="submit" class="btn btn-primary">로그인</button>
            </form>
        </div>
    </div>
</div>
