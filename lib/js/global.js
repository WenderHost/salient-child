jQuery(function( $ ){
  // Add breadcrumbs to main content section
  if( null != wpvars.breadcrumbs ){
    $('.container.main-content').prepend('<div class="container-wrap breadcrumbs-container" style=""><div class="breadcrumbs-container" style="">' + wpvars.breadcrumbs + '</div></div>');
  }
});