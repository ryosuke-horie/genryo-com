// 入力ページに遷移。
function moveInput() {
    window.location.href = '/weight/input';
}

// 詳細ページに遷移。
function moveShow() {
    window.location.href = '/weight/show';
}

// モーダルを隠す。
function hideModal() {
    let modal = document.getElementsByClassName("modal");
    modal[0].classList.add("hidden");
}

// モーダルを表示。
function showModal() {
    let modal = document.getElementsByClassName("modal");
    modal[0].classList.remove("hidden");
}