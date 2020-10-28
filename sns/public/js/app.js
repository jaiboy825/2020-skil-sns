//사진을 업로드하고 공유하는 그런 SNS
//권한을 설정
//카카오스토리, 인스타그램

window.addEventListener("load", () => {
    const dropzone = document.querySelector(".postContainer");
    const dropList = document.querySelector(".showUpImg");
    const photoUpInput = document.querySelector("#photoUpInput");
    var sel_files = [];
    const pimg = document.querySelector("#profileImg");
    let index = 0;
    let post = document.querySelector(".postMenuBtn");
    post.addEventListener("click", (e) => postProcess(sel_files));//게시 버튼을 클릭하면 올려놨던 이미지 파일들을 모두 보내줌


    photoUpInput.addEventListener("change", a => {
        a.preventDefault();
        let fileLists = Array.from(a.srcElement.files);

        fileLists.forEach(b => {
            // console.log(b);
            let formData = new FormData();
            formData.append("file", b);
            if (!b.type.match("image.*")) {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: '올바르지 않은 이미지 형식',
                    text: '이미지 파일만 업로드 가능',
                    showConfirmButton: false,
                    timer: 1000
                });
                return;
            }
            if (b.type.substring(0, 5) == "image") {
                // console.log("이미지입니다");
                sel_files.push(b);
            };

            // console.log(sel_files);
            // console.log(index);
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "/upload.php");
            xhr.addEventListener("load", () => {
                let json = JSON.parse(xhr.responseText);
                let sui = document.querySelector(".showUpImg");
                if (json.type == "image") {
                    let child = makeTemplate(json.src, b.name, index);
                    dropList.appendChild(child);
                    index++;
                    $(sui).css("display", "grid");
                    $(sui).css("grid-template-columns", "90px 90px 90px 90px 90px")
                    $(sui).css("grid-template-rows", "90px")
                    console.log(index);
                } else {
                    index--;
                    idx--;
                    console.log(index);

                }
            });
            xhr.addEventListener("progress", a => {
                (a.loaded / a.total) * 100;
            });
            xhr.send(formData);
        });
    });
    dropzone.addEventListener("dragover", e => {
        // console.log("드래그 오버");
        e.preventDefault();

    });
    dropzone.addEventListener("drop", e => {
        e.preventDefault();
        let fileList = Array.from(e.dataTransfer.files);

        fileList.forEach(f => {
            // console.log(f);
            let formData = new FormData();
            formData.append("file", f);
            if (!f.type.match("image.*")) {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: '올바르지 않은 이미지 형식',
                    text: '이미지 파일만 업로드 가능',
                    showConfirmButton: false,
                    timer: 1000
                });
                return;
            }
            if (f.type.substring(0, 5) == "image") {
                // console.log("이미지입니다");
                sel_files.push(f);
            };
            let btn = document.querySelector(".postMenuBtn");

            // console.log(sel_files);
            // console.log(index);

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "/upload.php");
            xhr.addEventListener("load", () => {
                let json = JSON.parse(xhr.responseText);
                let sui = document.querySelector(".showUpImg");
                if (json.type == "image") {
                    let child = makeTemplate(json.src, f.name, index);
                    dropList.appendChild(child);
                    index++;
                    $(sui).css("display", "grid");
                    $(sui).css("grid-template-columns", "90px 90px 90px 90px 90px")
                    $(sui).css("grid-template-rows", "90px")
                    console.log(index);
                } else {

                    index--;
                    idx--;
                    console.log(index);
                }
            });
            xhr.addEventListener("progress", e => {
                (e.loaded / e.total) * 100;
            });
            xhr.send(formData);
        });
    });
    $(document).on("click", ".imgRemove", function (e) {
        let idx = $($(e.target)[0]).data("idx");
        // console.log("index :" + idx);
        sel_files.splice(idx, 1);
        index--;
        console.log(index);

        // console.log(idx);
        // console.log("sel_files" + sel_files);
        // console.log(sel_files);
        $(this.parentNode).remove();

        // var img_id = "#img_id" + idx;
        // console.log("img_id" + img_id)
        // $(img_id).remove();
        // $(".upload-item").remove();
        let btn = document.querySelector(".postMenuBtn");
        let sui = document.querySelector(".showUpImg");
        if (sel_files.length <= 0) {
            console.log(index);
            $(sui).css("display", "none");

        } else if (index <= 0) {
            $(sui).css("display", "none");
            console.log(index);
        }
    });

    function makeTemplate(src, name, index) {
        let div = document.createElement("div");
        // console.log(index);
        div.innerHTML = `
        <div class="imgRemove" data-idx="${index}" id="img_id${index}">
            <div class="img-box" data-idx="${index}">
                <img src="${src}" alt="" data-idx="${index}">
            </div>
                <a class="imgnames">${name}</a>
                <input type="hidden" value = "${name}" class="ni>
        </div>`;
        div.classList.add("upload-item");
        return div;
    }
});