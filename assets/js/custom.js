$(document).ready(function() {

  $("main#spapp > section").height($(document).height() - 60);

  var app = $.spapp({pageNotFound : 'error_404'}); // initialize

  // define routes
  app.route({
    view: 'Babies',
    load: 'Babies.html'
  });
  app.route({
    view: 'Home',
    load: 'Home.html'
  });

  // run app
  app.run();

});
