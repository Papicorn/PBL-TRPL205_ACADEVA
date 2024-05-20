<footer>
    <div class="footer clearfix mb-0 text-muted">
        <div class="float-start">
            <p>2023 &copy; Mazer</p>
        </div>
        <div class="float-end">
            <p>Crafted with <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                by <a href="https://saugi.me">Saugi</a></p>
        </div>
    </div>
</footer>
        </div>
    </div>
    <script src="<?= base_url('/assets/static/js/components/dark.js') ?>"></script>
    <script src="<?= base_url('/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') ?>"></script>
    
    
    <script src="<?= base_url('/assets/compiled/js/app.js') ?>"></script>

    
<!-- Need: Apexcharts -->
<script src="<?= base_url('/assets/extensions/apexcharts/apexcharts.min.js') ?>"></script>
<script src="<?= base_url('/assets/static/js/pages/dashboard.js') ?>"></script>
<script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            height: 450,
          initialView: 'dayGridMonth',
          headerToolbar: {
            left: 'prev,next',
            center: 'title',
            right: 'dayGridMonth,dayGridWeek,dayGridDay' 
        },
        
        events: [
            {
                allDay: false,
                title: 'Rapat Pagi',
                description: 'description for Repeating Event',
                start: '2024-05-01T09:00:00',
                end: '2024-05-03T10:00:00'
            }
        ]
        });
        calendar.render();
      });

    </script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
        // set delay 10s
        var delay = 2000;
        
        $(window).on('load', function() {
            setTimeout(function(){
                $("#loading").hide();
                $(".loader").hide();
            },delay);
        });
    </script>
    

</body>

</html>