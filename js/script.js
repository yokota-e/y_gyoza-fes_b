// ハンバーガーメニューここから

// ハンバーガーメニューの開閉処理
// １．必要な要素を取得する（hamburgerボタン、body要素）
let humBtn = document.getElementById('js-ham-button');
let bodyElm = document.querySelector('body');
// ２．hamburgerボタンにクリックイベントを登録
// ３．hamburgerボタンがクリックされたら、body要素に「open」クラスを付けたり外したりする
humBtn.addEventListener('click',() => {
    // if(bodyElm.classList.contains('open')){
    // bodyElm.classList.remove('open');
    // }else{
    // bodyElm.classList.add('topPage');
    // }
    bodyElm.classList.toggle('open');
} )


// ハンバーガーメニューここまで