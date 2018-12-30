var webpage = require('webpage');
var page = webpage.create();
var system = require('system');
var args = system.args;

//var domain = '10.0.0.125';
var domain = '127.0.0.1';
var url = 'http://' + domain + '/viewTicket.php?id=' + args[1];

phantom.addCookie({
  'name': 'PHPSESSID',
  'value': '7mjhjeu6d9dqtqg5m6pf6c24a1',
  'domain': domain
});

page.open(url, function(status) {
  console.log('Status: ' + status);
  just_wait();
});

function just_wait(){
  setTimeout(function() {
    phantom.exit();
  }, 2000);
}
