/**
 * 譁�ｭ励さ繝ｼ繝� UTF-8N 謾ｹ陦後さ繝ｼ繝鵜F
 *
 * @package    BXI
 * @copyright  Copyright (c) 2018-2024 E TRUST, INC
 * @version    BXI v5.6.12 240404
 */
function showAjaxError(jqxhr, status, error) {
        console.log(jqxhr.responseText);
        if (status) alert(status + "\n" + error);
        else alert("繧ｨ繝ｩ繝ｼ\n" + error);
      }
      function isPreview() {
        if (location.href.indexOf("bxi/browse.html") > -1) return true;
        else if (location.href.indexOf("bxi/blog_preview.html") > -1) return true;
        else if (location.href.indexOf("bxi/recruit_browse.html") > -1) return true;
        else return false;
      }
      function isBlogPage() {
        if (location.href.indexOf("blog/") > -1) return true;
        else return false;
      }
      function isPageClass() {
        if (location.href.indexOf("html.php") > -1) return false;
        else if (location.href.indexOf("shop/") > -1) return false;
        else if (location.href.indexOf("blog/") > -1) return false;
        else if (location.href.indexOf("sns/") > -1) return false;
        else if (location.href.indexOf("customer/") > -1) return false;
        else return true;
      }
      function trimTag(str) {
        return str.replace(/<("[^"]*"|'[^']*'|[^'">])*>/g,'');
      }
      function translate(lang) {
        if (lang == undefined) return;
        var text = [];
        $(".translate").each(function() {
          if ($(this).prop("tagName") == "DIV") {
            //text.push($(this).attr("id") + "|::|" + trimTag($(this).prev().html()));
            text.push($(this).attr("id") + "|::|" + $(this).prev().html());
          } else {
            //text.push($(this).attr("id") + "|::|" + trimTag($(this).html()));
            text.push($(this).attr("id") + "|::|" + $(this).html());
          }
        });
        if (text.length == 0) return;
        $("div#builingual div.progress").show();
        $("div#builingual div.language").hide();
        console.log(lang);
      
        $.post(location.href, { "function": "getWords", "text": text, "lang": lang }, function(res) {
          if (res.status != "SUCCEED") alert(res.text);
          $(".translate").each(function() {
            if ($(this).prop("tagName") == "DIV") {
              if (!res.replace) $(this).html(res.text[$(this).attr("id")]);
              else $(this).prev().html(res.text[$(this).attr("id")]);
            } else {
              if (!res.replace) $(this).next("span").html(res.text[$(this).attr("id")]);
              else $(this).html(res.text[$(this).attr("id")]);
            }
            $("div#builingual div.progress").hide();
            $("div#builingual div.language").show();
          });
        }, "json").fail(showAjaxError);
      }
      var page = {
        "margin": 50
      };
      function scrollIndex(index) {
        var top = $(`#${index}`).offset().top - page.margin;
        $("body,html").animate({scrollTop: top});
      }
      var kuroneko = {
        "$form": null,
        "getToken": function($form) {
          console.log("kuroneko.getToken()");
          
          var data = {};
          data.traderCode = $("input#traderCode", $form).val();
          data.authDiv = "3";
          data.optServDiv = "00";
          data.checkSum = $("input#checkSum", $form).val();
          data.cardNo = $("input#card_number", $form).val();
          data.cardOwner = $("input#card_name", $form).val();
          data.cardExp = $("input#card_month", $form).val() + $("input#card_year", $form).val();
          data.securityCode = $("input#card_security", $form).val();
          //console.log(data);return;
          kuroneko.$form = $form;
          $("img.load", kuroneko.$form).show();
          WebcollectTokenLib.createToken(data, kuroneko.success, kuroneko.failure);
        },
        "success": function(res) {
          console.log(res.token);
          var data = {};
          data.token = res.token;
          data.action = "accept";
          $.post(location.href, data, function (res) {
            if (res.hasError) {
              console.log(res.text); alert(res.text);
              $("img.load", kuroneko.$form).hide();
              $("button.accept", kuroneko.$form).removeAttr("disabled");
            } else {
              location.href = res.url;
            }
          }, "json").fail(showAjaxError);
        },
        "failure": function(res) {
          console.log(res);
          alert(res.errorInfo[0].errorMsg);
          $("img.load", kuroneko.$form).hide();
          $("button.accept", kuroneko.$form).removeAttr("disabled");
        }
      };
      $(function() {
        console.log(location.href);
        // note: 繧ｫ繝ｬ繝ｳ繝繝ｼ蝟ｶ讌ｭ譌･繧ｯ繝ｪ繝�け
        $("div#form_calendar").on("click", "td.open.reserv", function() {
          if (isPreview() || !isPageClass()) return false;
          var data = {};
          data.date = $(this).data("date");
          data.reserv_type = $("div#form_calendar input[name='reserv_type']").val();
          data.reserv_time_csv = $("div#form_calendar input#reserv_time_csv").val();
          data.n_limit = $("div#form_calendar input#n_limit").val();
          if ($("div#form_calendar input#n_range").length > 0) data.n_range = $("div#form_calendar input#n_range").val();
          data.action = "selectDate";
          if ($("section form input[name='MLID']").length) data.MLID = $("section form input[name='MLID']").val();
          $.post(location.href, data, function(res) {
            if (res.status != "SUCCEED") { if (res.text) alert(res.text); }
            else $("div#form_calendar div.reserv").html(res.text);
          }, "json").fail(showAjaxError);
        });
        // note: 繧ｫ繝ｬ繝ｳ繝繝ｼ 蜑肴怦縺ｸ遘ｻ蜍�
        $("div#form_calendar").on("click", "span.prev", function() {
          if (isPreview()) return false;
          var data = {};
          data.month = $("div#form_calendar span.prev").data("month");
          data.open_day = $("div#form_calendar input[name='open_day']").val();
          data.close_day = $("div#form_calendar input[name='close_day']").val();
          data.close_days = $("div#form_calendar input[name='close_days']").val();
          data.action = "moveCalendar";
          if ($("section form input[name='MLID']").length) data.MLID = $("section form input[name='MLID']").val();
          $.post(location.href, data, function(res) {
            if (res.status != "SUCCEED") console.log(res.text);
            else $("div#form_calendar").html(res.text);
          }, "json").fail(showAjaxError);
        });
        // note: 繧ｫ繝ｬ繝ｳ繝繝ｼ 谺｡譛医∈遘ｻ蜍�
        $("div#form_calendar").on("click", "span.next", function() {
          if (isPreview()) return false;
          var data = {};
          data.month = $("div#form_calendar span.next").data("month");
          data.open_day = $("div#form_calendar input[name='open_day']").val();
          data.close_day = $("div#form_calendar input[name='close_day']").val();
          data.close_days = $("div#form_calendar input[name='close_days']").val();
          data.action = "moveCalendar";
          if ($("section form input[name='MLID']").length) data.MLID = $("section form input[name='MLID']").val();
          $.post(location.href, data, function(res) {
            if (res.status != "SUCCEED") console.log(res.text);
            else $("div#form_calendar").html(res.text);
          }, "json").fail(showAjaxError);
        });
        // note: 莠育ｴ�凾髢薙そ繝ｫ驕ｸ謚�
        $("div#form_calendar div.reserv").on("click", ".range table tbody td", function() {
          $("input[type=radio]", $(this)).prop("checked", true);
        });
        // note: 鄙ｻ險ｳ螳溯｡�
        translate($("div#builingual select").val());
        $("div#builingual select").on("change", function() { translate($(this).val()); });
        // note: 繧ｹ繝｢繝ｼ繝ｫ逕ｻ蜒上け繝ｪ繝�け�医い繧､繝�Β隧ｳ邏ｰ��
        $("article.item div.small img").on("click", function() {
          var photo = $(this).closest("div.photo");
          if ($("div.large img", photo).length == 0) return;
          $("div.large img", photo).attr("src", $(this).attr("src"));
        });
        // note: SKU�代け繝ｪ繝�け�医い繧､繝�Β隧ｳ邏ｰ��
        $("div.sku1 ul li").on("click", function() {
          if (isPreview()) return false;
          var parent = $(this).closest("div.sku1");
          var get = {};
          if ($(this).data("category") != "") get["category"] = $(this).data("category");
          get["item_number"] = parent.data("item_number");
          get["sku1"] = $(this).data("sku1");
          location.href = "?" + $.param(get);
        });
        // note: SKU2繧ｯ繝ｪ繝�け�医い繧､繝�Β隧ｳ邏ｰ��
        $("div.sku2 ul li.instock").on("click", function() {
          if (isPreview()) return false;
          var parent = $(this).closest("div.sku2");
          var get = {};
          if (parent.data("category") != "") get["category"] = parent.data("category");
          get["item_number"] = parent.data("item_number");
          get["sku1"] = $("ul li.selected", parent.prev()).data("sku1");
          get["sku2"] = $(this).data("sku2");
          location.href = "?" + $.param(get);
        });  
        // note: 繧ｫ繝ｼ繝郁｡ｨ遉ｺ繝｡繧ｽ繝�ラ
        var loadCart = function() {
          $.post(location.href, {"action":"loadCart"}, function(res) {
            if (res.status != "SUCCEED") { if (res.text != "") alert(res.text); return; }
            $("#cart").html(res.html);
          }, "json").fail(showAjaxError);
        };
        // note: 繧ｫ繝ｼ繝医↓蜈･繧後ｋ�医い繧､繝�Β隧ｳ邏ｰ��
        $("div.item_view").on("click", "button.addcart", function() {
          if (isPreview()) return false;
          $.post(location.href, $(this).closest("form").serialize(), function(res) {
            if (res.status != "SUCCEED") { if (res.text != "") alert(res.text); return; }
            if (res.url != undefined) location.href = res.url;
            else if ($("#cart").length > 0) $("#cart").html(res.html);
          }, "json").fail(showAjaxError);
          return false;
        });
        // note: 縺吶∋縺ｦ繧ｫ繝ｼ繝医↓蜈･繧後ｋ�医ヰ繝ｳ繝峨Ν��
        $("div.bundle").on("click", "button.addcart.all", function() {
          var data = {};
          data.item_numbers = $("input[name=item_numbers]", $(this).parent()).val();
          data.action = "addCartAll";
          $.post(location.href, data, function(res) {
            if (res.status != "SUCCEED") { if (res.text != "") alert(res.text); return; }
            if (res.url != undefined) location.href = res.url;
            else if ($("#cart").length > 0) $("#cart").html(res.html);
          }, "json").fail(showAjaxError);
          return false;
        });
        // note: 繧ｫ繝ｼ繝医↓蜈･繧後ｋ�医い繧､繝�Β繝ｪ繧ｹ繝茨ｼ�
        // modified: 201204 蝗ｺ螳壹�繝ｼ繧ｸ繝代せ霑ｽ蜉�
        $("div.items").on("click", "button", function() {
          if (isPreview()) return false;
          var data = {};
          data.item_number = $(this).data("number");
          data.item_name = $(this).data("name");
          if ($(this).data("file") != undefined) data.file_name = $(this).data("file");
          data.photo = $(this).data("photo");
          data.n_price = $(this).data("price");
          data.n_order = "1";
          data.postage = $(this).data("postage");
          data.postage_name = $(this).data("postagename");
          data.n_deliv = $(this).data("deliv");
          data.n_point = $(this).data("point");
          data.action = "addCart";
          //console.log(data);
          $.post(location.href, data, function(res) {
            if (res.status != "SUCCEED") { if (res.text != "") alert(res.text); return; }
            if (res.url != undefined) location.href = res.url;
            else if ($("#cart").length > 0) $("#cart").html(res.html);
          }, "json").fail(showAjaxError);
          return false;
        });
        // note: 繧ｫ繝ｼ繝域峩譁ｰ
        $("#cart").on("click", "a.update", function() {
          var parent = $(this).closest("li");
          var data = {};
          data.key = parent.data("key");
          data.n_order = $("input", parent).val();
          data.action = "updateCart";
          $.post(location.href, data, function(res) {
            if (res.status != "SUCCEED") { if (res.text != "") alert(res.text); }
            loadCart();
          }, "json").fail(showAjaxError);
        });
        // note: 繧ｫ繝ｼ繝亥炎髯､
        $("#cart").on("click", "a.remove", function() {
          var parent = $(this).closest("li");
          var data = {};
          data.key = parent.data("key");
          data.action = "removeCart";
          $.post(location.href, data, function(res) {
            if (res.status != "SUCCEED") { if (res.text != "") alert(res.text); return; }
            $("#cart").html(res.html);
          }, "json").fail(showAjaxError);
        });
        // note: 繝ｬ繧ｸ縺ｫ騾ｲ繧
        $("body").on("click", "button.purchase", function() {
          $.post(location.href, { "action": "purchase" }, function(res) {
            if (res.status != "SUCCEED") { if (res.text != "") alert(res.text); return; }
            location.href = res.url;
          }, "json").fail(showAjaxError);
        });
        // note: 繧ｫ繝ｼ繝郁ｦ∫ｴ�縺後≠繧句�ｴ蜷医↓繧ｫ繝ｼ繝医ｒ陦ｨ遉ｺ縺吶ｋ
        if ($("#cart").length > 0) {
          var page = location.href.split('/').pop().split('?')[0];
          if (page.indexOf("purchase_") == -1) loadCart();
        }
        $("div.form_wrap.login button").on("click", function() {
          var data = {};
          data.email = $("input#email").val();
          data.passwd = $("input#passwd").val();
          data.action = "mailFormLogin";
          if (data.email == "" || data.passwd == "") {
            alert("E-mail繧｢繝峨Ξ繧ｹ縺ｨ繝代せ繝ｯ繝ｼ繝峨ｒ蜈･蜉帙＠縺ｦ縺上□縺輔＞縲�");
            return false;
          }
          $.post(location.href, data, function(res) {  
            if (res.status != "SUCCEED") { if (res.text != "") alert(res.text); }
            else location.reload();
          }, "json").fail(showAjaxError);
          return false;
        });
        $("form a.remainder").on("click", function() {
          var data = {};
          data.email = $("input#email").val();
          data.action = "mailFormRemaind";
          if (data.email == "") {
            alert("E-mail繧｢繝峨Ξ繧ｹ繧貞�蜉帙＠縺ｦ縺上□縺輔＞縲�");
            return;
          }
          $.post(location.href, data, function(res) {  
            if (res.text != "") alert(res.text);
          }, "json").fail(showAjaxError);
        });
        // note: 繧ｫ繧ｹ繧ｿ繝槭�繝ｭ繧ｰ繧｢繧ｦ繝�
        $("#customer").on("click", "a", function() {
          if (!confirm("繝ｭ繧ｰ繧｢繧ｦ繝医＠縺ｦ繧ゅｈ繧阪＠縺�〒縺吶°��")) return;
          $.post(location.href, {"action": "logoutCustomer"}, function(res) {
            if (res.status != "SUCCEED") { if (res.text != "") alert(res.text); }
            else location.reload();
          }, "json").fail(showAjaxError);
        });
        // note: 繧ｫ繧ｹ繧ｿ繝槭�隕∫ｴ�縺後≠繧句�ｴ蜷医↓繝ｭ繧ｰ繧､繝ｳ莨壼藤繧定｡ｨ遉ｺ縺吶ｋ
        if ($("#customer").length > 0) {
          $.post(location.href, {"action": "loadCustomerLogin"}, function(res) {
            if (res.status != "SUCCEED") { if (res.text != "") alert(res.text); }
            else $("#customer").html(res.html);
          }, "json").fail(showAjaxError);
        }
        // note: 邨槭ｊ霎ｼ縺ｿ讀懃ｴ｢
        var search = function() {
          if (isPreview()) return false;
          $.post(location.href, $("#search").serialize(), function(res) {
            if (res.url != "") location.href = res.url;
            else location.reload();
          }, "json").fail(showAjaxError);
        };
        $("#search select").on("change", search);
        $("#search input[type=radio]").on("click", search);
        $("#search input[type=checkbox]").on("click", search);
        $("#search input[type=text]").on("keypress", function(e) {
          if (e.which == 13 && !isBlogPage()) search();
        });
        $("#search_2 a").on("click", function() {
          search();
        });
        // note: 繝代せ繝ｯ繝ｼ繝峨�繝ｼ繧ｸ縺ｫ蜿ｯ隕門喧繧｢繧､繧ｳ繝ｳ霑ｽ蜉�
        if ($(location).attr("pathname") == "/passwd.html") {
          $("input[name=passwd]").after("<a></a>");
          $("input[name=passwd]").parent().addClass("passwd");
        }
        // note: 繝代せ繝ｯ繝ｼ繝牙庄隕門喧
        $(".passwd input + a").on("click", function() {
          if ($(this).prev().attr("type") == "text") $(this).prev().attr("type", "password");
          else $(this).prev().attr("type", "text");
        });
        // note: Enter辟｡蜉ｹ蛹�
        $("form div.purchase input, div.purchase form input").on("keydown", function(e) {
          if (e.keyCode == 13) { console.log("keydown"); return false; }
        });
        // note: 繝輔ぃ繧､繝ｫ繝繧ｦ繝ｳ繝ｭ繝ｼ繝�
        $("div.form_download button").on("click", function() {
          var data = {};
          data.file = $(this).data("file");
          data.key = $(this).data("key");
          data.action = "checkDownload";
          $.post(location.href, data, function(res) {
            if (res.hasError) alert(res.text);
            else {
              delete data.action;
              location.href  = location.href + "?" + $.param(data);
            }
          }, "json").fail(showAjaxError);
        });
        // note: 逶ｮ谺｡繧ｹ繧ｯ繝ｭ繝ｼ繝ｫ
        $("div.bxi_index ol li span").on("click", function() {
          scrollIndex($(this).data("index"));
        });
      });