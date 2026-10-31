document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('[data-table-search]').forEach(input => {
    input.addEventListener('input', () => {
      const q = input.value.toLocaleLowerCase('es');
      const table = input.closest('.panel').querySelector('tbody');
      table.querySelectorAll('tr').forEach(row => row.style.display = row.innerText.toLocaleLowerCase('es').includes(q) ? '' : 'none');
    });
  });
});
