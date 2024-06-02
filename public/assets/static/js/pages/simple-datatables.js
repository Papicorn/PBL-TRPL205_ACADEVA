document.addEventListener('DOMContentLoaded', function () {
  // Inisialisasi DataTable untuk tabel dosen
  let dataTables = [];
  let tableElements = document.querySelectorAll('table[data-table]');

  tableElements.forEach((table, index) => {
    dataTables[index] = new simpleDatatables.DataTable(table, {
      // Opsi konfigurasi lainnya jika diperlukan
    });

    // Fungsi untuk menyesuaikan Bootstrap 5 untuk tabel
    function adaptPageDropdown(dataTable) {
      const selector = dataTable.wrapper.querySelector(".dataTable-selector");
      if (selector) {
        selector.parentNode.parentNode.insertBefore(selector, selector.parentNode);
        selector.classList.add("form-select");
      }
    }

    // Fungsi untuk menyesuaikan pagination Bootstrap 5 untuk tabel
    function adaptPagination(dataTable) {
      const paginations = dataTable.wrapper.querySelectorAll("ul.dataTable-pagination-list");

      for (const pagination of paginations) {
        pagination.classList.add(...["pagination", "pagination-primary"]);
      }

      const paginationLis = dataTable.wrapper.querySelectorAll("ul.dataTable-pagination-list li");

      for (const paginationLi of paginationLis) {
        paginationLi.classList.add("page-item");
      }

      const paginationLinks = dataTable.wrapper.querySelectorAll("ul.dataTable-pagination-list li a");

      for (const paginationLink of paginationLinks) {
        paginationLink.classList.add("page-link");
      }
    }

    // Patch untuk setiap tabel
    dataTables[index].on("datatable.init", () => {
      adaptPageDropdown(dataTables[index]);
      adaptPagination(dataTables[index]);
    });
    dataTables[index].on("datatable.update", () => adaptPagination(dataTables[index]));
    dataTables[index].on("datatable.sort", () => adaptPagination(dataTables[index]));
    dataTables[index].on("datatable.page", () => adaptPagination(dataTables[index]));
  });
});