;(function (exports) {
  var MS_IN_MINUTES = 60 * 1000;

  var formatTime = function (date) {
    let isoDate = date.toISOString();
    return isoDate.replace(/-|:|\.\d+/g, '');
  };

  var calculateEndTime = function (event) {
    return event.end ?
        formatTime(event.end) :
        formatTime(new Date(event.start.getTime() + (event.duration * MS_IN_MINUTES)));
  };

  var calendarGenerators = {
    google: function (event) {
      var startTime = formatTime(event.start);
      var endTime = calculateEndTime(event);

      var href = encodeURI([
        'https://www.google.com/calendar/render',
        '?action=TEMPLATE',
        '&text=' + (event.title || ''),
        '&dates=' + (startTime || ''),
        '/' + (endTime || ''),
        '&details=' + (event.description || ''),
        '&location=' + (event.address || ''),
        '&sprop=&sprop=name:'
      ].join(''));
      return '<a class="icon-google item" target="_blank" href="' +
          href + '"> <svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.08068 3.97826C5.58693 3.97826 4.82262 3.41687 4.01774 3.43716C2.95583 3.45069 1.98186 4.05266 1.43399 5.00635C0.331507 6.92048 1.14992 9.74772 2.22535 11.3034C2.75292 12.0609 3.37519 12.9131 4.20036 12.8861C4.99172 12.8523 5.28932 12.372 6.24977 12.372C7.20346 12.372 7.474 12.8861 8.31271 12.8658C9.16494 12.8523 9.70604 12.0947 10.2268 11.3304C10.8288 10.4511 11.0791 9.59892 11.0926 9.55157C11.0723 9.54481 9.43549 8.91578 9.4152 7.02194C9.40167 5.43922 10.7071 4.68169 10.7679 4.64787C10.0239 3.55891 8.88086 3.43716 8.4818 3.41011C7.44019 3.32894 6.56767 3.97826 6.08068 3.97826ZM7.83925 2.38202C8.27889 1.85445 8.56973 1.1172 8.48856 0.386719C7.85954 0.413774 7.102 0.80607 6.64883 1.33364C6.24301 1.80034 5.89129 2.55111 5.98599 3.26807C6.68265 3.32218 7.3996 2.90959 7.83925 2.38202Z" fill="black"/>' +
          '</svg> Google календарь</a>';
    },

    yahoo: function (event) {
      var eventDuration = event.end ?
          ((event.end.getTime() - event.start.getTime()) / MS_IN_MINUTES) :
          event.duration;

      // Yahoo dates are crazy, we need to convert the duration from minutes to hh:mm
      var yahooHourDuration = eventDuration < 600 ?
          '0' + Math.floor((eventDuration / 60)) :
          Math.floor((eventDuration / 60)) + '';

      var yahooMinuteDuration = eventDuration % 60 < 10 ?
          '0' + eventDuration % 60 :
          eventDuration % 60 + '';

      var yahooEventDuration = yahooHourDuration + yahooMinuteDuration;

      // Remove timezone from event time
      var st = formatTime(new Date(event.start - (event.start.getTimezoneOffset() *
          MS_IN_MINUTES))) || '';

      var href = encodeURI([
        'http://calendar.yahoo.com/?v=60&view=d&type=20',
        '&title=' + (event.title || ''),
        '&st=' + st,
        '&dur=' + (yahooEventDuration || ''),
        '&desc=' + (event.description || ''),
        '&in_loc=' + (event.address || '')
      ].join(''));

      return '<a class="icon-yahoo item" target="_blank" href="' +
          href + '">Yahoo! Calendar</a>';
    },

    ics: function (event, eClass, calendarName) {
      var startTime = formatTime(event.start);
      var endTime = calculateEndTime(event);

      var href = encodeURI(
          'data:text/calendar;charset=utf8,' + [
            'BEGIN:VCALENDAR',
            'VERSION:2.0',
            'BEGIN:VEVENT',
            'URL:' + document.URL,
            'DTSTART:' + (startTime || ''),
            'DTEND:' + (endTime || ''),
            'SUMMARY:' + (event.title || ''),
            'DESCRIPTION:' + (event.description || ''),
            'LOCATION:' + (event.address || ''),
            'END:VEVENT',
            'END:VCALENDAR'].join('\n'));

      return '<a class="' + eClass + ' item" target="_blank" href="' +
          href + '"><svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">\n' +
          '<path d="M13.3878 7.15434C13.3884 6.70005 13.35 6.24655 13.2731 5.79883H6.99219V8.36633H10.5896C10.516 8.7764 10.3602 9.1673 10.1316 9.51548C9.90298 9.86365 9.6063 10.1619 9.25944 10.3922V12.0588H11.4064C12.6635 10.8987 13.3878 9.18297 13.3878 7.15434Z" fill="#4285F4"/>\n' +
          '<path d="M6.99369 13.6699C8.79102 13.6699 10.3044 13.0791 11.4079 12.0607L9.26094 10.394C8.66337 10.7996 7.89374 11.0311 6.99369 11.0311C5.25648 11.0311 3.78198 9.85887 3.25472 8.2793H1.04297V9.99683C1.59731 11.1009 2.44733 12.0291 3.49813 12.6777C4.54893 13.3263 5.75915 13.6698 6.99369 13.6699Z" fill="#34A853"/>\n' +
          '<path d="M3.25297 8.27907C2.97423 7.45136 2.97423 6.55501 3.25297 5.7273V4.00977H1.04123C0.574896 4.93858 0.332031 5.96368 0.332031 7.00318C0.332031 8.04269 0.574896 9.06779 1.04123 9.9966L3.25297 8.27907Z" fill="#FBBC04"/>\n' +
          '<path d="M6.99369 2.97517C7.9435 2.95964 8.86127 3.31884 9.54862 3.97514L11.4496 2.07243C10.2442 0.939203 8.64729 0.317043 6.99369 0.336375C5.75915 0.336431 4.54893 0.679933 3.49813 1.32853C2.44733 1.97713 1.59731 2.90529 1.04297 4.0094L3.25472 5.72693C3.78198 4.14736 5.25648 2.97517 6.99369 2.97517Z" fill="#EA4335"/>\n' +
          '</svg>\n' + calendarName + ' календарь</a>';
    },

    ical: function (event) {
      return this.ics(event, 'icon-ical', 'Apple');
    },

    outlook: function (event) {
      return this.ics(event, 'icon-outlook', 'Outlook');
    }
  };

  var generateCalendars = function (event) {
    return {
      google: calendarGenerators.google(event),
      // yahoo: calendarGenerators.yahoo(event),
      ical: calendarGenerators.ical(event),
      //outlook: calendarGenerators.outlook(event)
    };
  };

  // Create CSS
  var addCSS = function () {
    if (!document.getElementById('ouical-css')) {
      document.getElementsByTagName('head')[0].appendChild(generateCSS());
    }
  };

  var generateCSS = function () {
    var styles = document.createElement('style');
    styles.id = 'ouical-css';

    styles.innerHTML = "#add-to-calendar-checkbox-label{cursor:pointer}.add-to-calendar-checkbox~a{display:none}.add-to-calendar-checkbox:checked~a{display:block;width:150px;margin-left:20px}input[type=checkbox].add-to-calendar-checkbox{position:absolute;top:-9999px;left:-9999px}.add-to-calendar-checkbox~a:before{width:16px;height:16px;display:inline-block;background-image:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFQAAAAQCAYAAACIoli7AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyRpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoTWFjaW50b3NoKSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo0MzJCRDU2NUE1MDIxMUUyOTY1Q0EwNTkxNEJDOUIwNCIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDo0MzJCRDU2NkE1MDIxMUUyOTY1Q0EwNTkxNEJDOUIwNCI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjQzMkJENTYzQTUwMjExRTI5NjVDQTA1OTE0QkM5QjA0IiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjQzMkJENTY0QTUwMjExRTI5NjVDQTA1OTE0QkM5QjA0Ii8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+1Gcb3QAACh1JREFUeNrEWAtw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);margin-right:.5em;content:' '}.icon-ical:before{background-position:-68px 0}.icon-outlook:before{}.icon-yahoo:before{background-position:-36px +4px}.icon-google:before{background-position:-52px 0}";

    return styles;
  };

  // Make sure we have the necessary event data, such as start time and event duration
  var validParams = function (params) {
    return params.data !== undefined && params.data.start !== undefined &&
        (params.data.end !== undefined || params.data.duration !== undefined);
  };

  var generateMarkup = function (calendars, clazz, calendarId) {
    var result = document.createElement('div');

    // result.innerHTML = '<label for="checkbox-for-' +
    //     calendarId + '" class="add-to-calendar-checkbox">+</label>';
    // result.innerHTML += '<input name="add-to-calendar-checkbox" class="add-to-calendar-checkbox" id="checkbox-for-' + calendarId + '" type="checkbox">';

    Object.keys(calendars).forEach(function (services) {
      result.innerHTML += calendars[services];
    });

    result.className = 'add-to-calendar';
    if (clazz !== undefined) {
      result.className += (' ' + clazz);
    }

    addCSS();

    result.id = calendarId;
    return result;
  };

  var getClass = function (params) {
    if (params.options && params.options.class) {
      return params.options.class;
    }
  };

  var getOrGenerateCalendarId = function (params) {
    return params.options && params.options.id ?
        params.options.id :
        Math.floor(Math.random() * 1000000); // Generate a 6-digit random ID
  };

  exports.createCalendar = function (params) {
    if (!validParams(params)) {
      console.log('Event details missing.');
      return;
    }

    return generateMarkup(
        generateCalendars(params.data),
        getClass(params),
        getOrGenerateCalendarId(params));
  };
})(this);
