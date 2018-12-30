rot13 = function(s) {
    return (s = (s) ? s : this).split('').map(function(_)
     {
    	if (!_.match(/[A-Za-z]/)) return _;
    	c = Math.floor(_.charCodeAt(0) / 97);
    	k = (_.toLowerCase().charCodeAt(0) - 96) % 26 + 13;
    	return String.fromCharCode(k + ((c == 0) ? 64 : 96));
     }).join('');
 };
