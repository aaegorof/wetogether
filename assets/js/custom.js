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
    const img = target.querySelector('.opacityanimated');
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

setTimeout(animateThings, 500);




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
  $('.ui.modal').modal();
  $('a[href^="#modal"]').click(function (e) {
    e.preventDefault();
    const targetId = $(this).attr('href').split('-').slice(1).join('-');
    $('#' +targetId).modal('show');
  });


  function animateElement(animateContainerSelector, fric = 30, maxRadius = 30) {
    if(!document.querySelector(animateContainerSelector)) {
      return
    }
    let lFollowX = 0,
        lFollowY = 0,
        x = 0,
        y = 0,
        friction = 1 / fric;

    function moveBackground(animateContainerSelector) {
      x += (lFollowX - x) * friction;
      y += (lFollowY - y) * friction;

      const translate = 'translateX(' + x + 'px) translateY(' + y +'px)';

      $(animateContainerSelector).css({
        '-webit-transform': translate,
        '-moz-transform': translate,
        'transform': translate
      });

      window.requestAnimationFrame(() => moveBackground(animateContainerSelector));
    }
    moveBackground(animateContainerSelector);

    $(window).on('mousemove', function(e) {
      var isHovered = $(animateContainerSelector + ':hover').length > 0;
      const position = document.querySelector(animateContainerSelector).getBoundingClientRect();
      const {top, width, left, height} = position
      const xCenter = left + width/2
      const yCenter = top + height/2
      //if(!$(e.target).hasClass('animate-this')) {
      if(!isHovered) {
        var lMouseX = Math.max(-100, Math.min(100, xCenter - e.clientX)),
            lMouseY = Math.max(-100, Math.min(100, yCenter - e.clientY));

        lFollowX = (maxRadius * lMouseX) / 100;
        lFollowY = (maxRadius * lMouseY) / 100;
      }
    });
  }

    animateElement('.fly-svg');



  const animateTarget = (animateContainer) => {
    const target = animateContainer.find('.left-svg');
    const trans = num => (x, y) => {
      const xx = num < 30 ? num : -num;
      const yy = num < 30 ? num : -num;
      console.log(num, x, y, xx, yy);
      return `translate3d(${x / xx}px, ${y / yy}px, 0)`;
    };

    animateContainer.visibility({
      once       : false,
      continuous : true,
      offset: 50,
      onUpdate: function(calculations) {
        // do something whenever calculations adjust
        // updateTable(calculations);
      },
      onPassing  : function(calculations) {
        // target.prepend(calculations.percentagePassed);
        const trnsf = trans(Math.random() * 20 + 22)(calculations.percentagePassed * 10, calculations.percentagePassed * 10);
        target.css('transform', trnsf);
      }
    });
  };



})(jQuery);


/**
 * By Alvaro Trigo
 * Follow me on Twitter: https://twitter.com/imac2
 */
(function(){
  let scontainer = '.sticky-container';
  let slist = '.sticky-list';
  init();
  let g_containerInViewport;

  function init(){
    setStickyContainersSize();
    bindEvents();
  }

  function bindEvents(){
    window.addEventListener("wheel", wheelHandler);
  }

  function setStickyContainersSize(){
    document.querySelectorAll(scontainer).forEach(function(container){
      const stikyContainerHeight = (container.querySelector(slist).offsetWidth + window.innerHeight);
      container.setAttribute('style', 'height: ' + stikyContainerHeight + 'px');
    });
  }

  function isElementInViewport (el) {
    const rect = el.getBoundingClientRect();
    return rect.top <= 0 && rect.bottom > document.documentElement.clientHeight;
  }

  function wheelHandler(evt){

    const containerInViewPort = Array.from(document.querySelectorAll(scontainer)).filter(function(container){
      return isElementInViewport(container);
    })[0];

    if(!containerInViewPort){
      return;
    }

    var isPlaceHolderBelowTop = containerInViewPort.offsetTop < document.documentElement.scrollTop;
    var isPlaceHolderBelowBottom = containerInViewPort.offsetTop + containerInViewPort.offsetHeight > document.documentElement.scrollTop;
    let g_canScrollHorizontally = isPlaceHolderBelowTop && isPlaceHolderBelowBottom;

    if(g_canScrollHorizontally){
      containerInViewPort.querySelector(slist).scrollLeft += evt.deltaY;
    }
  }
})();


document.addEventListener('click', function(e){
  const target = e.target,
      classes = [...target.classList];

  if(classes.includes('social_share')){
    return JSShare.go(e.target);
  }
})
