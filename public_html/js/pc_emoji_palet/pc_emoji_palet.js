////////
// emoji-pallet
// OpenPNE PCモジュール用　絵文字入力パレット ver1.2
// (c)2008 Cake All rights reserved.
// SNS  : http://sns.openpne.jp/?m=pc&a=page_f_home&target_c_member_id=1911
// Home : http://trpgtools-onweb.sourceforge.jp/
////////

////////
// 設定
////////
// AUの絵文字を使うかどうか
useAu = false;
// SoftBankの絵文字を使うかどうか
useSb = false;

// 絵文字入力パレットを同じ画面で表示するかどうか
// true: 同じ画面に表示：画面を開く時、少し重くなります
// false: 別ウィンドウをポップアップで表示します
selfPallet = true;
// 別ウィンドウを用いる場合の設定
// パレット画面のサイズ
palletWidth = 300; // 幅
palletHeight = 160; // 高さ
// 絵文字パレット画面のURL(通常、変更不要です)
PalletURL = './js/pc_emoji_palet/pc_emoji_palet.html';

// 絵文字番号の範囲
// 本線で絵文字が追加された場合のみ変更。通常は変更の必要ありません
eNumDocomo = 252;
eNumAu1 = 518;
eNumAu2 = 822;
eNumSb = 485;

////////
// 出力
////////
function createEmojiPalletDoCoMo()
{
    document.write('<div id="epDocomo" style="display:none;"></div>');
}

function createEmojiPalletAu()
{
    document.write('<div id="epAu" style="display:none"></div>');
}

function createEmojiPalletSoftBank()
{
    document.write('<div id="epSb" style="display:none"></div>');
}

function renderEmojiPalletDoCoMo()
{
    for (n=1; n<=eNumDocomo; n++) {
        emojiPallet(n, "i", "epDocomo");
    }
    Element.addClassName("epDocomo", "finishLoadEmojiImage");
}

function renderEmojiPalletAu()
{
    for (n=1; n<=eNumAu1; n++) {
        emojiPallet(n, "e", "epAu");
    }
    for (n=700; n<=eNumAu2; n++) {
        emojiPallet(n, "e", "epAu");
    }
    Element.addClassName("epAu", "finishLoadEmojiImage");
}

function renderEmojiPalletSoftBank()
{
    for (n=1; n<=eNumSb; n++) {
        emojiPallet(n, "s", "epSb");
    }
    Element.addClassName("epSb", "finishLoadEmojiImage");
}

function output() {
    document.write('<div id="emoji_pallet" class="padding_ss" style="width:439px;">');

    // Toggle版
    if (selfPallet) {
        document.write('絵文字入力　');
        document.write('<a href="#" onclick=\'togglePallet("epDocomo"); return false;\'>DoCoMo</a>');
        if (useAu) document.write('　<a href="#" onclick=\'togglePallet("epAu"); return false;\'>AU</a>');
        if (useSb) document.write('　<a href="#" onclick=\'togglePallet("epSb"); return false;\'>SoftBank</a>');

        createEmojiPalletDoCoMo();

        if (useAu) {
            createEmojiPalletAu();
        }
        if (useSb) {
            createEmojiPalletSoftBank();
        }
    // 別ウィンドウ版
    } else {
        document.write('<a href="javascript:popupPallet(PalletURL)">絵文字入力</a>');
    }

    document.write('</div>');
}

////////
// 関数
////////

// 絵文字出力
function emojiPallet(i, career, target) {
    var src = "./skin/default/img/emoji/" + career + "/" + career + i + ".gif";
    var alt = "[" + career + ":" + i + "]";
    var onclick = "putEmojiToSelf('[" + career + ":" + i + "]')";
    if (target) {
        var div = document.getElementById(target);
        var img = document.createElement("img");
        img.setAttribute("src", src);
        img.setAttribute("alt", alt);
        img.setAttribute("onclick", onclick);
        div.appendChild(img);
    } else {
        document.write('<img src="' + src + '" alt="' + alt + '" onclick="' + onclick + '">');
    }
}

// 絵文字コードをテキストエリアに入力
function putEmojiToSelf(emoji) {
    var body = document.getElementsByName("body");
    for (var i = 0; i < body.length; i++) {
        if (body[i].nodeName.toLowerCase() == 'textarea') {
            var elm = body[i];
            break;
        }
    }

    var selection = new Selection(elm);
    var pos = selection.create(); 

    var head = elm.value.substring(0, pos.start);
    var tail = elm.value.substring(pos.end, elm.value.length);
    elm.value =  head + emoji + tail;
}

// パレット表示切り替え
function togglePallet(pallet) {
    if ($(pallet).style.display == "none") {
        if (!Element.hasClassName(pallet, 'finishLoadEmojiImage')) {
            if (pallet == 'epDocomo') {
                renderEmojiPalletDoCoMo();
            }
            if (pallet == 'epAu') {
                renderEmojiPalletAu();
            }
            if (pallet == 'epSb') {
                renderEmojiPalletSoftBank();
            }
        }
        Element.show(pallet);
    } else {
        Element.hide(pallet);
    }
}

Event.observe(window, "load", function() {
    // 確実に表示するDoCoMo絵文字は先読みする
    renderEmojiPalletDoCoMo();
});


// ポップアップ
function popupPallet(URL){
    window.open(URL,"pallet","width="+palletWidth+",height="+palletHeight+",scrollbars=yes,status=no,resizable=yes,toolbar=no,location=no,menubar=no");
}
