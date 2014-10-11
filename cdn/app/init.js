var base_url="//demos.techumber.com/cdn/";

var site_array=[
    base_url+"css/style.css",
    "//code.jquery.com/jquery-1.11.1.min.js",
    base_url+"js/lib/easing.js",
    base_url +"js/lib/motio.js",
    base_url+"js/lib/preload.js",
    base_url+"js/lib/hover.js",
    base_url+"js/site.js"
];

var index_array=[
  base_url+"css/index.css", 
  base_url+"js/lib/isotope.js",
  base_url+"js/index.js"
];

var post_array=[
  base_url+"css/post.css",
  base_url+"js/lib/prettify/prettify-dark.css",
  base_url+"js/lib/prettify/prettify.js",
  base_url+"js/lib/related-posts.js"
];

var static_array=[
	base_url+"css/static.css"
];



head.ready(document,function(){
  //load hole site
  head.load(site_array,function(){
    console.log("whole site loadded....");
    //test page type
    if(TU_PAGE == "index"){
    	head.load(index_array,function(){
    		console.log("index array loadded....");
    	});
    }
    if(TU_PAGE == "post"){
    	head.load(post_array,function(){
    		console.log("post array loadded....");
    	});
    }

    if(TU_PAGE == "static"){
    	head.load(static_array,function(){
    		console.log("post array loadded....");
    	});
    }

  });
  
});
