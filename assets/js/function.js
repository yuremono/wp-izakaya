

$(function () {//パンくず
    let span = $(".title1  h1 span").detach();
    const H1 = document.querySelector('.title1 h1');// h1を指定している要素を取得
    const CURRENT_PAGE_URL = location.href;// 現在のurlを取得
    const HOME_PAGE_URL = `https://${location.host}`;// トップページのurlを取得
    const PAN = document.querySelector('pan');// パンくずを表示させる要素を取得
    const HOME_TEXT = '居酒屋';// トップページのリンクテキストを設定
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
    $(".title1 h1").prepend(span);
    // $(".title1 h1").append(span);
});


$(function () { //ページ毎処理
    let pageT = location.pathname.slice(1).replace(".html", "");
    let param = location.search;
    let body = $('body');
    let sec = $('main:first-child');
    if (pageT.includes("info")) {
        body.addClass("info");
        // $('.h').addClass('is-scroll');
    }
    else
    if (pageT == "" || pageT == "index" || param.includes("page=1&token")) {
        body.addClass("home");

    }
});
$(function () { //要素処理
    $('img').each(function () {// add alt
        $(this).on("error", function () {
            console.log("画像が指定されていません");
            $(this).attr("src", "https://placehold.jp/aaa/ffffff/600x400.png?text=dummy");
        });
        if ($(this).is('[alt=""]')) {
            $(this).attr('alt', '居酒屋');
        }
    });
    $('.has-h1 img,.fl50wide .box,.twopicBtn .box,.sns_slide .sns_photo,.title1 h1').addClass('js-hide');


    $('.twopicBtn>.box>div').wrapInner('<span>');
    $('.wrapGrid').wrapInner('<div class="dg">');
    $('.span-h :is(h1,h2,h3)>span:not(.translate)').addClass('sub');
    $('.title_026 :is(h1,h2,h3)').wrapInner('<span class="sub">');
    $(':is(.title1,[class*=hbb]) :is(h1,h2,h3,p)>span:not(.translate)').addClass('sub');

    $('#side,#col_side1,.dis,.disnone').remove();
    $('#main>#col_main,#col_main>main').unwrap();

    $('#contents .mv_slide ul>li').each(function (i) {
        if (!$(this).find('article').length) {
            $(this).wrapInner('<article>');
        }
        newel = $(this).find('article').addClass("art")
        $(this).find('img').insertBefore(newel)
        // console.log(newel.text());
        if ($.trim(newel.text()) == '') {
            newel.remove();
        }
        $(this).find('article a').prependTo($(this))
        // $(this).find('article a:not(.btn)').prependTo($(this))
        $(this).find('img,.art').prependTo($(this).find('a'))
    });
    $('.it,.ti').each(function (i) {
        if (!$(this).find('article').length) {
            $(this).wrapInner('<article>');
        }
        newel = $(this).find('article').addClass("art");
    });

    $('main div:not(.picBtn,.twopicBtn)>.box').each(function (i) {//ul構造の調整
        if (!$(this).find('article').length) {
            $(this).wrapInner('<article>');
        }
        newel = $(this).find('article').addClass("art")
        link = $(this).find('article>a[title]');
        newel.find('h3,div').appendTo(link);

    });


    $('#contents *:not(span,div.im,.beer-slider>.box)>img').wrap('<figure class="im">');
    $(".it,.ti,.it-g,.ti-g,.overimg,.l_edge,.r_edge,.i-art").find("article").each(function () {
        $(this).find(">.im, .itext").insertBefore($(this));
    });



    $(".brnone br,.nobr br,.r_edge div br").remove();
    $('.blog_text ul a:contains("#"),.sns_text ul a:contains("#")').each(function (i) { //"hash"remove
        let str = $(this).text().replace("#", "");
        $(this).text(str);
    });
    $('.blog_list a').attr('target', '_self');

    $(".policy-trigger,.policy-wrap").on("click", function () {
        $(".policy-wrap").toggleClass("active");
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







});


$(function () {// slick
    $(".sns_slide .sns_list").slick({
        autoplay: true,
        autoplaySpeed: 3000, //自動再生のスライド切り替えまでの時間を設定
        speed: 1000, //スライドが流れる速度を設定
        // cssEase: "linear", //スライドの流れ方を等速に設定
        slidesToShow: 3, //表示するスライドの数
        arrows: false, //矢印非表示
        useCSS: true,
        responsive: [
            { breakpoint: 1200, settings: { slidesToShow: 4 } },
            {
                breakpoint: 834,
                settings: {
                    slidesToShow: 3
                }
            },
            { breakpoint: 640, settings: { slidesToShow: 2 } }
        ]
    });

});

$(function () {//navigation
    // navsp
    $(".h_nav").clone().attr("id", "navsp").removeClass().addClass("nav").wrapInner('<div class="nav_inner">').insertAfter('.h_nav');
    $('#navsp li').addClass('js-hide');

    // $(".h_nav").clone().removeAttr('id').removeClass().addClass("mv_nav").insertBefore('.mv_slide');

    MENU = document.querySelector(".h_menu");
    navpc = document.querySelector(".h_nav");
    cont = document.querySelector("#contents");
    navsp = document.querySelector("#navsp");
    navul = document.querySelector("#navsp ul");
    // hdu = document.querySelector(".h_dropul");
    menutoggle = document.querySelectorAll(".menu_toggle, .nav a");
    contact = document.querySelectorAll(".h_contact");
    Dtoggle = document.querySelectorAll(".drop_toggle");
    Ghdr = document.querySelector("#global_header");
    hdr = document.querySelector('#header');
    focustrap = document.querySelector('.nav .focus_trap');
    // svg>path replace attr "d"
    const barToggle = () => {
        bar1 = document.querySelector(".bar1");
        bar2 = document.querySelector(".bar2");
        bar3 = document.querySelector(".bar3");
        // horizon
        if (bar1.getAttribute('d') === "M10 20 90 20") {
            bar1.setAttribute('d', "M10 50 90 50");
            bar2.setAttribute('d', "M10 50 90 50");
            bar3.setAttribute('d', "M10 50 90 50");
            // <path class="bar1" d="M10 20 90 20" />
            //                 <path class="bar2" d="M10 50 90 50" />
            //                 <path class="bar3" d="M10 80 90 80" />
        } else {
            bar1.setAttribute('d', "M10 20 90 20");
            bar2.setAttribute('d', "M10 50 90 50");
            bar3.setAttribute('d', "M10 80 90 80");
        }
        // cross
        // if (bar1.getAttribute('d') === "M10 20 90 20") {
        //     bar1.setAttribute('d', "M10 10 90 90");
        //     bar2.setAttribute('d', "M50 50 50 50");
        //     bar3.setAttribute('d', "M10 90 90 10");
        //     // tex.setAttribute("transform", "matrix(1 -.5 0 1 0 80)");
        // } else {
        //     bar1.setAttribute('d', "M10 20 90 20");
        //     bar2.setAttribute('d', "M10 50 90 50");
        //     bar3.setAttribute('d', "M10 80 90 80");
        // }
    }
    // MENU func
    const btnPress = () => {
        navpc.inert = navpc.inert === true ? false : true;
        MENU.ariaPressed = MENU.ariaPressed === "true" ? "false" : "true";
        MENU.ariaExpanded = MENU.ariaExpanded === "true" ? "false" : "true";
        MENU.ariaLabel =
            MENU.ariaLabel === "menu open" ?
                "menu close" :
                "menu open";
        hdr.classList.toggle("is-active");
        MENU.classList.toggle("is-active");
        navsp.classList.toggle("show");
        navul.classList.toggle("show");
        // SVG属性操作
        // barToggle();
        // アコーディオン閉じる
        // hBtn.forEach((el) => {
        //     el.ariaPressed = "false";
        //     el.ariaExpanded = "false";
        //     el.ariaLabel = "close";
        //     da = el.nextElementSibling;
        //     console.log(da);
        //     // da.ariaHidden = "true";
        //     // da.classList.remove("show");
        //     da.style.height =  `0px` ;
        // })
    };

    // btnPress();

    contact.forEach((el) => {
        el.addEventListener("click", () => {
            if (hdr.classList.contains("is-active")) {
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
    // window.addEventListener("keydown", () => {
    //     if (MENU.ariaPressed === "true") {
    //         if (event.key === "Escape") {
    //             btnPress();
    //         }
    //     }
    // });

    // アコーディオン開閉
    const dropDown = (el) => {
        el.ariaPressed = el.ariaPressed === "true" ? "false" : "true";
        el.ariaExpanded = el.ariaExpanded === "true" ? "false" : "true";
        el.ariaLabel = el.ariaLabel === "close" ? "open" : "close";
        // da.ariaHidden = da.ariaHidden === "false" ? "true" : "false";
        next = el.nextElementSibling;
        next.classList.toggle("show");
        el.classList.toggle("is-active");
        // gsap.to(ul, {
        //     height: "auto",
        //     duration:.6,
        // })
        // listH = next.childElementCount * da.querySelector("li").clientHeight;
        // listH = da.querySelector("ul").clientHeight;
        // listH = da.clientHeight;
        // da.style.height = da.style.height === `${listH}px` ? `0px` : `${listH}px`;
    }
    $('.drop ul').each(function (i) { //add custom prop
        let num = $(this).find('li').length;
        let listh = $(this).find('li').outerHeight();
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
    // ************ !確認用*****************
    // hlb = document.querySelectorAll(".h_list.__drop");
    //             hb = document.querySelectorAll(".h_btn");
    //             acc = document.querySelectorAll(".h_drop");
    //     hb.forEach((el) => {
    //             el.ariaPressed = "true";
    //             el.ariaExpanded = "true";
    //             el.ariaLabel = "open";
    //             el.classList.add("show");
    //         });
    //     acc.forEach((el) => {
    //             el.ariaPressed = "true";
    //             el.ariaExpanded = "true";
    //             el.ariaLabel = "close";
    //             el.classList.add("show");
    //         });
    // ************ !確認用*****************
});
$(function () {//IntersectionObserver >>>> webstrage
    $(".mv_slide ul").slick({
        autoplay: true,
        fade: true,
        autoplaySpeed: 4000,
        speed: 2000,
        arrows: false,
        slidesToShow: 1,
        infinite: true,
        useCSS: true,
    });

    //  SHOW
    let Once = document.querySelectorAll(
        ".js-right,.js-left,.js-bottom,.js-chB :is(.box,li),.js-hide,.ulcircle"
    );
    let Once2 = document.querySelectorAll(".js-top,[class*=js-clip]");
    const observerO = new IntersectionObserver(IOonce, { rootMargin: "-0% 0% -20% 0px", });
    const observerO2 = new IntersectionObserver(IOonce2, { rootMargin: "0% 0% -20% 0px", });

    function IOonce(entries) {
        entries.forEach(function (entry, i) {
            const target = entry.target;
            const delay = i * 120;
            if (entry.isIntersecting) {
                setTimeout(function () {
                    target.classList.add("show");
                }, delay);
            }
            // else {
            //     setTimeout(function () {
            //         target.classList.remove("show");
            //     }, delay);
            // }
        });
    }
    function IOonce2(entries) {
        entries.forEach(function (entry, i) {
            const target = entry.target;
            let delay = i * 120;
            if (entry.isIntersecting) {
                setTimeout(function () {
                    target.classList.add("show");
                }, delay);
            }
            // else {
            //     setTimeout(function () {
            //         target.classList.remove("show");
            //     }, delay);
            // }
        });
    }
    // IS-SCROLL
    const head = document.querySelectorAll(".mv_h,.title1");
    const observerH = new IntersectionObserver(IOhead, { rootMargin: "-0% 0% -0% 0px", threshold: 0.7 });
    function IOhead(entries) {
        entries.forEach(function (entry, i) {
            const header = document.querySelector('#header');
            if (entry.isIntersecting) {
                header.classList.remove('is-scroll');
            }
            else {
                header.classList.add('is-scroll');
            }
        });
    }
    // SLIDE
    const slide = document.querySelectorAll(".mv_slide,.toleft,.toright,.sns_slide");
    const observerS = new IntersectionObserver(IOslide, { rootMargin: "-20% 0% -20% 0px", threshold: 0 });
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
    // });
    // $(window).on('load', function () {// session

    var webStorage = function () {//
        setTimeout(function () {
            document.querySelector('body').setAttribute("style", "opacity:1;visibility:visible;");


        }, 1000);
        setTimeout(function () {
            // anc.forEach((tgt) => { observerB.observe(tgt); });

            slide.forEach((tgt) => { observerS.observe(tgt); });
            Once.forEach((tgt) => { observerO.observe(tgt); });
            Once2.forEach((tgt) => { observerO2.observe(tgt); });
            head.forEach((tgt) => { observerH.observe(tgt); });
        }, 1000);
    }
    webStorage();
});