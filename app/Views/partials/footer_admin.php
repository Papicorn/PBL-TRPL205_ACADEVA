<footer>
    <div class="footer clearfix mb-0 text-muted">
        <div class="float-start">
            <p>2024 &copy; Acadeva</p>
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
<script src="<?= base_url('/assets/extensions/simple-datatables/umd/simple-datatables.js') ?>"></script>
<script src="<?= base_url('/assets/static/js/pages/simple-datatables.js') ?>"></script>

    <!-- Popper.js from CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script>
    flatpickr("#timePicker", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i:S",
        time_24hr: true
    });

    document.getElementById('timeForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var time = document.getElementById('timePicker').value;
        console.log(time); // Output: HH:MM:SS
        this.submit();
    });

</script>
        <script>
        var delay = 500;
        
        $(window).on('load', function() {
            setTimeout(function(){
                $("#loading").hide();
                $(".loader").hide();
            },delay);
        });
    </script>
    <?php 
    if (session()->has('sweet')):
    // $errors = implode('<br>', array_map('esc', session('gagal')));
    ?>
    <script>
        Swal.fire({
            title: "<?= session()->get('sweet_text') ?>",
            icon: "<?= session()->get('sweet') ?>"
        });
    </script>
    <?php endif; ?>
    

</body>

</html>