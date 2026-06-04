/*================================================================= 
 License : e-TRUST Inc.
 File name : function.js
 Style : function
================================================================= */
// lenis gsap
$(window).on('load', function () {
        gsap.config({
            nullTargetWarn: false,
        });
        class MomentumLenis {//lenis 
            constructor() {
              this._lenisInit();
            }
            _lenisInit() {
              gsap.registerPlugin(ScrollTrigger);
              const lenis = new Lenis({
                lerp: .3,
              });
              lenis.on("scroll", ScrollTrigger.update);
      
              gsap.ticker.add((time) => {
                lenis.raf(time * 500);
              });
              // Images parallax
              gsap.utils.toArray(".box-parallax .box").forEach((parallaxBoxes) => {
                const parallaxImages = parallaxBoxes.querySelector("img");
                const tl = gsap.timeline({
                  scrollTrigger: {
                    trigger: parallaxBoxes,
                    scrub: true,
                    pin: false,
                    // markers: true,
                  },
                });
                tl.fromTo(
                  parallaxImages,
                  {
                    yPercent: -40,
                    ease: "none",
                  },
                  {
                    yPercent: 40,
                    ease: "none",
                  }
                );
              });
            }
        }
        new MomentumLenis();
        // gsap
        gsap.registerPlugin(ScrollTrigger);
        gsap.from('.home .bg_slide img', {
            // y: 400, //transform:scale(1)
            autoAlpha: 1, //transform:scale(1)
            scrollTrigger: {
              trigger: '.About',
              start: 'center 100%',
              end: 'center 0%', // アニメーションの終了位置の指定
            //   markers: true,
                scrub: true,
                trigger: '.About',
                start: 'top bottom',
                end: '20% 50%',
                scrub: 0,
            }
        });
        /* 画面幅によってアニメーションを出し分ける 開始 */
        ScrollTrigger.matchMedia({
            // 960px以上
            "(min-width: 835px)": function () {
                gsap.from('.home .bg_slide ', {
                    scale: 0.5, //transform:scale(1)
                    // width: 50%;
                    scrollTrigger: {
                      trigger: '.About',
                      start: 'center 100%',
                      end: 'center 0%', // アニメーションの終了位置の指定
                        scrub: true,
                        trigger: '.About',
                        start: 'top bottom',
                        end: '20% 50%',
                        scrub: 0,
                    }
                });
            },
            // 834px
            "(max-width: 834px)": function () {
                console.log(window.innerWidth);
                gsap.from('.home .bg_slide ', {
                    y: window.innerHeight*0.5, //transform:scale(1)
                    // width: 50%;
                    scrollTrigger: {
                      trigger: '.About',
                      start: 'center 100%',
                      end: 'center 0%', // アニメーションの終了位置の指定
                        scrub: true,
                        trigger: '.About',
                        start: 'top bottom',
                        end: '20% 50%',
                        scrub: 0,
                    }
                });
            },
            // メディアのサイズに関係なく、すべてに適用する
            // all: function () {
            // gsap.set(".moveItem", { autoAlpha: 0 });
            // },
        });
        
            
    });
    $(window).on('load', function () {//IntersectionObserver
        //  SHOW
        let Once = document.querySelectorAll(
            ".u-rad,[class*=js-]:not([class*=js-ch],.js-letter,.js-bgFix),[class*=js-ch]>*,.js-letter,.img_outer,.H-split :is(h1,h2,h3)>span:nth-child(1),.About_tx"
        );
        const observerO = new IntersectionObserver(IOonce, {
            rootMargin: "0% 0% -20% 0px",
            threshold: 0,
                // root: document.body,
            // rootMargin:'0px',
            // threshold:0.9
        });
        function IOonce(entries) {
            entries.forEach(function (entry, i) {
                const target = entry.target;
                const delay = i * 100;
                if (entry.isIntersecting) {
                    target.classList.add("show");
                    if (target.classList.contains("img_outer")) {
                        setTimeout(() => {
                            target.classList.add("sd-scale");
                        }, 1800);
                    }
                }
            });
        }
        let Toggle = document.querySelectorAll(
            ".f,.js-bgFix"
        );
        const observerT = new IntersectionObserver(IOtoggle, { rootMargin: "-0% 0% -60% 0px", });
        function IOtoggle(entries) {
            entries.forEach(function (entry, i) {
                const target = entry.target;
                if (entry.isIntersecting) {
                    target.classList.add("show");
                }
                else {
                    target.classList.remove("show");
                }
            });
        }
        // header trans
        const head = document.querySelectorAll(".mv_it");
        const observerH = new IntersectionObserver(IOhead, { rootMargin: "-0% 0% -0% 0px", threshold: .8 });
    
        function IOhead(entries) {
            entries.forEach(function (entry, i) {
                const header = document.querySelector('#header');
                if (entry.isIntersecting) {
                    header.classList.remove('trans');
                }
                else {
                    header.classList.add('trans');
                }
            });
    
        }
        // SLIDE
        const slide = document.querySelectorAll(".mv_slide,.bg_slide, .sns_slide");
        const observerS = new IntersectionObserver(IOslide, { rootMargin: "-0% 0% -0% 0px", threshold: 0.5 });
        function IOslide(entries) {
            entries.forEach(function (entry, i) {
                const targetID = entry.target.id;
                const target = $(`#${targetID}`);
                if (entry.isIntersecting) {
                    // console.log(target);
                    try {
                        target.find('ul,>div').slick('slickPlay');
                    } catch (e) { }
                }
                else {
                    try {
                        target.find('ul,>div').slick('slickPause');
                    } catch (e) { }
                }
            });
        }
        // setTimeout(() => {
        // }, 400);
        $(".mv_slide ul,.mv_slide02,.bg_slide ul").slick({
            cssEase: "ease-out", 
            // vertical: true,
            autoplay: true,
            fade: true,
            autoplaySpeed: 500,
            speed: 4000,
            arrows: false,
            slidesToShow: 1,
            infinite: true,
            useCSS: true,
            pauseOnFocus: false, //スライダーをフォーカスした時にスライドを停止させるか
            pauseOnHover: false, //スライダーにマウスホバーした時にスライドを停止させるか
        });
        var webStorage = function () {// 
            document.querySelector('body').setAttribute("style", "opacity:1;visibility:visible;");
            // head.forEach((tgt) => { observerH.observe(tgt); });
            setTimeout(function () {
                // anc.forEach((tgt) => { observerB.observe(tgt); });
                
                // slide.forEach((tgt) => { observerS.observe(tgt); });
                Once.forEach((tgt) => { observerO.observe(tgt); });
                // head.forEach((tgt) => { observerH.observe(tgt); });
                Toggle.forEach((tgt) => { observerT.observe(tgt); });
    
            }, 300);
    
        }
        webStorage();
    });
    
    $(function () { //ページ毎処理
        let pageT = location.pathname.slice(1).replace(".html", "");
        let param = location.search;
        let body = $('body');
            if (pageT == "" || pageT.includes("index") || param.includes("page=1&token")) {
                body.addClass("home");
            }
            else {}
    });
    
    // *******************emの文字を取得*******************
    $(function () {//パンくず
    
        const H1 = document.querySelector('.mv_it   h1 span:first-of-type ');// h1を指定している要素を取得
        const CURRENT_PAGE_URL = location.href;// 現在のurlを取得
        const HOME_PAGE_URL = `https://${location.host}`;// トップページのurlを取得
        const PAN = document.querySelector('pan');// パンくずを表示させる要素を取得
        // const HOME_TEXT = 'ホーム';// トップページのリンクテキストを設定
        const HOME_TEXT = 'Home';// トップページのリンクテキストを設定
        if (H1) {
            const H1_TEXT = H1.textContent;// 現在のh1テキストからリンクテキストを設定
            // const H1_TEXT = H1.innerHTML;// 現在のh1テキストからリンクテキストを設定
            const BREADCRUMB_HTML = `
            <ul itemscope="itemscope" itemtype="https://schema.org/BreadcrumbList">
                <li itemprop="itemListElement" itemscope="itemscope" itemtype="https://schema.org/ListItem">
                    <meta itemprop="position" content="1">
                    <a itemprop="item" itemscope="itemscope" itemtype="http://schema.org/Thing" href="${HOME_PAGE_URL}" itemid="${HOME_PAGE_URL}">
                        <meta itemprop="name" content="${HOME_TEXT}">
                        ${HOME_TEXT}
                    </a>
                </li>
                <li>></li>
                <li>${H1_TEXT}</li>
            </ul>
            `
            PAN.insertAdjacentHTML('afterbegin', BREADCRUMB_HTML);
        }
    
    });
    $(window).on('load', function () {//scrollbar幅取得
        const scrollbarWidth = window.innerWidth - document.body.clientWidth;
        document.querySelector('html').style.setProperty('--bar', `${scrollbarWidth}px`);
    });
    $(function () {//全画像処理
        $('img').each(function () {// add alt
            if ($(this).is('[alt="English Quests"]')) {
                $(this).attr('alt', '');
            }
        });
    });
    $(function () { //要素処理
        // 使わないラップ要素を除外、リスト系の初期設定等、要素の操作
        // $(".dis,.disnone").remove();
        $('#main>#col_main,#col_main>section').unwrap();
        $('#side,#col_side1,.dis,.disnone').remove();
        $('.H-split :is(h1,h2,h3)').html(function(){//#で分けて囲む
            return $(this).html().replace(/\n/g,'').split("#").filter(function(x){
              return x.match(/\S/);
            }).map(function(x){
              return "<span>"+x+"</span>";
            }).join("");
        });
        $('.H-split :is(h1,h2,h3)>span:nth-child(1)').html(function(){//#で分けて囲む
            return $(this).html().replace(/\n/g,'').split("").filter(function(x){
              return x.match(/\S/);
            }).map(function(x){
              return "<span>"+x+"</span>";
            }).join("");
        });
        $('#contents *:not(span,.im,p)>img').each(function (i) {
            $(this).wrap('<figure class="im">');
        });
        $('.fb_chat[class*=kage]').each(function(i){
            src = $(this).find('img').attr('src');
            $(this).find('.im').attr('style',`mask-image:url(/${src})`);
        });
    
    
    
        $('.grid50>*').each(function (i) { //add custom prop
            let num = $(this).find('>*').length;
            $(this).attr('style', `--r:${num};`)
        });
        $(' .name-link tr:not(:first-of-type) td[id*=_cell_1_] div').each(function(i){
            NLD = $(this).html();
            $(this).wrapInner(`<a href="#${NLD}">`);
        });
    
        // $(' .ul_btns li a').addClass('btn');
        $(' .ul_btns li').each(function (i) {
            tx = $(this).text();
            $(this).wrapInner('<a class="btn" target="_self">')
            $(this).find('.btn').attr('href', `#${tx}`);
            console.log(
                $(this).text()
            );
        });
        $('.js-wrap :is(h1,h2,h3),.H-wrap :is(h1,h2,h3)').wrapInner('<span>');
    
    
    
        $('.cloneShadow,.stroke').wrapInner('<div>');
        $('.cloneShadow,.stroke,.mv_marquee div').each(function () {
            let ad = $(this).find('>*').clone('true').attr('aria-hidden', 'true');
            ad.appendTo($(this));
        });
    
        $('.wrapGrid').wrapInner('<div class="dg">');
    
        $('#contents .mv_bnr ul>li').each(function (i) {
            $(this).find('a>*:not(img:first-child)').wrapAll("<article>")
        });
        $('[class*=it0],[class*=ti0]').each(function (i) {
            if (!$(this).find('article').length) {
                $(this).wrapInner('<article>');
            }
            newel = $(this).find('article').addClass("art");
        });
        $("[class*='it0'],[class*='ti0'],.overimg,.fl50_it").find("article").each(function () {
            $(this).find(">.im, .itext").insertBefore($(this));
        });
        $(".itlayer").wrapInner('<article>');
    
        $('section div.__ancs ul>li').each(function (i) {//ul構造の調整
            if (!$(this).find('article').length) {
                $(this).wrapInner('<article>');
            }
            newel = $(this).find('article').addClass("art")
            link = $(this).find('article>a[title]');
            newel.find('h3,div').appendTo(link);
        });
        $(' div:not(.ver2)>.box').each(function (i) {//.box構造の調整
            if (!$(this).find('article').length) {
                $(this).wrapInner('<article>');
            }
            newel = $(this).find('article');
            link = $(this).find('article>a[title]');
            newel.find('div').appendTo(link);
        });
        $(".brnone br,.nobr br,.r_edge div br").remove();
        $('.blog_text ul a:contains("#"),.sns_text ul a:contains("#"),.blog ul a:contains("#")').each(function (i) { //"hash"remove
            let str = $(this).text().replace("#", "");
            $(this).text(str);
        });
        $('.blog_list a').attr('target', '_self');
    
        $(".policy-trigger,.policy-wrap").on("click", function () {
            $(".policy-wrap").toggleClass("active");
        });
    
        $(".toggle .toggle_h").click(function () {
            $(this).next("div").stop().slideToggle();
            $(this).toggleClass("show");
        });
        $(".form_qa.__toggle dl:not(:first-of-type) dd").attr('style', 'display:none');
        $(".form_qa.__toggle dt").click(function () {
            $(this).next("dd").stop().slideToggle();
            $(this).toggleClass("show");
        });
    
        $('p.annot').insertAfter('.form_wrap.entry');
        $('div.submit').insertAfter('.annot');
        $(".form_02 dt").each(function () {//#で分割
            let tx = $(this).text();
            if (tx.indexOf("#") >= 0) {
                let array = $(this).html().split('#');
                // array.each(function (i) {
                //     $(this);
                // });
                // console.log(array);
                $(this).html(array[0] + '<span>' + array[1] + '</span>')
                // $(this).html('<span>' + array[0] + '</span><span>' + array[1] + '</span>')
            }
        });
        $(".link_box .box").each(function (i) {
            $(this).wrap(`<a href="#0${i + 1}" />`);
        });
        $(".dl_qa.firstopen dl:first-child dt").addClass('show');
        $(".dl_qa dl dt").click(function () {
            $(this).next("dd").stop().slideToggle();
            $(this).toggleClass('show');
        });
    
    
    
    
    });
    $(function () {// slick
    
        $(".sns_slide .sns_list").slick({
            // autoplay: true,
            autoplaySpeed: 5000, //自動再生のスライド切り替えまでの時間を設定
            speed: 600, //スライドが流れる速度を設定
            cssEase: "ease-in-out", //スライドの流れ方を等速に設定
            slidesToShow: 5, //表示するスライドの数
            arrows: true,
            dots: true,
            useCSS: true,
            responsive: [
                { breakpoint: 1440, settings: { slidesToShow: 4 } },
                { breakpoint: 960, settings: { slidesToShow: 3 } },
                {
                    breakpoint: 834,
                    settings: {
                        slidesToShow: 2
                    }
                },
                // { breakpoint: 640, settings: { slidesToShow: 2 } }
            ]
        });
        $(".ul_slide ul,.card_slide").slick({
            // autoplay: true,
            autoplaySpeed: 5000, //自動再生のスライド切り替えまでの時間を設定
            speed: 600, //スライドが流れる速度を設定
            cssEase: "ease-in-out", //スライドの流れ方を等速に設定
            slidesToShow: 3, //表示するスライドの数
            arrows: true,
            // dots: true,
            useCSS: true,
            responsive: [
                // { breakpoint: 1200, settings: { slidesToShow: 4 } },
                {
                    breakpoint: 834,
                    settings: {
                        slidesToShow: 2
                    }
                },
                // { breakpoint: 640, settings: { slidesToShow: 2 } }
            ]
        });
    
        $(".blog_slide .blog_list").slick({
            // autoplay: true,
            autoplaySpeed: 5000, //自動再生のスライド切り替えまでの時間を設定
            speed: 600, //スライドが流れる速度を設定
            cssEase: "ease-in-out", //スライドの流れ方を等速に設定
            slidesToShow: 4, //表示するスライドの数
            arrows: true,
            dots: true,
            useCSS: true,
            responsive: [
                { breakpoint: 961, settings: { slidesToShow: 3 } },
                {
                    breakpoint: 834,
                    settings: {
                        slidesToShow: 2
                    }
                },
                // { breakpoint: 640, settings: { slidesToShow: 2 } }
            ]
        });
        $('.blog_slide .slick-track').addClass('js-chB');
        $('.popup li,.popup .box:not(:has(img[alt=arrow]))').each(function (i) {
            src = $(this).find('img').wrap('<a class="popup__a">').addClass('popup__img').attr('src');
            // console.log(src);
            $(this).find('.popup__a').attr('href', `${src}`)
        });
        $('.popup').magnificPopup({//ポップアップ
            delegate: 'a',
            type: 'image',
            removalDelay: 600,
            gallery: {
                enabled: true
            },
            preloader: true,
        });
        $('[class*=slide_custom] ul').slick({
            dots: true,
            autoplay: false,
            arrows: true,
            // fade: true,
            speed: 400,
            slidesToShow: 1,
            customPaging: function (slick, index) {
                // スライダーのインデックス番号に対応した画像のsrcを取得
                var targetImage = slick.$slides.eq(index).find('img').attr('src');
                // slick-dots > li　の中に上記で取得した画像を設定
                return '<img src=" ' + targetImage + ' "/>';
            },
            responsive: [
                // { breakpoint: 1401,settings: {slidesToShow: 4}  },
                // { breakpoint: 1001,settings: {slidesToShow: 3}  },
                {
                    breakpoint: 641,
                    settings: {
                        slidesToShow: 1
                    }
                },
                // {breakpoint: 641,settings: {slidesToShow: 2 }}
            ]
        });
        // 横並びサムネイルスライド
        $('.main ul').addClass('main-img');
        $('.thumb li').addClass('thumbnail-item');
        $('.simulation-list').each(function (i, e) {
            var slider = ".main-img"; // スライダー
            var thumbnailItem = ".thumbnail-item"; // サムネイル
            // サムネイル画像アイテムに data-index でindex番号を付与
            $(thumbnailItem, e).each(function () {
                var index = $(thumbnailItem, e).index(this);
                $(this).attr("data-index", index);
            });
            // スライダー初期化後、カレントのサムネイル画像にクラス「thumbnail-current」を付ける
            $(slider, e).on('init', function (slick) {
                var index = $(".slide-item.slick-slide.slick-current", e).attr("data-slick-index");
                $(thumbnailItem + '[data-index="' + index + '"]', e).addClass("thumbnail-current");
            });
            //slickスライダー
            $(slider, e).slick({
                autoplay: false,
                arrows: true,
                fade: true,
            });
            //サムネイル画像アイテムをクリックしたときにスライダー切り替え
            $(thumbnailItem, e).on('click', function () {
                var index = $(this).attr("data-index");
                $(slider, e).slick("slickGoTo", index, false);
            });
            //サムネイル画像のカレントを切り替え
            $(slider, e).on('beforeChange', function (event, slick, currentSlide, nextSlide) {
                $(thumbnailItem, e).each(function () {
                    $(this).removeClass("thumbnail-current");
                });
                $(thumbnailItem + '[data-index="' + nextSlide + '"]', e).addClass("thumbnail-current");
            });
        });
    
    });
    $(function () {//navigation
        $(".h_nav ul li a").each(function () {// #でh_nav aをspan分離
            let tx = $(this).text();
            if (tx.indexOf("#") >= 0) {
                let array = $(this).html().split('#');
                // console.log(array);
                // $(this).html(array[0] + '<span>' + array[1] + '</span>')
                $(this).html('<span>' + array[0] + '</span>' + array[1])
                // $(this).html('<dt>' + array[0] + '</dt><dd>' + array[1] + '</dd>')
            }
        });
        // navsp
        $(".h_nav").clone().attr("id", "navsp").removeClass().addClass("nav").wrapInner('<div class="nav_inner">').insertAfter('.h_nav');
    
        MENU = document.querySelector(".h_menu");
        navpc = document.querySelector(".h_nav");
        HnavA = document.querySelectorAll(".h_nav a");
        cont = document.querySelector("#contents");
        navsp = document.querySelector("#navsp");
        navul = document.querySelector("#navsp ul");
        // hdu = document.querySelector(".h_dropul");
        menutoggle = document.querySelectorAll(".menu_toggle, .nav a:not(.nopointer,.drop_toggle)");
        contact = document.querySelectorAll(".h_items a");
        Dtoggle = document.querySelectorAll(".drop_toggle");
        Ghdr = document.querySelector("#global_header");
        hdr = document.querySelector('#header');
        focustrap = document.querySelector('.focus_trap');
    
        // svg>path replace attr "d"
        // MENU func
        const btnPress = () => {
            navpc.inert = navpc.inert === true ? false : true;
            navsp.classList.toggle("show");
            MENU.ariaPressed = MENU.ariaPressed === "true" ? "false" : "true";
            MENU.ariaExpanded = MENU.ariaExpanded === "true" ? "false" : "true";
            MENU.ariaLabel =
                MENU.ariaLabel === "menu open" ?
                    "menu close" :
                    "menu open";
            hdr.classList.toggle("active");
            MENU.classList.toggle("active");
            navul.classList.toggle("show");
        };
    
        // btnPress();
    
        HnavA.forEach((el) => {
            el.addEventListener("click", () => {
                setTimeout(() => {
                    el.blur();
                    console.log(878);
                }, 600);
            });
        });
        contact.forEach((el) => {
            el.addEventListener("click", () => {
                if (hdr.classList.contains("active")) {
                    btnPress();
                }
            });
        });
        menutoggle.forEach((el) => {
            el.addEventListener("click", () => {
                // if (innerWidth <= 1200) {
                btnPress();
                // }
            });
        });
        focustrap.addEventListener("focus", () => {
            MENU.focus();
        });
        window.onkeyup = function (event) {
            if (event.keyCode == '27' && MENU.ariaPressed === "true") {
                btnPress();
            }
        }
    
        // アコーディオン開閉 
        const dropDown = (el) => {
            // el.ariaPressed = el.ariaPressed === "true" ? "false" : "true";
            // da.ariaHidden = da.ariaHidden === "false" ? "true" : "false";
            // next = el.nextElementSibling;
            parent = el.closest('li');
            target = el.closest('li').querySelector('ul');
            target.classList.toggle("show");
            el.classList.toggle("active");
            parent.ariaExpanded = parent.ariaExpanded === "true" ? "false" : "true";
            target.ariaHidden = target.ariaHidden === "false" ? "true" : "false";
            target.ariaLabel = target.ariaLabel === "open" ? "close" : "open";
        }
        $('.drop ').each(function (i) { //add custom prop
            let num = $(this).find('ul li').length;
            let listh = $(this).find('ul li').outerHeight();
            // console.log(listh);
            $(this).attr('style', `--li:${num};--h:${listh}px`)
            // $('.ulcircle').attr('style',  `--listnum:${listnum - 1}`)
        });
        Dtoggle.forEach((el) => {
            el.addEventListener("click", () => {
                dropDown(el);
            });
        });
        if (window.innerWidth >= 1200) {  // hover dropdown
            hlb = document.querySelectorAll(".h_list.__drop");
            hlb.forEach((el) => {
                el.addEventListener("mouseover", () => {
                    console.log(56);
                    hb = el.querySelector(".h_btn");
                    acc = el.querySelector(".h_drop");
                    hb.ariaPressed = "true";
                    hb.ariaExpanded = "true";
                    hb.ariaLabel = "open";
                    // hb.classList.add("show");
                    acc.classList.add("show");
                    hb.nextElementSibling.ariaHidden = "false";
                    hb.nextElementSibling.classList.add("show");
                });
                el.addEventListener("mouseleave", () => {
                    hb.ariaPressed = "false";
                    hb.ariaExpanded = "false";
                    hb.ariaLabel = "close";
                    // hb.classList.remove("show");
                    acc.classList.remove("show");
                    hb.nextElementSibling.ariaHidden = "true";
                    hb.nextElementSibling.classList.remove("show");
                });
            });
        }
    });