
<script>
var chartColors = {
  red: "rgb(255, 99, 132)",
  orange: "rgb(255, 159, 64)",
  yellow: "rgb(255, 205, 86)",
  green: "rgb(75, 192, 192)",
  info: "#41B1F9",
  blue: "#3245D1",
  purple: "rgb(153, 102, 255)",
  grey: "#EBEFF6",
  primary: "#142E53",
}

// 
var ctxBar = document.getElementById("bar").getContext("2d")
var myBar = new Chart(ctxBar, {
  type: "bar",
  data: {
    labels: [
      <?php foreach($matkul_diampu as $row): ?>
        "<?= $row['nama_matkul'] ?>",
      <?php endforeach; ?>
    ],
    datasets: [
      {
        label: "Mahasiswa (Sesi selesai)",
        backgroundColor: [
          chartColors.primary,
          chartColors.primary,
          chartColors.primary,
          chartColors.primary,
          chartColors.primary,
          chartColors.primary,
          chartColors.primary,
        ],
        data: [
                        <?php 
                        foreach ($matkul_diampu as $row) {
                            $nama_matkul = $row['nama_matkul'];
                            $jumlah = isset($rekap_diampu[$nama_matkul]) ? $rekap_diampu[$nama_matkul] : 0;
                            echo $jumlah . ',';
                        }
                        ?>
                    ],
      },
    ],
  },
  options: {
    responsive: true,
    barRoundness: 1,
    title: {
      display: true,
      text: "Mahasiwa",
    },
    legend: {
      display: false,
    },
    scales: {
      yAxes: [
        {
          ticks: {
            beginAtZero: true,
            suggestedMax: 40 + 20,
            padding: 10,
          },
          gridLines: {
            drawBorder: false,
          },
        },
      ],
      xAxes: [
        {
          gridLines: {
            display: false,
            drawBorder: false,
          },
        },
      ],
    },
  },
})

// let ctx1 = document.getElementById("canvas1").getContext("2d");
// let ctx2 = document.getElementById("canvas2").getContext("2d");
// let ctx3 = document.getElementById("canvas3").getContext("2d");
// let ctx4 = document.getElementById("canvas4").getContext("2d");
// var lineChart1 = new Chart(ctx1, config1);
// var lineChart2 = new Chart(ctx2, config2);
// var lineChart3 = new Chart(ctx3, config3);
// var lineChart4 = new Chart(ctx4, config4);

</script>