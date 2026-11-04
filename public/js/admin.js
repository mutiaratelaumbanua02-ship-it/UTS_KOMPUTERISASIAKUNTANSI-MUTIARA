document.addEventListener('DOMContentLoaded', function () {
  // Konfirmasi hapus (form)
  document.querySelectorAll('form[data-confirm]').forEach(function (f) {
    f.addEventListener('submit', function (e) { if (!confirm(f.dataset.confirm)) e.preventDefault(); });
  });
  // Konfirmasi logout (link)
  document.querySelectorAll('a[data-confirm-link]').forEach(function (a) {
    a.addEventListener('click', function (e) { if (!confirm(a.dataset.confirmLink)) e.preventDefault(); });
  });
  // Pencarian tabel langsung
  var search = document.getElementById('search');
  if (search) {
    search.addEventListener('input', function () {
      var q = search.value.toLowerCase();
      document.querySelectorAll('#data-table tbody tr').forEach(function (tr) {
        tr.style.display = tr.textContent.toLowerCase().includes(q) ? '' : 'none';
      });
    });
  }
  // Alert hilang otomatis
  document.querySelectorAll('[data-autohide]').forEach(function (a) {
    setTimeout(function () { a.style.opacity = 0; setTimeout(function () { a.remove(); }, 500); }, 3000);
  });
  // Pratinjau Rupiah
  var price = document.getElementById('price'), prev = document.getElementById('price-preview');
  if (price && prev) {
    var show = function () { prev.textContent = price.value ? 'Rp ' + Number(price.value).toLocaleString('id-ID') : ''; };
    price.addEventListener('input', show); show();
  }
  // Tampilkan/sembunyikan password
  var sp = document.getElementById('show-pass'), pw = document.getElementById('password');
  if (sp && pw) sp.addEventListener('change', function () { pw.type = sp.checked ? 'text' : 'password'; });
  // Menu sidebar di HP
  var mb = document.getElementById('menu-btn'), sb = document.getElementById('sidebar');
  if (mb && sb) mb.addEventListener('click', function () { sb.classList.toggle('open'); });
});
