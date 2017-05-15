
function getDate( d ) {
    d = d.split(' ');
    var t = d[1];
    d = d[0];
    d = d.split('-');
    if( t == undefined )  t = [0,0,0,0];
    else          t = t.split(':');
    while( t.length < 4 )  t.push(0);
    var d = new Date( Date.UTC( d[0] , d[1]-1 , d[2] , t[0] , t[1] , t[2] , t[3] ) );
    return d.getTime();
};