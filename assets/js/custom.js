(function(){
  init();
  var g_containerInViewport;
  function init(){
    setStickyContainersSize();
    bindEvents();
  }

  function bindEvents(){
    window.addEventListener("wheel", wheelHandler);
  }

  function setStickyContainersSize(){
    document.querySelectorAll('.sticky-container').forEach(function(container){
      const stikyContainerHeight = (container.querySelector('main').offsetWidth + window.innerHeight);
      container.setAttribute('style', 'height: ' + stikyContainerHeight + 'px');
    });
  }

  function isElementInViewport (el) {
    const rect = el.getBoundingClientRect();
    return rect.top <= 0 && rect.bottom > document.documentElement.clientHeight;
  }

  function wheelHandler(evt){

    const containerInViewPort = Array.from(document.querySelectorAll('.sticky-container')).filter(function(container){
      return isElementInViewport(container);
    })[0];

    if(!containerInViewPort){
      return;
    }

    var isPlaceHolderBelowTop = containerInViewPort.offsetTop < document.documentElement.scrollTop;
    var isPlaceHolderBelowBottom = containerInViewPort.offsetTop + containerInViewPort.offsetHeight > document.documentElement.scrollTop;
    let g_canScrollHorizontally = isPlaceHolderBelowTop && isPlaceHolderBelowBottom;

    if(g_canScrollHorizontally){
      containerInViewPort.querySelector('main').scrollLeft += evt.deltaY;
    }
  }
})();

function intersect(target, callback){
  let observer = new IntersectionObserver(callback, {
    rootMargin: '-50% 0px -10% 0px',
    threshold: [0, .2, .5, .75, 1]
  });
  // let target = document.querySelector(query);
  observer.observe(target);
}

let callback = function(entries, observer) {
  entries.forEach(({intersectionRatio, target}) => {
    const img = target.querySelector('.feature-img');
    img.style.opacity = Math.round(intersectionRatio * 100)/100;
    //console.log(intersectionRatio, target)
  })
};

const features = document.querySelectorAll('.feature-item.nobg');
features.forEach(feature => {
  intersect(feature, callback);
});



(function($){
  const openDropdown = (buttonClass, dropDownClass) => {
    $(buttonClass).click(function (e) {
      e.preventDefault();
      e.stopPropagation();
      $(this).children(dropDownClass).toggleClass('opened');
    }).focusout(function () {
      $(dropDownClass).removeClass('opened');
    })
  };
  openDropdown('.add-to-calendar', '.add-to-calendar-dropdown');
  openDropdown('.to-share', '.social-dropdown');


  $("#shareIcons").jsSocials({
    // showLabel: false,
    // showCount: false,
    shares: ["email", "twitter", "facebook", "googleplus", "linkedin", "pinterest", "stumbleupon", "whatsapp"]
  });

})(jQuery);



var shareItems = document.querySelectorAll('.social_share');
for (var i = 0; i < shareItems.length; i += 1) {
  shareItems[i].addEventListener('click', function share(e) {
    return JSShare.go(this);
  });
}
