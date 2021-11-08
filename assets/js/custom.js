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

let featureIntersectCb = function(entries, observer) {
  entries.forEach(({intersectionRatio, target}) => {
    const img = target.querySelector('.feature-img');
    img.style.opacity = Math.round(intersectionRatio * 100)/100;
    //console.log(intersectionRatio, target)
  })
};
let animateCb = function(entries, observer) {
  entries.forEach(({intersectionRatio, target}) => {
    if(intersectionRatio > 0) {
      target.classList.add('animated');
    } else {
      target.classList.remove('animated');
    }
    console.log(intersectionRatio, target)
  })
};

const features = document.querySelectorAll('.feature-item.nobg');
const toAnimate = document.querySelectorAll('.to-animate');
features.forEach(feature => {
  intersect(feature, featureIntersectCb);
});

function animateThings(){
  toAnimate.forEach(animElem => {
    let observer = new IntersectionObserver(animateCb, {
      rootMargin: '-20% 0px -20% 0px',
      threshold: [0, 0.2, 1]
    });
    // let target = document.querySelector(query);
    observer.observe(animElem);
  });
}

setTimeout(
    animateThings, 500
)




(function($){
  const openDropdown = (buttonClass, dropDownClass) => {
    // $(document).on( 'click', e=> {
    //   console.log(e.target, $(dropDownClass))
    //   if (!e.target === $(dropDownClass) // if the target of the click isn't the container...
    //       && $(dropDownClass).has(e.target).length === 0) // ... nor a descendant of the container
    //   {
    //     $(dropDownClass).removeClass('opened');
    //   }
    // });
    // $(buttonClass).click(function (e) {
    //   e.stopPropagation();
    //   $(this).children(dropDownClass).on('click',function (e) {
    //     e.stopPropagation();
    //   }).toggleClass('opened');
    // }).focusout(function (e) {
    //   $(dropDownClass).removeClass('opened');
    // });
  };

  // openDropdown('.add-to-calendar', '.add-to-calendar-dropdown');
  // openDropdown('.to-share', '.social-dropdown');


  $('.tab-menu a').tab();
  $('.ui.dropdown').dropdown();
  $('.pll-parent-menu-item .sub-menu').addClass('menu ui');
  $('.pll-parent-menu-item .sub-menu li').addClass('item');
  $('.pll-parent-menu-item').dropdown();
  // $("#shareIcons").jsSocials({
  //   // showLabel: false,
  //   // showCount: false,
  //   shares: ["email", "twitter", "facebook", "googleplus", "linkedin", "pinterest", "stumbleupon", "whatsapp"]
  // });

})(jQuery);



var shareItems = document.querySelectorAll('.social_share');
for (var i = 0; i < shareItems.length; i += 1) {
  shareItems[i].addEventListener('click', function share(e) {
    return JSShare.go(this);
  });
}
