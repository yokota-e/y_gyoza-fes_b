// ハンバーガーメニューここから

// ハンバーガーメニューの開閉処理
// １．必要な要素を取得する（hamburgerボタン、body要素）
let humBtn = document.getElementById('hamburger');
let humMenu = document.getElementById('hum-menu');
// ２．hamburgerボタンにクリックイベントを登録
// ３．hamburgerボタンがクリックされたら、body要素に「open」クラスを付けたり外したりする
humBtn.addEventListener('click',() => {
    // if(bodyElm.classList.contains('open')){
    // bodyElm.classList.remove('open');
    // }else{
    // bodyElm.classList.add('topPage');
    // }
    humMenu.classList.toggle('open');
    humBtn.classList.toggle('active');
} )

// ハンバーガーメニューここまで


// スライダーここから
$(function(){
  $('.slideshow').slick({
    autoplay: true,
    autoplaySpeed: 3000,
    dots: true,
    infinite: true,
  slidesToShow: 3,
  slidesToScroll: 3,
   responsive: [
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    }
  ]
});
});

// スライダーここまで