<div class="container">
    <div class="row">
        <?php if(isset($todo)) : ?>
            <h2 class="my-3">할 일 수정하기</h2>
        <?php else : ?>
            <h2 class="my-3">할 일 작성하기</h2>
        <?php endif; ?>
        <div class="col-10 offset-1">
            <form method="post">
                <?php if(isset($todo)) : ?>
                    <input type="hidden" name="id" value="<?= $todo->id ?>">
                <?php endif; ?>
                <div class="form-group">
                    <label for="title">할 일</label>
                    <?php if(isset($todo)) : ?>
                        <input type="text" class="form-control" id="title" name="title" placeholder="할 일을 입력하세요" value='<?= $todo->title ?>'>
                    <?php else : ?>
                        <input type="text" class="form-control" id="title" name="title" placeholder="할 일을 입력하세요">
                    <?php endif; ?>
                </div>
                <div class="form-row">
                    <div class="col-5">
                        <label for="date">날짜</label>
                        <?php if(isset($todo)) : ?>
                            <input type="date" class="form-control" id="date" name="date" value='<?= $todo->title ?>'>
                        <?php else : ?>
                            <input type="date" class="form-control" id="date" name="date">
                        <?php endif; ?>
                    </div>
                    <div class="col-5 offset-2">
                        <label for="time">시간</label>
                        <?php if(isset($todo)) : ?>
                            <input type="time" class="form-control" id="time" name="time" value='<?= $todo->time ?>'>
                        <?php else : ?>
                            <input type="time" class="form-control" id="time" name="time">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="content">상세내용</label>
                    <textarea name="content" id="content" 
                        rows="3" class="form-control"><?= isset($todo) ? $todo-> : ''; ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">
                    <?= isset($todo) ? "수정" : "작성" ?>
                </button>
            </form>
        </div>
    </div>
</div>