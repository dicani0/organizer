<script>
      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar-{{ $id }}');

        var calendar = new FullCalendar.Calendar(calendarEl, {
          plugins: [ 'dayGrid' ],
          events: [{!! $options !!}]
        });

        calendar.render();
      });
</script>
