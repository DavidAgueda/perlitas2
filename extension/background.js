/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// background.js

// Called when the user clicks on the browser action.
//chrome.browserAction.onClicked.addListener(function(tab) {
//  // Send a message to the active tab
//  chrome.tabs.query({active: true, currentWindow: true}, function(tabs) {
//    var activeTab = tabs[0];
//    chrome.tabs.sendMessage(activeTab.id, {"message": "clicked_browser_action"});
//  });
//});
//
//// This block is new!
//chrome.runtime.onMessage.addListener(
//  function(request, sender, sendResponse) {
//    if( request.message === "open_new_tab" ) {
//      chrome.tabs.create({"url": request.url});
//    }
//  }
//);