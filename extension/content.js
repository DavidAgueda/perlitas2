// content.js

//chrome.runtime.onMessage.addListener(
//  function(request, sender, sendResponse) {
//    if( request.message === "clicked_browser_action" ) {
//      var firstHref = $("a[href^='http']").eq(0).attr("href");
//
//      console.log(firstHref);
//      console.log(chrome);
//
//      // This line is new!
//      chrome.runtime.sendMessage({"message": "open_new_tab", "url": firstHref});
//    }
//  }
//);

console.log("hola");

//chrome.tabs.onUpdated.addListener(function (){
    $('h1').css('background-color','red');
//})