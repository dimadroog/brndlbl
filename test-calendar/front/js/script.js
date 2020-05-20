document.addEventListener('DOMContentLoaded', function() {
  var url = jQuery('#calendar').data('jsonurl'); 
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
    },
    editable: true,
    navLinks: true, // can click day/week names to navigate views
    eventLimit: true, // allow "more" link when too many events
    events: {
      url: url+'php/get-events.php',
      failure: function() {
        document.getElementById('script-warning').style.display = 'block'
      }
    },
    loading: function(bool) {
      document.getElementById('loading').style.display =
        bool ? 'block' : 'none';
    },
    eventClick: function(info) {

      jQuery([document.documentElement, document.body]).animate({
          scrollTop: jQuery('.scroll-to').offset().top
      }, 300);

      // console.log(info.event.extendedProps.purl);
      jQuery('.event-details').slideDown();
      jQuery('.event-details__title').text(info.event.title);
      jQuery('.event-details__date').text((new Date(info.event.start)).toISOString().slice(0, 10));
      jQuery('.event-details__link').attr('href',info.event.extendedProps.purl);
      jQuery('.event-details__country').text(info.event.extendedProps.country);
      jQuery('.event-details__city').text(info.event.extendedProps.city);
      jQuery('.event-details__category').text(info.event.extendedProps.category);
    },

  });

  calendar.render();
});