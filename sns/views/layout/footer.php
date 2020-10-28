<?php if (isset($_SESSION['user'])) : ?>
<div>
    <footer class="footerU">
        <p class="text-center p-2s">개인정보처리방침 · 이용 약관 · 광고 · <br>AdChoices · 쿠키 · 더 보기 <br>Jacebook © 2020</p>
    </footer>
</div>
<?php else : ?>
<div class="container-fluid footerL">
    <div class="row">
        <div class="col-12">
            <footer class="bg-white text-black">
                <p class="text-center p-2">Jacebook &copy;2020</p>
            </footer>
        </div>
    </div>
</div>
<?php endif; ?>
</body>
</html>