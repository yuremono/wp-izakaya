<?php
/**
 * トップ page content.
 *
 * @package Izakaya
 */

declare(strict_types=1);

if (!defined('ABSPATH')) {
        exit;
}
?>
<div id="contents_wrap">
        <div id="contents" class="clearfix">
                <main>
                        <div class="mv bg100 c143">
                                <!-- #c143 -->
                                <div class="clearfix mv_slide c501">
                                        <ul>
                                                <li>
                                                        <img src="<?php echo esc_url(theme_source_uri('images/home/mv01__pc.jpg')); ?>"
                                                             alt="">
                                                </li>
                                                <li>
                                                        <img src="<?php echo esc_url(theme_source_uri('images/home/mv02__pc.jpg')); ?>"
                                                             alt="">
                                                </li>
                                        </ul>
                                </div><!-- #c501 -->
                                <div class="clearfix mv_h js-hide c464">
                                        <img src="<?php echo esc_url(theme_source_uri('images/home/logo.png')); ?>" alt="" class="imgL">
                                </div><!-- #c464 -->
                
                        </div><!-- #c391 -->
                        <div class="second c462">
                                <!-- #c462 -->
                                <div class="second_bg js-hide c508">
                
                                </div><!-- #c508 -->
                                <div class="clearfix has-h1 f18 c507">
                                        <img src="<?php echo esc_url(theme_source_uri('images/home/kanji-wh.png')); ?>" alt=""
                                             class="imgR">
                                        <div><span style='font-size: clamp(20px,3.6vw,36px);'>居酒屋</span><br />
                                                <h1>焼酎をゆっくり楽しめる居酒屋です。<br />
                                                        落ち着いた雰囲気でゆっくりと焼酎を楽しめるお店です。<br />
                                                        当店では１００銘柄以上の焼酎を揃えていますので、<br />
                                                        お好みの香りや、味を言っていただければお客様に合った焼酎をご提供いたします。
                                                </h1>
                                                日頃、焼酎をあまり飲まない方でもお気軽に立ち寄っていただき、焼酎についてなんでも質問してください。<br />
                                                店名はテーマ名に合わせて「居酒屋」としています。<br />
                                                是非、居酒屋でお好みの焼酎と出会い、素敵な時間をお過ごしください。
                                        </div>
                                </div><!-- #c507 -->
                
                        </div><!-- #c465 -->
                        <div class="fl50wide c414">
                                <!-- #c414 -->
                                <div class="clearfix c502">
                                        <article>
                                                <h2>焼酎の原酒</h2>
                                                <div>皆さんがよく見かける焼酎は<br />
                                                        25度や20度のものが多いと思いますが、<br />
                                                        それらの焼酎は原酒に水を加えることによって<br />
                                                        度数を調整しています。<br />
                                                        水や添加物を一切加えない状態のお酒のことを<br />
                                                        原酒と呼びます。<br />
                                                        <a class="btn" href="<?php echo esc_url(home_url('/genshu/')); ?>">詳しく見る</a>
                                                </div>
                                        </article>
                                </div><!-- #c502 -->
                                <div class="twopicR wrapGrid c475">
                                        <div class="box">
                                                <img src="<?php echo esc_url(theme_source_uri('images/shoutyuu/Image_20230915_180414_591.jpeg')); ?>"
                                                     alt="">
                                                <div></div>
                                        </div>
                                        <div class="box">
                                                <img src="<?php echo esc_url(theme_source_uri('images/shoutyuu/IMG_404334.jpg')); ?>"
                                                     alt="">
                                                <div></div>
                                        </div>
                                </div><!-- #c475 -->
                                <div class="twopicL wrapGrid c477">
                                        <div class="box">
                                                <img src="<?php echo esc_url(theme_source_uri('images/home/s01.jpg')); ?>" alt="">
                                                <div></div>
                                        </div>
                                        <div class="box">
                                                <img src="<?php echo esc_url(theme_source_uri('images/shoutyuu/IMG_4057.jpg')); ?>"
                                                     alt="">
                                                <div></div>
                                        </div>
                                </div><!-- #c477 -->
                                <div class="clearfix c503">
                                        <article>
                                                <h2>本格焼酎</h2>
                                                <div>当店で扱っている焼酎は本格焼酎と言われるものです。<br />
                                                        連続式蒸留機を使用して純粋なアルコール分を取り出したものではなく、単式蒸留機を使用してじっくりと蒸留していくことで出来る焼酎で<br />
                                                        本格焼酎には原料の芋、米、麦などの風味が豊かで、深い味わいが楽しめます。<br />
                                                        <a class="btn" href="<?php echo esc_url(home_url('/shochu/')); ?>">詳しく見る</a>
                                                </div>
                                        </article>
                                </div><!-- #c503 -->
                
                        </div><!-- #c417 -->
                        <div class="linkouter_top mt-bl05 c478">
                                <!-- #c478 -->
                                <div class="clearfix twopicBf c505">
                                        <div><a class="btn" href="<?php echo esc_url(home_url('/other/')); ?>"><br />
                                                        <span>Other</span><br />
                                                        <span>その他のお酒</span><br />
                                                </a></div>
                                </div><!-- #c505 -->
                                <div class="twopicBtn c504">
                                        <div class="box">
                                                <a href="<?php echo esc_url(home_url('/other/')); ?>" title="" target="_self"><img
                                                             src="<?php echo esc_url(theme_source_uri('images/home/sonota01.jpg')); ?>"
                                                             alt=""></a>
                                                <div></div>
                                        </div>
                                        <div class="box">
                                                <a href="<?php echo esc_url(home_url('/other/')); ?>" title="" target="_self"><img
                                                             src="<?php echo esc_url(theme_source_uri('images/home/IMG_4031.jpg')); ?>"
                                                             alt=""></a>
                                                <div>その他のお酒<br></div>
                                        </div>
                                </div><!-- #c504 -->
                
                        </div><!-- #c479 -->
                        <div class="linkouter_bottom c509">
                                <!-- #c509 -->
                                <div class="clearfix twopicBf c510">
                                        <div><a class="btn" href="<?php echo esc_url(home_url('/otsumami/')); ?>"><br />
                                                        <span>Otsumami</span><br />
                                                        <span>おつまみ</span><br />
                                                </a></div>
                                </div><!-- #c510 -->
                                <div class="twopicBtn c511">
                                        <div class="box">
                                                <a href="<?php echo esc_url(home_url('/otsumami/')); ?>" title="" target="_self"><img
                                                             src="<?php echo esc_url(theme_source_uri('images/home/IMG_3974.jpg')); ?>"
                                                             alt=""></a>
                                                <div>おつまみ<br></div>
                                        </div>
                                        <div class="box">
                                                <a href="<?php echo esc_url(home_url('/otsumami/')); ?>" title="" target="_self"><img
                                                             src="<?php echo esc_url(theme_source_uri('images/home/IMG_4007.jpg')); ?>"
                                                             alt=""></a>
                                                <div></div>
                                        </div>
                                </div><!-- #c511 -->
                
                        </div><!-- #c512 -->
                        <div class="sns_slide mt-bl05 c494">
                                <div class="sns_list">
                                        <div>
                                                <div class="sns_photo">
                                                        <a href="#" target="_blank" rel="noopener noreferrer">
                                                                <img
                                                                     src="<?php echo esc_url(theme_source_uri('img/sns/202605/18085852931454967.jpg')); ?>">
                                                        </a>
                                                </div>
                                                <!-- div.sns_list div.sns_photo -->
                                                <div class="sns_text">
                                                        <div class="sns_date">2026.05.31
                                                        </div>
                                                        <div class="caption">2026/05/31
                                                                こんにちは
                                                                居酒屋です。
                
                                                                皆様のおかげで居酒屋
                                                                2026年6月で3周年を迎えることとなりました
                                                                これも皆様のお力添えがあってこそでございます
                                                                ありがとうございます😃✨
                                                                つきましてはささやかではございますが
                                                                3周年の記念グッズを6月2日からご来店のお客様にお配りいたします
                                                                6月1日は月曜日なのでお休みです。
                
                                                                今後とも変わらぬご愛顧を賜りますようお願い申し上げます。
                
                                                                居酒屋
                                                                火〜土曜日:17:00〜2:00
                                                                日曜日:15:00〜0:00
                                                                定休日:月曜日
                                                                TEL:000-0000-0000
                
                                                                #居酒屋#居酒屋#焼酎好きな人と繋がりたい
                                                        </div>
                                                        <div id="TRANS_SNSCS496"></div>
                                                        <ul class="clearfix">
                                                                <li><a href="#" target="_blank"
                                                                           rel="noopener noreferrer">#焼酎好きな人と繋がりたい</a>
                                                                </li>
                                                        </ul>
                                                </div><!-- div.sns_list div.sns_text -->
                                        </div><!-- div.sns_list > div -->
                                        <div>
                                                <div class="sns_photo">
                                                        <a href="#" target="_blank" rel="noopener noreferrer">
                                                                <img
                                                                     src="<?php echo esc_url(theme_source_uri('img/sns/202604/18064284329391009.jpg')); ?>">
                                                        </a>
                                                </div>
                                                <!-- div.sns_list div.sns_photo -->
                                                <div class="sns_text">
                                                        <div class="sns_date">2026.04.28
                                                        </div>
                                                        <div class="caption">2026/04/28
                                                                こんにちは
                                                                居酒屋です。
                
                                                                5月お休みのお知らせ
                
                                                                GW中は休まず営業します
                                                                お出かけする方もそうじゃない方も
                                                                お気軽にご利用ください。
                                                                よろしくお願いいたします。
                
                                                                居酒屋
                                                                火〜土曜日:17:00〜2:00
                                                                日曜日:15:00〜0:00
                                                                定休日:月曜日
                                                                TEL:000-0000-0000
                
                                                                #居酒屋#居酒屋#焼酎#焼酎好きな人と繋がりたい
                                                        </div>
                                                        <div id="TRANS_SNSCS495"></div>
                                                        <ul class="clearfix">
                                                                <li><a href="#" target="_blank"
                                                                           rel="noopener noreferrer">#焼酎好きな人と繋がりたい</a>
                                                                </li>
                                                        </ul>
                                                </div><!-- div.sns_list div.sns_text -->
                                        </div><!-- div.sns_list > div -->
                                        <div>
                                                <div class="sns_photo">
                                                        <a href="#" target="_blank" rel="noopener noreferrer">
                                                                <img
                                                                     src="<?php echo esc_url(theme_source_uri('img/sns/202603/17985292958964841.jpg')); ?>">
                                                        </a>
                                                </div>
                                                <!-- div.sns_list div.sns_photo -->
                                                <div class="sns_text">
                                                        <div class="sns_date">2026.03.31
                                                        </div>
                                                        <div class="caption">爆風</div>
                                                        <div id="TRANS_SNSCS494"></div>
                                                        <ul class="clearfix">
                                                        </ul>
                                                </div><!-- div.sns_list div.sns_text -->
                                        </div><!-- div.sns_list > div -->
                                        <div>
                                                <div class="sns_photo">
                                                        <a href="#" target="_blank" rel="noopener noreferrer">
                                                                <img
                                                                     src="<?php echo esc_url(theme_source_uri('img/sns/202603/18058750685688590.jpg')); ?>">
                                                        </a>
                                                </div>
                                                <!-- div.sns_list div.sns_photo -->
                                                <div class="sns_text">
                                                        <div class="sns_date">2026.03.13
                                                        </div>
                                                        <div class="caption">2026/03/13
                                                                こんにちは
                                                                居酒屋です。
                
                                                                話題の芋焼酎居酒屋の2026年版『居酒屋
                                                                EP9』
                                                                入荷しました。
                                                                居酒屋は居酒屋にある居酒屋が手掛けるシリーズでフルーティーな香りが特徴の芋焼酎です
                                                                今年の居酒屋はマスカットの様なフルーティーな香りに花の香を思わせるフローラルな香りがプラスされました
                                                                とっても上品な香りです
                                                                炭酸割りで香りに包まれる感じをお楽しみください。
                
                                                                居酒屋
                                                                火〜土曜日:17:00〜2:00
                                                                日曜日:15:00〜0:00
                                                                定休日:月曜日
                                                                TEL:000-0000-0000
                
                                                                #居酒屋#焼酎#居酒屋#居酒屋#フルーティー
                                                        </div>
                                                        <div id="TRANS_SNSCS493"></div>
                                                        <ul class="clearfix">
                                                                <li><a href="#" target="_blank" rel="noopener noreferrer">#フルーティー</a>
                                                                </li>
                                                        </ul>
                                                </div><!-- div.sns_list div.sns_text -->
                                        </div><!-- div.sns_list > div -->
                                        <div>
                                                <div class="sns_photo">
                                                        <a href="#" target="_blank" rel="noopener noreferrer">
                                                                <img
                                                                     src="<?php echo esc_url(theme_source_uri('img/sns/202603/18157574734438771.jpg')); ?>">
                                                        </a>
                                                </div>
                                                <!-- div.sns_list div.sns_photo -->
                                                <div class="sns_text">
                                                        <div class="sns_date">2026.03.11
                                                        </div>
                                                        <div class="caption">2026/03/11
                                                                こんにちは
                                                                居酒屋です。
                
                                                                春限定の芋焼酎入荷です
                                                                居酒屋にある居酒屋さんの
                                                                『居酒屋』
                                                                居酒屋産の芋を原料に黄色麹で醸した
                                                                芋焼酎で華やかな香りとキレのある上品な甘さがある焼酎です。
                                                                ロックでキリッと飲むのも少し加水して香りを楽しむのもオススメです。
                                                                春限定焼酎を是非味わって下さい。
                
                                                                居酒屋
                                                                火〜土曜日:17:00〜2:00
                                                                日曜日:15:00〜0:00
                                                                定休日:月曜日
                                                                TEL:000-0000-0000
                
                                                                #居酒屋#焼酎#居酒屋#居酒屋#春
                                                        </div>
                                                        <div id="TRANS_SNSCS492"></div>
                                                        <ul class="clearfix">
                                                                <li><a href="#" target="_blank" rel="noopener noreferrer">#春</a>
                                                                </li>
                                                        </ul>
                                                </div><!-- div.sns_list div.sns_text -->
                                        </div><!-- div.sns_list > div -->
                                        <div>
                                                <div class="sns_photo">
                                                        <a href="#" target="_blank" rel="noopener noreferrer">
                                                                <img
                                                                     src="<?php echo esc_url(theme_source_uri('img/sns/202602/18082662812251390.jpg')); ?>">
                                                        </a>
                                                </div>
                                                <!-- div.sns_list div.sns_photo -->
                                                <div class="sns_text">
                                                        <div class="sns_date">2026.02.05
                                                        </div>
                                                        <div class="caption">2026/02/05
                                                                こんにちは
                                                                居酒屋です。
                
                                                                居酒屋にある居酒屋さんの
                                                                『居酒屋』入荷しました。
                                                                焼酎造りで重要な工程の一つである蒸留
                                                                その蒸留のタイミングを細かく分析し、芋の香りをリッチ抽出した革新的な本格焼酎です。
                                                                原料にジョイホワイト芋を使用してワイン酵母で
                                                                低温長期発酵してあります。
                                                                高級感のある甘い香りにスッキリした後味の焼酎に仕上がっています。
                                                                アルコール度数は40度としっかりした飲み応え
                                                                ストレートで高級感のある甘さを味わっても良し
                                                                炭酸割りでスッキリと飲むのも良しです
                
                                                                是非飲んでみてください。
                
                                                                居酒屋
                                                                火〜土曜日:17:00〜2:00
                                                                日曜日:15:00〜0:00
                                                                定休日:月曜日
                                                                TEL:000-0000-0000
                
                                                                #居酒屋#焼酎#居酒屋#居酒屋#焼酎好きな人と繋がりたい
                                                        </div>
                                                        <div id="TRANS_SNSCS491"></div>
                                                        <ul class="clearfix">
                                                                <li><a href="#" target="_blank"
                                                                           rel="noopener noreferrer">#焼酎好きな人と繋がりたい</a>
                                                                </li>
                                                        </ul>
                                                </div><!-- div.sns_list div.sns_text -->
                                        </div><!-- div.sns_list > div -->
                                        <div>
                                                <div class="sns_photo">
                                                        <a href="#" target="_blank" rel="noopener noreferrer">
                                                                <img
                                                                     src="<?php echo esc_url(theme_source_uri('img/sns/202602/18089503574095106.jpg')); ?>">
                                                        </a>
                                                </div>
                                                <!-- div.sns_list div.sns_photo -->
                                                <div class="sns_text">
                                                        <div class="sns_date">2026.02.01
                                                        </div>
                                                        <div class="caption">2026/02/01
                                                                こんにちは
                                                                居酒屋です。
                                                                2月のお休みをお知らせ致します
                                                                2月もよろしくお願いします😊
                
                                                                居酒屋
                                                                火〜土曜日:17:00〜2:00
                                                                日曜日:15:00〜0:00
                                                                定休日:月曜日
                                                                TEL:000-0000-0000
                
                                                                #焼酎#居酒屋#居酒屋#焼酎好きな人と繋がりたい
                                                        </div>
                                                        <div id="TRANS_SNSCS490"></div>
                                                        <ul class="clearfix">
                                                                <li><a href="#" target="_blank"
                                                                           rel="noopener noreferrer">#焼酎好きな人と繋がりたい</a>
                                                                </li>
                                                        </ul>
                                                </div><!-- div.sns_list div.sns_text -->
                                        </div><!-- div.sns_list > div -->
                                        <div>
                                                <div class="sns_photo">
                                                        <a href="#" target="_blank" rel="noopener noreferrer">
                                                                <img
                                                                     src="<?php echo esc_url(theme_source_uri('img/sns/202601/18190047208350479.jpg')); ?>">
                                                        </a>
                                                </div>
                                                <!-- div.sns_list div.sns_photo -->
                                                <div class="sns_text">
                                                        <div class="sns_date">2026.01.22
                                                        </div>
                                                        <div class="caption">2026/01/22
                                                                こんにちは
                                                                居酒屋です
                
                                                                居酒屋にある居酒屋さんの
                                                                『居酒屋 いちご酒』入荷しました。
                                                                居酒屋の名産いちごをギュッと凝縮した
                                                                もっといちごが好きになる果実酒です
                                                                ストレートでもロックでも炭酸割りでも美味しく飲めます
                                                                是非飲んでみてください。
                
                                                                居酒屋
                                                                火〜土曜日:17:00〜2:00
                                                                日曜日:15:00〜0:00
                                                                定休日:日曜日
                                                                TEL:000-0000-0000
                
                                                                ＃居酒屋＃居酒屋＃居酒屋＃居酒屋＃いちご酒
                                                        </div>
                                                        <div id="TRANS_SNSCS489"></div>
                                                        <ul class="clearfix">
                                                        </ul>
                                                </div><!-- div.sns_list div.sns_text -->
                                        </div><!-- div.sns_list > div -->
                                        <div>
                                                <div class="sns_photo">
                                                        <a href="#" target="_blank" rel="noopener noreferrer">
                                                                <img
                                                                     src="<?php echo esc_url(theme_source_uri('img/sns/202601/17953307568058502.jpg')); ?>">
                                                        </a>
                                                </div>
                                                <!-- div.sns_list div.sns_photo -->
                                                <div class="sns_text">
                                                        <div class="sns_date">2026.01.14
                                                        </div>
                                                        <div class="caption">こんにちは
                                                                居酒屋です。
                                                                居酒屋で杜氏をしていた居酒屋さんが独立して、去年、居酒屋に新たに
                                                                『居酒屋
                                                                牛ノ根蒸留所』を誕生させましたその蔵の最初に醸造した3作品入荷しました
                                                                こちらは記念限定ボトルになります。
                
                                                                ・居酒屋 1stボトル (classical):
                                                                コガネセンガンと黒麹ベースの米麹を使用しています
                                                                伸びやかな余韻と澄んだバランスが特徴で湯割り推奨。
                
                                                                ・蜜滴KEND 1stボトル:
                                                                自社栽培の「紅ハルカ」を糖化熟成させた、蜜のような甘みとすっきりした後味、華やかな甘みと余韻が魅力。
                
                                                                ・PHOENIX 1stボトル:
                                                                白麹・黒麹を採用。高アルコールながら甘みと伸びやかな余韻が際立つ、記念碑的な一本。
                
                                                                是非新たに誕生した蔵の味を味わってみてください。
                
                                                                居酒屋
                                                                火〜土曜日:17:00〜2:00
                                                                日曜日:15:00〜0:00
                                                                定休日:月曜日
                                                                TEL:000-0000-0000
                
                                                                ＃居酒屋＃居酒屋＃居酒屋</div>
                                                        <div id="TRANS_SNSCS488"></div>
                                                        <ul class="clearfix">
                                                        </ul>
                                                </div><!-- div.sns_list div.sns_text -->
                                        </div><!-- div.sns_list > div -->
                                        <div>
                                                <div class="sns_photo">
                                                        <a href="#" target="_blank" rel="noopener noreferrer">
                                                                <img
                                                                     src="<?php echo esc_url(theme_source_uri('img/sns/202601/18081256660957007.jpg')); ?>">
                                                        </a>
                                                </div>
                                                <!-- div.sns_list div.sns_photo -->
                                                <div class="sns_text">
                                                        <div class="sns_date">2026.01.02
                                                        </div>
                                                        <div class="caption">2026/01/02
                                                                あけましておめでとうございます
                                                                居酒屋です。
                                                                本日から4日まで15:00から営業致します
                                                                お通しがお正月バージョンでちょっと豪華です
                                                                居酒屋の味エビ雑煮もご用意してます
                                                                お時間ございましたらお気軽にご利用ください。
                                                                本年もよろしくお願い致します。

                                                                居酒屋
                                                                火〜土曜日:17:00〜2:00
                                                                日曜日:15:00〜0:00
                                                                定休日:月曜日
                                                                TEL:000-0000-0000

                                                                #焼酎#お正月#japan#新年の挨拶#居酒屋
                                                        </div>
                                                        <div id="TRANS_SNSCS487"></div>
                                                        <ul class="clearfix">
                                                                <li><a href="#" target="_blank"
                                                                           rel="noopener noreferrer">#居酒屋</a>
                                                                </li>
                                                        </ul>
                                                </div><!-- div.sns_list div.sns_text -->
                                        </div><!-- div.sns_list > div -->
                                </div><!-- div.sns_list -->
                        </div><!-- #c494 -->
                        <div class="clearfix f32 mt-bl div-fcc c506">
                                <div>お知らせ<i class="triple f16"></i><a class="btn2"
                                           href="<?php echo esc_url(home_url('/insta/')); ?>">詳しく見る</a>
                                                                        </div>
                                                                </div><!-- #c506 -->
                                                                </main>
                                                                </div>
                                                                </div>