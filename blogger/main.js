requirejs.config({
  //By default load any module IDs from js/lib\\
  //  urlArgs: "bust=" + (new Date()).getTime(),
  baseUrl: 'http://demos.techumber.com/blogger/',
  paths: {
    jQuery: "//http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"
  }

});
require(['http://demos.techumber.com/blogger/app/dpage.js'], function (Dpage) {
  Dpage.init();
});