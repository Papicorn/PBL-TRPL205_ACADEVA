<script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                height: 500,
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'title'
                },
                footerToolbar: {
                    center: 'dayGridMonth,dayGridWeek,dayGridDay'
                },
                events: [
                    <?php foreach($jadwal as $rowdatajadwal): ?>
                    {
                        allDay: false,
                        title: '<?= $rowdatajadwal['nama_matkul'] ?>',
                        description: '<?= $rowdatajadwal['nama_kelas'] ?>',
                        start: '<?= $rowdatajadwal['tanggal'] . "T" . $rowdatajadwal['waktu_mulai'] ?>',
                        end: '<?= $rowdatajadwal['tanggal'] . "T" . $rowdatajadwal['waktu_selesai'] ?>'
                    },
                    <?php endforeach; ?>
                ],
                eventDidMount: function(info) {
                    var startDate = new Date(info.event.start);
                    var endDate = new Date(info.event.end);
                    var options = { hour: '2-digit', minute: '2-digit' };

                    var tooltipContent = `
                        <div>
                            <strong>${info.event.title}</strong><br>
                            <strong>Kelas:</strong> ${info.event.extendedProps.description}<br>
                            <strong>Waktu:</strong> ${startDate.toLocaleString('id-ID', options)} - ${endDate.toLocaleString('id-ID', options)}
                        </div>
                    `;
                    var tooltip = new bootstrap.Tooltip(info.el, {
                        title: tooltipContent,
                        placement: 'top',
                        trigger: 'hover',
                        html: true
                    });
                }
            });
            
            calendar.render();
        });
    </script>